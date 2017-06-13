<html lang="hr">
  <head>
    <title>PHP seminar - unos</title>
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
          <li><a href="index.php">Home</a></li>
          <li class="active"><a href="unos.php">Unos</a></li>
        </ul>
      </div>
    </nav>
    <div class="container">
    <form method="post" action="" enctype="multipart/form-data">
      <div class="form-group">
      Naslov:<input type="text" name="naslov" class="form-control">
      <br />
      Zanr:<select name="zanr" class="form-control">
        <?php
        //Popunjavanje padajuceg izbornika sa popisom zanrova
        require('class.zanr.php');

        $zanrovi = new zanr();

        foreach ( $zanrovi->id as $key=>$zanr)
        {
          $zanrNaziv = $zanrovi->naziv[$key];
          $zanrId = $zanrovi->id[$key];
          echo "<option value=".$zanrId." >".$zanrNaziv."</option>";
        }

        ?>
      </select>
      <br />
      Godina: <select name="godina" class="form-control">
        <option value="1990">1990</option>
        <option value="1991">1991</option>
        <option value="1992">1992</option>
        <option value="1993">1993</option>
        <option value="1994">1994</option>
        <option value="1995">1995</option>
        <option value="1996">1996</option>
        <option value="1997">1997</option>
        <option value="1998">1998</option>
        <option value="1999">1999</option>
        <option value="2000">2000</option>
        <option value="2001">2001</option>
        <option value="2002">2002</option>
        <option value="2003">2003</option>
        <option value="2004">2004</option>
        <option value="2005">2005</option>
        <option value="2006">2006</option>
        <option value="2007">2007</option>
        <option value="2008">2008</option>
        <option value="2009">2009</option>
        <option value="2010">2010</option>
        <option value="2011">2011</option>
        <option value="2012">2012</option>
        <option value="2013">2013</option>
        <option value="2014">2014</option>
        <option value="2015">2015</option>
        <option value="2016">2016</option>
        <option value="2017">2017</option>
      </select>
      <br />
      Trajanje:<input type="text" name="trajanje" class="form-control">
      <br />
      Slika: <input type="file" name="datoteka" value="" class="btn btn-default btn-file">
      <br />
      <input type="submit" name="gumb" value="Submit" class="btn btn-default">
    </div>
    </form>
    <br /><br />

    <?php

    if (isset($_POST["btn_brisi"]))
    {
      $id_del = $_POST["btn_brisi"];
      $conn_del = new baza();
      $sql_del = "DELETE FROM filmovi WHERE id = $id_del";
      $result = $conn_del->query($sql_del);
      $conn_del->close();

      //brisanje slike
      $path = $_POST["slika_brisi"];
      if(unlink($path)) echo '<div class="alert alert-danger">
  <strong>Film obrisan!</strong></div>';
    }

    if (isset ($_REQUEST['gumb']))
    {
      //upload datoteke
      $uploaddir ='PHP_seminarski_rad_img/';
      $uploadfile = basename($_FILES['datoteka']['name']);

      $file_array = explode(".", $uploadfile);
      $file_ext = end($file_array);

      $file_onserver = "file_".time().".".$file_ext;

      $new_file_name = $uploaddir.$file_onserver;

      move_uploaded_file($_FILES['datoteka']['tmp_name'], $new_file_name);

      $naslov = $_REQUEST['naslov'];
      $zanr = $_REQUEST['zanr'];
      $godina = $_REQUEST['godina'];
      $trajanje = $_REQUEST['trajanje'];
      //var_dump($_REQUEST);
      $conn = new baza();
      $sql = "INSERT INTO filmovi (naslov, id_zanr, godina, trajanje, slika)
              VALUES ('".$naslov."', '".$zanr."', '".$godina."', '".$trajanje."', '".$new_file_name."')
              ";
      if($conn->query($sql) === TRUE)
      {
        echo '<div class="alert alert-success">
  <strong>Novi zapis uspješno dodan!</strong>
</div>';
        echo '<br />';
      } else {
        echo '<div class="alert alert-danger">
  <strong>Dodavanje zapisa nije uspjelo!</strong>
</div>';
      }

      $conn->close();
    }

    //Prikaz svih filmova iz baze
    $conn_get = new baza();
    $sql_get = "SELECT slika, naslov, godina, trajanje, id FROM filmovi
                ORDER BY naslov";
    $result = $conn_get->query($sql_get);
    if ($result->num_rows > 0)
    {
      echo '<table border="1" class="table-condensed">';
      echo '<tbody>';
      echo '<tr><th>Slika</th><th>Naslov</th><th>Godina</th><th>Trajanje</th><th>Akcija</th></tr>';
      while($row = $result->fetch_assoc())
      {
        echo '<tr>';
        echo '<td><img src="'.$row['slika'].'" alt="slika" style="max-width:100px;"></td><td>'.$row['naslov'].'</td><td>'.$row['godina'].'</td>
              <td>'.$row['trajanje'].' min</td><td><form method="POST" action=""><button type="submit" name="btn_brisi" value="'.$row['id'].'">Obriši</button>
              <input type=hidden name=slika_brisi value="'.$row['slika'].'" value="value1"></form></td>';
        echo '</tr>';
      }
      echo '</tbody>';
      echo '</table>';
    }

    ?>
    <br /><br /><br />
  </div>
  </body>
</html>
