<?php

require	('fpdf/fpdf.php');
include ('data.php');

//function foo(){
//    include_once ('index.php');
//    return $foo;
//
//}

class PDF extends FPDF {
	
	function Header() {
		$this->Image('logo2.png',140,15,60);
        $this->SetFont('Arial','B',24);
        $this->SetTextColor(255, 0, 0);
        $this->Cell(1,60,'Factuur');
	}
    
    function Footer() {
//		$this->Image('logo2.png',10,6,30);
//        $this->SetFont('Arial','B',16);
//        $this->Cell(1,60,'Factuur');
        
        $this->SetY(200);
        $this->SetTextColor(0, 0, 0);
        
        $this->Ln(5);
        $this->Cell(1,1,('Elite Luxury'));
        $this->Ln(5);
        $this->Cell(1,1,('info@eliteluxury.nl'));
        $this->Ln(5);
        $this->Cell(1,1,('Straatlaan 123'));
        $this->Ln(5);
        $this->Cell(1,1,('6060GD Eindhoven'));
        $this->Ln(15);
        $this->Cell(1,1,('(+31)40 123456789'));
        $this->Ln(5);
        $this->Cell(1,1,('KvK nr:       0123456789'));
        $this->Ln(5);
        $this->Cell(1,1,('BTW nr:      NL0123456789B02'));
        $this->Ln(5);
        $this->Cell(1,1,('IBAN:          NL01INGB0554896'));
        
        $this->SetFont('Arial','',10);
        $this->Ln(20);
        $this->Cell(1,1,('NOTITIE'));
        $this->Ln(8);
        $this->Cell(1,1,('Wij willen u aan herinneren dat bij het aankoop van dit product u aangegeven geeft dat u 18+ bent.'));
        $this->Ln(5);
        $this->Cell(1,1,('Het is wettelijk verboden volgens de NIX18 wetgeving om als minderjarige alcohol te kopen of te drinken.'));
	}
	
}

function AcceptPageBreak()
{
    //Methode die wel of niet de automatische pagina break accepteert
    if($this->col<2)
    {
        //Ga naar volgende kolom
        $this->SetCol($this->col+1);
        //Stel ordinaat in op bovenkant
        $this->SetY($this->y0);
        //Blijf op de pagina
        return false;
    }
    else
    {
        //Ga terug naar eerste kolom
        $this->SetCol(0);
        //Pagina break
        return true;
    }
}




$doctype = ".pdf";
$docname = "$client_ordernummer"."$doctype";
$download = "Elite-Luxury_order_"."$docname";
$location = "order/"."$docname";

$pdf = new PDF();
//$title='Factuur';
//$pdf->SetTitle($title);
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
$pdf->Ln(40);
$pdf->Cell(1,1,($client_name_file));
//$pdf->Cell(40,140,($test));
$pdf->Ln(5);
$pdf->Cell(1,1,($client_email_file));
$pdf->Ln(5);
$pdf->Cell(1,1,($client_adres_file));
$pdf->Ln(5);
$pdf->Cell(1,1,($client_zipcode_file));
$pdf->Ln(15);
$pdf->Cell(1,1,("Factuurdatum: $date"));
$pdf->Ln(5);
$pdf->Cell(1,1,("Ordernummer: $client_ordernummer"));

// bestelling omschrijving en prijs
$pdf->Ln(20);
$pdf->Line(11, 100, 230-40, 100);                       // LINE
$pdf->Cell(1,1,('BESCHRIJVING'));
$pdf->Ln(0);
$pdf->SetX(60);
$pdf->Cell(1,1,('PRODUCT'));
$pdf->Ln(0);
$pdf->SetX(110);
$pdf->Cell(1,1,('AANTAL'));
$pdf->Ln(0);
$pdf->SetX(160);
$pdf->Cell(1,1,('PRIJS'));
$pdf->Line(11, 110, 230-40, 110);                       // LINE

$pdf->Ln(15);
$pdf->Cell(1,1,($client_color_file));
$pdf->Ln(0);
$pdf->SetX(60);
$pdf->Cell(1,1,($client_bottle_file));
$pdf->Ln(0);
$pdf->SetX(110);
$pdf->Cell(1,1,($total_amount_file));
$pdf->Ln(0);
$pdf->SetX(160);
$pdf->Cell(1,1,($client_bottleprice_file));
// row 2
$pdf->Ln(10);
$pdf->Cell(1,1,($client_bottlename_file));
$pdf->Ln(0);
$pdf->SetX(60);
$pdf->Cell(1,1,($client_swa_file));
$pdf->Ln(0);
$pdf->SetX(110);
$pdf->Cell(1,1,($total_amountswa_file));
$pdf->Ln(0);
$pdf->SetX(160);
$pdf->Cell(1,1,($client_swaprice_file));
//$pdf->Cell(40,140,($_GET["$message_client"]));
// row 3
$pdf->Ln(30);
$pdf->Cell(1,1,('21% BTW'));
$pdf->Ln(0);
$pdf->SetX(60);
$pdf->Cell(1,1,('-'));
$pdf->Ln(0);
$pdf->SetX(110);
$pdf->Cell(1,1,('-'));
$pdf->Ln(0);
$pdf->SetX(160);
$pdf->Cell(1,1,($price_tax));

$pdf->Line(11, 170, 230-40, 170);                       // LINE
$pdf->Ln(20);
$pdf->SetX(110);
$pdf->Cell(1,1,('Totaal te betalen: '));
$pdf->Ln(0);
$pdf->SetX(160);
		$pdf->Image('euro-sign-solid.png',158,179,2);
        $pdf->SetTextColor(255, 0, 0);
$pdf->Cell(1,1,($client_total_price_tax));

$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(1,1,('____________'));
// einde bestelling omschrijving en prijs




//                  Auto-download + save on server

$pdf->Output('F',"$location");
//$pdf->Output('D',"$download");

$pdf->Output();

?>