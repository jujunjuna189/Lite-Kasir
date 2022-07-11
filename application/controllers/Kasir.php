<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kasir extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Models', 'models');
    }
	
	public function index()
	{
        $data['penjualan'] = 2500000;
        $data['pembelian'] = 3467000;
        $data['laba'] = 4565000;

        $this->load->view('layouts/header');
        $this->load->view('layouts/navbar');
        $this->load->view('layouts/sidebar');
		$this->load->view('kasir/index', $data);
        $this->load->view('layouts/footer');
	}
}
