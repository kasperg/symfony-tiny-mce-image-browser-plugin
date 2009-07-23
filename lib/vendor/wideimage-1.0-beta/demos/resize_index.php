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
	
	html_header('Resize');
	
	$width = Request::getRegex('width', Registry::get('image dim regex'), null);
	$height = Request::getRegex('height', Registry::get('image dim regex'), null);
	
	if ($width == null && $height == null)
	{
		$width = 150;
		$height = '30%';
	}
?>

<form action="?" method="get">

<table>
	<tr>
		<td>
	Width: <input type="text" name="width" value="<?php echo $width; ?>" />
	Height: <input type="text" name="height" value="<?php echo $height; ?>" />
	Fit:
	<select name="fit">
<?php
	$fit = Request::getOption('fit', Registry::get('resize methods'), 'inside');
	foreach (Registry::get('resize methods') as $resize_method)
	{
		if ($resize_method == $fit)
			$sel = 'selected="selected"';
		else
			$sel = '';
		echo "<option {$sel} value=\"{$resize_method}\">{$resize_method}</option>\n";
	}
?>
	</select>
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
		
		$img_url = "resize.php?img={$image}&width={$width}&height={$height}&fit={$fit}";
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