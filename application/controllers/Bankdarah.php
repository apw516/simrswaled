<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bankdarah extends CI_Controller {
	public function __construct()
    {
        parent::__construct();	
		$role_id = $this->session->userdata('role_id');
		if ($this->session->userdata('username') == '') {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Anda harus Login!</div>');
            redirect('Auth');
        }
		else if($role_id != '1'){
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Anda harus Login sebagai Dokter!</div>');
			redirect('Auth');
		}
        $this->load->model('model_pencarian');   
    }
	public function index()
	{
        $data['user'] = $this->db->get_where('dd_user', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = "SemerusmartReborn - Bank darah ( stok darah )";
        $kemarin='';
		$sekarang='';
		$data['stok'] = $this->model_pencarian->get_stok_darah();
		$this->load->view('templates/header',$data);
		$this->load->view('templates/navbar',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('bankdarah/index',$data);
		$this->load->view('templates/footer_bd');
		$this->load->view('templates/jquerytambahan',$data);
	}    
    public function simpanstok()
    {
		$user = $this->db->get_where('dd_user', ['username' => $this->session->userdata('username')])->row_array();
        foreach($_POST['data'] as $d)
			{
				$data_stok = [
					'nomor_kantong' => $d['nomor_kantong'],
					'goldar' => $d['goldar'],
					'jenis' => $d['jenis'],
					'tanggal_aftap' => $d['tgl_aftap'],
					'tanggal_exp' => $d['tgl_exp'],
					'tanggal_periksa' => $d['tgl_periksa'],
					'tanggal_input' => date('Y-m-d h:i:s'),
					'user' => $this->session->userdata('username'),
				];
				$this->db->insert('tb_stok_darah',$data_stok);
			}
			$this->session->set_flashdata('message', '6');
			redirect('Bankdarah');
    }
	public function cekstok()
	{
		$nomor_kantong = $this->input->post('nomorkantong');
		$cek_stok = $this->db->get_where('tb_stok_darah',array('nomor_kantong' => $nomor_kantong, 'status' => 1))->num_rows();		
		$data = [
			'cekstok' => $cek_stok
		];
		echo json_encode($data);
	}
	public function pesandarah()
	{
		$id = $this->input->post('id');
		$data['stok'] = $this->db->get_where('tb_stok_darah',array('id' => $id))->row_array();
		$this->load->view('v_jquery/pesandarah',$data);
	}
	public function hapusdarah()
	{
		$id = $this->input->post('id');
		$data['stok'] = $this->db->get_where('tb_stok_darah',array('id' => $id))->row_array();
		$this->load->view('v_jquery/hapusdarah',$data);
	}
	public function editdarah()
	{
		$id = $this->input->post('id');
		$data['stok'] = $this->db->get_where('tb_stok_darah',array('id' => $id))->row_array();
		$this->load->view('v_jquery/editdarah',$data);
	}
	public function pesandarahDone()
	{
		$id = $this->input->post('nomor_kantong');
		$this->db->where('id',$id);
		$this->db->update('tb_stok_darah',array('status' => 3));
		$cek = $this->db->get_where('tb_stok_darah',array('id' => $id,'status' => 3))->num_rows();
		$data = [
			'cekstok' => $cek
		];
		echo json_encode($data);
	}
	public function hapusdarahDone()
	{
		$id = $this->input->post('nomor_kantong');
		$this->db->where('id',$id);
		$this->db->delete('tb_stok_darah');
		$cek = $this->db->get_where('tb_stok_darah',array('id' => $id))->num_rows();
		$data = [
			'cekstok' => $cek
		];
		echo json_encode($data);
	}
	public function editdarahDone()
	{

		$id = $this->input->post('id');
		$nomor_kantong = $this->input->post('nomor_kantong');
		$jenis = $this->input->post('jenis');
		$goldar = $this->input->post('goldar');
		$tgl_aftap = $this->input->post('tgl_aftap');
		$tgl_exp = $this->input->post('tgl_exp');
		$tgl_periksa = $this->input->post('tgl_periksa');
		$status_darah = $this->input->post('status_darah');
		$data_edit = [
			'nomor_kantong' => $nomor_kantong,
			'goldar' => $goldar,
			'jenis' => $jenis,
			'tanggal_aftap' => $tgl_aftap,
			'tanggal_exp' => $tgl_exp,
			'tanggal_periksa' => $tgl_periksa,
			'status' => $status_darah
		];
		$this->db->where('id',$id);
		$this->db->update('tb_stok_darah',$data_edit);
		$data = [
			'cekstok' => 0
		];
		echo json_encode($data);
	}
}
