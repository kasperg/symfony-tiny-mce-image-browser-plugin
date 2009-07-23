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
	
	html_header('Apply Mask');
	
	$masks = array('diagonal', 'circle', 'smiley');
	$mask = Request::getOption('mask', $masks,'diagonal');
	$left = Request::getInt('left');
	$top = Request::getInt('top');
?>

<form action="?" method="get">

<table>
	<tr>
		<td>
			<select name="mask">
<?php
	foreach ($masks as $mask_opt)
	{
		if ($mask_opt == $mask)
			$sel = 'selected="selected"';
		else
			$sel = '';
		
		echo "<option $sel value=\"{$mask_opt}\">{$mask_opt}</option>\n";
	}
?>
			</select>
		</td>
		<td>
			<img src="images/mask-<?php echo $mask; ?>.gif" />
		</td>
		<td>
			left: <input type="text" name="left" value="<?php echo $left; ?>" />
			<br />
			top: <input type="text" name="top" value="<?php echo $top; ?>" />
		</td>
		<td>
			<input type="submit" value="show" />
		</td>
	</tr>
</table>
Note: Mask outputs are all alpha transparent PNGs.
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
		
		$img_url = "applyMask.php?img={$image}&mask={$mask}&left={$left}&top={$top}";
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