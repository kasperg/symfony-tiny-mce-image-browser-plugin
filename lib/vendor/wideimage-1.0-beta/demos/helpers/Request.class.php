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
	
	class Request
	{
		protected static $vars = array();
		
		static function initialize()
		{
			self::$vars = $_REQUEST;
		}
		
		static function get($key, $default = null)
		{
			if (isset(self::$vars[$key]))
				return self::$vars[$key];
			else
				return $default;
		}
		
		static function getInt($key, $default = 0)
		{
			$value = self::get($key);
			if ($value !== null)
				return intval($value);
			else
				return $default;
		}
		
		static function getOption($key, $valid = array(), $default = null)
		{
			$value = self::get($key);
			if ($value !== null && in_array($value, $valid))
				return strval($value);
			else
				return $default;
		}
		
		static function getRegex($key, $regex, $default = null)
		{
			$value = self::get($key);
			if ($value !== null && preg_match($regex, $value))
				return $value;
			else
				return $default;
		}
	}
?>