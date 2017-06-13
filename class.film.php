<?php

require('class.baza.php');

class film
{
  public $naslov;
  public $godina;
  public $trajanje;
  public $slika;
  public $id_zanr;

  public function __construct($slovo)
  {
    $this->db = new baza();
    $this->naslov = array();
    $this->id_zanr = array();
    $this->godina = array();
    $this->trajanje = array();
    $this->slika = array();

    $res = $this->db->query("SELECT naslov, godina, trajanje, slika
                              FROM filmovi
                              WHERE filmovi.naslov LIKE '".$slovo."%'");

    while ($red = $res->fetch_array())
    {
      $this->naslov[] = $red['naslov'];
      $this->godina[] = $red['godina'];
      $this->trajanje[] = $red['trajanje'];
      $this->slika[] = $red['slika'];
    }
  }
}

//test
//$test = new film('H');
//var_dump($test);
