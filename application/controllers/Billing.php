<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Billing extends CI_Controller {
    public function __construct()
    {
        parent::__construct();	
		$role_id = $this->session->userdata('role_id');
		if ($this->session->userdata('username') == '') {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Anda harus Login!</div>');
            redirect('Auth');
        }
		else if($role_id != '1'){
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Anda harus Login sebagai admin!</div>');
			redirect('Auth');
		}
		$this->load->library('Pdf');
		$this->load->library('PDF_AutoPrint_struk'); // MEMANGGIL LIBRARY YANG KITA BUAT TADI
        $this->load->model('modelBilling');   
        $this->load->model('modelGetNomor');   
    }
	public function index()
	{
        $data['user'] = $this->db->get_where('dd_user', ['username' => $this->session->userdata('username')])->row_array();
		$kode_unit = $this->session->userdata('kode_unit');
		$data['rajal'] = substr($kode_unit,0,1);
		if($data['rajal'] == 1)
		{
			$data['px_poli'] = $this->modelBilling->get_px_rajal($kode_unit);
		}
        $data['title'] = "SemeruSmart - Billing";
		$this->load->view('templates/header',$data);
		$this->load->view('templates/navbar',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('Billing/index',$data);
		$this->load->view('templates/footer_billing');
	}
	public function simpanBilling()
	{		
		$user = $this->db->get_where('dd_user', ['username' => $this->session->userdata('username')])->row_array();		
		$diagnosa = $this->input->post('diagnosa_pasien');
		$kode_penjamin = $this->input->post('get_kode_penjamin');
		$kode_unit = $this->input->post('get_kode_unit');
		$kode_kunjungan = $this->input->post('get_kode_kunjungan');
		$kode_dokter = $this->input->post('get_Dokter');
		$nama_unit = $this->input->post('get_unit');
		$kelas = $this->input->post('get_kelas');
		$tgl_daftar = date('Y-m-d h:i:s');
		$kode_unit_pref =  $this->session->userdata('kode_unit');
		$mt_unit = $this->db->get_where('mt_unit',array('kode_unit' => $kode_unit_pref))->row_array();
		$prefix = $mt_unit['prefix_unit'];
		$kode_layanan_header = $this->modelGetNomor->getKodeLayananHeader($prefix);	
		$mt_trx = [
			'tgl' => date('Y-m-d h:i:s'),
			'no_trx_layanan' => $kode_layanan_header,
			'unit' => $user['kode_unit']
		];
		$this->db->insert('mt_nomor_trx',$mt_trx);		
		$data_header = [
			'kode_layanan_header' => $kode_layanan_header,
            'tgl_entry' =>  date('Y-m-d h:i:s'),
            'kode_kunjungan' => $kode_kunjungan,
        	'kode_unit' => $this->session->userdata('kode_unit'),
            'kode_tipe_transaksi' => '1',
            'pic' => $this->session->userdata('id'),
            'status_layanan' =>'3',  
            'status_retur' => 'OPN',
            'status_pembayaran' => 'OPN',
			'dok_kirim' => $kode_dokter,
			'unit_pengirim' => "$kode_unit | $nama_unit | $kelas",
			'diagnosa' => $diagnosa
		];
		$this->db->insert('ts_layanan_header',$data_header);
		$grand_total_tarif = 0;
		foreach ($_POST['data'] as $d) {
			$ts_layanan_header = $this->db->get_where('ts_layanan_header',array('kode_layanan_header' => $kode_layanan_header))->row_array();
			$tarif = $this->db->get_where('mt_tarif_detail',array('KODE_TARIF_DETAIL' => $d['kodelayanan']))->row_array();
			$kode_layanan_detail_1 = $this->modelGetNomor->get_kode_layanan_detail();
			if($user['kode_unit'] == '3011'){

					foreach($_POST['darah'] as $drh)
				{
					if($drh['kodelayanan'] == $d['kodelayanan'])
					{
						$data_darah = [
							'tanggal_entry' => date('Y-m-d h:i:s'),
							'user' => $this->session->userdata('id'),
							'status_retur' => 2,
							'nomor_layanan_header' => $kode_layanan_header,
							'nomor_kantong' => $drh['nomorkantong'],
							'kode_layanan_detail' => $kode_layanan_detail_1,
							'id_layanan_header' => $ts_layanan_header['id'],
						];
						$this->db->insert('ts_pemakaian_darah',$data_darah);
					}
					$stok = [
						'id_header_pakai' => $ts_layanan_header['id'],
						'status' => 2,
						'tanggal_pakai' => date('Y-m-d h:i:s')
					];
					$this->db->where('nomor_kantong',$drh['nomorkantong']);
					$this->db->update('tb_stok_darah',$stok);
				}
			};
			$total_layanan = $tarif['TOTAL_TARIF_CURRENT']*$d['jlh'];
			$diskon = ($d['disc']/100)*$total_layanan;
			$total_cyto = (50/100)*$total_layanan;
			if($d['cyto'] == '0'){
				$grandTotalLayanan = $total_layanan - $diskon;
			}else{
				$grandTotalLayanan = $total_layanan - $diskon + $total_cyto;
			}
			if($kode_penjamin == 'P01'){
				$detail_1 = [
					'id_layanan_detail' => $kode_layanan_detail_1,
					'kode_layanan_header' => $kode_layanan_header,
					'kode_tarif_detail' => $tarif['KODE_TARIF_DETAIL'],
					'total_tarif' => $tarif['TOTAL_TARIF_CURRENT'],
					'jumlah_layanan' => $d['jlh'],
					'total_layanan' => $tarif['TOTAL_TARIF_CURRENT']*$d['jlh'],
					'grantotal_layanan' => $grandTotalLayanan,
					'status_layanan_detail' =>'OPN',
					'diskon_layanan' => $d['disc'],
					'tgl_layanan_detail' => $tgl_daftar,
					'cyto' => $d['cyto'],
					'tagihan_pribadi' => $grandTotalLayanan,
					'tgl_layanan_detail_2' => $tgl_daftar,
					'row_id_header' => $ts_layanan_header['id']
				];
			}else{
			$detail_1 = [
				'id_layanan_detail' => $kode_layanan_detail_1,
				'kode_layanan_header' => $kode_layanan_header,
				'kode_tarif_detail' => $tarif['KODE_TARIF_DETAIL'],
				'total_tarif' => $tarif['TOTAL_TARIF_CURRENT'],
				'jumlah_layanan' => $d['jlh'],
				'total_layanan' => $tarif['TOTAL_TARIF_CURRENT']*$d['jlh'],
				'grantotal_layanan' => $grandTotalLayanan,
				'status_layanan_detail' =>'OPN',
				'diskon_layanan' => $d['disc'],
				'tgl_layanan_detail' => $tgl_daftar,
				'cyto' => $d['cyto'],
				'tagihan_penjamin' => $grandTotalLayanan,
				'tgl_layanan_detail_2' => $tgl_daftar,
				'row_id_header' => $ts_layanan_header['id']
			];
		}
			$this->db->insert('ts_layanan_detail',$detail_1);
			$grand_total_tarif = $grand_total_tarif + $grandTotalLayanan;
        }
		if($kode_penjamin == 'P01'){
		$header_update = [
			'status_layanan' => 1,
            'total_layanan' => $grand_total_tarif,
            'tagihan_pribadi' => $grand_total_tarif
		];
		}else{
		$header_update = [
			'kode_tipe_transaksi' => '2',
			'status_layanan' => 2,
			'total_layanan' => $grand_total_tarif,
			'tagihan_penjamin' => $grand_total_tarif
			];  
		}
		$this->db->where('id',$ts_layanan_header['id']);
        $this->db->update('ts_layanan_header',$header_update);
		$data_history = [
			'user' => $user['username'],
			'kode_unit' => $user['kode_unit'],
			'tanggal_entry' => date('Y-m-d h:i:s'),
			'kode_layanan_header' => $kode_layanan_header
		];
		$this->db->insert('history_user_billing',$data_history);
		
		$this->session->set_flashdata('message', '1');
		$this->session->unset_userdata('id_header');
        $this->session->unset_userdata('kode_layanan_header');
		$data = [			
			'id_header' => $ts_layanan_header['id'],
			'kode_layanan_header' => $kode_layanan_header
		];
		$this->session->set_userdata($data);	
	  	redirect('Billing');
	}
	public function cetakBilling()
	{
		$kode_layanan_header = $this->session->userdata('id_header');
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
		$pdf->SetXY(10,$YX4+3);
        $pdf->Cell(0,1,'tanggal entry ',0,1);	
		$pdf->SetXY(30,$YX4+3);
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
        $pdf->Output();
	}
	public function dataBilling()
	{
		$data['user'] = $this->db->get_where('dd_user', ['username' => $this->session->userdata('username')])->row_array();
		$prefix = $data['user']['kode_unit'];
		$data['v_ts_kj'] = $this->modelBilling->getVrincian($prefix);
        $data['title'] = "SemerusmartReborn - Data billing system";
		$this->load->view('templates/header',$data);
		$this->load->view('templates/navbar',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('Billing/dataBilling',$data);
		$this->load->view('templates/footer'); 
	}
	public function detailBilling()
	{
		$id = $this->input->post('id');
		$data['ts_layanan_detail'] = $this->db->get_where('v_ly_dt',array('id_header' => $id))->result_array();
		$data['ts_kj'] = $this->db->get_where('v_ts_kj',array('id_header' => $id))->row_array();
		$ts_kj = $this->db->get_where('v_ts_kj',array('id_header' => $id))->row_array();
		$unit = $this->session->userdata('kode_unit');
		$data['unit'] = $this->session->userdata('kode_unit');
		if($unit == '3011'){
			$data['ts_pemakaian_darah'] = $this->db->get_where('view_pemakaian_darah',array('kode_layanan_header' => $ts_kj['kode_layanan_header']))->result_array();
		}
		$this->load->view('Billing/modalDetail',$data);
	}
	public function detailRetur()
	{
		$data['id'] = $this->input->post('id');
		$data['nama'] = $this->input->post('nama');
		$this->load->view('Billing/detailretur',$data);
	}
	function returLayanan()
	{
		$user = $this->db->get_where('dd_user', ['username' => $this->session->userdata('username')])->row_array();	
		$kode_detail = $this->input->post('id_detail');
		$jlh_retur = $this->input->post('jlh_retur');
		$alasan_retur = $this->input->post('alasan');
		$ts_ly_dt = $this->db->get_where('ts_layanan_detail',array('id_layanan_detail' => $kode_detail))->row_array();
		$kode_header = $ts_ly_dt['row_id_header'];
//ambil data layanan header
		$ts_ly_hd = $this->db->get_where('ts_layanan_header',array('id' => $kode_header))->row_array();
		if($user['kode_unit'] == '3011')
		{
			$count_pemakaian_darah = $this->db->get_where('ts_pemakaian_darah',array('kode_layanan_detail' => $kode_detail))->num_rows();
			if($count_pemakaian_darah == $jlh_retur){
			$ambil_satu = $this->db->get_where('ts_pemakaian_darah',array('kode_layanan_detail' => $kode_detail,'status_retur' => 2))->row_array();
			$edit_pemakaian = [
				'status_retur' => 1,
				'tanggal_retur' => date('Y-m-d h:i:s')
			];
			$this->db->where('kode_layanan_detail',$kode_detail);
			$this->db->update('ts_pemakaian_darah',$edit_pemakaian);
				$edit_stok = [
					'status' => 1,
					'tanggal_pakai' => (NULL),
					'id_header_pakai' => (NULL)
				];
			$this->db->where('id_header_pakai',$ts_ly_hd['id']);
			$this->db->where('nomor_kantong',$ambil_satu['nomor_kantong']);
			$this->db->update('tb_stok_darah',$edit_stok);
			}else{
				for($i=0;$i<$jlh_retur;$i++){
					$ambil_satu = $this->db->get_where('ts_pemakaian_darah',array('kode_layanan_detail' => $kode_detail,'status_retur' => 2))->row_array();
					$edit_pemakaian = [
						'status_retur' => 1,
						'tanggal_retur' => date('Y-m-d h:i:s')
					];
					$this->db->where('id',$ambil_satu['id']);
					$this->db->where('status_retur',2);
					$this->db->update('ts_pemakaian_darah',$edit_pemakaian);
					$edit_stok = [
						'status' => 1,
						'tanggal_pakai' => (NULL),
						'id_header_pakai' => (NULL)
					];
					$this->db->where('id_header_pakai',$ts_ly_hd['id']);
					$this->db->where('nomor_kantong',$ambil_satu['nomor_kantong']);
					$this->db->update('tb_stok_darah',$edit_stok);
				}				
			}
		}
		if($jlh_retur <= $ts_ly_dt['jumlah_layanan']){
//ambil data ts_kunjungan
		$ts_kj = $this->db->get_where('ts_kunjungan',array('kode_kunjungan' => $ts_ly_hd['kode_kunjungan']))->row_array();
//ambil prefix
		$kode_unit_pref =  $this->session->userdata('kode_unit');
		$mt_unit = $this->db->get_where('mt_unit',array('kode_unit' => $kode_unit_pref))->row_array();
		$prefix = $mt_unit['prefix_unit'];
//buat kode retur header
		$kode_retur_header = $this->modelBilling->getKodeReturHeader1($prefix);
		$this->db->insert('ts_nomor_retur_header',array('id' => $kode_retur_header,'date' => date('Y-m-d')));
//buat kode retur detail

		$kode_retur_detail = $this->modelBilling->getKodeReturDetail1();
		$this->db->insert('ts_nomor_retur_detail',array('id' => $kode_retur_detail,'date' => date('Y-m-d')));
		
		$ts_retur_header = [
			"kode_kunjungan" => $ts_ly_hd['kode_kunjungan'],
			"kode_retur_header" => $kode_retur_header,
			"kode_layanan_header" => $ts_ly_hd['kode_layanan_header'],
			"tgl_retur" => date('Y-m-d h:i:s'),
			"total_retur" => '0',
			"status_retur" => "OPN",
			"pic" => $this->session->userdata('username'),
			"alasan_retur" => $alasan_retur,			
			"status_pembayaran" => "OPN"		
		];
		$this->db->insert('ts_retur_header',$ts_retur_header);
	
		$qty_awal_det = $ts_ly_dt['jumlah_layanan'];
		$qty_retur = $jlh_retur;
		$qty_sisa_det = $qty_awal_det - $qty_retur;
		$tarif_layanan_det =  $ts_ly_dt['total_tarif'];
		$total_tarif_layanan_det = $tarif_layanan_det * $qty_retur;
		if($qty_sisa_det == 0){
			$stts = 'CLS';
		}else{
			$stts = 'OPN';
		}
		$ts_retur_detail = [
			"kode_retur_detail" => $kode_retur_detail,
			"id_layanan_detail" => $kode_detail,
			"tgl_retur_detail" => date('Y-m-d h:i:s'),
			"kode_retur_header" => $kode_retur_header,
			"qty_awal" => 	$qty_awal_det,
			"qty_retur" => $qty_retur,
			"qty_sisa" =>$qty_sisa_det,
			"tarif_layanan" => $tarif_layanan_det,
			"total_retur_detail" => $total_tarif_layanan_det,
			"status_retur_detail" => $stts,
			"row_id_header" => $ts_ly_dt['row_id_header']
		];
		$this->db->insert('ts_retur_detail',$ts_retur_detail);

		$ts_ret_hd_up = [
			"total_retur" => $total_tarif_layanan_det,
			"status_retur" => $stts
		];
		$this->db->where('kode_retur_header',$kode_retur_header);
		$this->db->update('ts_retur_header',$ts_ret_hd_up);

		if($ts_kj['kode_penjamin'] == 'P01')
		{
			//jika penjamin pribadi
			$ts_ly_det_up = [
				"jumlah_layanan" => $qty_sisa_det,
				"jumlah_retur" => $qty_retur,
				"total_layanan" => $ts_ly_dt['total_tarif'] * $qty_sisa_det,
				"grantotal_layanan" => $ts_ly_dt['total_tarif'] *$qty_sisa_det,
				"status_layanan_detail" => $stts,
				"tagihan_pribadi" => $ts_ly_dt['total_tarif'] *$qty_sisa_det
			];	
		}else{
			//jika penjamin asuransi
			$ts_ly_det_up = [
				"jumlah_layanan" =>$qty_sisa_det,
				"jumlah_retur" => $qty_retur,
				"total_layanan" => $ts_ly_dt['total_tarif'] * $qty_sisa_det,
				"grantotal_layanan" => $ts_ly_dt['total_tarif'] * $qty_sisa_det,
				"status_layanan_detail" => $stts,
				"tagihan_penjamin" => $ts_ly_dt['total_tarif'] * $qty_sisa_det
			];	
		}		
		$this->db->where('id_layanan_detail',$kode_detail);
		$this->db->update('ts_layanan_detail',$ts_ly_det_up);

		$count_ts_kunjungan_retur = $this->modelBilling->hitung_retur_header($kode_header);		
		$ts_ly_dt2 = $this->db->get_where('ts_layanan_detail',array('id_layanan_detail' => $kode_detail))->row_array();
		if($count_ts_kunjungan_retur > 0)		
		{		
			if($ts_kj['kode_penjamin'] == 'P01'){
				//jika penjamin pribadi
				$ts_ly_head_up = [
					"total_layanan" => $ts_ly_hd['total_layanan'] - $total_tarif_layanan_det,		
					"tagihan_pribadi" => $ts_ly_hd['total_layanan'] - $total_tarif_layanan_det
				];
			}else{
				//jika penjamin asuransi
				$ts_ly_head_up = [
					"total_layanan" => $ts_ly_hd['total_layanan'] - $total_tarif_layanan_det,		
					"tagihan_penjamin" => $ts_ly_hd['total_layanan'] - $total_tarif_layanan_det
				];
			}	
		}else{
			if($ts_kj['kode_penjamin'] == 'P01'){
				//jika penjamin pribadi
				$ts_ly_head_up = [
					"status_layanan" => '3',
					"status_retur" => 'CLS',
					"total_layanan" => $ts_ly_hd['total_layanan'] - $total_tarif_layanan_det,		
					"tagihan_pribadi" => $ts_ly_hd['total_layanan'] - $total_tarif_layanan_det
				];
			}else{
				//jika penjamin asuransi
				$ts_ly_head_up = [
					"status_layanan" => '3',
					"status_retur" => 'CLS',
					"total_layanan" => $ts_ly_hd['total_layanan'] - $total_tarif_layanan_det,		
					"tagihan_penjamin" => $ts_ly_hd['total_layanan'] - $total_tarif_layanan_det
				];
			}
		}		
		$this->db->where('id',$kode_header);
		$this->db->update('ts_layanan_header',$ts_ly_head_up);
		$this->session->set_flashdata('message', '2');
		redirect('Billing/dataBilling');
	}else{
		$this->session->set_flashdata('message', '5');
		redirect('Billing/dataBilling');
	}
	}
public function ExpertisiPA()
{
	$data['user'] = $this->db->get_where('dd_user', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = "SemeruSmart - Riwayat expertisi PA";
		$kemarin='';
		$sekarang='';	
		$data['dataPasien'] = $this->modelBilling->getPasien($kemarin,$sekarang);
		$this->load->view('templates/header',$data);
		$this->load->view('templates/navbar',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('Billing/expertisiPA',$data);
		$this->load->view('templates/footer');
}
function cariRiwayat()
	{
		$kemarin= $this->input->post('tgl_kemarin');
		$sekarang=$this->input->post('tgl_sekarang');	
		$data['dataPasien'] = $this->modelBilling->getPasien($kemarin,$sekarang);		
		$this->load->view('v_jquery/dataRiwayat',$data);
	}
function detailExpertisiPA()
{
		$id_detail = $this->input->post('id_detail');
		$data['nama_tarif'] = $this->input->post('nama_tarif');
		$data['nama_px'] = $this->input->post('nama_px');
		$data['no_rm'] = $this->input->post('no_rm');
		$data['isi'] = $this->db->get_where('ts_hasil_expertisi_pa',array('id_detail' => $id_detail))->row_array();
		$data['isi_expert'] = $this->modelBilling->get_isi_expert($id_detail);
		$this->load->view('v_jquery/lihatExpert',$data);
}

function detailReturdarah()
{
	$data['id'] = $this->input->post('id');
	$this->load->view('Billing/detailreturdarah',$data);
}
function returDarah()
	{
		$id = $this->input->post('nomor_kantong');
		
		$this->db->where('nomor_kantong',$id);
		$this->db->update('ts_pemakaian_darah',array('status_retur' => 2));

		$stok = [
			'status' => 1,
			'tanggal_pakai' => '(NULL)'
		];

		$this->db->where('nomor_kantong',$id);
		$this->db->update('tb_stok_darah',$stok);
		redirect('Bankdarah');
	}
}