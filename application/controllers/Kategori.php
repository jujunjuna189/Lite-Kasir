<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {
    private $title = 'Kategori';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Models', 'models');
        $this->load->model('GlobalModel', 'globalModel');
    }
    
    public function index()
	{
        // Footer
        $footer['script_loader'] = '<script src="'. base_url() .'assets/customjs/kategori.js"></script>';

        // kategori
		$select = $this->db->select('*');

		$data['kategori'] = $this->models->Get_All('kategori', $select);
		$data['no'] = 1;
        $data['title_page'] = $this->title;

        $this->load->view('layouts/header');
        $this->load->view('layouts/navbar', $data);
        $this->load->view('layouts/sidebar');
		$this->load->view('master/kategori/index', $data);
        $this->load->view('layouts/footer', $footer);
	}

    public function create()
    {
        $data = array(
			'nama_kategori'	=>	$this->input->post('nama_kategori'),
		);

		$this->models->Save($data, 'kategori');

		redirect('Kategori');
    }

    public function update()
    {
        $data = array(
			'nama_kategori'	=>	$this->input->post('nama_kategori'),
		);

		$where['id'] = $this->input->post('id');
		$this->models->Update($where, $data, 'kategori');

		redirect('Kategori');
    }

    public function delete()
    {
        $where['id'] = $this->input->get('id');
		$this->models->Delete($where, 'kategori');

		redirect('Kategori');
    }
}