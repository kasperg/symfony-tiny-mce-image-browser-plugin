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
	
	html_header('Apply filter');
	
	$filters = array(
		'IMG_FILTER_NEGATE', 
		'IMG_FILTER_GRAYSCALE', 
		'IMG_FILTER_BRIGHTNESS', 
		'IMG_FILTER_CONTRAST',
		'IMG_FILTER_COLORIZE',
		'IMG_FILTER_EDGEDETECT',
		'IMG_FILTER_EMBOSS',
		'IMG_FILTER_GAUSSIAN_BLUR',
		'IMG_FILTER_SELECTIVE_BLUR',
		'IMG_FILTER_MEAN_REMOVAL',
		'IMG_FILTER_SMOOTH');
	
	$filter = Request::getOption('filter', $filters, $filters[0]);
	$arg1 = Request::getInt('arg1', null);
	$arg2 = Request::getInt('arg2', null);
	$arg3 = Request::getInt('arg3', null);
?>

<form action="?" method="get">

<table>
	<tr>
		<td>
			filter: <select name="filter">
<?php
	foreach ($filters as $filter_opt)
	{
		if ($filter_opt == $filter)
			$sel = 'selected="selected"';
		else
			$sel = '';
		
		echo "<option $sel value=\"{$filter_opt}\">{$filter_opt}</option>\n";
	}
?>
			</select>
			arg1: <input size="5" type="text" name="arg1" value="<?php echo $arg1; ?>" />
			arg2: <input size="5" type="text" name="arg2" value="<?php echo $arg2; ?>" />
			arg3: <input size="5" type="text" name="arg3" value="<?php echo $arg3; ?>" />
		</td>
		<td>
			<input type="submit" value="show" />
		</td>
	</tr>
</table>
Note: Filter outputs are all alpha transparent PNGs.
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
		
		$img_url = "applyFilter.php?img={$image}&filter={$filter}&arg1={$arg1}&arg2={$arg2}&arg3={$arg3}";
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