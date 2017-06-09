<html lang="hr">
  <head>
    <title>PHP seminar - unos</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  </head>
  <body>

    <form method="post" action="" enctype="multipart/form-data">
      Naslov:<input type="text" name="naslov">
      <br />
      Zanr:<select name="zanr">
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
      Godina: <input type="text" name="godina">
      <br />
      Trajanje:<input type="text" name="trajanje">
      <br />
      Slika: <input type="file" name="datoteka" value="">
      <br />
      <input type="submit" name="gumb" value="Submit">
    </form>

    <?php

    if (isset($_POST["btn_brisi"]))
    {
      $id_del = $_POST["btn_brisi"];
      $conn_del = new baza();
      $sql_del = "DELETE FROM filmovi WHERE id = $id_del";
      $result = $conn_del->query($sql_del);
      $conn_del->close();
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

      if (move_uploaded_file($_FILES['datoteka']['tmp_name'], $new_file_name))
      {
        echo 'Slika uspješno dodana';
        echo '<br /><br />';
        //var_dump($new_file_name);
        echo '<br /><br />';
      }
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
        echo 'Novi zapis uspješno dodan';
        echo '<br />';
      } else {
        echo 'Dodavanje zapisa nije uspjelo';
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
      echo '<table border="1">';
      while($row = $result->fetch_assoc())
      {
        echo '<tr>';
        echo '<td><img src="'.$row['slika'].'" alt="slika" style="max-width:100px;"></td><td>'.$row['naslov'].'</td><td>'.$row['godina'].'</td>
              <td>'.$row['trajanje'].'</td><td><form method="POST" action=""><button type="submit" name="btn_brisi" value="'.$row['id'].'">Obriši</button></form></td>';
        echo '</tr>';
      }
      echo '</table>';
    }

    ?>


  </body>
</html>
