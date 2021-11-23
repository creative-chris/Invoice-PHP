<?php

include ('data.php');

//if(isset($_GET['submit'])){
//    
//    $bestelling = $_GET['order'];
//    
//    $naamkleur = $_GET['select-name-colour'];
//    $fleskleur = $_GET['select-bottle-colour'];
//    $aantal = $_GET['aantal'];
//    $fles = $_GET['fles'];
//    $flesname = $_GET['flesname'];
//    $email = $_GET['email'];
//	$name = $_GET['name'];
//	$lastname = $_GET['lastname'];
//	$adress = $_GET['adres'];
//	$zipcode = $_GET['zipcode'];
//	$city = $_GET['city'];
//	$bday = $_GET['birthdate'];
//	$gender = $_GET['gender'];
//	$checkage = $_GET['checkage'];
//	$checkvoorwaarden = $_GET['checkvoorwaarden'];
//	$prijs = $_GET['prijs']; // Moet
//	$prijs3 = $_GET['prijs3']; // Armand
//}



if(isset($_POST['submit'])){
    
    $naamkleur = $_POST['select-name-colour'];
    $fleskleur = $_POST['select-bottle-colour'];
    $aantal = $_POST['aantal'];
    $fles = $_POST['fles'];
    $flesname = $_POST['flesname'];
    $email = $_POST['email'];
	$name = $_POST['name'];
	$lastname = $_POST['lastname'];
	$adress = $_POST['adres'];
	$zipcode = $_POST['zipcode'];
	$city = $_POST['city'];
	$bday = $_POST['birthdate'];
	$gender = $_POST['gender'];
	$checkage = $_POST['checkage'];
	$checkvoorwaarden = $_POST['checkvoorwaarden'];
	$prijs = $_POST['prijs']; // Moet
	$prijs3 = $_POST['prijs3']; // Armand
	$swa = $_POST['swarofski']; // swarofski
    
   
    
    $postnr = (int) filter_var($zipcode, FILTER_SANITIZE_NUMBER_INT);
    $datenr = (int) filter_var($date2, FILTER_SANITIZE_NUMBER_INT);
    $aantalnr = (int) filter_var($aantal, FILTER_SANITIZE_NUMBER_INT);
    $prijsM = (int) filter_var($prijs, FILTER_SANITIZE_NUMBER_INT);
    $prijsA = (int) filter_var($prijs3, FILTER_SANITIZE_NUMBER_INT);
    $swarofski = (int) filter_var($swa, FILTER_SANITIZE_NUMBER_INT);
    
//    $prijsM = $prijs;
//    $prijsA = $prijs3;
    
    $ordernummer = "$postnr"."$datenr"."$num";
    
    
    
    $swaprice = 0;
    $aantalswa = 0;
    
    if ($swarofski == 1) {
        
        $swaprice = 40;
        $aantalswa = 1;
        
    }
    
    if ($prijsM > $prijsA) {
        
         $prijsA = "";
    }
    if ($prijsA > $prijsM) {
        
         $prijsM = "";
    }
    
    $client_name =  "$name"."\n"."$lastname";
    $client_email =  "$email";
    $client_zipcode =  "$zipcode  $city";
    $client_total =  "$prijsM $prijsA";
    
    $client_total_int = (int) filter_var($client_total, FILTER_SANITIZE_NUMBER_INT);
    
    $btw = 0.21;
    
    $client_total_incl = $client_total_int * $btw + $client_total_int;
    
    $baseM = 140;
    $flesprijsM = $baseM * $aantalnr;
    
    $baseA = 320;
    $flesprijsA = $baseA * $aantalnr;
    
    $totalswaprice = $swaprice * $aantalnr;
    $totalaantalswa = $aantalswa * $aantalnr;
    
    if ($fles == "Moet en Chandon") {
        $flesprijsA = "";
    }
    if ($fles == "Armand de Brignac") {
        $flesprijsM = "";
    }
    
	
    //                                              mail
	$subject_client = "Elite Luxury";
	$message_client = "Geachte $gender $lastname ,". "\n"
	."\n"
		."Bedankt voor uw Bestelling."."\n"
		."\n"
		."\n"
		."\n"
		."Wij hebben uw bestelling ontvangen en zullen het zo snel mogelijk verwerken zodra u uw openstaande bedrag van [ €"."$client_total_incl"." incl. BTW ] betaald heeft."."\n"
        ."Ook zullen wij binnenkort contact met u opnemen."."\n"
        ."\n"
        ."\n"
        ."Uw ordernummer: "."$ordernummer"."\n"
        ."Bekijk uw factuur in deze link:"."\n" ."https://chriskit.info/factuur/order/"."$ordernummer".".pdf"
        ."\n"
        ."\n"
        ."NOTITIE:"."\n" 
        ."Wij willen u aan herinneren dat bij het aankoop van dit product u aangegeven geeft dat u 18+ bent."."\n"
        ."Het is wettelijk verboden volgens de NIX18 wetgeving om als minderjarige alcohol te kopen of te drinken."
        ."\n"
        ."\n"
        ."\n"
        ."Met vriendelijkegroet, "."\n"
        ."\n"
        ."\n"
        ."Elite Luxury"."\n";
    
    
    $headers = 'From: info@chriskit.info';
    
    
    $to = $email; // this is your Email address 
//    mail($to, $subject_me, $message_me);   
    mail ($to, $subject_client, $message_client, $headers); // sends a copy of the message to the sender
    
    //                                          einde    mail
    
    
//        ."\n"
//        ."$adress"."\n"
//        ."\n"
//        ."$zipcode"."\n"."$city"."\n"
//        ."\n"
//        ."NEDERLAND"."$postnr"."\n"
//        ."\n"
//        ."$date";
        
    
//	$message_client ="Nogmaals bedankt voor uw Bestelling.". "\n"
//	."\n"
//		."Hier onder ziet u uw gegevens en bestelling"."\n"
//		."\n"
//		."\n"
//		."\n"
//		."Fles:  ". $fles."\n"
//        ."Naam op fles:  ". $flesname."\n"
//        ."Naam kleur:  ". $naamkleur."\n"
//        ."Fles kleur:  ". $fleskleur."\n"
//        ."Aantal:  ". $aantal."\n"
//        ."\n"
//        ."\n"
//        ."\n"
//        ."Naam:  ". $name."\n"
//        ."Achternaam:  ". $lastname."\n"
//        ."E-mail:  ". $from."\n"
//        ."Adress:  ". $adress."\n"
//        ."Postcode:  ". $zipcode."\n"
//        ."Woonplaats:  ". $city."\n"
//        ."Geboortedatum:  ". $bday."\n"
//        ."Geslacht:  ". $gender."\n"
//        ."18+ validatie:  ". $checkage."\n"
//        ."Voorwaarden:  ". $checkvoorwaarden."\n"
//        ."Prijs:  ". "€". $prijs. $prijs3."\n";
    

    
    
    
    $one = '1';
    
    $fpx = fopen('txt\totaalprijs.txt', 'w');
    fwrite($fpx, "$client_total");
    fclose($fpx);
    
    $fp0 = fopen('txt\ordernummer.txt', 'w');
    fwrite($fp0, "$ordernummer");
    fclose($fp0);
    
    $fp1 = fopen('txt\client_name.txt', 'w');
    fwrite($fp1, "$client_name");
    fclose($fp1);
    
    $fp2 = fopen('txt\client_email.txt', 'w');
    fwrite($fp2, "$client_email");
    fclose($fp2);
    
    $fp3 = fopen('txt\client_adres.txt', 'w');
    fwrite($fp3, "$adress");
    fclose($fp3);
    
    $fp4 = fopen('txt\client_zipcode.txt', 'w');
    fwrite($fp4, "$client_zipcode");
    fclose($fp4);
    
    //
    $fp5_1 = fopen('txt\color.txt', 'w');
    fwrite($fp5_1, "Kleur fles: $fleskleur");
    fclose($fp5_1);
    
    $fp5_2 = fopen('txt\bottle.txt', 'w');
    fwrite($fp5_2, "$fles");
    fclose($fp5_2);
    
    $fp5_3 = fopen('txt\amount.txt', 'w');
    fwrite($fp5_3, "$aantal");
    fclose($fp5_3);
    
    $fp5_4 = fopen('txt\bottle_price.txt', 'w');
    fwrite($fp5_4, "$flesprijsA"."$flesprijsM");
    fclose($fp5_4);
    
    // row2
    $fp6_1 = fopen('txt\colorname.txt', 'w');
    fwrite($fp6_1, "[$flesname], $naamkleur");
    fclose($fp6_1);
    
    $fp6_2 = fopen('txt\swarofski.txt', 'w');
    fwrite($fp6_2, "Swarofski");
    fclose($fp6_2);
    
    $fp6_3 = fopen('txt\amount-swa.txt', 'w');
    fwrite($fp6_3, "$totalaantalswa");
    fclose($fp6_3);
    
    $fp6_4 = fopen('txt\swarofski_price.txt', 'w');
    fwrite($fp6_4, "$totalswaprice");
    fclose($fp6_4);
    
    
     



   header('Location: thank-you-order.php');



    }

?>
<!doctype html>
<html>
<!-- Chrome, Firefox OS and Opera -->
<meta name="theme-color" content="#DAA520">
<!-- Windows Phone -->
<meta name="msapplication-navbutton-color" content="#DAA520">
<!-- iOS Safari -->
<meta name="apple-mobile-web-app-status-bar-style" content="#DAA520">
<meta charset="UTF-8" />
<meta name="viewport" content="initial-scale=1.0, width=device-width"/>
<head>
<title> Elite Luxury </title>
<link href="style-elite.css" type="text/css" rel="stylesheet" media="screen"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="jquery/jquery-2.1.1.min.js"></script>
<script>
    $(document).ready(function(){
		
		

		
//		$('.submit').click(function(){			
//			window.open('http://chriskit.info/advanced_dev/factuur/factuur.php', '_blank')
//		});
		
		
		
		
	
		var ham = 'unclicked';
	
		$('.ham').click(function(){
            if (ham == 'unclicked'){
								ham = 'clicked';
                                $('#topnav').animate({overflow: 'visible'}, 100);
								$('#topnav').animate({height: '155px'}, 1000);
			}
                     else { 
						 ham = 'unclicked';
                         $('#topnav').animate({overflow: 'hidden'}, 100);
						 $('#topnav').animate({height: '0px'}, 1000);
                    }
    	});
		
		
		//
		
		var moetflesprijs = 140;
		var moet = 140;
		var moetswarofski = 180;
		
		
		$('#moetswarofski').change(function(){
			if($('#moetswarofski').prop("checked")==true){
				moetflesprijs = moetswarofski;
			}else{
				moetflesprijs = moet;
			}

			var totaalprijs = "€ "+($('#aantal').val() * moetflesprijs);
			$('#prijs').val(totaalprijs);
			$('#prijs2').val(totaalprijs);
		});
		
		
		$('#aantal').change(function(){
			
			
			var totaalprijs = "€ "+($('#aantal').val() * moetflesprijs);
			$('#prijs').val(totaalprijs);
			$('#prijs2').val(totaalprijs);
		});
		
		
		
		var armandflesprijs = 320;
		var armand = 320;
		var armandswarofski = 360;
		
		$('#armandswarofski').change(function(){
			if($('#armandswarofski').prop("checked")==true){
				armandflesprijs = armandswarofski;
			}else{
				armandflesprijs = armand;
			}

			var totaalprijs2 = "€ "+($('#aantal2').val() * armandflesprijs);
			$('#prijs3').val(totaalprijs2);
			$('#prijs4').val(totaalprijs2);
		});
		
		
		$('#aantal2').change(function(){
			
			
			var totaalprijs2 = "€ "+($('#aantal2').val() * armandflesprijs);
			$('#prijs3').val(totaalprijs2);
			$('#prijs4').val(totaalprijs2);
		});
		
		//
		
        $('.armandnav').click(function(){
            if (    $('.armandnav') ){
                                $('.selectarmand').animate({marginLeft: '0px'}, 1000);
			}
                     else { 
                            
                    }
        
    	});
        $('.moetnav').click(function(){
            if (    $('.moetnav') ){
                                $('.selectmoet').animate({marginLeft: '0px'}, 1000);
			}
                     else { 
                            
                    }
        
    	});
        $('#close').click(function(){
            if (    $('#close') ){
                                $('.selectmoet').animate({marginLeft: '1500px'}, 1000);
			}
                     else { 
						 
                    }
        
    	});
        $('#close2').click(function(){
            if (    $('#close') ){
                                $('.selectarmand').animate({marginLeft: '1500px'}, 1000);
			}
                     else { 
						 
                    }
        
    	});
                    $('.flesarmand').click(function(){
                            if (    $('.flesarmand').attr('src') == 'image/flessen/armand%20de%20brignac_wit.png')
									  {
                                $('.flesarmand').attr('src', 'image/flessen/armand%20de%20brignac_zwart.png');
                                }
                     else { 
                           $('.flesarmand').attr('src', 'image/flessen/armand%20de%20brignac_zilver.png');
                    }
                                         });
		
	
		
					
    });
</script>
</head>
<body>
    <div id="container">
    <div id="shopcontainer">
        <div id="header">
			<a href="index.html"><img class="logo2" src="image/logo2.png" /></a>
			<a href="#" class="ham">
				<i class="fa fa-bars" aria-hidden="true" id="ham"></i>
			</a>
			<div id="nav">
				<ul id="topnav">
					<li class="home"><a href="index.html">Home</a></li>
					<li class="shop"><a href="shop.php">Shop</a></li>
					<li class="aboutus"><a href="aboutus.html">About</a></li>
					<li class="contact"><a href="contact.php">Contact</a></li>
				</ul>
			</div>
        </div>
		<div id="banner2">
		<div id="shopbanner"></div>
			<div id="moet">
				<h1 id="moetH">Mo&#235;t &#38; chandon</h1>
				<ul class="moetnav">
					<li class="moetgold"><a href="#"><img src="image/flessen/Moet%20en%20chandon_goud.png" width="150px"/></a></li>
					<li class="moetblue"><a href="#"><img src="image/flessen/Moet%20en%20chandon_blauw.png" width="150px"/></a></li>
					<li class="moetblue"><a href="#"><img src="image/flessen/Moet%20en%20chandon_rood.png" width="150px"/></a></li>
					<li class="moetpink"><a href="#"><img src="image/flessen/Moet%20en%20chandon_roze.png" width="150px"/></a></li>
					<li class="moetsilver"><a href="#"><img src="image/flessen/Moet%20en%20chandon_zilver.png" width="150px"/></a></li>
					<li class="moetblack"><a href="#"><img src="image/flessen/Moet%20en%20chandon_zwart.png" width="150px"/></a></li>
					<li class="moetwhite"><a href="#"><img src="image/flessen/Moet%20en%20chandon_wit.png" width="150px"/></a></li>
				</ul>
			</div>
			<div id="armand">
				<h1 id="armandH">Armand de Brignac</h1>
				<ul class="armandnav">
					<li ><a href="#" class="armandwhite"><img src="image/flessen/armand%20de%20brignac_wit.png" width="150px"/></a></li>
					<li class="armandblack"><a href="#"><img src="image/flessen/armand%20de%20brignac_zwart.png" width="150px"/></a></li>
					<li class="armandsilver"><a href="#"><img src="image/flessen/armand%20de%20brignac_zilver.png" width="150px"/></a></li>
					<li class="armandpink"><a href="#"><img src="image/flessen/armand%20de%20brignac_roze.png" width="150px"/></a></li>
					<li class="armandpink"><a href="#"><img src="image/flessen/armand%20de%20brignac_rood.png" width="150px"/></a></li>
					<li class="armandblue"><a href="#"><img src="image/flessen/armand%20de%20brignac_blauw.png" width="150px"/></a></li>
					<li class="armandgold"><a href="#"><img src="image/flessen/armand%20de%20brignac_goud.png" width="150px"/></a></li>
				</ul>
			</div>
		<div class="selectmoet">
			<i class="fa fa-window-close" aria-hidden="true" id="close"></i>
			<h1 id="moetH">Mo&#235;t &#38; chandon</h1>
			<img src="image/flessen/Moet%20en%20chandon_goud.png" class="mySlides"/>
			<div id="selectfles">
				<ul>
					<li><a href="#" class="regular"></a></li>
					<li class="swarofski"><a href="#"></a></li>
				</ul>
			</div>
			
            <form id="order" name="order" method="post" action="" class="order">
				<div id="bestelling">
				<br>
                    <select name="fles" id="select" required>
                        <option value="Moet en Chandon" selected>Mo&#235;t &#38; chandon</option>
                    </select>
				<br>
            <br>
<input type="text" value="" id="select" name="flesname" placeholder="Naam (max 9 letters):" max="9" min="1" required/><br>
				<br>
                    <select name="select-name-colour" id="select" required>
                        <option value="- Kleur naam -" disabled selected>- Kleur naam -</option>
                        <option value="goud">Goud</option>
                        <option value="zilver">Zilver</option>
                        <option value="blauw">Blauw</option>
                        <option value="roze">Roze</option>
                        <option value="wit">Wit</option>
                        <option value="zwart">Zwart</option>
                    </select>
				<br>
                    <br>
                    <select name="select-bottle-colour" id="select" required>
                        <option value="- Kleur fles -" disabled selected>- Kleur fles -</option>
                        <option value="goud">Goud</option>
                        <option value="zilver">Zilver</option>
                        <option value="blauw">Blauw</option>
                        <option value="roze">Roze</option>
                        <option value="wit">Wit</option>
                        <option value="zwart">Zwart</option>
                    </select>
                <br>
                <br>
                <label>swarofski:&nbsp;&nbsp;&nbsp;<input type="checkbox" id="moetswarofski" name="swarofski" value="1" /></label>
                <br>
                <br>
				<input type="number" value="" name="aantal" id="aantal" placeholder="aantal" max="99" min="1" required/>
                <br>
                <br>
				<br>
				</div>
				<div id="persoonlijkgegevens">
            Voornaam:<input type="text" value="" id="name" name="name" placeholder="" required/><br>
                    <br>
            Achternaam:<input type="text" value="" id="lastname" name="lastname" placeholder="" required/> <br>
                    <br>
            E-mail:<input type="email" value="" id="email" name="email" placeholder="" required/> <br>
                    <br>
            Adres:<input type="text" value="" id="adres" name="adres" placeholder="" required/> <br>
                    <br>
            Postcode:<input type="text" value="" id="zipcode" name="zipcode" placeholder="" required/> <br>
                    <br>
            Woonplaats:<input type="text" value="" id="city" name="city" placeholder="" required/> <br>
                    <br>
            Geboortedatum:<input type="date" value="" id="birthdate" name="birthdate" placeholder="" required/> <br>
                    <br>
                    <br>
                    <select name="gender" id="gender" required>
                        <option value="- Geslacht -" disabled selected>- Geslacht -</option>
                        <option value="Heer">Man</option>
                        <option value="Mevrouw">Vrouw</option>
                    </select>
                <br>
                <br>
                Bij deze valideer ik (nogmaals) dat ik 18+ ben.:&nbsp;&nbsp;&nbsp;<input type="checkbox" id="acceptTOS" name="checkage" value="Ja" required/>
                <br>
                <br>
                Accepteer u onze<a href="about.html"> voorwaarden &amp; servicebeleid</a>?:&nbsp;&nbsp;&nbsp;<input type="checkbox" id="acceptTOS" name="checkvoorwaarden" value="Geaccepteerd" required/>
                <br>
				<br>
				Prijs:<input type="hidden" value="" name="prijs" id="prijs" placeholder="" max="" min="1"/>
				<input type="text" value="" name="prijs2" id="prijs2" placeholder="€ 0" max="" min="1"/>
                <br>
				<br>
            <input type="submit" value="Verzenden" id="submit" name="submit" onClick="MM_validateForm('name','','R','email','','R','comment','','R');return document.MM_returnValue"/>
				</div>
            </form>
			
			</div>
		<div class="selectarmand">
			<i class="fa fa-window-close" aria-hidden="true" id="close2"></i>
			<h1 id="armandH">Armand de Brignac</h1>
			<img src="image/flessen/armand%20de%20brignac_wit.png" class="flesarmand"/>
			<div id="selectfles">
				<ul>
					<li class="regular"><a href="#"></a></li>
					<li class="swarofski"><a href="#"></a></li>
				</ul>
			</div>
			
            <form id="order" name="order" method="post" action="" class="order">
				<div id="bestelling">
				<br>
                    <select name="fles" id="select" required>
                        <option value="Armand de Brignac" selected>Armand de Brignac</option>
                    </select>
				<br>
            <br>
<input type="text" value="" id="select" name="flesname" placeholder="Naam (max 9 letters):" max="9" min="1" required/><br>
				<br>
                    <select name="select-name-colour" id="select" required>
                        <option value="- Kleur naam -" disabled selected>- Kleur naam -</option>
                        <option value="goud">Goud</option>
                        <option value="zilver">Zilver</option>
                        <option value="blauw">Blauw</option>
                        <option value="roze">Roze</option>
                        <option value="wit">Wit</option>
                        <option value="zwart">Zwart</option>
                    </select>
				<br>
                    <br>
                    <select name="select-bottle-colour" id="select" required>
                        <option value="- Kleur fles -" disabled selected>- Kleur fles -</option>
                        <option value="goud">Goud</option>
                        <option value="zilver">Zilver</option>
                        <option value="blauw">Blauw</option>
                        <option value="roze">Roze</option>
                        <option value="wit">Wit</option>
                        <option value="zwart">Zwart</option>
                    </select>
                <br>
                <br>
                <label>swarofski:&nbsp;&nbsp;&nbsp;<input type="checkbox" id="armandswarofski" name="swarofski" value="1" /></label>
                <br>
                <br>
				<input type="number" value="" name="aantal" id="aantal2" placeholder="aantal" max="99" min="1" required/>
                <br>
                <br>
				<br>
				</div>
				<div id="persoonlijkgegevens">
            Voornaam:<input type="text" value="" id="name" name="name" placeholder="" required/><br>
                    <br>
            Achternaam:<input type="text" value="" id="lastname" name="lastname" placeholder="" required/> <br>
                    <br>
            E-mail:<input type="email" value="" id="email" name="email" placeholder="" required/> <br>
                    <br>
            Adres:<input type="text" value="" id="adres" name="adres" placeholder="" required/> <br>
                    <br>
            Postcode:<input type="text" value="" id="zipcode" name="zipcode" placeholder="" required/> <br>
                    <br>
            Woonplaats:<input type="text" value="" id="city" name="city" placeholder="" required/> <br>
                    <br>
            Geboortedatum:<input type="date" value="" id="birthdate" name="birthdate" placeholder="" required/> <br>
                    <br>
                    <br>
                    <select name="gender" id="gender" required>
                        <option value="- Geslacht -" disabled selected>- Geslacht -</option>
                        <option value="M">Man</option>
                        <option value="V">Vrouw</option>
                    </select>
                <br>
                <br>
                Bij deze valideer ik (nogmaals) dat ik 18+ ben.:&nbsp;&nbsp;&nbsp;<input type="checkbox" id="acceptTOS" name="checkage" value="Ja" required/>
                <br>
                <br>
                Accepteer u onze<a href="about.html"> voorwaarden &amp; servicebeleid</a>?:&nbsp;&nbsp;&nbsp;<input type="checkbox" id="acceptTOS" name="checkvoorwaarden" value="Geaccepteerd" required/>
                <br>
				<br>
				Prijs:<input type="hidden" value="" name="prijs3" id="prijs3" placeholder="" max="" min="1"/>
				<input type="num" value="" name="prijs4" id="prijs4" placeholder="€ 0" max="" min="1"/>
                <br>
				<br>
            <input type="submit" value="Verzenden" id="submit" name="submit" class="submit" onClick="MM_validateForm('name','','R','email','','R','comment','','R');return document.MM_returnValue"/>
				</div>
            </form>
		</div>
		</div>
        <div id="footer">
			<div id="footertext">Volg en like ons:</div>
			<a href="http://www.facebook.com/elitelxry"><img src="icon/facebook-icon-preview-1.png" class="facebook" /></a>
			<a href="http://www.instagram.com/elitelxry"><img src="icon/instagram-logo-vector-download-400x400.png" class="instagram" /></a>
        </div>
    </div>
    </div>
</body>
</html>