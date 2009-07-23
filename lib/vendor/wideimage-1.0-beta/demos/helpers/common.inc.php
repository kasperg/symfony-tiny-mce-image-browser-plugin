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
	
	define('WI_DEMO_PATH', realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..') . DIRECTORY_SEPARATOR);
	define('WI_IMG_PATH', WI_DEMO_PATH . 'images' . DIRECTORY_SEPARATOR);
	
	require_once(dirname(__FILE__) . '/../config.php');
	require_once($wideimage_inc_path . '/WideImage.inc.php');
	
	require_once(WI_DEMO_PATH . 'helpers/Request.class.php');
	Request::initialize();
	
	require_once(WI_DEMO_PATH . 'helpers/Registry.class.php');
	
	// common
	Registry::set('image formats', array('jpg', 'png', 'gif'));
	Registry::set('images', array('rainbow.png', 'fgnl.jpg', 'color-hole.gif', 'bg03.jpg', 'blue-alpha.png', 'mask-smiley.gif'));
	Registry::set('colors', array('16', '128', '256', 'truecolor'));
	
	// resize
	Registry::set('resize methods', array('inside', 'fill', 'outside'));
	Registry::set('image dim regex', '/^[0-9]{1,}[\%]?$/');
	
	
	function img_header($format)
	{
		header('Pragma: no-cache');
		
		if (Registry::get('debug') == 'text')
			header('Content-type: text/plain');
		elseif (Registry::get('debug') == 'html')
			header('Content-type: text/html');
		else
			header('Content-type: image/' . $format);
	}
	
	function html_header($title)
	{
		$html = <<<HTML
<html>
	<head>
			<title>{$title}</title>

<style>
	body
	{
		background-color: #f0f0f0;
		background-image: url("images/bg.gif");
		background-attachment: fixed;
	}
	
	img { border-width: 0px; }
	div.frame { }
	div.frame img
	{
		border: 1px dashed red;
	}

	td { border-bottom: 1px solid grey; padding: 10px; }
	td.left { text-align: left }
	td.right { text-align: right }
	
	p.navbar a
	{
		color: black;
	}

	p.navbar a:visited
	{
		color: gray;
	}
</style>

	</head>

	<body>
		<p class="navbar">
			<strong>WideImage demos</strong>
			(these demos are for visual demonstration only, source code is far 
			too complicated to learn correctly from it)
			<br />
			
			<a href="asGrayscale_index.php">asGrayscale</a>
			<a href="asNegative_index.php">asNegative</a>
			<a href="getMask_index.php">getMask</a>
			<a href="getChannels_index.php">getChannels</a>
			
			<a href="applyMask_index.php">applyMask</a>
			<a href="applyFilter_index.php">applyFilter</a>
			<a href="merge_index.php">merge</a>
			
			<a href="crop_index.php">crop</a>
			<a href="resize_index.php">resize</a>
			<a href="rotate_index.php">rotate</a>
			<a href="mirror_index.php">mirror</a>
			<a href="flip_index.php">flip</a>

			<a href="canvas_index.php">canvas</a>
		</p>
HTML;
	echo $html;
	}
?>
