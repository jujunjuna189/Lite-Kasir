<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

    private $title = "Laporan";

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Models', 'models');
        $this->load->model('GlobalModel', 'globalModel');
    }

    // Move to report controller
    public function report_filter_re()
    {
        $id = $this->input->get('id');
        // Footer
        $footer['script_loader'] = '';
        // transaksi
        $owner = $this->getOwner();
        $data['title_page'] = $this->title . ' RE';
		$data['id_ht_penjualan'] = $id;
        $data['owner'] = $owner;
		$data['no'] = 1;

        $this->load->view('layouts/header');
        $this->load->view('layouts/navbar', $data);
        $this->load->view('layouts/sidebar');
		$this->load->view('report/laporan_re/index', $data);
        $this->load->view('layouts/footer', $footer);
    }

    public function report_transaksi_re()
    {
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $id_owner = $this->input->post('id_owner');
        // Header
        $header['auth_big_page'] = true;
        // Footer
        $footer['script_loader'] = '';
        // transaksi
        $data['title_page'] = $this->title . " RE";
        $laporan = $this->getLaporan($start_date, $end_date, $id_owner);
		$data['laporan'] = $laporan;
		$data['no'] = 1;

        $this->load->view('layouts/auth/header', $header);
		$this->load->view('report/laporan_re/report', $data);
        $this->load->view('layouts/auth/footer');
    }

    public function getLaporan($start_date, $end_date, $id_owner)
    {
        $this->db->select('dt_penjualan.*, dt_penjualan.harga_jual as detail_harga_jual, dt_penjualan.kuantitas as detail_kuantitas, ht_penjualan.*, produk.id_owner');
        $this->db->from('dt_penjualan');
        $this->db->join('ht_penjualan', 'dt_penjualan.id_ht_penjualan = ht_penjualan.id');
        $this->db->join('produk', 'dt_penjualan.id_produk = produk.id');
        $this->db->where('ht_penjualan.waktu >=', $start_date);
        $this->db->where('ht_penjualan.waktu <=', $end_date);
        if($id_owner != ''){
            $this->db->where('produk.id_owner', $id_owner);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function getOwner()
    {
        $select = $this->db->select('*');
        $get = $this->models->Get_All('owner', $select);

        return $get;
    }
}