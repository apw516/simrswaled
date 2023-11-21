<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class JasaMedis extends CI_Controller {
    public function __construct()
    {
        parent::__construct();	
		$role_id = $this->session->userdata('role_id');		
		// $this->load->library('Pdf');
        $this->load->model('modelJM');   
    }
	public function index()
	{
        $data['user'] = $this->db->get_where('dd_user', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = "SemeruSmart - Jasa Medis";
        $data['dokter'] = $this->db->get('mt_paramedis')->result_array();
        $data['laporan'] = $this->db->get('ts_laporan_jm')->result_array();
		$this->load->view('templates/header',$data);
		$this->load->view('templates/navbar',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('jasamedis/index',$data);
		$this->load->view('templates/footer_jm');
	}
    public function tampilJM()
    {
        $tgl_awal = $this->input->post('tgl_kemarin');
        $tgl_akhir = $this->input->post('tgl_sekarang');
        $dokter = $this->input->post('dokter');
        $penjamin = $this->input->post('penjamin');
        $data['penjamin'] = $this->input->post('penjamin');
        $data['jm_v'] = $this->modelJM->get_jm($tgl_awal,$tgl_akhir,$dokter,$penjamin);
        $this->load->view('jasamedis/tabel_jm',$data);
    }
    public function simpanrumus()
    {
        $kelompok = $this->input->post('KELOMPOK');
        $cara = $this->input->post('cara');
        $kelas = $this->input->post('kelas');
        $RUMUS1 = $this->input->post('RUMUS1');
        $RUMUS2 = $this->input->post('RUMUS2');
        $RUMUS3 = $this->input->post('RUMUS3');
        $RUMUS4 = $this->input->post('RUMUS4');
        $DATA = [
            'kelompok' => $kelompok,
            'cara_bayar' => $cara,
            'kelas' => $kelas,
            'rumus1' => $RUMUS1,
            'rumus2' =>$RUMUS2,
            'rumus3' =>$RUMUS3,
            'rumus4' =>$RUMUS4,
        ];
        $cek1 = $this->db->get('mt_rumus_jasa_pelayanan')->num_rows();
        $this->db->insert('mt_rumus_jasa_pelayanan',$DATA);
        $cek2 = $this->db->get('mt_rumus_jasa_pelayanan')->num_rows();
        if($cek2 > $cek1)
        {
            $data = [
                'status' => 1
                //sukses
            ];
        }else{
            $data = [
                'status' => 2
                //gagal
            ];
        }
        $this->session->set_flashdata('message', '7');
        redirect('jasa_medis_dokter');
    }
    public function simpan_laporan_jm()
    {
        $data_laporan = [
            'dokter' => $this->input->post('dokter'),
            'tanggal_awal' => $this->input->post('tgl_awal'),
            'tanggal_akhir' => $this->input->post('tgl_akhir'),
            'penjamin' => $this->input->post('penjamin'),
            'created_date' => date('Y-m-d h:i:s')
        ];
        $this->db->insert('ts_laporan_jm',$data_laporan);
    }
    public function hapus_jm()
    {
        $id_detail = $this->input->post('id_detail');
        $this->db->where('id',$id_detail);
        $this->db->delete('ts_laporan_jm');
    }
}