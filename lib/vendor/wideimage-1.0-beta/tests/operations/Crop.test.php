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
	
	class CropTest extends ImageTester
	{
		function testCropTransparentGif()
		{
			$img = wiImage::load(IMG_PATH . '100x100-color-hole.gif');
			
			$cropped = $img->crop('10%', 15, 50, '40%');
			
			$this->assertTrue($cropped instanceof wiTrueColorImage);
			$this->assertTrue($cropped->isTransparent());
			$this->assertEqual(50, $cropped->getWidth());
			$this->assertEqual(40, $cropped->getHeight());
			
			$this->assertRGBNear($cropped->getRGBAt(39, 9), 255, 255, 0);
			$this->assertRGBNear($cropped->getRGBAt(40, 9), 0, 0, 255);
			$this->assertRGBNear($cropped->getRGBAt(14, 35), 255, 0, 0);
			$this->assertRGBNear($cropped->getRGBAt(16, 11), $cropped->getTransparentColorRGB());
		}
		
		function testCropPNGAlpha()
		{
			$img = wiImage::load(IMG_PATH . '100x100-blue-alpha.png');
			
			$cropped = $img->crop(10, 10, 50, 50);
			
			$this->assertTrue($cropped instanceof wiTrueColorImage);
			$this->assertFalse($cropped->isTransparent());
			$this->assertEqual(50, $cropped->getWidth());
			$this->assertEqual(50, $cropped->getHeight());
			
			$this->assertRGBNear($cropped->getRGBAt(39, 39), 0, 0, 255, 32);
			$this->assertRGBNear($cropped->getRGBAt(40, 40), 0, 0, 255, 96);
		}
	}
?>