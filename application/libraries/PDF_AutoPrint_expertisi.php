<?php
include_once APPPATH . '/third_party/fpdf_javascript/pdf_js.php';

class PDF_AutoPrint_expertisi extends PDF_JavaScript
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
                $tgl_input =  $_SESSION['tgl_input'];
                $no_periksa =  $_SESSION['no_periksa'];
                $dok1= $_SESSION['dok1'];
                $no_rm= $_SESSION['no_rm'];
                $nama_px= $_SESSION['nama_pasien'];
                $unit_asal= $_SESSION['unit_asal'];
                $tgl_lahir= $_SESSION['tgl_lahir'];
                $dok2= $_SESSION['dok2'];
                $desa= $_SESSION['desa'];
                $kec= $_SESSION['kec'];
                $tgl_baca= $_SESSION['tgl_baca'];
            $this->Image(base_url('assets/assets/img/kab.png'), 10, 10, 25, 23);
            $this->Image(base_url('assets/assets/img/logo_rs.png'), 175, 10, 25, 20);
            $this->SetFont('Arial','B',12);
            $this->Cell(0,7,'RUMAH SAKIT UMUM DAERAH WALED',0,1,'C');
            $this->Cell(10,0,'',0,1);
            $this->SetFont('Arial','B',14);
            $this->Cell(0,7,'INSTALASI LABORATORIUM PATOLOGI KLINIK DAN',0,1,'C');
            $this->Cell(10,0,'',0,0);
            $this->Cell(0,7,'KEDOKTERAN LABORATORIUM',0,1,'C');
            $this->Cell(10,1,'',0,1);
            $this->SetFont('Arial','B',10);
            $this->Cell(0,7,'Jl. Prabu Kiansantang No.4, Waled Kota, Waled, Cirebon, Jawa Barat 45187',0,1,'C');
            $this->Cell(10,0,'',0,0); 
            $this->Line(10, 40, 205,40);
            $this->SetFont('Arial','B',10);	
            $this->SetXY(10, 40);
            $this->Cell(10,7,'Tanggal',0,1);
            $this->SetXY(40, 40);
            $this->Cell(10,7,':',0,1);
            $this->SetXY(45, 40);
            $this->Cell(10,7,date("d-m-Y",strtotime($tgl_input)),0,1);
    
            $this->SetXY(110, 40);
            $this->Cell(10,7,'Nomor pemeriksaan',0,1);
            $this->SetXY(145, 40);
            $this->Cell(10,7,':',0,1);
            $this->SetXY(150, 40);
            $this->Cell(10,7,$no_periksa,0,1);
    
    
            $this->SetXY(10, 45);
            $this->Cell(10,7,'Nomor RM',0,1);
            $this->SetXY(40, 45);
            $this->Cell(10,7,':',0,1);
            $this->SetXY(45, 45);
            $this->Cell(10,7,$no_rm,0,1);
    
            $this->SetXY(110, 61);
            $this->MultiCell(135,4,'Dokter Pengirim');
            // $this->Cell(10,7,'Dokter Pengirim',0,1);
            
            $this->SetXY(145, 61);
            $this->MultiCell(143,4,':');
    
            $this->SetXY(150, 61);
            $this->MultiCell(56,4,$dok1);
    
            // $this->Cell(10,7,$DOK1['nama_paramedis'],0,1);
    
    
            $this->SetXY(10, 50);
            $this->Cell(10,7,'Nama',0,1);
            $this->SetXY(40, 50);
            $this->Cell(10,7,':',0,1);	
            $this->SetXY(45, 50);
            $this->Cell(10,7,$nama_px ,0,1);	
    
            $this->SetXY(110, 45);
            $this->Cell(10,7,'Asal / Ruangan',0,1);
            $this->SetXY(145, 45);
            $this->Cell(10,7,':',0,1);
            $this->SetXY(150, 45);
            $this->Cell(10,7,$unit_asal,0,1);
    
            $this->SetXY(10, 55);
            $this->Cell(10,7,'Tanggal lahir',0,1);
            $this->SetXY(40, 55);
            $this->Cell(10,7,':',0,1);
            $this->SetXY(45, 55);
            $this->Cell(10,7,date("d-m-Y",strtotime($tgl_lahir)),0,1);
    
            $this->SetXY(110, 55);
            $this->Cell(10,7,'Dokter PA',0,1);
            $this->SetXY(145, 55);
            $this->Cell(10,7,':',0,1);
            $this->SetXY(150, 55);
            $this->Cell(10,7,$dok2,0,1);
    
            $this->SetXY(10, 60);
            $this->Cell(10,7,'Alamat',0,1);
            $this->SetXY(40, 60);
            $this->Cell(10,7,':',0,1);
            $this->SetXY(45, 60);
            $this->Cell(10,7,$desa.' / '.$kec,0,1);
            
            $this->SetXY(110, 50);
            $this->Cell(10,7,'Tanggal selesai',0,1);
            $this->SetXY(145, 50);
            $this->Cell(10,7,':',0,1);
            $this->SetXY(150, 50);
            $this->Cell(10,7,date("d-m-Y",strtotime($tgl_baca)),0,1);
            // $this->Cell(10,7,$isi['tgl_baca'],0,1);
            $this->Line(10, 69, 205,69);
            $this->Line(10, 70, 205,70);
        $this->Ln(15);
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