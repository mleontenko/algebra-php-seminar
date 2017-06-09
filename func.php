<?php

function menu()
{
	$slova[] = "A";
	$slova[] = "B";
	$slova[] = "C";
	$slova[] = "Č";
	$slova[] = "Ć";
	$slova[] = "D";
	$slova[] = "Đ";
	$slova[] = "E";
	$slova[] = "F";
	$slova[] = "G";
	$slova[] = "H";
	$slova[] = "I";
	$slova[] = "J";
	$slova[] = "K";
	$slova[] = "L";
	$slova[] = "M";
	$slova[] = "N";
	$slova[] = "O";
	$slova[] = "P";
	$slova[] = "R";
	$slova[] = "S";
	$slova[] = "T";
	$slova[] = "U";
	$slova[] = "V";
	$slova[] = "Z";
	
	echo '|';
	foreach ( $slova as $slovo )
	{
		echo ' <a href="?s='.$slovo.'">'.$slovo.'</a> |';
	}
}

?>