<?php

define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_DBASE", "kolekcija");


class baza extends mysqli
{
	public function __construct($baza = DB_DBASE)
	{
		parent::__construct(DB_HOST, DB_USER, DB_PASS, $baza);
		$this->set_charset('utf8');
	}
}

?>
