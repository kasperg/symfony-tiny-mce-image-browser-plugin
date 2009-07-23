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
	$angle = Request::getInt('angle', 0);
	$font_size = Request::getInt('font_size', 20);
	
	$canvas = $img->getCanvas();
	
	$canvas->setFont(new wiFont_TTF('arial', $font_size, $img->allocateColor(0, 0, 0)));
	$canvas->writeText(11, 51, 'Hello world!', $angle);
	
	$canvas->setFont(new wiFont_TTF('arial', $font_size, $img->allocateColor(200, 220, 255)));
	$canvas->writeText(10, 50, 'Hello world!', $angle);
	
	$format = substr(Request::get('img'), -3);
	img_header($format);
	echo $img->asString($format);
?>