<?php

$file0 = 'txt/ordernummer.txt';
$file1 = 'txt/client_name.txt';
$file2 = 'txt/client_email.txt';
$file3 = 'txt/client_adres.txt';
$file4 = 'txt/client_zipcode.txt';

// bestelling omschrijving en prijs
$file5_1 = 'txt/color.txt';
$file5_2 = 'txt/bottle.txt';
$file5_3 = 'txt/amount.txt';
$file5_4 = 'txt/bottle_price.txt';
// Row2
$file6_1 = 'txt/colorname.txt';
$file6_2 = 'txt/swarofski.txt';
$file6_3 = 'txt/amount-swa.txt';
$file6_4 = 'txt/swarofski_price.txt';
// einde bestelling omschrijving en prijs

$filex = 'txt/totaalprijs.txt';

$tax = 0.21;
$client_price = file_get_contents($filex);

$client_total_price = (int) filter_var($client_price, FILTER_SANITIZE_NUMBER_INT);

$client_total_price_tax = $client_total_price * $tax + $client_total_price;
$price_tax = $client_total_price * $tax;

$client_ordernummer = file_get_contents($file0);

$client_name_file = file_get_contents($file1);
$client_email_file = file_get_contents($file2);
$client_adres_file = file_get_contents($file3);
$client_zipcode_file = file_get_contents($file4);

// bestelling omschrijving en prijs
$client_color_file = file_get_contents($file5_1);
$client_bottle_file = file_get_contents($file5_2);
$total_amount_file = file_get_contents($file5_3);
$client_bottleprice_file = file_get_contents($file5_4);
// Row2
$client_bottlename_file = file_get_contents($file6_1);
$client_swa_file = file_get_contents($file6_2);
$total_amountswa_file = file_get_contents($file6_3);
$client_swaprice_file = file_get_contents($file6_4);
// einde bestelling omschrijving en prijs

$num = str_pad(mt_rand(1,999),3,'0',STR_PAD_LEFT);

 date_default_timezone_set('Europe/Amsterdam');
    setlocale(LC_TIME, 'NL_nl');
    
    //$date = date("l \, j F Y");
    $date = date("d.m.y"); 
    $date2 = date("m.y"); 

?>