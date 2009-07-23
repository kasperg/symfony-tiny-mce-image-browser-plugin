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
	
	class ResizeTest extends ImageTester
	{
		function testResizeFill()
		{
			$img = wiImage::load(IMG_PATH . '100x100-color-hole.gif');
			$resized = $img->resize(50, 20, 'fill');
			$this->assertTrue($resized instanceof wiTrueColorImage);
			$this->assertTrue($resized->isTransparent());
			$this->assertEqual(50, $resized->getWidth());
			$this->assertEqual(20, $resized->getHeight());
			$this->assertRGBEqual($resized->getRGBAt(5, 5), 255, 255, 0);
			$this->assertRGBEqual($resized->getRGBAt(45, 5), 0, 0, 255);
			$this->assertRGBEqual($resized->getRGBAt(45, 15), 0, 255, 0);
			$this->assertRGBEqual($resized->getRGBAt(5, 15), 255, 0, 0);
			
			$this->assertRGBEqual($resized->getRGBAt(25, 10), 255, 255, 255);
			$this->assertRGBEqual($img->getTransparentColorRGB(), 255, 255, 255);
		}
		
		function testResizeInside()
		{
			$img = wiImage::load(IMG_PATH . '100x100-color-hole.gif');
			$resized = $img->resize(50, 20, 'inside');
			$this->assertTrue($resized instanceof wiTrueColorImage);
			$this->assertTrue($resized->isTransparent());
			$this->assertEqual(20, $resized->getWidth());
			$this->assertEqual(20, $resized->getHeight());
			/*
			$this->assertRGBEqual($resized->getRGBAt(5, 5), 255, 255, 0);
			$this->assertRGBEqual($resized->getRGBAt(45, 5), 0, 0, 255);
			$this->assertRGBEqual($resized->getRGBAt(45, 15), 0, 255, 0);
			$this->assertRGBEqual($resized->getRGBAt(5, 15), 255, 0, 0);
			$this->assertRGBEqual($resized->getRGBAt(25, 10), 255, 255, 255);
			$this->assertRGBEqual($img->getTransparentColorRGB(), 255, 255, 255);
			*/
		}
	}
?>