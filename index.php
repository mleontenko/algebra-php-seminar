<!DOCTYPE html>
<html lang="hr">
  <head>
    <title>PHP seminar - index</title>
    <meta charset="utf-8">
  </head>
  <body>
    <?php

    require('class.htmltable.php');
    require('class.film.php');
    require('func.php');

    //funkcija koja ispisuje Izbornik sa slovima
    menu();

    //provjera da li je kliknuto slovo
    if ( isset($_REQUEST['s']) )
    {
      $filmovi = new film ($_REQUEST['s']);
      $tablica =  array();
      //var_dump($filmovi);

      foreach ( $filmovi->naslov as $key=>$film)
      {
        $tablica[] = array(
                            $filmovi->naslov[$key],
                            $filmovi->godina[$key],
                            $filmovi->trajanje[$key]
                          );
      }

      //ispis tablice
      $tbl = new htmltable();
      $tbl->ispisi($tablica);
    }

     ?>
  </body>
</html>
