<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller {
    private $title = 'Supplier';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Models', 'models');
        $this->load->model('GlobalModel', 'globalModel');
    }
    
    public function index()
	{
        // Footer
        $footer['script_loader'] = '<script src="'. base_url() .'assets/customjs/supplier.js"></script>';

        // supplier
		$select = $this->db->select('*');

		$data['supplier'] = $this->models->Get_All('supplier', $select);
		$data['no'] = 1;
        $data['title_page'] = $this->title;

        $this->load->view('layouts/header');
        $this->load->view('layouts/navbar', $data);
        $this->load->view('layouts/sidebar');
		$this->load->view('master/supplier/index', $data);
        $this->load->view('layouts/footer', $footer);
	}

    public function create()
	{
		$data = array(
			'nama_supplier'	=>	$this->input->post('nama_supplier'),
			'no_hp'		=>	$this->input->post('no_hp'),
			'alamat'		=>	$this->input->post('alamat'),
		);

		$this->models->Save($data, 'supplier');

		redirect('Supplier');
	}

	public function update()
	{
		$data = array(
			'nama_supplier'	=>	$this->input->post('nama_supplier'),
			'no_hp'		=>	$this->input->post('no_hp'),
			'alamat'		=>	$this->input->post('alamat'),
		);

		$where['id'] = $this->input->post('id');
		$this->models->Update($where, $data, 'supplier');

		redirect('Supplier');
	}

    public function delete()
	{

		$where['id'] = $this->input->get('id');
		$this->models->Delete($where, 'supplier');

		redirect('Supplier');
	}
}