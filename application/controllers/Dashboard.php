<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    public function __construct()
    {
        parent::__construct();	
		$role_id = $this->session->userdata('role_id');		
		$this->load->library('Pdf');
        $this->load->model('model_pencarian');   
        // $this->load->model('modelGetNomor');   
    }
	public function index()
	{
        $data['user'] = $this->db->get_where('dd_user', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = "SemeruSmart - Dashboard Pendaftaran";
		$data['total_px'] = $this->model_pencarian->count_px_umum();
		$data['total_px_not_umum'] = $this->model_pencarian->count_px_not_umum();
		$data['total_px_ranap_umum'] = $this->model_pencarian->count_px_ranap_umum();
		$data['total_px_rajal_umum'] = $this->model_pencarian->count_px_rajal_umum();
		$this->load->view('templates/header',$data);
		$this->load->view('templates/navbar',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('dashboard/pendaftaran',$data);
		$this->load->view('templates/footer');
	}
    public function BankDarah()
    {
        $data['user'] = $this->db->get_where('dd_user', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = "SemeruSmart - Dashboard Bank Darah";
        $kemarin='';
		$sekarang='';
		$data['stok'] = $this->model_pencarian->get_stok_darah();
		$this->load->view('templates/header',$data);
		$this->load->view('templates/navbar',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('dashboard/bankdarah',$data);
		$this->load->view('templates/footer');
		$this->load->view('templates/jquerytambahan',$data);
    }
    public function BedMonitoring()
    {
        $data['user'] = $this->db->get_where('dd_user', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = "SemeruSmart - Bed Monitoring";
        $kemarin='';
		$sekarang='';
		$data['stok'] = $this->model_pencarian->get_stok_darah();
		$this->load->view('templates/header',$data);
		$this->load->view('templates/navbar',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('dashboard/bankdarah',$data);
		$this->load->view('templates/footer');
		$this->load->view('templates/jquerytambahan',$data);
    }
    public function JadwalOperasi()
    {
        $data['user'] = $this->db->get_where('dd_user', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = "SemeruSmart - Jadwal Operasi";
        $kemarin='';
		$sekarang='';
		$data['stok'] = $this->model_pencarian->get_stok_darah();
		$this->load->view('templates/header',$data);
		$this->load->view('templates/navbar',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('dashboard/bankdarah',$data);
		$this->load->view('templates/footer');
		$this->load->view('templates/jquerytambahan',$data);
    }
}