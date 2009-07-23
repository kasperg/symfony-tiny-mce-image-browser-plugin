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
	
	class DimensionTest extends UnitTestCase
	{
		function testIsPercent()
		{
			$this->assertTrue(wiDimension::isPercent('13%'));
			$this->assertTrue(wiDimension::isPercent('113%'));
			$this->assertTrue(wiDimension::isPercent('1.23%'));
			
			$this->assertFalse(wiDimension::isPercent('.23%'));
			$this->assertFalse(wiDimension::isPercent('1,23%'));
			$this->assertFalse(wiDimension::isPercent('11,a a 3%'));
		}
		
		function testCalculateRelativeDimension()
		{
			$this->assertIdentical(10, wiDimension::calculateRelativeDimension(100, '10%'));
			$this->assertIdentical(-1, wiDimension::calculateRelativeDimension(-20, '5%'));
		}
		
		function testFix()
		{
			$this->assertIdentical(10, wiDimension::fix(100, '10%'));
			$this->assertIdentical(10, wiDimension::fix(100, '10'));
			
			$this->assertIdentical(300, wiDimension::fix(200, '150%'));
			$this->assertIdentical(150, wiDimension::fix(200, '150'));
		}
	}
?>