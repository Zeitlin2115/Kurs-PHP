 <?php
    session_start();

    if (isset($_POST['email'])) 
    {

        //Udana walidacja

        $wszystko_ok=true;


        //sprawdz ncik

        $nick=$_POST['nick'];


        //sprawdzenie dlugosci nicku

        if ((strlen($nick)<3) || (strlen($nick)>20)) 
        {
            $wszystko_ok=false;
            $_SESSION['e_nick']="Nick musi posiadac od 3 do 20 znakow";
        }

        if (ctype_alnum($nick)==false) 
        {
            $wszystko_ok=false;
            $_SESSION['e_nick']="Nick moze skaldac sie tylko z liter i cyfr";
        }


        //sprawdz poprawnosc adsresu email

        $email=$_POST['email'];
        $emailB=filter_var($email,FILTER_SANITIZE_EMAIL);

       if ((filter_var($emailB,FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email))
       {
         $wszystko_ok=false;
         $_SESSION['e_email']="Podaj poprawny adres email";
       }


       //sprawdz poprawnosc hasel

       $haslo1=$_POST['haslo1'];
       $haslo2=$_POST['haslo2'];

       if((strlen($haslo1)<8)||(strlen($haslo1)>20))
       {
            $wszystko_ok=false;
            $_SESSION['e_haslo']="Haslo musi posiadac min 8 znakow do 20 znakow";

       }

       if($haslo1!=$haslo2)
        {
            $wszystko_ok=false;
            $_SESSION['e_haslo']="Podane hasla nie sa identyczne";

       }

       $haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT); 


       //czy zaakceptowano rwgulamin?
       if(!isset($_POST['regulamin']))
       {
        $wszystko_ok=false;
        $_SESSION['e_regulamin']="Potwierdz akceptacje regulaminu";
       }


       //Bot or not?
       $sekret="6LeJ93YfAAAAAGV90Rw7DBI9RKzEPfr3lb23trwX";

       $sprawdz = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$sekret.'&response='.$_POST['g-recaptcha-response']);

       $odpowiedz= json_decode($sprawdz);

       if($odpowiedz->success==false)
       {
        $wszystko_ok=false;
        $_SESSION['e_bot']="Potwierdz ze  nie jestes botem";

       }

       //zapamietaj wprowadzone dane
        $_SESSION['fr_nick']=$nick;
        $_SESSION['fr_email']=$email;
        $_SESSION['fr_haslo1']=$haslo1;
        $_SESSION['fr_haslo2']=$haslo2;
        if (isset($_POST['regulamin'])) $_SESSION['fr_regulamin'] = true;

       require_once "connect.php";
       mysqli_report(MYSQLI_REPORT_STRICT);

       try
       {
        $polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
        if($polaczenie->connect_errno!=0)
                {
                    throw new Exception(mysqli_connect_errno());
                }
                else
                {
                    //czy email juz istnieje
                    $rezultat = $polaczenie->query("SELECT id FROM uzytkownicy WHERE email='$email'");

                    if(!$rezultat) throw new Exception($polaczenie->error);
                    
                    $ile_takich_maili = $rezultat->num_rows;
                    if($ile_takich_maili>0)
                    {
                        $wszystko_ok=false;
                        $_SESSION['e_email']="Istnieje juz konto do tego adresu email";

                    }

                    //czy uzytkownik juz istnieje
                    $rezultat = $polaczenie->query("SELECT id FROM uzytkownicy WHERE user='$nick'");

                    if(!$rezultat) throw new Exception($polaczenie->error);
                    
                    $ile_takich_nickow = $rezultat->num_rows;
                    if($ile_takich_nickow>0)
                    {
                        $wszystko_ok=false;
                        $_SESSION['e_nick']="Istnieje juz konto o takim nicku";

                    }

                    if ($wszystko_ok==true) 
                    {
                        //dodajemy gracza do bazy wszystko ok
                        if($polaczenie->query("INSERT INTO uzytkownicy VALUES (NULL,'$nick','$haslo_hash','$email', 100, 100, 100, now() + INTERVAL 14 DAY)"))
                        {
                            $_SESSION['udanarejestracja']=true;
                            header('Location: witamy.php');
                        }
                        else
                        {
                          throw new Exception($polaczenie->error);  
                        }

                    }

                    $polaczenie->close();
                }

       }
       catch(Exception $e)
       {

        echo '<span style="color:red"> Bład serwera! Przepraszamy za niedogodnosci i prosimy o rejestracje w innym terminie</span>';
        //echo'<br>Informacja developerksa: '.$e;
       }
    }

?>


<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Osadnicy- załóż darmowe konto!</title>
     <script src="https://www.google.com/recaptcha/api.js" async defer></script>

     <style>
         .error
         {
            color:red;
            margin-top:10px;
            margin-bottom: 10px; 
         }

     </style>

</head>

    <body>
        
        <form method="post">

            Nickname: <br> <input type="text" value="<?php
                if(isset($_SESSION['fr_nick']))
                {
                    echo $_SESSION['fr_nick'];
                    unset($_SESSION['fr_nick']);
                }   
                     
                ?>" name="nick"><br>

                <?php

                if (isset($_SESSION['e_nick'])) 
                {
                    echo '<div class="error">'.$_SESSION['e_nick'].'</div>';
                    unset($_SESSION['e_nick']);
                }

                ?>

            E-mail: <br> <input type="text" value="<?php
                if(isset($_SESSION['fr_email']))
                {
                    echo $_SESSION['fr_email'];
                    unset($_SESSION['fr_email']);
                }   
                     
                ?>" name="email"><br>

                <?php

                if (isset($_SESSION['e_email'])) 
                {
                    echo '<div class="error">'.$_SESSION['e_email'].'</div>';
                    unset($_SESSION['e_email']);
                }

                ?>


            Twoje hasło:<br> <input type="password" value="<?php
                if(isset($_SESSION['fr_haslo1']))
                {
                    echo $_SESSION['fr_haslo1'];
                    unset($_SESSION['fr_haslo1']);
                }   
                     
                ?>" name="haslo1"><br>

                <?php

                if (isset($_SESSION['e_haslo'])) 
                {
                    echo '<div class="error">'.$_SESSION['e_haslo'].'</div>';
                    unset($_SESSION['e_haslo']);
                }

                ?>



            Powtórz hasło:<br> <input type="password" value="<?php
                if(isset($_SESSION['fr_haslo2']))
                {
                    echo $_SESSION['fr_haslo2'];
                    unset($_SESSION['fr_haslo2']);
                }   
                     
                ?>" name="haslo2"><br>





            <label>
            <input type="checkbox" name="regulamin" <?php 
                   if (isset($_SESSION['fr_regulamin']))
                   {
                    echo "checked";   
                       unset($_SESSION['fr_regulamin']);
                   }
                   
                   ?>>Akceptuje regulamin
            </label>

                <?php

                if (isset($_SESSION['e_regulamin'])) 
                {
                    echo '<div class="error">'.$_SESSION['e_regulamin'].'</div>';
                    unset($_SESSION['e_regulamin']);
                }

                ?>


            <div class="g-recaptcha" data-sitekey="6LeJ93YfAAAAALVxDVtweBSCw5vGOJ8FTAGzNEDx"></div>

                <?php

                if (isset($_SESSION['e_bot'])) 
                {
                    echo '<div class="error">'.$_SESSION['e_bot'].'</div>';
                    unset($_SESSION['e_bot']);
                }

                ?>




        <br>
        <input type="submit" value="zarejestruj sie">
        </form>
  

    </body>
</html>
