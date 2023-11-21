<?php
include_once APPPATH . '/third_party/fpdf_javascript/pdf_js.php';

class PDF_AutoPrint extends PDF_JavaScript
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
        $this->Line(2, 2, 208,2); 
        $this->SetFont('Times','',8); 
		$this->SetXY(4,4);
        $this->Cell(0,1,'Tgl Pelayanan',0,1,'L');       
		$this->SetXY(30,4);
        $this->Cell(0,1,'RM',0,1,'L');            
		$this->SetXY(50,4);
        $this->Cell(0,1,'Pasien',0,1,'L');       
		$this->SetXY(98,4);
        $this->Cell(0,1,'Kelas',0,1,'L');       
		$this->SetXY(110,4);
        $this->Cell(0,1,'Unit',0,1,'L');     
        $this->SetXY(135,4);
        $this->Cell(0,1,'Nama Tarif',0,1,'L');     
		$this->SetXY(180,4);
        $this->Cell(0,1,'Tarif RS',0,1,'L');           
		$this->SetXY(193,4);
        $this->Cell(0,1,'Diterima',0,1,'L');       
        $this->Line(2, 8, 208,8); 
        $this->Ln(10);
        }
    }              
    function Footer() {               
            $this->SetY(-15);   
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