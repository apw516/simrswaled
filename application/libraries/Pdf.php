<?php
include_once APPPATH . '/third_party/fpdf/fpdf.php';
class Pdf extends FPDF{
    function __construct($orientation='L', $unit='mm', $size='A4') {
        parent::__construct($orientation,$unit,$size);
    }
    function Header(){   
        // global $title ;
        // $lebar = $this->w;
        // $this->SetFont('Arial','B',15);
        // $w = $this->GetStringWidth($title );
        // $this->SetX(($lebar -$w)/2);
        // $this->Cell($w,9,$title  ,0,0,'C');
        // $this->Ln();
        // $this->line($this->GetX(), $this->GetY(), $this->GetX()+$lebar-20, $this->GetY());
        // $this->Ln(10);



        $this->Image(base_url('assets/assets/img/logo_rs.png'), 4, 5, 22, 18);
        $this->SetFont('Times','',10);
		$this->SetXY(70,8);
        $this->Cell(0,1,'PEMERINTAH KABUPATEN CIREBON',0,1,'L');       
		$this->SetXY(55,12);
        $this->Cell(0,1,'RUMAH SAKIT UMUM DAERAH WALED KAB.CIREBON',0,1,'L');       
		$this->SetXY(66,16);
        $this->Cell(0,1,'Jln. Prabu Kiansantang No.4 Waled Kab.Cirebon',0,1,'L');       
		$this->SetXY(70,20);
        $this->Cell(0,1,'Tlp. ( 0231 ) 661126 Fax. ( 0231 ) 664091',0,1,'L');       
        $this->Line(2, 25, 208,25);
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