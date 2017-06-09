<?php

class htmlTable
{
	public function ispisi($dataArray)
	{
		echo '<table border=1>';
		foreach ($dataArray as $row)
		{
			echo '<tr>';
			
			foreach ($row as $cell)
			{
				echo "<td>" . $cell . "</td>";			
			}
			
			echo '</tr>';
		}
		echo '</table>';
	}
}

?>