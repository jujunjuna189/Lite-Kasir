<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kasir extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Models', 'model');
    }
	
	public function index()
	{
        $this->load->view('layouts/header');
        $this->load->view('layouts/preloader');
        $this->load->view('layouts/navbar');
        $this->load->view('layouts/sidebar');
		$this->load->view('kasir/index');
        $this->load->view('layouts/footer');
	}
}
