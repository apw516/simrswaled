<?php
include_once APPPATH . '/third_party/fpdf_javascript/pdf_js.php';
date_default_timezone_set('Asia/Jakarta');

class PDF_AutoPrint_struk_retur extends PDF_JavaScript
{
    function AutoPrint($printer='')
    {
        // Open the print dialog
        if($printer)
        {
            $printer = str_replace('\\', '\\\\', $printer);
            $script = "var pp = getPrintParams();";
            $script .= "pp.interactive = pp.constants.interactionLevel.full;";
            $script .= "pp.printerName = '$printer'";
            $script .= "print(pp);";
        }
        else
            $script = 'print(true);';
        $this->IncludeJS($script);
    }
    function Header(){  
        if($this->PageNo() > 1)   
        {     
        $this->Line(2, 2, 95,2);
		$this->SetFont('Arial','B',8);
		$this->SetXY(2,4);
        $this->Cell(0,1,'Nama Layanan',0,1); 
		$this->SetXY(65,4);
        $this->Cell(0,1,'Qty retur',0,1); 
		$this->SetXY(85,4);
        $this->Cell(0,1,'Tarif',0,1); 
		$this->Line(2, 6, 95,6);	 
        $this->Ln(5);
        }
    }              
    function Footer() {               
            $this->SetY(-20);   
            $lebar = $this->w;   
            $this->SetFont('Arial','I',8);           
            $this->line($this->GetX(), $this->GetY(), $this->GetX()+$lebar-20, $this->GetY());
            $this->SetY(-15);
            $this->SetX(0);       
            $this->Ln(1);
            $hal = 'Page : '.$this->PageNo().'/{nb}' ;
            $this->Cell($this->GetStringWidth($hal ),10,$hal );   
            $datestring = "Year: %Y Month: %m Day: %d - %h:%i %a";
            $tanggal  = 'Printed : '.date('d-m-Y  h:i-a').' ';
            $this->Cell($lebar-$this->GetStringWidth($hal )-$this->GetStringWidth($tanggal)-20);   
            $this->Cell($this->GetStringWidth($tanggal),10,$tanggal );   
           
      }               
    
}

?>