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
	
	if (!defined('WI_LIB_PATH'))
		define('WI_LIB_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR . '../lib/');
	
	// suppose you have an autoload function that handles classes with names 
	// beginning with 'wi'
	function __autoload($class)
	{
		if (substr($class, 0, 2) == 'wi')
		{
			$file = substr($class, 2) . '.class.php';
			$file = realpath(dirname(__FILE__) . '/../lib/' . $file);
			if (file_exists($file))
				require_once($file);
		}
	}
	
	define('TEST_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);
	define('IMG_PATH', TEST_PATH . 'images' . DIRECTORY_SEPARATOR);
	
	class ImageTester extends UnitTestCase
	{
		function assertRGBWithinMargin($rec, $r, $g, $b, $a, $margin)
		{
			if (is_array($r))
			{
				$a = $r['alpha'];
				$b = $r['blue'];
				$g = $r['green'];
				$r = $r['red'];
			}
			
			$result = 
				abs($rec['red'] - $r) <= $margin && 
				abs($rec['green'] - $g) <= $margin && 
				abs($rec['blue'] - $b) <= $margin;
			
			$result = $result && ($a === null || abs($rec['alpha'] - $a) <= $margin);
			
			$this->assertTrue($result, 
				"RGBA [{$rec['red']}, {$rec['green']}, {$rec['blue']}, {$rec['alpha']}] " . 
				"doesn't match RGBA [$r, $g, $b, $a] within margin [$margin].");
		}
		
		function assertRGBNear($rec, $r, $g = null, $b = null, $a = null)
		{
			$this->assertRGBWithinMargin($rec, $r, $g, $b, $a, 2);
		}
		
		function assertRGBEqual($rec, $r, $g = null, $b = null, $a = null)
		{
			$this->assertRGBWithinMargin($rec, $r, $g, $b, $a, 0);
		}
	}
?>