<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_js extends CI_Controller {
	public function __construct()
    {
        parent::__construct();		
		$this->load->library('Pdf');
        $this->load->model('model_pencarian');   
    }
	public function index()
	{
        $data['title'] = "Semerusmart - Billing";
		$this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('templates/navbar');
		$this->load->view('Billing/index');
		$this->load->view('templates/footer');
	}
    public function get_autocomplete_bulan()
    {
        if (isset($_GET['term'])) {
            $result = $this->model_pencarian->search_bulan($_GET['term']);
            if (count($result) > 0) {
            foreach ($result as $row)
                $arr_result[] = array(
					'label' => $row->nama_bulan,
					'kd_bulan' => $row->id_bulan					
				);
                echo json_encode($arr_result);
            }
        }
    }
    public function get_autocomplete_unit()
    {
        if (isset($_GET['term'])) {
            $result = $this->model_pencarian->search_unit($_GET['term']);
            if (count($result) > 0) {
            foreach ($result as $row)
                $arr_result[] = array(
					'label' => $row->nama_unit,
					'kd_unit' => $row->kode_unit					
				);
                echo json_encode($arr_result);
            }
        }
    }
    public function get_autocomplete_unit_ranap()
    {
        if (isset($_GET['term'])) {
            $result = $this->model_pencarian->search_unit_ranap($_GET['term']);
            if (count($result) > 0) {
            foreach ($result as $row)
                $arr_result[] = array(
					'label' => $row->nama_unit,
					'kd_unit' => $row->kode_unit					
				);
                echo json_encode($arr_result);
            }
        }
    }
    public function get_autocomplete_dokter(){
		if (isset($_GET['term'])) {
            $result = $this->model_pencarian->search_dokter($_GET['term']);
            if (count($result) > 0) {
            foreach ($result as $row)
                $arr_result[] = array(
					'label' => $row->nama_paramedis,
					'kd_paramedis' => $row->kode_paramedis					
				);
                echo json_encode($arr_result);
            }
        }
	}
    public function tabelPasien()
	{ 
		$nomor_rm = $this->input->post('nomor_rm');
		$nama_pasien = $this->input->post('nama_pasien');
		$alamat = $this->input->post('alamat');
		$jenis_layanan = $this->input->post('jenis_layanan');
		$unit = $this->input->post('kode_unit_daftar');
		$tgl = $this->input->post('tanggal_cari');
		if($jenis_layanan == 2){
			$data['tabel_pasien'] = $this->model_pencarian->getPasienRI($nomor_rm,$nama_pasien,$alamat);			
		}else{
			$data['tabel_pasien'] = $this->model_pencarian->getPasienRJ($nomor_rm,$nama_pasien,$alamat,$unit,$tgl);					
			// $count_pasien = $this->model_pencarian->getPasienRJ($nomor_rm,$nama_pasien,$alamat,$unit,$tgl);
		}
		// $data['tabel'] = $this->db->get_where('mt_pasien',array('no_rm' => $nomor_rm))->result_array();
		$this->load->view('v_jquery/tabelPasien',$data);
	}
    public function cariLayanan()
	{
		$user = $this->db->get_where('dd_user', ['username' => $this->session->userdata('username')])->row_array();
		$data['user'] = $this->db->get_where('dd_user', ['username' => $this->session->userdata('username')])->row_array();
		$unit = $user['kode_unit'];
		$layanan = $this->input->post('layanan');
		$kelas_tarif = $this->input->post('kelas_tarif');
		if($layanan ==''){
			$data['tb_layanan'] = $this->model_pencarian->getAllLayanan($unit);
		}else{
			$data['tb_layanan'] = $this->model_pencarian->getLayanan($layanan,$kelas_tarif,$unit);
		}
		$this->load->view('v_jquery/tabellayanan',$data);
	}
	public function cariPasien()
	{
		$no_rm = $this->input->post('rm');
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$data['mt_pasien'] = $this->model_pencarian->getMtPasien($no_rm,$nama,$alamat);
		$this->load->view('v_jquery/tabel_pasien',$data);
	}
	public function add_rumus()
	{
		$tgl_awal = $this->input->post('tgl_awal');
		$tgl_akhir = $this->input->post('tgl_akhir');
		$dokter = $this->input->post('dokter');
        $penjamin = $this->input->post('penjamin');
		$jm= $this->model_pencarian->get_jm($tgl_awal,$tgl_akhir,$dokter,$penjamin);
		$kelompok = '';
		$array_kosong = []; 
		foreach($jm as $j)
		if($j['KELOMPOK'] != $kelompok)
		{
			$data_loop = [
				'kelompok' => $j['KELOMPOK'],
				'cara_bayar' => $j['CARA_BAYAR'],
				'kelas' => $j['kode_unit']
			];
			array_push($array_kosong,$data_loop);
			$k_lama = $j['KELOMPOK'];
			$kelompok = $k_lama;	
		}
		$data['array'] = $array_kosong;
		$this->load->view('jasamedis/modalrumus',$data);
	}
}
