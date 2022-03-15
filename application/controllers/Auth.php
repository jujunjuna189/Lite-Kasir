<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Models', 'models');
    }
	
	public function index()
	{
        $this->load->view('layouts/auth/header');
		$this->load->view('auth/login');
        $this->load->view('layouts/auth/footer');
	}

    public function login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $select = $this->db->select('*');
        $where['username'] = $username;
        $where['password'] = md5($password);
        $select = $this->db->where($where);
        $user = $this->models->Get_All('users', $select);

        if(count($user) > 0){
            $data = '';
            foreach($user as $val){
                $data = $val;
            }

            $this->session->set_userdata($data);
            redirect('Kasir');
        }else{
            redirect('Auth/login');
        }
    }
}
