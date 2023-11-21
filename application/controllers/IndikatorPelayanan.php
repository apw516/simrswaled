<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class indikatorPelayanan extends CI_Controller {
	public function __construct()
    {
        parent::__construct();	
		if ($this->session->userdata('username') == '') {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Anda harus Login!</div>');
            redirect('Auth');
        }
        $this->load->model('modelBorLossToi');   
    }
	public function index()
	{		
        $data['user'] = $this->db->get_where('dd_user', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = "Semerusmart - Indikator pelayanan RS";   
		$data['unit'] = $this->modelBorLossToi->get_unit_ranap();
		$data['bulan'] = $this->db->get('mt_bulan')->result_array();
		$month = date('m');
		$year = date('Y');
		$tgl_awal =$year."-".$month."-01";
		$tgl_akhir =$year."-".$month."-31";
		$data['borlosstoi']= $this->modelBorLossToi->get_sp_borlosstoi($tgl_awal,$tgl_akhir);
		$hari_rawat = 0;
		$jumlah_tt = 0;		
		$pasien_rawat = 0;
		$kr_48 = 0;		$perbaikan = 0; $aps = 0; $rujuk = 0;
		$lb_48 = 0;		
		foreach($data['borlosstoi'] as $b)
		{
			$kr_48_1 = $b['M_KR_48'];
			$kr_48 = $kr_48_1 + $kr_48;

			$lb_48_1 = $b['M_LB_48'];
			$lb_48 = $lb_48_1 + $lb_48;

			$perbaikan1 = $b['PERBAIKAN_SEMBUH'];
			$perbaikan = $perbaikan1 + $perbaikan;

			$aps1 = $b['APS'];
			$aps = $aps1 + $aps;

			$rujuk1 = $b['REFERAL_RUJUK'];
			$rujuk = $rujuk1 + $rujuk;

			$pasien_rawat1 = $b['JML_PASIEN_DIRAWAT'];
			$pasien_rawat = $pasien_rawat1 + $pasien_rawat;

			$hari_rawat1 = $b['JML_HARI_RAWAT'];
			$hari_rawat = $hari_rawat1 + $hari_rawat;

			$jumlah_tt1 = $b['JML_TT'];
			$jumlah_tt = $jumlah_tt1 + $jumlah_tt;
			$hari = $b['JUMLAH_HARI'];
		}
			$total_KR_48 = $kr_48;
			$total_LB_48 = $lb_48;
			$GRAND_TOTAL_MATI = $total_KR_48 + $total_LB_48;

			$total_perbaikan = $perbaikan;
			$total_aps = $aps;
			$total_rujuk = $rujuk;

			$GRANDTOTAL_PX_KELUAR = $total_perbaikan + $total_aps + $total_rujuk;
			$total_mati_keluar = $GRAND_TOTAL_MATI + $GRANDTOTAL_PX_KELUAR;

			$total_pasien_rawat = $pasien_rawat;
			$total_hari_rawat = $hari_rawat;
			$total_jumlah_tt = $jumlah_tt;

			$bor1 = $total_hari_rawat;
			$bor2 = $total_jumlah_tt * $hari * 100;
			$hsl_bor = $bor1 / $bor2;
			$hsl_bor1 = strval($hsl_bor);
			$hsl_bor2 = substr($hsl_bor1,4,4);
			$hsl_bor3 = substr($hsl_bor2,0,2);
			$hsl_bor4 = substr($hsl_bor2,2,2);
			$data['bor'] = $hsl_bor3.'.'.$hsl_bor4;

			$los = $total_pasien_rawat / $total_mati_keluar;
			$hsl_los = strval($los);
			$hsl_los1 = substr($hsl_los,2,3);
			$hsl_los2 = substr($hsl_los1,0,1);
			$hsl_los3 = substr($hsl_los1,1,2);
			$data['los'] = $hsl_los2.'.'.$hsl_los3;

			$toi_hit1 = $total_jumlah_tt * $hari;
			$toi_hit2 = $toi_hit1 - $total_hari_rawat;
			$toi_hit3 = strval($toi_hit2 / $total_mati_keluar);
			$data['toi'] = substr($toi_hit3,0,4);
			$data['bto'] = substr(strval($total_mati_keluar / $total_jumlah_tt),0,4);

			$ndr_hit1 = $total_LB_48 = $lb_48 / $total_mati_keluar;
			$ndr_hit2 = strval($ndr_hit1 * 1000);
			$ndr_hit3 = substr($ndr_hit2,0,3);
			$ndr_hit4 = substr($ndr_hit2,3,2);
			$data['ndr'] = $ndr_hit3.$ndr_hit4;

			$gdr = strval($GRAND_TOTAL_MATI /  $total_mati_keluar * 1000);
			$data['gdr'] = substr($gdr,0,5);
			$this->load->view('templates/header',$data);
			$this->load->view('templates/sidebar',$data);
			$this->load->view('templates/navbar');
			$this->load->view('borlostoi/index2',$data);
			$this->load->view('templates/footer_bor');
	}  
	public function setTempatTidur()
	{				
        $data['user'] = $this->db->get_where('dd_user', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = "SemerusmartReborn - Set Tempat Tidur";
		$data['unit'] = $this->modelBorLossToi->get_unit_ranap();
		$data['bulan'] = $this->db->get('mt_bulan')->result_array();
		$data['tahun'] = date('Y');
		$data['tt'] = $this->db->get('v_log_tt')->result_array();
		$this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('templates/navbar');
		$this->load->view('borlostoi/settempattidur',$data);
		$this->load->view('templates/footer_bor',$data);
	}
	public function setbedsave()
	{
		foreach($_POST['data'] as $d)
		{
			$unit = $d['unit'];
			$bulan = (int)$d['bulan'];
			$tahun = $d['tahun'];
			$cek = $this->modelBorLossToi->cek_ruangan($unit,$bulan,$tahun);
			$data= [
				'tahun' => $d['tahun'],
				'bulan' => $d['bulan'],
				'unit' => $d['unit'],
				'jumlah_tt' => $d['jumlah']				
			];
			if($cek == 0){
				$this->db->insert('log_tt_ruangan',$data);
			}else{
				$get = $this->modelBorLossToi->get_log_ruangan($unit,$bulan,$tahun);
				$id = $get['id'];
				$this->db->where('id',$id);
				$this->db->update('log_tt_ruangan',$data);
			}	
		}redirect('IndikatorPelayanan/setTempatTidur');
	}
	public function indikatorbor()
	{
		$month = $this->input->post('bulan');
		$year = date('Y');
		$tgl_awal =$year."-".$month."-01";
		$tgl_akhir =$year."-".$month."-31";
		$borlosstoi= $this->modelBorLossToi->get_sp_borlosstoi($tgl_awal,$tgl_akhir);
		$hari_rawat = 0;
		$jumlah_tt = 0;		
		$pasien_rawat = 0;
		$kr_48 = 0;		$perbaikan = 0; $aps = 0; $rujuk = 0;
		$lb_48 = 0;		
		foreach($borlosstoi as $b)
		{
			$kr_48_1 = $b['M_KR_48'];
			$kr_48 = $kr_48_1 + $kr_48;

			$lb_48_1 = $b['M_LB_48'];
			$lb_48 = $lb_48_1 + $lb_48;

			$perbaikan1 = $b['PERBAIKAN_SEMBUH'];
			$perbaikan = $perbaikan1 + $perbaikan;

			$aps1 = $b['APS'];
			$aps = $aps1 + $aps;

			$rujuk1 = $b['REFERAL_RUJUK'];
			$rujuk = $rujuk1 + $rujuk;

			$pasien_rawat1 = $b['JML_PASIEN_DIRAWAT'];
			$pasien_rawat = $pasien_rawat1 + $pasien_rawat;

			$hari_rawat1 = $b['JML_HARI_RAWAT'];
			$hari_rawat = $hari_rawat1 + $hari_rawat;

			$jumlah_tt1 = $b['JML_TT'];
			$jumlah_tt = $jumlah_tt1 + $jumlah_tt;
			$hari = $b['JUMLAH_HARI'];
		}
			$total_KR_48 = $kr_48;
			$total_LB_48 = $lb_48;
			$GRAND_TOTAL_MATI = $total_KR_48 + $total_LB_48;

			$total_perbaikan = $perbaikan;
			$total_aps = $aps;
			$total_rujuk = $rujuk;

			$GRANDTOTAL_PX_KELUAR = $total_perbaikan + $total_aps + $total_rujuk;
			$total_mati_keluar = $GRAND_TOTAL_MATI + $GRANDTOTAL_PX_KELUAR;

			$total_pasien_rawat = $pasien_rawat;
			$total_hari_rawat = $hari_rawat;
			$total_jumlah_tt = $jumlah_tt;

			$bor1 = $total_hari_rawat;
			$bor2 = $total_jumlah_tt * $hari * 100;
			$hsl_bor = $bor1 / $bor2;
			$hsl_bor1 = strval($hsl_bor);
			$hsl_bor2 = substr($hsl_bor1,4,4);
			$hsl_bor3 = substr($hsl_bor2,0,2);
			$hsl_bor4 = substr($hsl_bor2,2,2);
			$data['bor'] = $hsl_bor3.'.'.$hsl_bor4;

			$los = $total_pasien_rawat / $total_mati_keluar;
			$hsl_los = strval($los);
			$hsl_los1 = substr($hsl_los,2,3);
			$hsl_los2 = substr($hsl_los1,0,1);
			$hsl_los3 = substr($hsl_los1,1,2);
			$data['los'] = $hsl_los2.'.'.$hsl_los3;

			$toi_hit1 = $total_jumlah_tt * $hari;
			$toi_hit2 = $toi_hit1 - $total_hari_rawat;
			$toi_hit3 = strval($toi_hit2 / $total_mati_keluar);
			$data['toi'] = substr($toi_hit3,0,4);
			$data['bto'] = substr(strval($total_mati_keluar / $total_jumlah_tt),0,4);

			$ndr_hit1 = $total_LB_48 = $lb_48 / $total_mati_keluar;
			$ndr_hit2 = strval($ndr_hit1 * 1000);
			$ndr_hit3 = substr($ndr_hit2,0,3);
			$ndr_hit4 = substr($ndr_hit2,3,2);
			$data['ndr'] = $ndr_hit3.$ndr_hit4;

			$gdr = strval($GRAND_TOTAL_MATI /  $total_mati_keluar * 1000);
			$data['gdr'] = substr($gdr,0,5);
		$this->load->view('borlostoi/indikator',$data);
	}
	public function tampilborlosstoi()
	{
		$tgl_awal = $this->input->post('tgl_kemarin');
		$tgl_akhir = $this->input->post('tgl_sekarang');		
		$unit = $this->modelBorLossToi->get_unit_ranap();
		$jumlah_pasien_awal = [];
		foreach($unit as $u){
			$kode_unit = $u['kode_unit'];
			$pasien_awal = $this->modelBorLossToi->countpxawal($kode_unit,$tgl_awal,$tgl_akhir);
			$pasien_masuk = $this->modelBorLossToi->count_px_masuk($kode_unit,$tgl_awal,$tgl_akhir);
			$kr_48_1 = $this->modelBorLossToi->count_kr_48_1($kode_unit,$tgl_awal,$tgl_akhir);
			$kr_48_2 = $this->modelBorLossToi->count_kr_48_2($kode_unit,$tgl_awal,$tgl_akhir);
			$jlh_px_awal = [
				'ruangan' => $u['nama_unit'],
				'jumlah' => $pasien_awal['jumlah'],
				'jumlah_px_masuk' => $pasien_masuk['jumlah'],
				'kr_48_1' => $kr_48_1['jumlah'],
				'kr_48_2' => $kr_48_2['jumlah'],
			];
			array_push($jumlah_pasien_awal,$jlh_px_awal);
		}
		$data['px_awal'] = $jumlah_pasien_awal;
		// $unit = $this->model_pencarian->get_unit_ranap();
		// $array_kosong = []; 
		// foreach($unit as $u){
		// 	$kode_unit = $u['kode_unit'];
		// 	$jlh_tt = $this->model_pencarian->hitung_tempat_tidur($kode_unit);
		// 	$px_mati_kr48 = $this->model_pencarian->hitung_mati_kr48($kode_unit);
		// 	$px_mati_lb48 = $this->model_pencarian->hitung_mati_lb48($kode_unit);
		// 	$px_perbaikan = $this->model_pencarian->hitung_perbaikan($kode_unit);
		// 	$px_aps = $this->model_pencarian->hitung_aps($kode_unit);
		// 	$px_rujuk = $this->model_pencarian->hitung_rujuk($kode_unit);
		// 	$px_awal = $this->model_pencarian->get_pasien_awal($kode_unit);
		// 	$px_masuk = $this->model_pencarian->get_pasien_masuk($kode_unit);
		// 	$lama_rawat = $this->model_pencarian->hitung_lama_rawat($kode_unit); 
		// 	$data_loop = [
		// 		'nama_unit' => $u['nama_unit'],
		// 		'jlh_tt' => $jlh_tt,	
		// 		'px_mati_kr48' => $px_mati_kr48,	
		// 		'px_mati_lb48' => $px_mati_lb48,	
		// 		'px_perbaikan' => $px_perbaikan,	
		// 		'px_aps' => $px_aps,	
		// 		'px_rujuk' => $px_rujuk,	
		// 		'px_awal' => $px_awal,	
		// 		'px_masuk' => $px_masuk,	
		// 		'lama_rawat' => $lama_rawat	
		// 	];
		// 	array_push($array_kosong,$data_loop);	
		// 	};
		// 	$data['array'] = $array_kosong;
		$data['borlosstoi'] = $this->modelBorLossToi->get_sp_borlosstoi($tgl_awal,$tgl_akhir);
		$this->load->view('borlostoi/tampilborlosstoi',$data);
	}

}