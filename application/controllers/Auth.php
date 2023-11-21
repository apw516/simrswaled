<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {	
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
		$this->load->model('modelLogin');   
    }
	public function index()
	{
        $this->form_validation->set_rules('username', 'Username', 'trim|required',[
            'required' => 'Periksa username anda!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'SemerusmartReborn - Login page';
			$this->load->view('Auth/header',$data);
			$this->load->view('Auth/index');
			$this->load->view('Auth/footer');
		}else {
            //validasi sukses ,ke halaman awal login
            $this->_login();
        }
	}
    private function _login()
    {
        //ambil data email dan password untuk login
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        //query data,mencari user yang emailnya sesuai dengan data login
        $user = $this->modelLogin->getUser($username);
        //jika usernya ada
        if ($user) {
                //cek password
                if (md5($password) == $user['password']) {
                    $data = [
                        'nama' => $user['nama_user'],
                        'username' => $user['username'],
                        'id' => $user['id'],
                        'kode_unit' => $user['kode_unit'], //untuuk menentukan menu 
                        'role_id' => $user['role_id'] //untuuk menentukan menu 
                    ];
                    $this->session->set_userdata($data);
                    if($user['kode_unit'] == '8004'){
                        redirect('JasaMedis');
                    }                   
                    else if($user['kode_unit'] == '3001'){
                        redirect('IndikatorPelayanan');
                    }                           
                                               
                    else if($user['role_id'] == '1'){
                        redirect('Billing');
                    }                            
                    else if($user['kode_unit'] == '3020' && $user['role_id'] == '2'){
                        redirect('ExpertisiPA');
                    }                            
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password!</div>');
                    redirect('Auth');
                }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">username is not register!</div>');
            redirect('Auth');
        }
    }
    public function registration()
    {
        $data['title'] = 'SemerusmartReborn - Registration';
        $this->load->view('Auth/header',$data);
		$this->load->view('Auth/regis');
		$this->load->view('Auth/footer');
    }
    public function logout()
    {
        $this->session->unset_userdata('nama');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('kode_unit');	
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You have been logout!</div>');
        redirect('Auth');
    }
}
