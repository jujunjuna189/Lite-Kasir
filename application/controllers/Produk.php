<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {
	private $title = 'Produk';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Models', 'models');
        $this->load->model('GlobalModel', 'globalModel');
    }
	
	public function index()
	{
        // Footer
        $footer['script_loader'] = '<script src="'. base_url() .'assets/customjs/produk.js"></script>';

        // Produk
		$select = $this->db->select('*');

		$data['title_page'] = $this->title;
		$data['produk'] = $this->models->Get_All('produk', $select);
		$data['owner'] = $this->models->Get_All('owner', $select);
		$data['kategori'] = $this->models->Get_All('kategori', $select);
		$data['no'] = 1;

        $this->load->view('layouts/header');
        $this->load->view('layouts/navbar', $data);
        $this->load->view('layouts/sidebar');
		$this->load->view('master/produk/index', $data);
        $this->load->view('layouts/footer', $footer);
	}

    public function create()
	{
		$data = array(
			'nama'			=>	$this->input->post('nama'),
			'id_kategori'	=> 	$this->input->post('id_kategori'),
			'kuantitas'		=>	$this->input->post('kuantitas'),
			'harga_jual'	=>	$this->input->post('harga_jual'),
			'harga_beli'	=> 	$this->input->post('harga_beli'),
			'id_owner'		=> 	$this->input->post('id_owner')
		);

		$this->models->Save($data, 'produk');

		redirect('Produk');
	}

	public function update()
	{
		$data = array(
			'nama'			=>	$this->input->post('nama'),
			'id_kategori'	=> 	$this->input->post('id_kategori'),
			'kuantitas'		=>	$this->input->post('kuantitas'),
			'harga_jual'	=>	$this->input->post('harga_jual'),
			'harga_beli'	=> 	$this->input->post('harga_beli'),
			'id_owner'		=> 	$this->input->post('id_owner')
		);

		$where['id'] = $this->input->post('id');
		$this->models->Update($where, $data, 'produk');

		redirect('Produk');
	}

	public function delete()
	{

		$where['id'] = $this->input->get('id');
		$this->models->Delete($where, 'produk');

		redirect('Produk');
	}
}
