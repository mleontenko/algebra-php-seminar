<?php

require ('class.baza.php');

class zanr
{
  public $id;
  public $naziv;

  public function __construct()
  {
    $this->db = new baza();
    $this->id = array();
    $this->naziv = array();

    $res = $this->db->query("SELECT id, naziv FROM zanr");

    while ($red = $res->fetch_array())
    {
      $this->id[] = $red['id'];
      $this->naziv[] = $red['naziv'];
    }
  }
}

//test
//$test = new zanr();
//var_dump($test);

?>
