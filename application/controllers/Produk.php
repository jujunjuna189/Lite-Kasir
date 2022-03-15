<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Models', 'model');
    }
	
	public function index()
	{
        $footer['script_loader'] = '<script src="'. base_url() .'assets/customjs/produk.js"></script>';

        $this->load->view('layouts/header');
        $this->load->view('layouts/preloader');
        $this->load->view('layouts/navbar');
        $this->load->view('layouts/sidebar');
		$this->load->view('master/produk/index');
        $this->load->view('layouts/footer', $footer);
	}
}
