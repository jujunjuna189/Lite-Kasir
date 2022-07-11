<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {
    private $title = 'Customer';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Models', 'models');
        $this->load->model('GlobalModel', 'globalModel');
    }
	
	public function index()
	{
        // Footer
        $footer['script_loader'] = '<script src="'. base_url() .'assets/customjs/customer.js"></script>';

        // Customer
		$select = $this->db->select('*');

		$data['customer'] = $this->models->Get_All('customer', $select);
		$data['no'] = 1;
        $data['title_page'] = $this->title;

        $this->load->view('layouts/header');
        $this->load->view('layouts/navbar', $data);
        $this->load->view('layouts/sidebar');
		$this->load->view('master/customer/index', $data);
        $this->load->view('layouts/footer', $footer);
	}

    public function create()
	{
		$data = array(
			'nama_customer'	=>	$this->input->post('nama_customer'),
            'status'	=>	$this->input->post('status'),
		);

		$this->models->Save($data, 'customer');

		redirect('Customer');
	}

	public function update()
	{
		$data = array(
			'nama_customer'	=>	$this->input->post('nama_customer'),
            'status'	=>	$this->input->post('status'),
		);

		$where['id'] = $this->input->post('id');
		$this->models->Update($where, $data, 'customer');

		redirect('Customer');
	}

    public function delete()
	{

		$where['id'] = $this->input->get('id');
		$this->models->Delete($where, 'customer');

		redirect('Customer');
	}
}
