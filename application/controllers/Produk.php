<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

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

		$data['produk'] = $this->models->Get_All('produk', $select);
		$data['owner'] = $this->models->Get_All('owner', $select);
		$data['no'] = 1;

        $this->load->view('layouts/header');
        $this->load->view('layouts/preloader');
        $this->load->view('layouts/navbar');
        $this->load->view('layouts/sidebar');
		$this->load->view('master/produk/index', $data);
        $this->load->view('layouts/footer', $footer);
	}
}
