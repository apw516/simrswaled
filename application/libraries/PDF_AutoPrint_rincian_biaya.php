<?php
include_once APPPATH . '/third_party/fpdf_javascript/pdf_js.php';
date_default_timezone_set('Asia/Jakarta');

class PDF_AutoPrint_rincian_biaya extends PDF_JavaScript
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
            // $this->Line(2,2, 95,2);
            // $this->SetFont('Arial','',8);
            // $this->SetXY(4,4);
            // $this->Cell(0,1,'Nama Layanan',0,1); 
     
            // $this->SetXY(70,4);
            // $this->Cell(0,1,'Qty',0,1); 
     
            // $this->SetXY(85,4);
            // $this->Cell(0,1,'Tarif',0,1); 
            // $this->Line(2,6, 95,6);	
            $this->Line(2, 2, 208,2);
            $y5 = $this->GetY()+13;  
            $this->SetXY(6,4);
            $this->Cell(0,1,'No',0,1,'L'); 
            $this->SetXY(45,4);
            $this->Cell(0,1,'Keterangan',0,1,'L'); 
            $this->SetXY(120,4);
            $this->Cell(0,1,'Dibayar Tunai',0,1,'L'); 
            $this->SetXY(158,4);
            $this->Cell(0,1,'Pribadi',0,1,'L'); 
            $this->SetXY(185,4);
            $this->Cell(0,1,'Penjamin',0,1,'L'); 
            $this->Line(2, 8, 208,8);
        $this->Ln(10);
        }
    }              
    function Footer() {   
            $COUNTER =  $_SESSION['counter'];
            $RM =  $_SESSION['rm'];
            $NAMA= $_SESSION['nama'];            
            $this->SetY(-15);   
            $lebar = $this->w;   
            $this->SetFont('Arial','I',8);           
            // $this->line($this->GetX(), $this->GetY(), $this->GetX()+$lebar-20, $this->GetY());
            $this->SetY(-15);
            $this->SetX(0);       
            $this->Ln(1);
            $hal = 'Page : '.$this->PageNo().'/{nb}' ;
            $this->Cell($this->GetStringWidth($hal ),20,$hal );   
            $datestring = "Year: %Y Month: %m Day: %d - %h:%i %a";
            $tanggal  = 'tanggal cetak : '.date('d-m-Y  h:i-a').' ';
            $this->Cell($lebar-$this->GetStringWidth($hal )-$this->GetStringWidth($tanggal)-20);   
            $this->Cell($this->GetStringWidth($tanggal),10,$tanggal );  
            $Y = $this->GetY();
            $this->SetFont('Times','I',8);
            $this->SetXY(41,$Y+2);
            $this->MultiCell(40,3,"Catatan : Rincian dianggap sah bila ada tanda tangan petugas / adm dan stempel ruangan",0,1);
            $this->SetXY(146,$Y+2);
            $this->Cell(0,1,$COUNTER.'/'.$RM.'/'.$NAMA,0,1,'L');  
           
      }               
    
}

?>