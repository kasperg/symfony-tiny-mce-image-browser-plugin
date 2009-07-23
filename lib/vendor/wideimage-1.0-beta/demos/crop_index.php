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
	
	html_header('Crop');
	
	$left = Request::getRegex('left', Registry::get('image dim regex'), '10%');
	$top = Request::getRegex('top', Registry::get('image dim regex'), 15);
	$width = Request::getRegex('width', Registry::get('image dim regex'), 50);
	$height = Request::getRegex('height', Registry::get('image dim regex'), '40%');
?>

<form action="?" method="get">

<table>
	<tr>
		<td>
	Left: <input type="text" name="left" value="<?php echo $left; ?>" />
	Top: <input type="text" name="top" value="<?php echo $top; ?>" />
	Width: <input type="text" name="width" value="<?php echo $width; ?>" />
	Height: <input type="text" name="height" value="<?php echo $height; ?>" />
		</td>
		<td>
			<input type="submit" value="show" />
		</td>
	</tr>
</table>

</form>

<table>
<?php
	$i = 0;
	foreach (Registry::get('images') as $image)
	{
		if ($i % 2 == 0)
		{
			if ($i > 0)
				echo "\n</tr>\n";
			echo "<tr>\n";
		}
		$i++;
		
		$img_url = "crop.php?img={$image}&left={$left}&top={$top}&width={$width}&height={$height}";
?>
		<td class="right">
			<img src="images/<?php echo $image; ?>" />
		</td>
		<td class="left">
			<div class="frame">
			<a href="<?php echo $img_url; ?>"><img src="<?php echo $img_url; ?>" /></a>
			</div>
		</td>
<?php
	}
?>
	</tr>
</table>

		

	</body>
</html>