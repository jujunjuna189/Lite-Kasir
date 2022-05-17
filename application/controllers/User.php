<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    private $title = 'User';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Models', 'models');
        $this->load->model('GlobalModel', 'globalModel');
    }
	
	public function index()
	{
        // Footer
        $footer['script_loader'] = '<script src="'. base_url() .'assets/customjs/user.js"></script>';

        // Owner
		$select = $this->db->select('*');

		$data['user'] = $this->models->Get_All('users', $select);
		$data['no'] = 1;
        $data['title_page'] = $this->title;

        $this->load->view('layouts/header');
        $this->load->view('layouts/navbar', $data);
        $this->load->view('layouts/sidebar');
		$this->load->view('master/user/index', $data);
        $this->load->view('layouts/footer', $footer);
	}

    public function create()
	{
		$data = array(
			'nama'	        =>	$this->input->post('nama'),
			'username'		=>	$this->input->post('username'),
            'password'		=>	md5($this->input->post('password')),
            'akses'         =>  $this->input->post('akses'),
		);

		$this->models->Save($data, 'users');

		redirect('User');
	}

	public function update()
	{
		$data = array(
			'nama'	        =>	$this->input->post('nama'),
			'username'		=>	$this->input->post('username'),
            'password'		=>	md5($this->input->post('password')),
            'akses'         =>  $this->input->post('akses'),
		);

		$where['id'] = $this->input->post('id');
		$this->models->Update($where, $data, 'users');

		redirect('User');
	}

    public function delete()
	{

		$where['id'] = $this->input->get('id');
		$this->models->Delete($where, 'users');

		redirect('User');
	}
}
