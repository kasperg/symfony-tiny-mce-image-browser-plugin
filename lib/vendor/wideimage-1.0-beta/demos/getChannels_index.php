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
	
	html_header('Get channels');
	
	$chans = array('R' => false, 'G' => false, 'B' => false, 'A' => false);
	foreach ($chans as $chan => $value)
		$chans[$chan] = Request::getInt($chan, false);
?>

<form action="?" method="get">

<table>
	<tr>
		<td>
			channels:
<?php
	foreach ($chans as $chan => $value)
	{
		if ($value)
			$chk = 'checked="checked"';
		else
			$chk = '';
		
		echo "<input $chk name=\"$chan\" value=\"1\" type=\"checkbox\" /> {$chan}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ";
	}
?>
		</td>
		<td>
			<input type="submit" value="show" />
		</td>
	</tr>
</table>
Note: Channel outputs are all PNGs.
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
		
		$img_url = "getChannels.php?img={$image}&R={$chans['R']}&G={$chans['G']}&B={$chans['B']}&A={$chans['A']}";
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