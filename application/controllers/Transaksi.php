<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Models', 'models');
        $this->load->model('GlobalModel', 'globalModel');
    }
	
	public function penjualan()
	{
        // Footer
        $footer['script_loader'] = '<script src="'. base_url() .'assets/customjs/penjualan.js"></script>';

        // transaksi
		$select = $this->db->select('*');

		$data['transaksi'] = $this->models->Get_All('ht_penjualan', $select);
        $data['customer'] = $this->models->Get_All('customer', $select);
        $data['produk'] = $this->models->Get_All('produk', $select);
		$data['no'] = 1;

        $this->load->view('layouts/header');
        $this->load->view('layouts/navbar');
        $this->load->view('layouts/sidebar');
		$this->load->view('master/transaksi/penjualan', $data);
        $this->load->view('layouts/footer', $footer);
	}
}
