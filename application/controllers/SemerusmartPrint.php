<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class SemerusmartPrint extends CI_Controller {
    public function __construct()
    {
        parent::__construct();	
		$username = $this->session->userdata('hak_akses');
		if ($this->session->userdata('username') == '') {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Anda harus Login!</div>');
            redirect('Auth');
        }
		// else if($username != '3'){
		// 	$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Anda harus Login sebagai admin!</div>');
		// 	redirect('Auth');
		// }
		$this->load->library('Pdf');
        $this->load->model('model_pencarian');   
        $this->load->model('modelBilling');   
        $this->load->model('modelGetNomor');   
    }
	public function index()
	{
        $data['user'] = $this->db->get_where('dd_user', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = "SemerusmartReborn - Billing";
		$this->load->view('templates/header',$data);
		$this->load->view('templates/navbar',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('Billing/index',$data);
		$this->load->view('templates/footer');
	}
	function printRincian($kode_layanan_header)
	{		
		$layanan_header = $this->db->get_where('ts_layanan_header',array('id' => $kode_layanan_header))->row_array();
		$ts_kunjungan = $this->db->get_where('ts_kunjungan',array('kode_kunjungan' => $layanan_header['kode_kunjungan']))->row_array();
		$mt_pasien = $this->db->get_where('mt_pasien', array('no_rm' => $ts_kunjungan['no_rm']))->row_array();
		$mt_unit = $this->db->get_where('mt_unit',array('kode_unit' => $ts_kunjungan['kode_unit']))->row_array();
		$mt_penjamin = $this->db->get_where('mt_penjamin',array('kode_penjamin' => $ts_kunjungan
		['kode_penjamin']))->row_array();

		$det = $this->db->get_where('ts_layanan_detail',array('row_id_header' => $layanan_header['id']))->result_array();
		$det_count = $this->db->get_where('ts_layanan_detail',array('row_id_header' => $layanan_header['id']))->num_rows();
		$unit_cetak = $this->session->userdata('kode_unit');
		$no_rm = $mt_pasien['no_rm'];
		$alamat = $this->modelBilling->getAlamat($no_rm);
		error_reporting(0); // AGAR ERROR MASALAH VERSI PHP TIDAK MUNCUL
 
        // $pdf = new FPDF('P', 'mm','A4'); 
		$pdf = new FPDF('P','mm',array(105,140));
		// $pdf -> SetMargins(4, 2, 4);
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
		$y = $H11+4;
		$pdf->SetXY(5,$y);
        $pdf->Cell(0,1,'Unit asal',0,1);
		$pdf->SetXY(35,$y);
        $pdf->Cell(0,1,': '.$mt_unit['nama_unit'],0,1);
		$pdf->SetXY(5,$y+4);
        $pdf->Cell(0,1,'Penjamin',0,1);
		$pdf->SetXY(35,$y+4);
        $pdf->Cell(0,1,': '.$mt_penjamin['nama_penjamin'],0,1);
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
		for($i = 0;$i<$det_count; $i++)
		{
			$mt_tarif_detail = $this->db->get_where('mt_tarif_detail',array('KODE_TARIF_DETAIL' => $det[$i]['kode_tarif_detail']))->row_array();
			$mt_tarif_header = $this->db->get_where('mt_tarif_header',array('KODE_TARIF_HEADER' => $mt_tarif_detail['KODE_TARIF_HEADER']))->row_array();
			IF($det[$i]['jumlah_layanan'] != '0'){		
			$pdf->SetXY(4,$y);
			$pdf->MultiCell(60,4,$mt_tarif_header['NAMA_TARIF']);
			// $pdf->Cell(0,1,$mt_tarif_header['NAMA_TARIF'],0,1); 
	 
			$pdf->SetXY(70,$y+2);
			$pdf->MultiCell(0,1,$det[$i]['jumlah_layanan'],0,1); 
	 
			$pdf->SetXY(82,$y+2);
			$pdf->MultiCell(0,1,rupiah($det[$i]['total_tarif']),0,1); 
			$H = $pdf->GetY();
			$y = $H+6;
			}
		}		
		$pdf->Line(2,$y+3, 95,$y+3);
		$pdf->SetXY(55,$y+5);
        $pdf->Cell(0,1,'Total Bayar',0,1);
		$pdf->SetXY(80,$y+5);
        $pdf->Cell(0,1,rupiah($layanan_header['total_layanan']),0,1);
		$pdf->Line(2,$y+8, 95,$y+8);
		$pdf->SetFont('Times','',7);	
		$pdf->SetXY(10,$y+10);
        $pdf->Cell(0,1,'tanggal cetak ',0,1);
		$pdf->SetXY(30,$y+10);
        $pdf->Cell(0,1,': '.date('Y-m-d h:h'),0,1);
		$pdf->SetXY(10,$y+13);
        $pdf->Cell(0,1,'tanggal entry ',0,1);	
		$pdf->SetXY(30,$y+13);
        $pdf->Cell(0,1,': '.$layanan_header['tgl_entry'],0,1);	
		$user = $this->session->userdata('username');
		$pdf->SetXY(10,$y+16);
        $pdf->Cell(0,1,'Diinput oleh ',0,1);	
		$pdf->SetXY(30,$y+16);
        $pdf->Cell(0,1,': '.$user,0,1);	
		if($unit_cetak == '3011')
		{
		$pdf->SetXY(65,$y+10);
		$H = $pdf->GetY();
		$y = $H+2;
        $pdf->Cell(0,1,'kantong darah yang dipakai ',0,1);
		$darah_pakai = $this->db->get_where('ts_pemakaian_darah',array('nomor_layanan_header' => $layanan_header['kode_layanan_header'],'status_retur' => 2))->num_rows();
		$darah_dipakai = $this->db->get_where('ts_pemakaian_darah',array('nomor_layanan_header' => $layanan_header['kode_layanan_header'],'status_retur' => 2))->result_array();
		for($j = 0;$j<$darah_pakai; $j++)
		{			 	 
			$pdf->SetXY(65,$y+3);
			$pdf->MultiCell(0,1,'- '. $darah_dipakai[$j]['nomor_kantong'],0,1); 
			$H = $pdf->GetY();
			$y = $H;			
		}
	}
		

        $pdf->Output();
	}
	function printRincianRetur($kode_layanan_header)
	{		
		$layanan_header = $this->db->get_where('ts_layanan_header',array('id' => $kode_layanan_header))->row_array();
		$ts_kunjungan = $this->db->get_where('ts_kunjungan',array('kode_kunjungan' => $layanan_header['kode_kunjungan']))->row_array();
		$mt_pasien = $this->db->get_where('mt_pasien', array('no_rm' => $ts_kunjungan['no_rm']))->row_array();
		$mt_unit = $this->db->get_where('mt_unit',array('kode_unit' => $ts_kunjungan['kode_unit']))->row_array();
		$mt_penjamin = $this->db->get_where('mt_penjamin',array('kode_penjamin' => $ts_kunjungan
		['kode_penjamin']))->row_array();
		$no_rm = $mt_pasien['no_rm'];

		$alamat = $this->modelBilling->getAlamat($no_rm);

		$det_ret_count = $this->model_pencarian->count_retur_detail($layanan_header['kode_layanan_header']);	
		$detail_retur = $this->model_pencarian->get_retur_detail($layanan_header['kode_layanan_header']);	
		$unit_cetak = $this->session->userdata('kode_unit');

		error_reporting(0); // AGAR ERROR MASALAH VERSI PHP TIDAK MUNCUL 
        $pdf = new FPDF('P','mm',array(105,140));
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
		$pdf->Line(2, $y+7, 95,$y+7);
		$pdf->SetFont('Arial','B',8);
		$pdf->SetXY(2,$y+9);
        $pdf->Cell(0,1,'Nama Layanan',0,1); 
 
		$pdf->SetXY(70,$y+9);
        $pdf->Cell(0,1,'Qty retur',0,1); 
 
		$pdf->SetXY(85,$y+9);
        $pdf->Cell(0,1,'Tarif',0,1); 
		$pdf->Line(2, $y+11, 95,$y+11);	        		
		$y = $y+13;
		$total_retur = 0;
		for($i = 0;$i<$det_ret_count; $i++)
		{			
			$pdf->SetXY(2,$y);
			$pdf->MultiCell(60,4,$detail_retur[$i]['NAMA_TARIF']);
			// $pdf->Cell(0,1,$mt_tarif_header['NAMA_TARIF'],0,1); 
	 
			$pdf->SetXY(70,$y+2);
			$pdf->MultiCell(0,1,$detail_retur[$i]['qty_retur'],0,1); 
	 
			$pdf->SetXY(82,$y+2);
			$pdf->MultiCell(0,1,rupiah($detail_retur[$i]['total_retur']),0,1); 
			$H = $pdf->GetY();
			$y = $H+6;
			$total_retur = $total_retur + $detail_retur[$i]['total_retur'];
		}			
		
		$pdf->Line(2,$y+3, 95,$y+3);
		$pdf->SetXY(55,$y+5);
        $pdf->Cell(0,1,'Total Retur',0,1);
		$pdf->SetXY(80,$y+5);
        $pdf->Cell(0,1,rupiah($total_retur),0,1);
		$pdf->Line(2,$y+8, 95,$y+8);
		$pdf->SetFont('Times','',7);	
		$pdf->SetXY(10,$y+10);
        $pdf->Cell(0,1,'tanggal cetak ',0,1);
		$pdf->SetXY(30,$y+10);
        $pdf->Cell(0,1,': '.date('Y-m-d h:h'),0,1);
		$pdf->SetXY(10,$y+13);
        $pdf->Cell(0,1,'tanggal entry ',0,1);	
		$pdf->SetXY(30,$y+13);
        $pdf->Cell(0,1,': '.$layanan_header['tgl_entry'],0,1);	
		$user = $this->session->userdata('username');
		$pdf->SetXY(10,$y+16);
        $pdf->Cell(0,1,'Diinput oleh ',0,1);	
		$pdf->SetXY(30,$y+16);
        $pdf->Cell(0,1,': '.$user,0,1);	
		
        $pdf->Output();
	}
	function printEX($id_detail)
	{
		$isi = $this->db->get_where('ts_hasil_expertisi_pa',array('id_detail' => $id_detail))->row_array();
		$ts_kj = $this->db->get_where('ts_kunjungan',array('kode_kunjungan' => $isi['kode_kunjungan']))->row_array();
		$DOK1 = $this->db->get_where('mt_paramedis',array('kode_paramedis' => $ts_kj['kode_paramedis']))->row_array();
		$DOK2 = $this->db->get_where('mt_paramedis',array('kode_paramedis' => $isi['kode_dokter']))->row_array();
		$pasien = $this->db->get_where('mt_pasien',array('no_rm' => $isi['no_rm']))->row_array();
		$desa = $this->db->get_where('mt_lokasi_villages',array('id' => $pasien['kode_desa']))->row_array();
		$kecamatan = $this->db->get_where('mt_lokasi_districts',array('id' => $desa['district_id']))->row_array();
		$alamat = $this->db->get_where('mt_lokasi_regencies',array('id' => $pasien['kabupaten']))->row_array();
		$isi_expert = $this->modelBilling->get_isi_expert($id_detail);
		$date = date('Y-m-d');
		error_reporting(0); // AGAR ERROR MASALAH VERSI PHP TIDAK MUNCUL
 
        $pdf = new FPDF('P', 'mm','A4'); 
		// $pdf -> SetMargins(2, 10, 12);
		$pdf->AddPage(); 
		$pdf->Image(base_url('assets/assets/img/kab.png'), 10, 10, 25, 23);
		$pdf->Image(base_url('assets/assets/img/logo_rs.png'), 175, 10, 25, 20);
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(0,7,'RUMAH SAKIT UMUM DAERAH WALED',0,1,'C');
        $pdf->Cell(10,0,'',0,1);
        $pdf->SetFont('Arial','B',14);
        $pdf->Cell(0,7,'INSTALASI LABORATORIUM PATOLOGI KLINIK DAN',0,1,'C');
        $pdf->Cell(10,0,'',0,0);
        $pdf->Cell(0,7,'KEDOKTERAN LABORATORIUM',0,1,'C');
        $pdf->Cell(10,1,'',0,1);
		$pdf->SetFont('Arial','B',10);
        $pdf->Cell(0,7,'Jl. Prabu Kiansantang No.4, Waled Kota, Waled, Cirebon, Jawa Barat 45187',0,1,'C');
        $pdf->Cell(10,0,'',0,0); 
		$pdf->Line(10, 40, 205,40);
		$pdf->SetFont('Arial','B',10);	

		$pdf->SetXY(10, 40);
        $pdf->Cell(10,7,'Tanggal',0,1);
		$pdf->SetXY(40, 40);
        $pdf->Cell(10,7,':',0,1);
		$pdf->SetXY(45, 40);
		$pdf->Cell(10,7,date("d-m-Y",strtotime($isi['tgl_input_layanan'])),0,1);

		$pdf->SetXY(110, 40);
        $pdf->Cell(10,7,'Nomor pemeriksaan',0,1);
		$pdf->SetXY(145, 40);
        $pdf->Cell(10,7,':',0,1);
		$pdf->SetXY(150, 40);
        $pdf->Cell(10,7,$isi['no_periksa'],0,1);


		$pdf->SetXY(10, 45);
        $pdf->Cell(10,7,'Nomor RM',0,1);
		$pdf->SetXY(40, 45);
        $pdf->Cell(10,7,':',0,1);
		$pdf->SetXY(45, 45);
        $pdf->Cell(10,7,$isi['no_rm'],0,1);

		$pdf->SetXY(110, 61);
		$pdf->MultiCell(135,4,'Dokter Pengirim');
        // $pdf->Cell(10,7,'Dokter Pengirim',0,1);
		
		$pdf->SetXY(145, 61);
		$pdf->MultiCell(143,4,':');

		$pdf->SetXY(150, 61);
		$pdf->MultiCell(56,4,$DOK1['nama_paramedis']);

        // $pdf->Cell(10,7,$DOK1['nama_paramedis'],0,1);


		$pdf->SetXY(10, 50);
        $pdf->Cell(10,7,'Nama',0,1);
		$pdf->SetXY(40, 50);
        $pdf->Cell(10,7,':',0,1);	
		$pdf->SetXY(45, 50);
        $pdf->Cell(10,7,$pasien['nama_px'],0,1);	

		$pdf->SetXY(110, 45);
        $pdf->Cell(10,7,'Asal / Ruangan',0,1);
		$pdf->SetXY(145, 45);
        $pdf->Cell(10,7,':',0,1);
		$pdf->SetXY(150, 45);
        $pdf->Cell(10,7,$isi['unit_asal'],0,1);

		$pdf->SetXY(10, 55);
        $pdf->Cell(10,7,'Tanggal lahir',0,1);
		$pdf->SetXY(40, 55);
        $pdf->Cell(10,7,':',0,1);
		$pdf->SetXY(45, 55);
		$pdf->Cell(10,7,date("d-m-Y",strtotime($pasien['tgl_lahir'])),0,1);

		$pdf->SetXY(110, 55);
        $pdf->Cell(10,7,'Dokter PA',0,1);
		$pdf->SetXY(145, 55);
        $pdf->Cell(10,7,':',0,1);
		$pdf->SetXY(150, 55);
        $pdf->Cell(10,7,$DOK2['nama_paramedis'],0,1);

		$pdf->SetXY(10, 60);
        $pdf->Cell(10,7,'Alamat',0,1);
		$pdf->SetXY(40, 60);
        $pdf->Cell(10,7,':',0,1);
		$pdf->SetXY(45, 60);
        $pdf->Cell(10,7,$desa['name'].' / '.$kecamatan['name'],0,1);
		
		$pdf->SetXY(110, 50);
        $pdf->Cell(10,7,'Tanggal selesai',0,1);
		$pdf->SetXY(145, 50);
        $pdf->Cell(10,7,':',0,1);
		$pdf->SetXY(150, 50);
		$pdf->Cell(10,7,date("d-m-Y",strtotime($isi['tgl_baca'])),0,1);
        // $pdf->Cell(10,7,$isi['tgl_baca'],0,1);
		$pdf->Line(10, 69, 205,69);
		$pdf->Line(10, 70, 205,70);

		$pdf->SetXY(20, 69);
		$pdf->SetFont('Arial','B',12);
        $pdf->Cell(0,7,'PATOLOGI ANATOMI',0,1,'C');
        $pdf->Cell(10,0,'',0,1);
		$pdf->SetXY(20, 75);
		$pdf->SetFont('Arial','B',12);
        $pdf->Cell(0,7,$isi['no_periksa'],0,1,'C');
        $pdf->Cell(10,0,'',0,1);

		$pdf->SetFont('Arial','B',10);
		$pdf->SetXY(10, 79);
		$pdf->MultiCell(100,5,'Jenis sampel ');
		$pdf->SetXY(60, 81);
		$pdf->MultiCell(143,4,$isi['tipe']);
		$H = $pdf->GetY();
		$y1 = $H + 5;
		$pdf->SetXY(10, $y1);
		$pdf->MultiCell(100,5,'MAKROSKOPIS ');
		$pdf->SetXY(60, $y1);
		$pdf->MultiCell(143,4,$isi_expert['makro']);
		$H2 = $pdf->GetY();
		$y2 = $H2 + 5;
		$pdf->SetXY(10, $y2);
		$pdf->MultiCell(100,5,'MIKROSKOPIS');
		$pdf->SetXY(60, $y2);
		$pdf->MultiCell(143,4,$isi_expert['mikro']);

		$H3= $pdf->GetY();
		$y3 = $H3 + 5;
		$pdf->SetXY(10, $y3);
		$pdf->MultiCell(100,5,'KESIMPULAN');
		$pdf->SetXY(60, $y3);
		$pdf->MultiCell(143,4,$isi_expert['kesimpulan']);
		$H4= $pdf->GetY();
		$yline = $H4 + 3;
		$y4 = $H4 + 5;
		$pdf->Line(10, $yline, 205,$yline);
		$pdf->Line(10, $yline+1, 205,$yline+1);
		$pdf->SetXY(165, $y4);
		$pdf->Cell(10,7,'Cirebon, '.$date,0,1);
		$pdf->SetXY(160, $y4+5);
		$pdf->Cell(10,7,'DPJP Laboratorium PA',0,1);
		$pdf->SetXY(160, $y4+25);
		$pdf->Cell(10,7,'dr. Hani Andriani, Sp.PA',0,1);
		$pdf->SetFont('Arial','B',8);
		$pdf->SetXY(143, $y4+30);
		$pdf->Cell(10,7,'449 / SIP.DSp-176 / SDK / DINKES / V / 2021 ',0,1);

        $pdf->Output();
		$cetakjlh = $isi['cetak'] + 1;
		$this->db->where('id_detail',$isi['id_detail']);
		$this->db->update('ts_hasil_expertisi_pa',array('cetak' => $cetakjlh));
	}
	function printRincianBiaya($no_rm,$counter)
	{
		$header = $this->model_pencarian->call_sp_rincian($no_rm,$counter);		
		// $rincian = $this->model_pencarian->call_sp_rincian_final($no_rm,$counter);		

		error_reporting(0); // AGAR ERROR MASALAH VERSI PHP TIDAK MUNCUL 
		$pdf = new FPDF('P','mm','letter');
		$title = 'Rincian biaya' ;
		$pdf->SetTitle($title );
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->Image(base_url('assets/assets/img/logo_rs.png'), 4, 3, 22, 20);
        $pdf->SetFont('Times','',11);
		$pdf->SetXY(75,5);
        $pdf->Cell(0,1,'PEMERINTAH KABUPATEN CIREBON',0,1,'L');   
		$pdf->SetXY(60,9);
        $pdf->Cell(0,1,'RUMAH SAKIT UMUM DAERAH WALED KAB.CIREBON',0,1,'L');  
		$pdf->SetFont('Times','',10);
		$pdf->SetXY(75,13);
        $pdf->Cell(0,1,'Jln. Prabu Kiansantang No. 4 Waled Kab. Cirebon',0,1,'L');    
		$pdf->SetXY(78,17);
        $pdf->Cell(0,1,'Tlp. ( 0231 ) 661126 Fax. ( 0231 ) 664091',0,1,'L');
		$pdf->Line(3, 25, 212,25);   
		$pdf->Line(3, 26, 212,26); 
		$pdf->SetFont('Times','',10);
		$pdf->SetXY(85,28);
        $pdf->Cell(0,1,'RINCIAN BIAYA PASIEN',0,1,'L');   
		$pdf->Line(3, 31, 212,31); 
		$pdf->SetXY(4,34);
        $pdf->Cell(0,1,'No. RM',0,1,'L');
		$pdf->SetXY(120,34);
        $pdf->Cell(0,1,'Penjamin',0,1,'L');
		$pdf->SetXY(4,38);  
        $pdf->Cell(0,1,'Nama Pasien',0,1,'L');  
		$pdf->SetXY(120,38);  
        $pdf->Cell(0,1,'Nomor SEP',0,1,'L');  
		$pdf->SetXY(4,42);
        $pdf->Cell(0,1,'Jenis Kelamin',0,1,'L'); 
		$pdf->SetXY(120,42);
        $pdf->Cell(0,1,'Tanggal Masuk',0,1,'L'); 
		$pdf->SetXY(4,46);  
        $pdf->Cell(0,1,'Alamat',0,1,'L');   
		$pdf->SetXY(120,46);  
        $pdf->Cell(0,1,'Tanggal Pulang',0,1,'L');   
		$pdf->SetXY(37,34);
        $pdf->Cell(0,1,': '. $header[0]['NORM'],0,1,'L');
		$pdf->SetXY(37,38);
        $pdf->Cell(0,1,': '. $header[0]['NAMA_PX'],0,1,'L');
		$pdf->SetXY(37,42);
        $pdf->Cell(0,1,': '. $header[0]['JK'],0,1,'L');		
		$pdf->SetXY(150,34);
        $pdf->Cell(0,1,': '. $header[0]['NAMA_PENJAMIN'],0,1,'L');
		$pdf->SetXY(150,38);
        $pdf->Cell(0,1,': '. $header[0]['SEP'],0,1,'L');
		$pdf->SetXY(150,42);
        $pdf->Cell(0,1,': '. $header[0]['TGL_MASUK'],0,1,'L');
		$pdf->SetXY(150,46);
        $pdf->Cell(0,1,': '. $header[0]['TGL_KELUAR'],0,1,'L');
		$pdf->SetXY(37,45);
        $pdf->MultiCell(60,4,': '. $header[0]['ALAMAT']) ;
		$H = $pdf->GetY();
		$pdf->Line(3, $H, 212,$H);   
		$pdf->Line(3, $H+1, 212,$H+1);
		$y = $pdf->GetY();
		$pdf->SetXY(4,$y+3);
        $pdf->Cell(0,1,'KELOMPOK TARIF',0,1,'L');
		$y = $pdf->GetY();
		for($i=0;$i<10;$i++){
			$pdf->SetXY(4,$y);
			$pdf->Cell(0,1,$header[$i]['SEQ_1'],0,1,'L');
		}		
		$pdf->Output();
	}
}