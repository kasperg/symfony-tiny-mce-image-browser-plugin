<?php
	/**
    This file is part of WideImage.
		
    WideImage is free software; you can redistribute it and/or modify
    it under the terms of the GNU Lesser General Public License as published by
    the Free Software Foundation; either version 2.1 of the License, or
    (at your option) any later version.
		
    WideImage is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU Lesser General Public License for more details.
		
    You should have received a copy of the GNU Lesser General Public License
    along with WideImage; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
  **/
	
	class wioCustomOp
	{
		static public $args = null;
		
		function execute()
		{
			self::$args = func_get_args();
			return self::$args[0]->copy();
		}
	}
	
	class wiImageFileMapper_FOO
	{
		public static $calls = array();
		public static $handle = null;
		
		function load()
		{
			self::$calls['load'] = func_get_args();
			return self::$handle;
		}
		
		function save($image, $uri = null)
		{
			self::$calls['save'] = func_get_args();
			if ($uri == null)
				echo 'out';
		}
	}
	
	class ImageTest extends ImageTester
	{
		function testLoadFromFile()
		{
			$img = wiImage::load(IMG_PATH . '100x100-red-transparent.gif');
			$this->assertTrue($img instanceof wiPaletteImage);
			$this->assertTrue($img->isValid());
			$this->assertFalse($img->isTrueColor());
			$this->assertTrue(100, $img->getWidth());
			$this->assertTrue(100, $img->getHeight());
			
			$img = wiImage::load(IMG_PATH . '100x100-rainbow.png');
			$this->assertTrue($img instanceof wiTrueColorImage);
			$this->assertTrue($img->isValid());
			$this->assertTrue($img->isTrueColor());
			$this->assertTrue(100, $img->getWidth());
			$this->assertTrue(100, $img->getHeight());
		}
		
		function testLoadFromString()
		{
			$img = wiImage::load(file_get_contents(IMG_PATH . '100x100-rainbow.png'));
			$this->assertTrue($img instanceof wiTrueColorImage);
			$this->assertTrue($img->isValid());
			$this->assertTrue($img->isTrueColor());
			$this->assertTrue(100, $img->getWidth());
			$this->assertTrue(100, $img->getHeight());
		}
		
		function testLoadFromHandle()
		{
			$handle = imagecreatefrompng(IMG_PATH . '100x100-rainbow.png');
			$img = wiImage::loadFromHandle($handle);
			$this->assertTrue($img->isValid());
			$this->assertTrue($img->isTrueColor());
			$this->assertTrue($handle === $img->getHandle());
			$this->assertTrue(100, $img->getWidth());
			$this->assertTrue(100, $img->getHeight());
			unset($img);
			$this->assertFalse(wiImage::isValidImageHandle($handle));
		}
		
		function testLoadMagical()
		{
			// from a handle
			$img = wiImage::load(imagecreatefrompng(IMG_PATH . '100x100-rainbow.png'));
			$this->assertTrue($img->isValid());
			
			// from binary string
			$img = wiImage::load(file_get_contents(IMG_PATH . '100x100-rainbow.png'));
			$this->assertTrue($img->isValid());
			
			// from a file
			$img = wiImage::load(IMG_PATH . '100x100-rainbow.png');
			$this->assertTrue($img->isValid());
		}
		
		function testLoadingByExtensionHint()
		{
			$img = wiImage::load(IMG_PATH . 'actually-a-png.jpg', 'png');
			$this->assertTrue($img->isValid());
		}
		
		function testLoadingByMimeTypeHint()
		{
			$img = wiImage::load(IMG_PATH . 'actually-a-png.jpg', 'image/png');
			$this->assertTrue($img->isValid());
		}
		
		function testDestructor()
		{
			Mock::generatePartial(
				'wiTrueColorImage',
				'MockImage',
				array('__destruct')
				);
			
			$img = new MockImage();
			$img->expectOnce('__destruct');
			unset($img);
		}
		
		function testAutoDestruct()
		{
			$img = wiTrueColorImage::create(10, 10);
			$handle = $img->getHandle();
			
			unset($img);
			
			$this->assertFalse(wiImage::isValidImageHandle($handle));
		}
		
		function testAutoDestructWithRelease()
		{
			$img = wiTrueColorImage::create(10, 10);
			$handle = $img->getHandle();
			
			$img->releaseHandle();
			unset($img);
			
			$this->assertTrue(wiImage::isValidImageHandle($handle));
			imagedestroy($handle);
		}
		
		function testCustomOpMagic()
		{
			$img = wiTrueColorImage::create(10, 10);
			$result = $img->customOp(123, 'abc');
			$this->assertTrue($result instanceof wiImage);
			$this->assertIdentical(wioCustomOp::$args[0], $img);
			$this->assertIdentical(wioCustomOp::$args[1], 123);
			$this->assertIdentical(wioCustomOp::$args[2], 'abc');
		}
		
		function testSaveOverrideFormat()
		{
			$uri = IMG_PATH . 'temp/test.gif';
			
			$img = wiTrueColorImage::create(10, 10);
			$img->saveToFile($uri, 'png');
			
			try
			{
				$img = @wiImage::load($uri);
				$this->fail("Exception expected");
			}
			catch (wiInvalidImageSourceException $e)
			{
				$this->pass();
			}
			
			$img = wiImage::load($uri, 'png');
			$this->assertTrue(10, $img->getWidth());
			$this->assertTrue(10, $img->getHeight());
			
			unlink($uri);
		}
		
		function testMapperLoad()
		{
			wiImageFileMapper_FOO::$handle = imagecreate(10, 10);
			$img = wiImage::load('image.foo');
			$this->assertEqual(wiImageFileMapper_FOO::$calls['load'], array('image.foo'));
			imagedestroy(wiImageFileMapper_FOO::$handle);
		}
		
		function testMapperSaveToFile()
		{
			$img = wiImage::load(IMG_PATH . 'fgnl.jpg');
			$img->saveToFile('test.foo', null, '123', 789);
			$this->assertEqual(wiImageFileMapper_FOO::$calls['save'], array($img->getHandle(), 'test.foo', '123', 789));
		}
		
		function testMapperAsString()
		{
			$img = wiImage::load(IMG_PATH . 'fgnl.jpg');
			$str = $img->asString('foo', '123', 789);
			$this->assertEqual(wiImageFileMapper_FOO::$calls['save'], array($img->getHandle(), null, '123', 789));
			$this->assertEqual('out', $str);
		}
		
		function testCanvasInstance()
		{
			$img = wiImage::load(IMG_PATH . 'fgnl.jpg');
			$canvas1 = $img->getCanvas();
			$this->assertTrue($canvas1 instanceof wiCanvas);
			$canvas2 = $img->getCanvas();
			$this->assertTrue($canvas1 === $canvas2);
		}
	}
?>