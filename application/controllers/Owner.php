<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Owner extends CI_Controller {
    private $title = 'Owner';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Models', 'models');
        $this->load->model('GlobalModel', 'globalModel');
    }
	
	public function index()
	{
        // Footer
        $footer['script_loader'] = '<script src="'. base_url() .'assets/customjs/owner.js"></script>';

        // Owner
		$select = $this->db->select('*');

		$data['owner'] = $this->models->Get_All('owner', $select);
		$data['no'] = 1;
        $data['title_page'] = $this->title;

        $this->load->view('layouts/header');
        $this->load->view('layouts/navbar', $data);
        $this->load->view('layouts/sidebar');
		$this->load->view('master/owner/index', $data);
        $this->load->view('layouts/footer', $footer);
	}

    public function create()
	{
		$data = array(
			'nama_owner'	=>	$this->input->post('nama_owner'),
			'status'		=>	$this->input->post('status'),
		);

		$this->models->Save($data, 'owner');

		redirect('Owner');
	}

	public function update()
	{
		$data = array(
			'nama_owner'	=>	$this->input->post('nama_owner'),
			'status'		=>	$this->input->post('status'),
		);

		$where['id'] = $this->input->post('id');
		$this->models->Update($where, $data, 'owner');

		redirect('Owner');
	}

    public function delete()
	{

		$where['id'] = $this->input->get('id');
		$this->models->Delete($where, 'owner');

		redirect('Owner');
	}
}
