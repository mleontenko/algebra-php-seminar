<!DOCTYPE html>
<html lang="hr">
  <head>
    <title>PHP seminar - index</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  </head>
  <body>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="index.php">PHP seminar</a>
        </div>
        <ul class="nav navbar-nav">
          <li class="active"><a href="index.php">Home</a></li>
          <li ><a href="unos.php">Unos</a></li>
        </ul>
      </div>
    </nav>
    <div class="container">
    <?php

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
                            $filmovi->trajanje[$key],
                            $filmovi->slika[$key]
                          );
      }
      foreach($tablica as $row)
      {
        echo '<br /><br />';
        echo '<table border=0>';
        echo '<tr><td><img src="'.$row[3].'" alt="slika" style="max-height:200px;"></img></td></tr>';
        echo '<tr><td>'.$row[0].' ('.$row[1].')</td></tr>';
        echo '<tr><td>'.$row[2].' min</td></tr>';
        echo '</table>';
      }

    }

     ?>
   </div>
  </body>
</html>
