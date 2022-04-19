    echo time()."<br>";

    $dataczas = new Datetime();

    echo $dataczas->format('Y-m-d H:i:s')."<br>",print_r($dataczas);


    $dzien =26;
    $miesiac = 7;
    $rok = 1875;

   if(checkdate($miesiac, $dzien, $rok))
    echo "<br> poprawna data";
    else echo "<br> bledna data";