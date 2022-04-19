
<?php
    session_start();

    if(!isset($_SESSION['zalogowany']))
    {
        header('Location:index.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Osadnicy- gra przeglądarkowa</title>
</head>
<body>
    
    <?php

    echo "<p>Witaj ".$_SESSION['user'].'! [<a href="logout.php">Wyloguj się</a>]</p>';
    echo "<p><b>Drewno</b>:".$_SESSION['drewno'];
    echo " | <b>Kamien</b>:".$_SESSION['kamien'];
    echo " | <b>Zboze</b>:".$_SESSION['zboze']."</p>";

    echo "<p><b>E-mail </b>:".$_SESSION['email'];
    echo "<br/><b>Data wygasniecia premium</b>: ".$_SESSION['dnipremium']."</p>";

    $dataczas = new Datetime('2017-01-01 9:30:15');

    echo "Data i czas serwera: ".$dataczas->format('Y-m-d H:i:s')."<br>";

    $koniec = Datetime::createFromFormat('Y-m-d H:i:s', $_SESSION['dnipremium']);

    $roznica = $dataczas->diff($koniec);

    if($dataczas<$koniec)
    echo "pozostało premoim: ".$roznica->format('%y lat, %m mies, %d dni, %h godz, %i min, %s sek');
    else 
    echo "premium nieaktywne od : ".$roznica->format('%y lat, %m mies, %d dni, %h godz, %i min, %s sek');


   

    ?>

   
</body>
</html>