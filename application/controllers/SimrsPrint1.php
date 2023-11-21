<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class SimrsPrint extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library('Pdf'); // MEMANGGIL LIBRARY YANG KITA BUAT TADI
        $this->load->library('PDF_AutoPrint'); // MEMANGGIL LIBRARY YANG KITA BUAT TADI
        $this->load->library('PDF_AutoPrint_struk'); // MEMANGGIL LIBRARY YANG KITA BUAT TADI
        $this->load->library('PDF_AutoPrint_struk_retur'); // MEMANGGIL LIBRARY YANG KITA BUAT TADI
        $this->load->library('PDF_AutoPrint_rincian_biaya'); // MEMANGGIL LIBRARY YANG KITA BUAT TADI
        $this->load->library('PDF_AutoPrint_expertisi'); // MEMANGGIL LIBRARY YANG KITA BUAT TADI
        $this->load->model('modelJM');   
        $this->load->model('model_pencarian');   
        $this->load->model('modelBilling');   
    }
	function index()
	{        
    global $title;
    $fpdf = new PDF_AutoPrint();
    // $fpdf = new PDF('P');
    $title = 'Contoh Kop' ;
    $fpdf->SetTitle($title );
    $fpdf->AliasNbPages();
    $fpdf->AddPage();
    $fpdf->SetFont('Arial','B',16);
    // $fpdf->Cell(40,10,'Hello World! its make with fPDF');
    $fpdf->AutoPrint();
    $fpdf->Output();  
	}
	function PrintJM($id_detail)
	{        
    
        $this->db->where('id',$id_detail);
        $this->db->update('ts_laporan_jm',array('status' => '1'));
        $detail = $this->db->get_where('ts_laporan_jm',array('id' => $id_detail))->row_array();
        $tgl_awal = $detail['tanggal_awal'];
        $tgl_akhir = $detail['tanggal_akhir'];
        $dokter = $detail['dokter'];
        $penjamin = $detail['penjamin'];
        $jm_v = $this->modelJM->get_jm($tgl_awal,$tgl_akhir,$dokter,$penjamin);
        $array_kelompok = []; 
        $kelompok = '';
        $total = 0;
        foreach($jm_v as $j){
        $kelompok1 = $j['KELOMPOK'];
        if($kelompok != $kelompok1)
            {
            $data_loop = [
				'kelompok' => $kelompok1,			
			    ];
                array_push ($array_kelompok,$data_loop);	
            }
            $kelompok = $kelompok1;	   
            if($kelompok1 == $kelompok)
            {
                $total1 = $j['grantotal_layanan'] + $total;
            }
        }

		error_reporting(0); 
		$pdf = new PDF_AutoPrint('P','mm','A4');
        $pdf->header = 0;
        $pdf->footer = 0;
        
        $pdf->AliasNbPages();
		// $pdf -> SetMargins(4, 4, 4);
        $pdf->SetTopMargin(200); 
        $pdf->addPage('','',false); 
        // $pdf->AddPage(); 
        $pdf->Image(base_url('assets/assets/img/logo_rs.png'), 4, 5, 22, 18);
        $pdf->SetFont('Times','',10);
		$pdf->SetXY(70,8);
        $pdf->Cell(0,1,'PEMERINTAH KABUPATEN CIREBON',0,1,'L');       
		$pdf->SetXY(55,12);
        $pdf->Cell(0,1,'RUMAH SAKIT UMUM DAERAH WALED KAB.CIREBON',0,1,'L');       
		$pdf->SetXY(66,16);
        $pdf->Cell(0,1,'Jln. Prabu Kiansantang No.4 Waled Kab.Cirebon',0,1,'L');       
		$pdf->SetXY(70,20);
        $pdf->Cell(0,1,'Tlp. ( 0231 ) 661126 Fax. ( 0231 ) 664091',0,1,'L');       
        $pdf->Line(2, 25, 208,25);
		$pdf->SetXY(80,28);
        $pdf->Cell(0,1,'Rincian Jasa Pelayanan BPJS',0,1,'L');       
		$pdf->SetXY(65,32);
        $pdf->Cell(0,1,'Nama Dokter'.' : '.$dokter,0,1,'L');       
		$pdf->SetXY(75,36);
        $pdf->Cell(0,1,'Periode'.' : '.$tgl_awal.' / '.$tgl_akhir,0,1,'L');      
        $pdf->Line(2, 39, 208,39); 
        $pdf->SetFont('Times','',8); 
		$pdf->SetXY(4,42);
        $pdf->Cell(0,1,'Tgl Pelayanan',0,1,'L');       
		$pdf->SetXY(30,42);
        $pdf->Cell(0,1,'RM',0,1,'L');            
		$pdf->SetXY(50,42);
        $pdf->Cell(0,1,'Pasien',0,1,'L');       
		$pdf->SetXY(85,42);
        $pdf->Cell(0,1,'Kelas',0,1,'L');       
		$pdf->SetXY(100,42);
        $pdf->Cell(0,1,'Unit',0,1,'L');       
		$pdf->SetXY(135,42);
        $pdf->Cell(0,1,'Nama Tarif',0,1,'L');       
		$pdf->SetXY(180,42);
        $pdf->Cell(0,1,'Tarif RS',0,1,'L');           
		$pdf->SetXY(193,42);
        $pdf->Cell(0,1,'Diterima',0,1,'L');       
        $pdf->Line(2, 46, 208,46);           
		$y = $pdf->GetY();
		$L1 = $y + 4;
		$y1 = $y + 6;
        $grandtotal = 0;
        foreach($array_kelompok as $k)
        {            
            $total = 0;
            foreach($jm_v as $j)
            {                
                if($k['kelompok'] == $j['KELOMPOK'])
                {
                $total1 = $total + $j['JS'];
                $total = $total1;
                }               
            }
            $grandtotal1= $total+$grandtotal;
            $grandtotal = $grandtotal1;
            $pdf->SetFont('Times','B',8); 
            $pdf->Line(2, $L1, 208,$L1);            
            $pdf->SetXY(4,$y1);
            $pdf->Cell(0,4,$k['kelompok'],0,1);      
            $pdf->SetXY(195,$y1);
            $pdf->SetFont('Times','B',8); 
            $pdf->Cell(0,4,rupiah($total),0,1,'L');     
            $pdf->SetFont('Times','',8); 
            $y2 = $pdf->GetY();
            $y3 = $y2 + 3;
            $i = 1;
            foreach($jm_v as $j)
            {                
                if($k['kelompok'] == $j['KELOMPOK'])
                {
                $total1 = $total + $j['JS'];
                $total = $total1;
                $pdf->SetY($y3);                
                $pdf->SetX(10);
                $pdf->MultiCell(20,3,$j['TGL'],0,1);
                $yy = $pdf->GetY();
                $pdf->SetY($yy-2);
                $pdf->SetX(4);
                $pdf->Cell(0,1,$i,0,1); 
                $pdf->SetY($yy-2);
                $pdf->SetX(28);
                $pdf->Cell(0,1,$j['rm'],0,1); 
                $pdf->SetY($yy-3);
                $pdf->SetX(45);
                $pdf->MultiCell(40,3,$j['NAMA_PX'],0,1);     
                // $pdf->SetY($yy-4);
                // $pdf->SetX(90);
                // $pdf->MultiCell(30,3,$j['NAMA_TARIF'],0,1);     
                $pdf->SetY($yy-2);
                $pdf->SetX(90);
                if($j['kode_unit'] == 3){
                    $kelas = 'III';
                }else if($j['kode_unit'] == 2){
                    $kelas = 'II';

                }else if($j['kode_unit'] == 1)
                {
                    $kelas = 'I';
                }
                $pdf->Cell(0,1,$kelas,0,1); 
                $pdf->SetFont('Times','',7); 
                $pdf->SetY($yy-3); 
                $pdf->SetX(95);
                $pdf->MultiCell(35,3,$j['NAMA_UNIT'],0,1); 
                $pdf->SetY($yy-3); 
                $pdf->SetX(125);
                $jmlh = strlen($j['NAMA_TARIF']);
                if($jmlh > 70){
                    $pdf->SetFont('Times','B',5); 
                }
                $pdf->MultiCell(55,3,$j['NAMA_TARIF'],0,1); 
                $pdf->SetFont('Times','',8); 
                $pdf->SetY($yy-2);
                $pdf->SetX(180);
                $pdf->Cell(0,1,rupiah($j['grantotal_layanan']),0,1,'L');                  
                $pdf->SetY($yy-2);
                $pdf->SetX(195);
                $pdf->Cell(0,1,rupiah($j['JS']),0,1);     
                $y4 = $pdf->GetY();
                $y3 = $y4 + 5; 
                $y5 = $pdf->GetY();               
                $i++;
            }            
            $y1 = $y5+6;
            $L1 = $y5+6;
        }        
        }
        $pdf->SetFont('Times','B',8); 
        $y_END = $pdf->GetY();              
        $pdf->Line(2, $y_END+3, 208,$y_END+3);            
        $pdf->Line(2, $y_END+4, 208,$y_END+4);    
        $pdf->Line(2, $y_END+14, 208,$y_END+14);            
        $pdf->Line(2, $y_END+15, 208,$y_END+15);    
        $y_END2 = $pdf->GetY();  
        $pdf->SetY($y_END2+8);
        $pdf->SetX(135);          
        $pdf->Cell(0,1,'Grand Total Layanan',0,1);           
        $pdf->SetY($y_END2+8);
        $pdf->SetX(190);
        $pdf->Cell(0,1,rupiah($grandtotal),0,1);   
        $pdf->SetFont('Times','I',8);       
        $pdf->SetY($y_END2+20);
        $pdf->SetX(18);
        $pdf->Cell(0,1,'_.Tanggal cetak : ' . date('Y/m/d'),0,1);           
        $pdf->AutoPrint();
        $pdf->Output();
	}
    function PrintRincianBilling($kode_layanan_header)
    {
		
		$layanan_header = $this->db->get_where('ts_layanan_header',array('id' => $kode_layanan_header))->row_array();
		$ts_kunjungan = $this->db->get_where('ts_kunjungan',array('kode_kunjungan' => $layanan_header['kode_kunjungan']))->row_array();
		$mt_pasien = $this->db->get_where('mt_pasien', array('no_rm' => $ts_kunjungan['no_rm']))->row_array();
		$mt_unit = $this->db->get_where('mt_unit',array('kode_unit' => $ts_kunjungan['kode_unit']))->row_array();
		$mt_penjamin = $this->db->get_where('mt_penjamin',array('kode_penjamin' => $ts_kunjungan
		['kode_penjamin']))->row_array();
        $mt_paramedis = $this->db->get_where('mt_paramedis',array('kode_paramedis' => $layanan_header['dok_kirim']))->row_array();
		$det = $this->db->get_where('ts_layanan_detail',array('row_id_header' => $layanan_header['id']))->result_array();
		$det_count = $this->db->get_where('ts_layanan_detail',array('row_id_header' => $layanan_header['id']))->num_rows();
		$unit_cetak = $this->session->userdata('kode_unit');
		$no_rm = $mt_pasien['no_rm'];
		$alamat = $this->modelBilling->getAlamat($no_rm);
		error_reporting(0); // AGAR ERROR MASALAH VERSI PHP TIDAK MUNCUL
 
        // $pdf = new FPDF('P', 'mm','A4'); 
		$pdf = new PDF_AutoPrint_struk('P','mm',array(105,140));
		// $pdf -> SetMargins(4, 2, 4);
        $pdf->header = 0;
        $pdf->footer = 0;
        
        $pdf->AddPage(); 
		$pdf->Image(base_url('assets/assets/img/logo_rs.png'), 4, 5, 15, 12);
        $pdf->SetFont('Times','',10);
		$pdf->SetXY(20,8);
        $pdf->Cell(0,1,'NOTA RINCIAN',0,1,'L');       
		$pdf->SetXY(20,12);
		if($unit_cetak == '3011')
		{
			$pdf->Cell(0,1,'RSUD WALED - BANK DARAH',0,1,'L');

		}if($unit_cetak == '3020')
		{
			$pdf->Cell(0,1,'RSUD WALED - PATOLOGI ANATOMI',0,1,'L');
		}
		if($unit_cetak == '3003')
		{
			$pdf->Cell(0,1,'RSUD WALED - RADIOLOGI',0,1,'L');
		}
        $pdf->SetFont('Times','',8);
		$pdf->SetXY(75,16);
		if($layanan_header['kode_tipe_transaksi'] == '2'){
			$pdf->Cell(0,1,'Resep Kredit',0,1,'L'); 
		}else{
			$pdf->Cell(0,1,'Resep Tunai',0,1,'L'); 
		}
        $pdf->SetFont('Times','',10);
       	$pdf->Line(2, 19, 95,19);
		$pdf->SetXY(5,22);
        $pdf->Cell(0,1,'Kode Layanan.',0,1);
		$pdf->SetXY(35,22);
        $pdf->Cell(0,1,': '.$layanan_header['kode_layanan_header'],0,1);
		$pdf->SetXY(5,26);
        $pdf->Cell(0,1,'No RM',0,1);
		$pdf->SetXY(35,26);
        $pdf->Cell(0,1,': '.$mt_pasien['no_rm'] ,0,1);
		$pdf->SetXY(5,30);
        $pdf->Cell(0,1,'Nama Pasien',0,1);
		$pdf->SetXY(35,30);
        $pdf->Cell(0,1,': '.$mt_pasien['nama_px'] ,0,1);
		$pdf->SetXY(5,34);
        $pdf->Cell(0,1,'Tanggal lahir / JK',0,1);
		$pdf->SetXY(35,34);
        $pdf->Cell(0,1,': '.date("d-m-Y",strtotime($mt_pasien['tgl_lahir'])).' / ' . $mt_pasien['jenis_kelamin'] ,0,1);
		$lahir    =new DateTime($mt_pasien['tgl_lahir']);
        $today        =new DateTime();
        $umur = $today->diff($lahir);
		$pdf->SetXY(5,38);
        $pdf->Cell(0,1,'Umur',0,1);
		$pdf->SetXY(35,38);
        $pdf->Cell(0,1,': '. $umur->y.'Th',0,1);
		$pdf->SetXY(5,42);
        $pdf->Cell(0,1,'Alamat',0,1);
		$pdf->SetXY(35,42);
        $pdf->Cell(0,1,': ',0,1);
		$pdf->SetXY(37,41);
        $pdf->MultiCell(60,4,$alamat['alamat']) ;
		$H11 = $pdf->GetY();
		$y = $H11+1;
		$pdf->SetXY(5,$y);
        $pdf->Cell(0,1,'Unit asal',0,1);
		$pdf->SetXY(35,$y);
        $pdf->Cell(0,1,': '.$mt_unit['nama_unit'],0,1);
		$pdf->SetXY(5,$y+4);
        $pdf->Cell(0,1,'Penjamin',0,1);
		$pdf->SetXY(35,$y+4);
        $pdf->Cell(0,1,': '.$mt_penjamin['nama_penjamin'],0,1);
		$pdf->SetXY(5,$y+8);
        $pdf->Cell(0,1,'Dokter Pengirim',0,1);
		$pdf->SetXY(35,$y+8);
        $pdf->Cell(0,1,': '.$mt_paramedis['nama_paramedis'],0,1);
		$pdf->Line(2, $y+10, 95,$y+10);
		$pdf->SetFont('Arial','',8);
		$pdf->SetXY(4,$y+12);
        $pdf->Cell(0,1,'Nama Layanan',0,1);
 		$pdf->SetXY(70,$y+12);
        $pdf->Cell(0,1,'Qty',0,1);  
		$pdf->SetXY(85,$y+12);
        $pdf->Cell(0,1,'Tarif',0,1); 
		$pdf->Line(2,$y+15, 95,$y+15);	        		
		$y = $y+16;
        $pdf->SetFont('Arial','',8);
        $Y2 = $pdf->GetY() + 4;
		for($i = 0;$i<$det_count; $i++)
		{
			$mt_tarif_detail = $this->db->get_where('mt_tarif_detail',array('KODE_TARIF_DETAIL' => $det[$i]['kode_tarif_detail']))->row_array();
			$mt_tarif_header = $this->db->get_where('mt_tarif_header',array('KODE_TARIF_HEADER' => $mt_tarif_detail['KODE_TARIF_HEADER']))->row_array();
			IF($det[$i]['jumlah_layanan'] != '0'){		
			$pdf->SetXY(4,$Y2);
			$pdf->MultiCell(60,3,ucwords(strtolower($mt_tarif_header['NAMA_TARIF'])));
            $M = $pdf->GetY();
			$pdf->SetXY(70,$M-2);
			$pdf->MultiCell(0,1,$det[$i]['jumlah_layanan'],0,1); 	 
			$pdf->SetXY(78,$M-2);
			$pdf->MultiCell(0,1,rupiah($det[$i]['total_tarif']),0,1); 
			$H = $pdf->GetY();
			$Y2 = $H+5;
			}
		}		
        $Y3 = $pdf->GetY();
		$pdf->Line(2,$Y3+2, 95,$Y3+2);
		$pdf->SetXY(55,$Y3+4);
        $pdf->Cell(0,1,'Total Bayar',0,1);
        $YX3 = $pdf->GetY();
		$pdf->SetXY(80,$YX3-1);
        $pdf->Cell(0,1,rupiah($layanan_header['total_layanan']),0,1);
		$pdf->SetFont('Times','',7);
        $YX4 = $pdf->GetY();    
		$pdf->SetXY(10,$YX4);
        $pdf->Cell(0,1,'tanggal entry ',0,1);
        $YX5 = $pdf->GetY();    
		$pdf->SetXY(30,$YX5-1);
        $pdf->Cell(0,1,': '.$layanan_header['tgl_entry'],0,1);	
		$user = $this->session->userdata('username');
		// $pdf->SetXY(10,$y+4);
        // $pdf->Cell(0,1,'Diinput oleh ',0,1);	
		// $pdf->SetXY(30,$y+4);
        // $pdf->Cell(0,1,': '.$user,0,1);	
		if($unit_cetak == '3011')
		{
		$H = $pdf->GetY();
		$Y4= $H+3;
        $pdf->SetXY(10,$Y4);
        $pdf->Cell(0,1,'kantong darah yang dipakai ',0,1);
		$darah_pakai = $this->db->get_where('ts_pemakaian_darah',array('nomor_layanan_header' => $layanan_header['kode_layanan_header'],'status_retur' => 2))->num_rows();
		$darah_dipakai = $this->db->get_where('ts_pemakaian_darah',array('nomor_layanan_header' => $layanan_header['kode_layanan_header'],'status_retur' => 2))->result_array();
        $Y5 = $pdf->GetY();
		for($j = 0;$j<$darah_pakai; $j++)
		    {			 	 
			$pdf->SetXY(20,$Y5+2);
			$pdf->MultiCell(0,1,'- '. $darah_dipakai[$j]['nomor_kantong'],0,1); 
			$H = $pdf->GetY();
			$Y5 = $H;			
		    }
        }
        $pdf->AutoPrint();
        $pdf->Output();
    }
    function PrintRincianRetur($kode_layanan_header)
    {
        $layanan_header = $this->db->get_where('ts_layanan_header',array('id' => $kode_layanan_header))->row_array();
		$ts_kunjungan = $this->db->get_where('ts_kunjungan',array('kode_kunjungan' => $layanan_header['kode_kunjungan']))->row_array();
		$mt_pasien = $this->db->get_where('mt_pasien', array('no_rm' => $ts_kunjungan['no_rm']))->row_array();
		$mt_unit = $this->db->get_where('mt_unit',array('kode_unit' => $ts_kunjungan['kode_unit']))->row_array();
        $mt_paramedis = $this->db->get_where('mt_paramedis',array('kode_paramedis' => $layanan_header['dok_kirim']))->row_array();
		$mt_penjamin = $this->db->get_where('mt_penjamin',array('kode_penjamin' => $ts_kunjungan
		['kode_penjamin']))->row_array();
		$no_rm = $mt_pasien['no_rm'];

		$alamat = $this->modelBilling->getAlamat($no_rm);

		$det_ret_count = $this->model_pencarian->count_retur_detail($layanan_header['kode_layanan_header']);	
		$detail_retur = $this->model_pencarian->get_retur_detail($layanan_header['kode_layanan_header']);	
		$unit_cetak = $this->session->userdata('kode_unit');
		error_reporting(0); // AGAR ERROR MASALAH VERSI PHP TIDAK MUNCUL 
        $pdf = new PDF_AutoPrint_struk_retur('P','mm',array(105,140));
		$pdf -> SetMargins(4, 2, 4);        
		$pdf->AddPage(); 
		$pdf->Image(base_url('assets/assets/img/logo_rs.png'), 4, 5, 15, 12);
        $pdf->SetFont('Times','',10);
		$pdf->SetXY(20,8);
        $pdf->Cell(0,1,'NOTA RINCIAN RETUR',0,1,'L');       
		$pdf->SetXY(20,12);
		if($unit_cetak == '3011')
		{
			$pdf->Cell(0,1,'RSUD WALED - BANK DARAH',0,1,'L');

		}if($unit_cetak == '3020')
		{
			$pdf->Cell(0,1,'RSUD WALED - PATOLOGI ANATOMI',0,1,'L');
		}
		if($unit_cetak == '3003')
		{
			$pdf->Cell(0,1,'RSUD WALED - RADIOLOGI',0,1,'L');
		}
        $pdf->SetFont('Times','',8);
		$pdf->SetXY(75,16);
		if($layanan_header['kode_tipe_transaksi'] == '2'){
			$pdf->Cell(0,1,'Resep Kredit',0,1,'L'); 
		}else{
			$pdf->Cell(0,1,'Resep Tunai',0,1,'L'); 
		}
        $pdf->SetFont('Times','',10);
       	$pdf->Line(2, 19, 95,19);
		$pdf->SetXY(5,22);
        $pdf->Cell(0,1,'Kode Layanan.',0,1);
		$pdf->SetXY(35,22);
        $pdf->Cell(0,1,': '.$layanan_header['kode_layanan_header'],0,1);
		$pdf->SetXY(5,26);
        $pdf->Cell(0,1,'No RM',0,1);
		$pdf->SetXY(35,26);
        $pdf->Cell(0,1,': '.$mt_pasien['no_rm'] ,0,1);
		$pdf->SetXY(5,30);
        $pdf->Cell(0,1,'Nama Pasien',0,1);
		$pdf->SetXY(35,30);
        $pdf->Cell(0,1,': '.$mt_pasien['nama_px'] ,0,1);
		$pdf->SetXY(5,34);
        $pdf->Cell(0,1,'Tanggal lahir / JK',0,1);
		$pdf->SetXY(35,34);
        $pdf->Cell(0,1,': '.date("d-m-Y",strtotime($mt_pasien['tgl_lahir'])).' / ' . $mt_pasien['jenis_kelamin'] ,0,1);
		$lahir    =new DateTime($mt_pasien['tgl_lahir']);
        $today        =new DateTime();
        $umur = $today->diff($lahir);
		$pdf->SetXY(5,38);
        $pdf->Cell(0,1,'Umur',0,1);
		$pdf->SetXY(35,38);
        $pdf->Cell(0,1,': '. $umur->y.'Th',0,1);
		$pdf->SetXY(5,42);
        $pdf->Cell(0,1,'Alamat',0,1);
		$pdf->SetXY(35,42);
        $pdf->Cell(0,1,': ',0,1);
		$pdf->SetXY(37,41);
        $pdf->MultiCell(60,4,$alamat['alamat']) ;


		$H11 = $pdf->GetY();
		$y = $H11+4;
		$pdf->SetXY(5,$y);
        $pdf->Cell(0,1,'Unit asal',0,1);
		$pdf->SetXY(35,$y);
        $pdf->Cell(0,1,': '.$mt_unit['nama_unit'],0,1);
		$pdf->SetXY(5,$y+4);
        $pdf->Cell(0,1,'Penjamin',0,1);
		$pdf->SetXY(35,$y+4);
        $pdf->Cell(0,1,': '.$mt_penjamin['nama_penjamin'],0,1);
		$pdf->SetXY(5,$y+8);
        $pdf->Cell(0,1,'Dokter Pengirim',0,1);
		$pdf->SetXY(35,$y+8);
        $pdf->Cell(0,1,': '.$mt_paramedis['nama_paramedis'],0,1);

        $y1 = $pdf->GetY();
		$pdf->Line(2, $y1+2, 95,$y1+2);
        $y2 = $pdf->GetY()+4;
		$pdf->SetFont('Arial','B',8);
		$pdf->SetXY(2,$y2);
        $pdf->Cell(0,1,'Nama Layanan',0,1); 
 
		$pdf->SetXY(65,$y2);
        $pdf->Cell(0,1,'Qty retur',0,1); 
 
		$pdf->SetXY(85,$y2);
        $pdf->Cell(0,1,'Tarif',0,1); 
        $y3 = $pdf->GetY()+2;
		$pdf->Line(2, $y3, 95,$y3);	   
        
        $y4 = $pdf->GetY()+2;
		$total_retur = 0;
		for($i = 0;$i<$det_ret_count; $i++)
		{			
			$pdf->SetXY(2,$y4+1);
			$pdf->MultiCell(60,4,$detail_retur[$i]['NAMA_TARIF']);
			// $pdf->Cell(0,1,$mt_tarif_header['NAMA_TARIF'],0,1); 
            $y4x = $pdf->GetY();
			$pdf->SetXY(70,$y4x-2);
			$pdf->MultiCell(0,1,$detail_retur[$i]['qty_retur'],0,1); 
            $y4x1 = $pdf->GetY();
			$pdf->SetXY(82,$y4x1-1);
			$pdf->MultiCell(0,1,rupiah($detail_retur[$i]['total_retur']),0,1); 
			$H = $pdf->GetY();
			$y4 = $H+2;
			$total_retur = $total_retur + $detail_retur[$i]['total_retur'];
		}			
        $y5= $pdf->GetY()+3;
		$pdf->Line(2,$y5, 95,$y5);
        $y6= $pdf->GetY()+5;
		$pdf->SetXY(55,$y6);
        $pdf->Cell(0,1,'Total Retur',0,1);
		$pdf->SetXY(80,$y6);
        $pdf->Cell(0,1,rupiah($total_retur),0,1);
        $y7= $pdf->GetY()+3;
		$pdf->Line(2,$y7, 95,$y7);
        $y8= $pdf->GetY()+5;	
        $pdf->SetFont('Arial','I',7);
		$pdf->SetXY(10,$y8);
        $pdf->Cell(0,1,'tanggal entry ',0,1);	
		$pdf->SetXY(30,$y8);
        $pdf->Cell(0,1,': '.$layanan_header['tgl_entry'],0,1);	
        $y9= $pdf->GetY()+2;	
		$user = $this->session->userdata('username');
		$pdf->SetXY(10,$y9);
        $pdf->Cell(0,1,'Diinput oleh ',0,1);	
		$pdf->SetXY(30,$y9);
        $pdf->Cell(0,1,': '.$user,0,1);	
		
        $pdf->Output();
    }
    function PrintRincianBiaya($no_rm,$counter)
    {
		$header = $this->model_pencarian->call_sp_rincian($no_rm,$counter);	
        $data = [
            'counter' => $counter,
            'rm' => $no_rm,
            'nama' => $header[0]['NAMA_PX'],
        ];	
        $this->session->set_userdata($data);
        $array_kelompok = []; 
        $array_unit = []; 
        $array_kelompok_tarif = []; 
        $array_kode_header = []; 
        $kelompok = '';
        $unit = '';
        $kelompok_tarif = '';
        $kode_header = '';
        $total = 0;
        $TOTAL_dibayar = 0;
        $TOTAL_PENJAMIN = 0;
        $TOTAL_PRIBADI = 0;
        $SEQ_2 = '';
        foreach($header as $j){
        $TOTAL_DIBAYAR1 =  $TOTAL_dibayar + $j['DIBAYAR_TUNAI'];
        $TOTAL_dibayar = $TOTAL_DIBAYAR1;
        $TOTAL_PRIBADI1 =  $TOTAL_PRIBADI + $j['TAGIHAN_PRIBADI'];
        $TOTAL_PRIBADI = $TOTAL_PRIBADI1;
        $TOTAL_PENJAMIN1 =  $TOTAL_PENJAMIN + $j['TAGIHAN_PENJAMIN'];
        $TOTAL_PENJAMIN = $TOTAL_PENJAMIN1;
        $kelompok1 = $j['SEQ_1'];
        $kelompok_tarif1= $j['KELOMPOK_TARIF'];
        $SEQ22= $j['SEQ_2'];
        $unit1 = $j['NAMA_UNIT'];
        $kode_header1 = $j['KODE_LAYANAN_HEADER'];
        if($kelompok != $kelompok1)
            {
            $data_loop = [
				'kelompok' => $kelompok1,			
			    ];
                array_push ($array_kelompok,$data_loop);	
            }
            $kelompok = $kelompok1;	   
        if($unit != $unit1)            
            {          
                $jlh= 0;
                foreach($array_unit as $au){
                    if($au['unit'] == $unit1 && $au['kelompok'] == $kelompok){
                        $jlh++;
                    }
                }      
                if($jlh == 0){
                    $data_loop2 = [
                        'unit' => $unit1,
                        'kelompok' =>	$j['SEQ_1']		
                        ];
                        array_push ($array_unit,$data_loop2);	
                }
                    
            }
            $unit = $unit1;	   
        // if($kelompok_tarif != $kelompok_tarif1)            
        //     {        
        //        $jlh= 0;
        //         foreach($array_kelompok_tarif as $kt){
        //             if($kt['kelompok_tarif'] == $kelompok_tarif1 && $kt['kelompok'] == $kelompok){
        //                 $jlh++;
        //             }
        //          }     
        //         if($jlh == 0){
        //         $data_loop3 = [
        //             'unit' => $j['NAMA_UNIT'],
        //             'kelompok' => $j['SEQ_1'],
        //             'kelompok_tarif' => $kelompok_tarif1
        //         ];
        //         array_push ($array_kelompok_tarif,$data_loop3);	
        //     }
        // }

            $jlht = 0;
            foreach($array_kelompok_tarif as $kt){
                if($kt['kelompok_tarif'] == $j['KELOMPOK_TARIF'] && $kt['seq2'] == $j['SEQ_2']){
                    $jlht++;
                }
            } 
            if($jlht == 0){
                $data_loop3 = [
                    'unit' => $j['NAMA_UNIT'],
                    'kelompok' => $j['SEQ_1'],
                    'kelompok_tarif' => $kelompok_tarif1,
                    'seq2' => $j['SEQ_2']
                ];
                array_push ($array_kelompok_tarif,$data_loop3);
            }
           
                $jlhc= 0;
                foreach($array_kode_header as $kd){
                    if($kd['kode_header'] == $kode_header1 && $kd['kelompok_tarif'] == $j['KELOMPOK_TARIF']){
                        $jlhc++;
                    }
                } 
                if($jlhc == 0){
                    $data_loop4 = [
                        'unit' => $j['NAMA_UNIT'],
                        'kelompok' => $j['SEQ_1'],
                        'kelompok_tarif' => $j['KELOMPOK_TARIF'],
                        'kode_header' => $kode_header1,
                    ];
                    array_push ($array_kode_header,$data_loop4);	
                }
                $kode_header = $kode_header1;
                $kelompok_tarif = $kelompok_tarif1;	
                
            }
            // VAR_DUMP($array_kelompok_tarif);DIE;
        error_reporting(0); 
		$pdf = new PDF_AutoPrint_rincian_biaya('P','mm','A4');
        $pdf->header = 0;
        $pdf->footer = 0;        
        $pdf->AliasNbPages();
		$pdf -> SetMargins(4, 4, 4);
		// $pdf -> SetAutoPageBreak(2,30); 
        $pdf->addPage('','',false); 
        // $pdf->AddPage(); 
        $pdf->Image(base_url('assets/assets/img/logo_rs.png'), 8, 5, 22, 18);
        $pdf->SetFont('Times','',10);
		$pdf->SetXY(75,8);
        $pdf->Cell(0,1,'PEMERINTAH KABUPATEN CIREBON',0,1,'L');       
		$pdf->SetXY(59,12);
        $pdf->Cell(0,1,'RUMAH SAKIT UMUM DAERAH WALED KAB.CIREBON',0,1,'L');       
		$pdf->SetXY(70,16);
        $pdf->Cell(0,1,'Jln. Prabu Kiansantang No.4 Waled Kab.Cirebon',0,1,'L');       
		$pdf->SetXY(76,20);
        $pdf->Cell(0,1,'Tlp. ( 0231 ) 661126 Fax. ( 0231 ) 664091',0,1,'L');       
        $pdf->Line(2, 25, 208,25);
        $pdf->Line(2, 26, 208,26);
        // $y = $pdf->GetY();  
        $pdf->SetXY(85,30);
        $pdf->Cell(0,1,'RINCIAN BIAYA PASIEN',0,1,'L');  
        $pdf->Line(2, 26, 208,26);
        $pdf->Rect(5, 35, 200, 25, 'S');
        $y = $pdf->GetY()+8;  
        $pdf->SetXY(6,$y);
        $pdf->Cell(0,1,'No. RM',0,1,'L'); 
        $pdf->SetXY(30,$y);
        $pdf->Cell(0,1,': '.$header['0']['NORM'],0,1,'L'); 
        $pdf->SetXY(125,$y);
        $pdf->Cell(0,1,'Penjamin',0,1,'L'); 
        $pdf->SetXY(150,$y);
        $pdf->Cell(0,1,': '.$header['0']['PENJAMIN'],0,1,'L'); 
        $y1 = $pdf->GetY()+3;  
        $pdf->SetXY(6,$y1);
        $pdf->Cell(0,1,'Nama Pasien',0,1,'L'); 
        $pdf->SetXY(30,$y1);
        $pdf->Cell(0,1,': '.$header['0']['NAMA_PX'],0,1,'L'); 
        $pdf->SetXY(125,$y1);
        $pdf->Cell(0,1,'No. SEP',0,1,'L'); 
        $pdf->SetXY(150,$y1);
        $pdf->Cell(0,1,': '.$header['0']['SEP'],0,1,'L'); 
        $y2 = $pdf->GetY()+3;  
        $pdf->SetXY(6,$y2);
        $pdf->Cell(0,1,'Jenis Kelamin',0,1,'L'); 
        $pdf->SetXY(30,$y2);
        $pdf->Cell(0,1,': '.$header['0']['JK'],0,1,'L');
        $pdf->SetXY(125,$y2);
        $pdf->Cell(0,1,'Tanggal Masuk',0,1,'L'); 
        $pdf->SetXY(150,$y2);
        $pdf->Cell(0,1,': '.$header['0']['TGL_MASUK'],0,1,'L');  
        $y3 = $pdf->GetY()+4;  
        $pdf->SetXY(6,$y3);
        $pdf->Cell(0,1,'Alamat',0,1,'L'); 
        $pdf->SetXY(30,$y3);
        $pdf->Cell(0,1,':',0,1,'L'); 
        $pdf->SetXY(32,$y3-1);
        $pdf->MultiCell(80,3,$header['0']['ALAMAT'],0,1); 
        $pdf->SetXY(125,$y3);
        $pdf->Cell(0,1,'Tanggal Pulang',0,1,'L'); 
        $pdf->SetXY(150,$y3);
        $pdf->Cell(0,1,': '.$header['0']['TGL_KELUAR'],0,1,'L'); 
        $y4 = $pdf->GetY()+9;  
        $pdf->Line(2, $y4, 208,$y4);
        $pdf->Line(2, $y4+1, 208,$y4+1);
        $y5 = $pdf->GetY()+13;  
        $pdf->SetXY(6,$y5);
        $pdf->Cell(0,1,'No',0,1,'L'); 
        $pdf->SetXY(45,$y5);
        $pdf->Cell(0,1,'Keterangan',0,1,'L'); 
        $pdf->SetXY(120,$y5);
        $pdf->Cell(0,1,'Dibayar Tunai',0,1,'L'); 
        $pdf->SetXY(158,$y5);
        $pdf->Cell(0,1,'Pribadi',0,1,'L'); 
        $pdf->SetXY(185,$y5);
        $pdf->Cell(0,1,'Penjamin',0,1,'L'); 
        $pdf->Line(2, $y5+4, 208,$y5+4);
        $y6 = $pdf->GetY()+8;
        foreach($array_kelompok as $k){
            $pdf->SetFont('Times','B',10);
            $pdf->SetXY(95,$y6);
            $pdf->Cell(0,1,$k['kelompok'],0,1,'L');
            $y8 = $pdf->GetY();
            $total_kelompok_unit_penjamin  = 0;
            $total_kelompok_unit_pribadi  = 0;
            $total_kelompok_unit_dibayar  = 0;
            foreach($array_unit as $u){
                if($u['kelompok'] == $k['kelompok']){

                    $pdf->SetFont('Times','B',10);
                    $pdf->SetXY(4,$y8);
                    $pdf->Cell(0,1,$u['unit'],0,1,'L');
                    $y10 = $pdf->GetY()+2;
                    $total_kelompok_unit_penjamin  = 0;
                    $total_kelompok_unit_pribadi  = 0;
                    $total_kelompok_unit_dibayar  = 0;
                    foreach($header as $hu){
                        if($hu['SEQ_1'] == $k['kelompok'] &&  $u['unit'] == $hu['NAMA_UNIT']){
                            $total_kelompok_unit_penjamin1 = $hu['TAGIHAN_PENJAMIN'];
                            $total_kelompok_unit_penjamin = $total_kelompok_unit_penjamin1 + $total_kelompok_unit_penjamin;

                            $total_kelompok_unit_pribadi1 = $hu['TAGIHAN_PRIBADI'];
                            $total_kelompok_unit_pribadi = $total_kelompok_unit_pribadi1 + $total_kelompok_unit_pribadi;

                            $total_kelompok_unit_dibayar1 = $hu['DIBAYAR_TUNAI'];
                            $total_kelompok_unit_dibayar = $total_kelompok_unit_dibayar1 + $total_kelompok_unit_dibayar;
                        }
                    }
                    foreach($array_kelompok_tarif as $kt){
                        if($kt['unit'] == $u['unit'] && $kt['kelompok'] == $k['kelompok']){                           
                            $pdf->SetFont('Times','B',10);
                            $pdf->SetXY(4,$y10);
                            $pdf->Cell(0,1,$kt['kelompok_tarif'],0,1,'L');
                            $y12 = $pdf->GetY()+4;
                            $total_kelompok_tarif = 0;
                            foreach($array_kode_header as $kdh)
                            {
                                if($kdh['kelompok'] == $k['kelompok'] && $kdh['kelompok_tarif'] == $kt['kelompok_tarif'] && $kdh['unit'] == $u['unit']){
                                    $pdf->SetFont('Times','B',10);
                                    $pdf->SetXY(4,$y12);
                                    $pdf->Cell(0,1,$kdh['kode_header'],0,1,'L');
                                    $y14 = $pdf->GetY()+4;
                                    $i = 1;
                                    $total_pribadi = 0;
                                    $total_penjamin = 0;
                                    $total_bayar_tunai = 0;
                                    $total_kelompok_tarif_penjamin  = 0;
                                    $total_kelompok_tarif_pribadi  = 0;
                                    $total_kelompok_tarif_dibayar  = 0;
                                    $array_temp = [];
                                    foreach($header as $h){                                   
                                    if($h['SEQ_1'] == $k['kelompok'] &&  $u['unit'] == $h['NAMA_UNIT'] && $kt['kelompok_tarif'] == $h['KELOMPOK_TARIF']){
                                        $total_kelompok_tarif_penjamin1 = $h['TAGIHAN_PENJAMIN'];
                                        $total_kelompok_tarif_penjamin = $total_kelompok_tarif_penjamin1 + $total_kelompok_tarif_penjamin;

                                        $total_kelompok_tarif2 = $h['TAGIHAN_PRIBADI'];
                                        $total_kelompok_tarif_pribadi = $total_kelompok_tarif2 + $total_kelompok_tarif_pribadi;

                                        $total_kelompok_tarif_dibayar2 = $h['DIBAYAR_TUNAI'];
                                        $total_kelompok_tarif_dibayar = $total_kelompok_tarif_dibayar2 + $total_kelompok_tarif_dibayar;
                                    }                                   
                                    if($h['SEQ_1'] == $k['kelompok'] &&  $u['unit'] == $h['NAMA_UNIT'] && $kt['kelompok_tarif'] == $h['KELOMPOK_TARIF'] && $kdh['kode_header'] == $h['KODE_LAYANAN_HEADER']){
                                    $total_pribadi1 = $h['TAGIHAN_PRIBADI'];
                                    $total_pribadi = $total_pribadi1 + $total_pribadi;

                                    $total_bayar_tunai1 = $h['DIBAYAR_TUNAI'];
                                    $total_bayar_tunai = $total_bayar_tunai1 + $total_bayar_tunai;

                                    $total_penjamin1 = $h['TAGIHAN_PENJAMIN'];
                                    $total_penjamin = $total_penjamin1 + $total_penjamin;
                                    
                                    $DATA_temp = [
                                        'kode' => $kdh['kode_header'],
                                        'Kelompok' => $h['SEQ_1'],
                                        'nama' =>$h['NAMA_TARIF'],
                                        'unit' => $h['NAMA_UNIT']
                                    ];
                                    array_push ($array_temp,$DATA_temp);	

                                    $y14t = $pdf->GetY();
                                    $pdf->SetFont('Times','I',10);
                                    $pdf->SetXY(4,$y14t+3);
                                    $pdf->Cell(0,1,$i.'.',0,1,'L'); 
                                    $y14n = $pdf->GetY();
                                    $pdf->SetY($y14n-2);
                                    $pdf->SetX(10);
                                    $pdf->MultiCell(60,3,$h['NAMA_TARIF'],0,1); 
                                    $y14i = $pdf->GetY();
                                    $pdf->SetXY(80,$y14i-2);
                                    $pdf->Cell(0,1,$h['KELAS'],0,1,'L'); 
                                    $y14k = $pdf->GetY();
                                    $pdf->SetXY(100,$y14k-1);
                                    $tgl = str_replace("-","/",substr($h['TGL'],5));
                                    $pdf->Cell(0,1,$tgl,0,1,'L'); 
                                    $y14L = $pdf->GetY();
                                    $pdf->SetXY(115,$y14L-1);
                                    $pdf->Cell(0,1,rupiah($h['JUMLAH_LAYANAN']),0,1,'L'); 
                                    $y14N = $pdf->GetY();
                                    $pdf->SetXY(130,$y14N-1);
                                    $pdf->Cell(0,1,rupiah($h['DIBAYAR_TUNAI']),0,1,'L'); 
                                    $y14M = $pdf->GetY();
                                    $pdf->SetXY(160,$y14M-1);
                                    $pdf->Cell(0,1,rupiah($h['TAGIHAN_PRIBADI']),0,1,'L'); 
                                    $y14j = $pdf->GetY();
                                    $pdf->SetXY(188,$y14j-1);
                                    $pdf->Cell(0,1,rupiah($h['TAGIHAN_PENJAMIN']),0,1,'L'); 
                                    $y14j = $pdf->GetY();
                                    $pdf->SetFont('Times','',10);
                                    $pdf->SetXY(8,$y14j+2);
                                    $pdf->Cell(0,1,$h['NAMA_PARAMEDIS'],0,1,'L'); 
                                    $y15 = $pdf->GetY();
                                    $y14 = $y15+4;
                                    $i++;

                                        }
                                    }
                                    $yx15 = $pdf->GetY();
                                    $yx14 = $yx15+4;
                                    $pdf->Line(120,$yx14-3, 205, $yx14-3);    
                                    $pdf->SetFont('Times','B',10);
                                    $pdf->SetXY(160,$yx14);
                                    $pdf->Cell(0,1,rupiah($total_pribadi),0,1,'L'); 
                                    $yx16 = $pdf->GetY();
                                    $yx17 = $yx16-1;
                                    $pdf->SetFont('Times','B',10);
                                    $pdf->SetXY(188,$yx17);
                                    $pdf->Cell(0,1,rupiah($total_penjamin),0,1,'L'); 
                                    $yx16 = $pdf->GetY();
                                    $yx17 = $yx16-1;
                                    $pdf->SetFont('Times','B',10);
                                    $pdf->SetXY(130,$yx17);
                                    $pdf->Cell(0,1,rupiah($total_bayar_tunai),0,1,'L'); 
                                }                              
                                $y13 = $pdf->GetY();                               
                                $y12 = $y13+4;                       
                            }     
                                      
                            $y16 = $pdf->GetY();
                            $pdf->SetFont('Times','B',8);
                            $pdf->SetXY(30,$y16+6);
                            $pdf->Cell(0,1,'Sub Total '.$kt['kelompok_tarif'],0,1,'L'); 
                            $y17 = $pdf->GetY();
                            $pdf->SetFont('Times','B',10);
                            $pdf->SetXY(116,$y17-1);
                            $pdf->Cell(0,1,': ',0,1,'L');                       
                            $pdf->SetXY(188,$y17-1);
                            $pdf->Cell(0,1,rupiah($total_kelompok_tarif_penjamin),0,1,'L');    
                            $pdf->SetFont('Times','B',10);
                            $pdf->SetXY(116,$y17-1);
                            $pdf->Cell(0,1,': ',0,1,'L');                       
                            $pdf->SetXY(160,$y17-1);
                            $pdf->Cell(0,1,rupiah($total_kelompok_tarif_pribadi),0,1,'L');    
                            $pdf->SetXY(130,$y17-1);
                            $pdf->Cell(0,1,rupiah($total_kelompok_tarif_dibayar),0,1,'L');    
                            $pdf->Line(4,$y17+2, 208, $y17+2);    
                        }                     
                        $y11 = $pdf->GetY();
                        $y10 = $y11+4;                   
                    }
                    $y20 = $pdf->GetY();
                    $pdf->SetFont('Times','B',10);
                    $pdf->SetXY(30,$y20+4);
                    $pdf->Cell(0,1,"Sub Total ".$u['unit'],0,1,'L');                       
                    $pdf->SetXY(116,$y20+4);
                    $pdf->Cell(0,1,': ',0,1,'L');                       
                    $pdf->SetXY(130,$y20+4);
                    $pdf->Cell(0,1,rupiah($total_kelompok_unit_dibayar),0,1,'L');
                    $pdf->SetXY(160,$y20+4);
                    $pdf->Cell(0,1,rupiah($total_kelompok_unit_pribadi),0,1,'L');
                    $pdf->SetXY(188,$y20+4);
                    $pdf->Cell(0,1,rupiah($total_kelompok_unit_penjamin),0,1,'L');
                    $pdf->Line(4,$y20+2, 208, $y20+2);    
                    $y9 = $pdf->GetY();
                    $y8 = $y9+4;
                    
                }
            }   
            
            $y7 = $pdf->GetY();
            $pdf->Line(2, $y7+2, 208,$y7+2);           
            $pdf->Line(2, $y7+3, 208,$y7+3);           
            $y6 = $y7+9;
        }      
        $YX =  $pdf->GetY();
        $pdf->Line(4,$YX+10, 208, $YX+10);    
        $pdf->Line(4,$YX+11, 208, $YX+11);    
        $pdf->SetXY(30,$YX+7);
        $pdf->Cell(0,1,"Total tagihan",0,1,'L');
        $pdf->SetXY(116,$YX+7);
        $pdf->Cell(0,1,":",0,1,'L');
        $pdf->SetXY(130,$YX+7);
        $pdf->Cell(0,1,rupiah($TOTAL_dibayar),0,1,'L');
        $pdf->SetXY(160,$YX+7);
        $pdf->Cell(0,1,rupiah($TOTAL_PRIBADI),0,1,'L');
        $pdf->SetXY(188,$YX+7);
        $pdf->Cell(0,1,rupiah($TOTAL_PENJAMIN),0,1,'L');
        $YX1 =  $pdf->GetY();
        $pdf->SetXY(4,$YX1+8);
        $pdf->Cell(0,1,"Waled , ".date('Y-m-d'),0,1,'L');
        $YX2 =  $pdf->GetY();
        $pdf->SetXY(4,$YX2+4);
        $pdf->Cell(0,1,"Petugas",0,1,'L');
        $YX3 =  $pdf->GetY();
        $pdf->Line(4,$YX3+20, 40, $YX3+20);  
       $pdf->Output();
    }
    function printEX($id_detail)
    {
        $isi = $this->db->get_where('ts_hasil_expertisi_pa',array('id_detail' => $id_detail))->row_array();
        $layanan_header =  $this->db->get_where('ts_layanan_header',array('id' => $isi['id_header']))->row_array();
		$ts_kj = $this->db->get_where('ts_kunjungan',array('kode_kunjungan' => $isi['kode_kunjungan']))->row_array();
		$DOK1 = $this->db->get_where('mt_paramedis',array('kode_paramedis' => $layanan_header['dok_kirim']))->row_array();
		$DOK2 = $this->db->get_where('mt_paramedis',array('kode_paramedis' => $isi['kode_dokter']))->row_array();
		$pasien = $this->db->get_where('mt_pasien',array('no_rm' => $isi['no_rm']))->row_array();
		$desa = $this->db->get_where('mt_lokasi_villages',array('id' => $pasien['kode_desa']))->row_array();
		$kecamatan = $this->db->get_where('mt_lokasi_districts',array('id' => $desa['district_id']))->row_array();
		$alamat = $this->db->get_where('mt_lokasi_regencies',array('id' => $pasien['kabupaten']))->row_array();
        $data = [
            'tgl_input' => $isi['tgl_input_layanan'],
            'no_periksa' => $isi['no_periksa'],
            'dok1' => $DOK1['nama_paramedis'],
            'no_rm' =>         $isi['no_rm'],
            'nama_pasien' => $pasien['nama_px'],
            'unit_asal'=> $isi['unit_asal'],
            'tgl_lahir'=> $pasien['tgl_lahir'],
            'dok2'=> $DOK2['nama_paramedis'],
            'desa'=> $desa['name'],
           'kec' =>  $kecamatan['name'],
           'tgl_baca' => $isi['tgl_baca']
        ];
        $this->session->set_userdata($data);
		$isi_expert = $this->modelBilling->get_isi_expert($id_detail);
		$date = date('Y-m-d');
  //       error_reporting(0); // AGAR ERROR MASALAH VERSI PHP TIDAK MUNCUL
  //       $pdf = new PDF_AutoPrint_expertisi('P','mm','A4');
  //       $pdf->header = 0;
  //       $pdf->footer = 0;        
  //       $pdf->AliasNbPages();
		// // $pdf -> SetMargins(4, 4, 4);
  //       $pdf->addPage('','',false); 
  //       $pdf->Image(base_url('assets/assets/img/kab.png'), 10, 10, 25, 23);
		// $pdf->Image(base_url('assets/assets/img/logo_rs.png'), 175, 10, 25, 20);
  //       $pdf->SetFont('Arial','B',12);
  //       $pdf->Cell(0,7,'RUMAH SAKIT UMUM DAERAH WALED',0,1,'C');
  //       $pdf->Cell(10,0,'',0,1);
  //       $pdf->SetFont('Arial','B',14);
  //       $pdf->Cell(0,7,'INSTALASI LABORATORIUM PATOLOGI KLINIK DAN',0,1,'C');
  //       $pdf->Cell(10,0,'',0,0);
  //       $pdf->Cell(0,7,'KEDOKTERAN LABORATORIUM',0,1,'C');
  //       $pdf->Cell(10,1,'',0,1);
		// $pdf->SetFont('Arial','B',10);
  //       $pdf->Cell(0,7,'Jl. Prabu Kiansantang No.4, Waled Kota, Waled, Cirebon, Jawa Barat 45187',0,1,'C');
  //       $pdf->Cell(10,0,'',0,0); 
		// $pdf->Line(10, 40, 205,40);
		// $pdf->SetFont('Arial','B',10);	

		// $pdf->SetXY(10, 40);
  //       $pdf->Cell(10,7,'Tanggal',0,1);
		// $pdf->SetXY(40, 40);
  //       $pdf->Cell(10,7,':',0,1);
		// $pdf->SetXY(45, 40);
		// $pdf->Cell(10,7,date("d-m-Y",strtotime($isi['tgl_input_layanan'])),0,1);

		// $pdf->SetXY(110, 40);
  //       $pdf->Cell(10,7,'Nomor pemeriksaan',0,1);
		// $pdf->SetXY(145, 40);
  //       $pdf->Cell(10,7,':',0,1);
		// $pdf->SetXY(150, 40);
  //       $pdf->Cell(10,7,$isi['no_periksa'],0,1);


		// $pdf->SetXY(10, 45);
  //       $pdf->Cell(10,7,'Nomor RM',0,1);
		// $pdf->SetXY(40, 45);
  //       $pdf->Cell(10,7,':',0,1);
		// $pdf->SetXY(45, 45);
  //       $pdf->Cell(10,7,$isi['no_rm'],0,1);

		// $pdf->SetXY(110, 61);
		// $pdf->MultiCell(135,4,'Dokter Pengirim');
  //       // $pdf->Cell(10,7,'Dokter Pengirim',0,1);
		
		// $pdf->SetXY(145, 61);
		// $pdf->MultiCell(143,4,':');

		// $pdf->SetXY(150, 61);
		// $pdf->MultiCell(56,4,$DOK1['nama_paramedis']);

  //       // $pdf->Cell(10,7,$DOK1['nama_paramedis'],0,1);


		// $pdf->SetXY(10, 50);
  //       $pdf->Cell(10,7,'Nama',0,1);
		// $pdf->SetXY(40, 50);
  //       $pdf->Cell(10,7,':',0,1);	
		// $pdf->SetXY(45, 50);
  //       $pdf->Cell(10,7,$pasien['nama_px'],0,1);	

		// $pdf->SetXY(110, 45);
  //       $pdf->Cell(10,7,'Asal / Ruangan',0,1);
		// $pdf->SetXY(145, 45);
  //       $pdf->Cell(10,7,':',0,1);
		// $pdf->SetXY(150, 45);
  //       $pdf->Cell(10,7,$isi['unit_asal'],0,1);

		// $pdf->SetXY(10, 55);
  //       $pdf->Cell(10,7,'Tanggal lahir',0,1);
		// $pdf->SetXY(40, 55);
  //       $pdf->Cell(10,7,':',0,1);
		// $pdf->SetXY(45, 55);
		// $pdf->Cell(10,7,date("d-m-Y",strtotime($pasien['tgl_lahir'])),0,1);

		// $pdf->SetXY(110, 55);
  //       $pdf->Cell(10,7,'Dokter PA',0,1);
		// $pdf->SetXY(145, 55);
  //       $pdf->Cell(10,7,':',0,1);
		// $pdf->SetXY(150, 55);
  //       $pdf->Cell(10,7,$DOK2['nama_paramedis'],0,1);

		// $pdf->SetXY(10, 60);
  //       $pdf->Cell(10,7,'Alamat',0,1);
		// $pdf->SetXY(40, 60);
  //       $pdf->Cell(10,7,':',0,1);
		// $pdf->SetXY(45, 60);
  //       $pdf->Cell(10,7,$desa['name'].' / '.$kecamatan['name'],0,1);
		
		// $pdf->SetXY(110, 50);
  //       $pdf->Cell(10,7,'Tanggal selesai',0,1);
		// $pdf->SetXY(145, 50);
  //       $pdf->Cell(10,7,':',0,1);
		// $pdf->SetXY(150, 50);
		// $pdf->Cell(10,7,date("d-m-Y",strtotime($isi['tgl_baca'])),0,1);
  //       // $pdf->Cell(10,7,$isi['tgl_baca'],0,1);
		// $pdf->Line(10, 69, 205,69);
		// $pdf->Line(10, 70, 205,70);
  //       $y = $pdf->GetY();
  //       $pdf->SetXY(20, $y+15);
		// $pdf->SetFont('Arial','B',12);
  //       $pdf->Cell(0,7,'PATOLOGI ANATOMI',0,1,'C');
  //       $pdf->Cell(10,0,'',0,1);
  //       $y2 = $pdf->GetY();
		// $pdf->SetXY(20, $y2);
		// $pdf->SetFont('Arial','B',12);
  //       $pdf->Cell(0,7,$isi['no_periksa'],0,1,'C');
  //       $pdf->Cell(10,0,'',0,1);
  //       $y3 = $pdf->GetY();
  //       $pdf->SetFont('Arial','B',10);
		// $pdf->SetXY(10, $y3);
		// $pdf->MultiCell(100,5,'Jenis sampel ');
  //       $pdf->SetXY(60, $y3);
		// $pdf->MultiCell(143,4,$isi['tipe']);
  //       $y4 = $pdf->GetY()+3;
  //       $pdf->SetXY(10, $y4);
		// $pdf->MultiCell(100,5,'MAKROSKOPIS');
  //       $pdf->SetXY(60, $y4);
		// $pdf->MultiCell(143,4,$isi_expert['makro']);
  //       $y5 = $pdf->GetY()+3;
  //       $pdf->SetXY(10, $y5);
		// $pdf->MultiCell(100,5,'MIKROSKOPIS');
  //       $pdf->SetXY(60, $y5);
		// $pdf->MultiCell(143,4,$isi_expert['mikro']);
        
  //       $y6 = $pdf->GetY()+3;
  //       $pdf->SetXY(10, $y6);
		// $pdf->MultiCell(100,5,'KESIMPULAN');
  //       $pdf->SetXY(60, $y6);
		// $pdf->MultiCell(143,4,$isi_expert['kesimpulan']);
  //       $y7 = $pdf->GetY()+3;
  //       $pdf->Line(10, $y7, 205,$y7);
		// $pdf->Line(10, $y7+1, 205,$y7+1);
  //       $y8 = $pdf->GetY()+4;
  //       $pdf->SetXY(165, $y8);
		// $pdf->SetFont('Arial','',10);
  //       $pdf->Cell(0,7,'Cirebon, '.$date,0,1,'C');
  //       $y9 = $pdf->GetY();
  //       $pdf->SetXY(162, $y9);
		// $pdf->Cell(10,7,'DPJP Laboratorium PA',0,1);
  //       $y10 = $pdf->GetY()+20;
		// $pdf->SetXY(160, $y10);
		// $pdf->Cell(10,7,'dr. Hani Andriani, Sp.PA',0,1);
		// $pdf->SetFont('Arial','B',8);
  //       $y11 = $pdf->GetY();
		// $pdf->SetXY(141, $y11);
		// $pdf->Cell(10,7,'449 / SIP.DSp-176 / SDK / DINKES / V / 2021 ',0,1);

  //       $pdf->AutoPrint();
  //       $pdf->Output();
    }
}