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
	
	require_once(dirname(__FILE__) . '/helpers/common.inc.php');
	
	//Registry::set('debug', 'text');
	
	$img = wiImage::load(WI_IMG_PATH . Request::get('img'));
	$left = Request::getRegex('left', Registry::get('image dim regex'));
	$top = Request::getRegex('top', Registry::get('image dim regex'));
	$width = Request::getRegex('width', Registry::get('image dim regex'));
	$height = Request::getRegex('height', Registry::get('image dim regex'));
	
	$result = $img->crop($left, $top, $width, $height);
	
	$format = substr(Request::get('img'), -3);
	img_header($format);
	echo $result->asString($format);
?>