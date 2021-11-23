<?php

include ('data.php');

?>
<!doctype html>
<html>
<meta charset=utf-8 />
<meta name="viewport" content="initial-scale=1.0, width=device-width"/>
<head>
<title> Bedankt! </title>
<link href="style-elite.css" type="text/css" rel="stylesheet" media="screen"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<script src="jquery/jquery-2.1.1.min.js"></script>
<script>
	$(document).ready(function(){
		
        
        window.open('factuur.php', '_blank');
        
        
        
//	$('.factuur').click(function(){			
//			window.open('http://chriskit.info/portofolio/portofolio/factuur/factuur.php','_blank')
//		});
		
	});
</script>
<style>

    #smart-button-container {
        z-index: 1;
        color: white!important;
        position: relative;
    }
    #smart-button-container input {
        position: relative;
        top: 50px;
        left: 0px;
    }
    
    
    </style>
</head>
<body>
    <div id="container">
        <div id="header">
			<div id="nav">
				<ul id="topnav">
					<li class="home"><a href="index.html">Home</a></li>
					<li class="shop"><a href="shop.php">Shop</a></li>
					<li class="aboutus"><a href="aboutus.html">About</a></li>
					<li class="contact"><a href="contact.php">Contact</a></li>
				</ul>
			</div>
			<a href="index.html"><img class="logo2" src="image/logo2.png" /></a>
        </div>
		<div id="banner2">
        <div id="center">
            <h1 class="contacth1">Bedankt voor uw bestelling!</h1>
            <p class="contactnote">Wij hebben u een link van uw factuur gestuurd naar uw mail. Uw bestelling wordt pas verwerkt als u betaald heeft. U kunt hieronder uw openstaande bedrag betalen.<br>
			<br>
				Als er iets mis is gegaan ga naar <a href="contact.php">Contact</a> en selecteer bij "soort vraag" 'Transactie problemen'.
				<br>
				Of voor toevoegingen bij uw bestellen selecteer 'Speciale wensen'.
				<a href="factuur.php" target="_blank">Click hier voor de Factuur pdf</a>
				<br>
				<br>
				<br>
				<br>
				<a href="factuur.php" target="_blank" hidden>Click hier voor de Factuur pdf</a><br>
            <br>
            <br>
            <b hidden>Betaal nu uw bedrag: &euro;<a id="excl"></a></b>
			</p><textarea id="bedrag" hidden><?php echo $client_total_price; ?></textarea>
            <textarea id="order" hidden><?php echo $client_ordernummer; ?></textarea><br>
            <textarea id="bottle" hidden><?php echo $client_bottle_file; ?></textarea><br>
            <br>
            <br>
            
            <div id="smart-button-container">
    <div style="text-align: center"><label for="description"> </label><input type="text" name="descriptionInput" id="description" maxlength="127" value="" ></div>
      <p id="descriptionError" style="visibility: hidden; color:red; text-align: center;">Please enter a description</p>
    <div style="text-align: center"><label for="amount"> </label><input name="amountInput" type="number" id="amount" value="" ><span> -</span></div>
      <p id="priceLabelError" style="visibility: hidden; color:red; text-align: center;">Please enter a price</p>
    <div id="invoiceidDiv" style="text-align: center; display: none;"><label for="invoiceid"> </label><input name="invoiceid" maxlength="127" type="text" id="invoiceid" value="" ></div>
      <p id="invoiceidError" style="visibility: hidden; color:red; text-align: center;">Please enter an Invoice ID</p>
    <div style="text-align: center; margin-top: 0.625rem;" id="paypal-button-container"></div>
  </div>
  
        </div>
		</div>
        <div id="footer">
			<div id="footertext">Volg en like ons:</div>
			<a href="http://www.facebook.com/elitelxry"><img src="icon/facebook-icon-preview-1.png" class="facebook" /></a>
			<a href="http://www.instagram.com/elitelxry"><img src="icon/instagram-logo-vector-download-400x400.png" class="instagram" /></a>
        </div>
    </div>
</body>
<script src="https://www.paypal.com/sdk/js?client-id=sb&currency=EUR" data-sdk-integration-source="button-factory"></script>
  <script>
      
      var BTW = 0.21;
      var shipping = 2;
      
      var bedrag = document.getElementById("bedrag").value;
      var order = document.getElementById("order").value;
      var client_bottle = document.getElementById("bottle").value;
      
      var excl = parseInt(bedrag);
      var ordernr = parseInt(order);
      
      var incl = excl * BTW + excl;
      
      
      document.getElementById('excl').innerHTML = incl;
      
      document.getElementById("description").value = client_bottle;
      document.getElementById("invoiceid").value = ordernr;
      document.getElementById("amount").value = incl;
      
      
      console.log(incl);
      console.log(ordernr);
      
      
  function initPayPalButton() {
    var description = document.querySelector('#smart-button-container #description');
    var amount = document.querySelector('#smart-button-container #amount');
    var descriptionError = document.querySelector('#smart-button-container #descriptionError');
    var priceError = document.querySelector('#smart-button-container #priceLabelError');
    var invoiceid = document.querySelector('#smart-button-container #invoiceid');
    var invoiceidError = document.querySelector('#smart-button-container #invoiceidError');
    var invoiceidDiv = document.querySelector('#smart-button-container #invoiceidDiv');

    var elArr = [description, amount];

    if (invoiceidDiv.firstChild.innerHTML.length > 1) {
      invoiceidDiv.style.display = "block";
    }

    var purchase_units = [];
    purchase_units[0] = {};
    purchase_units[0].amount = {};

    function validate(event) {
      return event.value.length > 0;
    }

    paypal.Buttons({
      style: {
        color: 'blue',
        shape: 'rect',
        label: 'checkout',
        layout: 'vertical',
        
      },

      onInit: function (data, actions) {
        actions.disable();

        if(invoiceidDiv.style.display === "block") {
          elArr.push(invoiceid);
        }

        elArr.forEach(function (item) {
          item.addEventListener('keyup', function (event) {
            var result = elArr.every(validate);
            if (result) {
              actions.enable();
            } else {
              actions.disable();
            }
          });
        });
      },

      onClick: function () {
        if (description.value.length < 1) {
          descriptionError.style.visibility = "visible";
        } else {
          descriptionError.style.visibility = "hidden";
        }

        if (amount.value.length < 1) {
          priceError.style.visibility = "visible";
        } else {
          priceError.style.visibility = "hidden";
        }

        if (invoiceid.value.length < 1 && invoiceidDiv.style.display === "block") {
          invoiceidError.style.visibility = "visible";
        } else {
          invoiceidError.style.visibility = "hidden";
        }

        purchase_units[0].description = description.value;
        purchase_units[0].amount.value = amount.value;

        if(invoiceid.value !== '') {
          purchase_units[0].invoice_id = invoiceid.value;
        }
      },

      createOrder: function (data, actions) {
        return actions.order.create({
          purchase_units: purchase_units,
        });
      },

      onApprove: function (data, actions) {
        return actions.order.capture().then(function (details) {
          alert('Dankje wel ' + details.payer.name.given_name + ', je transactie is compleet!');
        });
      },

      onError: function (err) {
        console.log(err);
      }
    }).render('#paypal-button-container');
  }
  initPayPalButton();
  </script>
</html>