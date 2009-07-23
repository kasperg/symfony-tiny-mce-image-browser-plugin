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
	
	html_header('Canvas');
	
	$angle = Request::getInt('angle', 30);
	$font_size = Request::getInt('font_size', 18);
?>

<form name="params" action="?" method="get">

<table>
	<tr>
		<td>
			Angle: <input type="text" name="angle" id="angle" value="<?php echo $angle; ?>" />
			<input type="button" value="+" onclick="document.getElementById('angle').value = document.getElementById('angle').value*1 + 10; document.params.submit();" />
			<input type="button" value="-" onclick="document.getElementById('angle').value = document.getElementById('angle').value*1 - 10; document.params.submit();" />
		</td>
		<td>
			Font size: <input type="text" name="font_size" id="font_size" value="<?php echo $font_size; ?>" />
			<input type="button" value="+" onclick="document.getElementById('font_size').value = document.getElementById('font_size').value*1 + 2; document.params.submit();" />
			<input type="button" value="-" onclick="document.getElementById('font_size').value = document.getElementById('font_size').value*1 - 2; document.params.submit();" />
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
		
		$img_url = "canvas.php?img={$image}&angle={$angle}&font_size={$font_size}";
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