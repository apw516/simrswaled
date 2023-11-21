<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ExpertisiPA extends CI_Controller {
	public function __construct()
    {
        parent::__construct();	
		$role_id = $this->session->userdata('role_id');
		if ($this->session->userdata('username') == '') {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Anda harus Login!</div>');
            redirect('Auth');
        }
		else if($role_id != '2'){
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Anda harus Login sebagai Dokter!</div>');
			redirect('Auth');
		}
		$this->load->library('Pdf');
        $this->load->model('model_pencarian');   
        $this->load->model('modelGetNomor');   
        $this->load->model('modelBilling');   
    }
	public function index()
	{
        $data['user'] = $this->db->get_where('dd_user', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = "SemeruSmart - Riwayat Expertisi PA";
        $kemarin='';
		$sekarang='';
		$data['dataPasien'] = $this->modelBilling->getPasien($kemarin,$sekarang);
		$this->load->view('templates/header',$data);
		$this->load->view('templates/navbar',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('ExpertisiPA/index',$data);
		$this->load->view('templates/footer');
	}
    public function cariRiwayat()
    {
        $kemarin= $this->input->post('tgl_kemarin');
		$sekarang=$this->input->post('tgl_sekarang');	
		$data['dataPasien'] = $this->model_pencarian->getPasien($kemarin,$sekarang);		
		$this->load->view('v_jquery/exDataRiwayat',$data);
    }
    public function getNoPeriksa()
    {
        $nama_tarif = $this->input->post('nama_tarif');
		if($nama_tarif == '[AWN] -  Sitologi / Biopsi / PA' || $nama_tarif == 'BIOPSI KHUSUS : BIOPSI ESOFAGUS, GASTER, COLON'){
			$prefix = 'H';
		}else{
			$tarif = substr($nama_tarif,0,1);
            $prefix = $tarif;
		}        
        $no_periksa = $this->model_pencarian->getNoPeriksa_new($prefix);
        $this->db->insert('mt_nomor_expertisi_pa2',array('id' => $no_periksa,'tanggal' => date('Y-m-d')));
        $mik = $this->input->post('Mikroskopis');
		$mak = $this->input->post('Makroskopis');
		$kesimpulan = $this->input->post('Kesimpulan');
		$user = $this->db->get_where('dd_user', ['username' => $this->session->userdata('username')])->row_array();	
		$ts_hasil_ex = [
			'kode_unit' =>  $this->input->post('kode_unit'),
			'kode_kunjungan' =>  $this->input->post('kode_kunjungan'),
			'no_rm' =>  $this->input->post('no_rm'),
			'counter' =>  $this->input->post('counter'),
			'kode_header' =>  $this->input->post('kode_header'),
			'id_header' =>  $this->input->post('id_header'),
			'id_detail' =>  $this->input->post('id_detail'),
			'unit_asal' =>  $this->input->post('unit_asal'),
			'hasil' =>  "$mak | $mik | $kesimpulan" ,
			'kode_dokter' =>  $user['username'],
			'kritis' =>  (NULL),
			'tipe' =>  $this->input->post('jenisSampel'),
			'cito' =>  (NULL),
			'tgl_input_layanan' =>   $this->input->post('tanggal_input'),
			'tgl_baca' =>  date('Y-m-d h:i:s'),
			'no_periksa' => $no_periksa,
			'validasi' => '0',
		];
		$this->db->insert('ts_hasil_expertisi_pa',$ts_hasil_ex);
		$data = [
			'no_periksa' => $no_periksa
		];

		echo json_encode($data);
    }
    public function isiExpert()
    {
        $id_detail = $this->input->post('id_detail');
		$count_pa = $this->db->get_where('ts_hasil_expertisi_pa',array('id_detail' => $id_detail))->num_rows();
		if($count_pa > 0){
			$data['ts_exp_pa'] = $this->db->get_where('ts_hasil_expertisi_pa',array('id_detail' => $id_detail))->row_array();
		}else{
			$data['ts_exp_pa'] = ['no_periksa' => '0'];
		}
		$id_header = $this->input->post('id_header');
		$data['isi'] = [
		'no_rm'   => $this->input->post('no_rm'),
		'nama_pasien'   => $this->input->post('nama_pasien'),
		'no_periksa'   => $this->input->post('no_periksa'),
		'kode'   => $this->input->post('kode'),
		'kode_kunjungan'  => $this->input->post('kode_kunjungan'),
		'no_rm' => $this->input->post('no_rm'),
		'nama_pasien' => $this->input->post('nama_pasien'),
		'jk' => $this->input->post('jk'),
		'umur' => $this->input->post('umur'),
		'dokkirim' => $this->input->post('dokkirim'),
		'counter' => $this->input->post('counter'),
		'nama_penjamin' => $this->input->post('nama_penjamin'),
		'kode_header' => $this->input->post('kode_header'),
		'id_header' => $this->input->post('id_header'),
		'id_detail' => $this->input->post('id_detail'),
		'unit_asal' => $this->input->post('unit_asal'),
		'nama_tarif' => $this->input->post('nama_tarif'),
		'tgl_input_layanan' => $this->input->post('tgl_input_layanan')];
		$data['dok_kirim'] = $this->db->get_where('ts_layanan_header',array('id' => $id_header	)) ->row_array();
        $this->load->view('v_jquery/isiExpert',$data);

    }
    public function editExpert()
	{
		$data['user'] = $this->db->get_where('dd_user', ['username' => $this->session->userdata('username')])->row_array();
		$data['no_rm'] = $this->input->post('no_rm');
		$data['nama_pasien'] = $this->input->post('nama_pasien');
		$id_detail = $this->input->post('id_detail');
		$data['nama_tarif'] = $this->input->post('nama_tarif');
		$data['isi'] = $this->db->get_where('ts_hasil_expertisi_pa',array('id_detail' => $id_detail))->row_array();
		$data['isi_expert'] = $this->modelBilling->get_isi_expert($id_detail);
		$this->load->view('v_jquery/editExpert',$data);
	}
    public function simpanEX()
    {
        $id_detail = $this->input->post('id_detail');
		$mik = $this->input->post('Mikroskopis');
		$mak = $this->input->post('Makroskopis');
		$dgk = $this->input->post('dgklinik');	
		$dgb = $this->input->post('dgpascabedah');
		$kesimpulan = $this->input->post('Kesimpulan');
		$ts_hasil_ex = [			
			'tipe' => $this->input->post('name'),
			'hasil' => "$mak | $mik | $kesimpulan",
			'kritis' =>  $this->input->post('kritis'),
			'tipe' =>  $this->input->post('tipe'),
			'tgl_baca' =>  date('Y-m-d h:i:s'),
			'cito' =>  $this->input->post('cyto'),
			'validasi' =>  $this->input->post('validasi'),			
			'diagnostik_klinik' =>  $dgk,			
			'diagnostik_pasca_bedah' =>  $dgb			
		];
		$this->db->where('id_detail',$id_detail);
		$this->db->update('ts_hasil_expertisi_pa',$ts_hasil_ex);
        $this->session->set_flashdata('message', '3');
        redirect('ExpertisiPA');
    }
}
