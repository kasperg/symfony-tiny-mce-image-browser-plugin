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
	
	html_header('Merge');
	
	$pct = Request::getInt('pct', 50);
	if ($pct < 0)
		$pct = 0;
	if ($pct > 100)
		$pct = 100;
	
	$overlay = Request::getOption('overlay', Registry::get('images'), 'color-hole.gif');
?>

<form name="params" action="?" method="get">

<table>
	<tr>
		<td>
			Percent: <input type="text" name="pct" id="pct" value="<?php echo $pct; ?>" />
			<input type="button" value="+" onclick="document.getElementById('pct').value = document.getElementById('pct').value*1 + 5; document.params.submit();" />
			<input type="button" value="-" onclick="document.getElementById('pct').value = document.getElementById('pct').value*1 - 5; document.params.submit();" />
			
			Overlay:
			<select name="overlay" onchange="document.params.submit();">
<?php
	foreach (Registry::get('images') as $image)
	{
		if ($image == $overlay)
			$sel = 'selected="selected"';
		else
			$sel = '';
		
		echo "<option {$sel} value=\"{$image}\">{$image}</option>\n";
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
		
		$img_url = "merge.php?img={$image}&overlay={$overlay}&pct={$pct}";
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