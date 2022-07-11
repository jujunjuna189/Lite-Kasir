<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

    private $title = 'Penjualan';
    private $titleReport = 'Laporan Transaksi';

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

        // if(isset($_POST)){
        //     $this->db->where('ht_penjualan.waktu >=', $this->input->post('start_date'));
        //     $this->db->where('ht_penjualan.waktu <=', $this->input->post('end_date'));
        // }

        $transaksi = $this->models->Get_All('ht_penjualan', $select);

        $header['title_page'] = $this->title;
		$data['transaksi'] = $transaksi;
        $data['customer'] = $this->models->Get_All('customer', $select);
        $data['produk'] = $this->models->Get_All('produk', $select);
		$data['no'] = 1;

        $this->load->view('layouts/header');
        $this->load->view('layouts/navbar', $header);
        $this->load->view('layouts/sidebar');
		$this->load->view('master/transaksi/penjualan', $data);
        $this->load->view('layouts/footer', $footer);
	}

    public function create()
    {
        $result = $this->input->post('data');

        $data['id_customer'] = $result['id_customer'];
        $data['nama_customer'] = $result['nama_customer'];
        $data['total_bayar'] = $result['total_bayar'];
        $data['waktu'] = $result['waktu'];
        $data['kasir'] = $result['kasir'];

        $this->models->Save($data, 'ht_penjualan');
        $lastData = $this->models->getLastData('ht_penjualan', 'id');
        $this->createDetailPenjualan($result['data_produk'], $lastData);
        echo json_encode("Insert Success");
    }

    public function createDetailPenjualan($result, $lastData)
    {
        $lengthData = count($result);
        $ht_id = $lastData->id;

        $data = [];
        for($i = 0; $i < $lengthData; $i++){
            $data[] = [
                'id_ht_penjualan' => $ht_id,
                'id_produk' => $result[$i]['id'],
                'nama_produk' => $result[$i]['nama'],
                'harga_beli' => $result[$i]['harga_beli'],
                'harga_jual' => $result[$i]['harga_jual'],
                'kuantitas' => $result[$i]['qty']
            ];

            // Get produk
            $produk = $this->models->Get_Where(['id' => $result[$i]['id']], 'produk');
            // Kurangi Stok produk
            $minProduk = $produk[0]->kuantitas - $result[$i]['qty'];
            $dataProduk['kuantitas'] = $minProduk;
            $where['id'] = $result[$i]['id'];
		    $this->models->Update($where, $dataProduk, 'produk');
        }

        $this->models->saveBatch($data, 'dt_penjualan');
    }

    public function delete()
    {
        $id = $this->input->get('id');
        // get dt_penjualan
        $resultDtPenjualan = $this->models->Get_Where(['id_ht_penjualan' => $id], 'dt_penjualan');
        foreach($resultDtPenjualan as $value){
            echo json_encode($value->kuantitas);
            // Firt data
            $qty = $value->kuantitas;
            // Get data produk
            $produk = $this->models->Get_Where(['id' => $value->id_produk], 'produk');
            // Tambah stok produk
            $count = $produk[0]->kuantitas + $qty;
            // Update stok produk
            $data['kuantitas'] = $count;
            $this->models->Update(['id' => $value->id_produk], $data, 'produk');
        }

        // Hapus dt_penjualan
        $this->models->Delete(['id_ht_penjualan' => $id], 'dt_penjualan');
        // Hapus ht_penjualan
        $this->models->Delete(['id' => $id], 'ht_penjualan');
        redirect('Transaksi/penjualan');
    }

    public function report()
    {
        $id = $this->input->get('id');
        // Header
        $header['auth_big_page'] = true;
        // transaksi
        $data['title_page'] = $this->titleReport;
		$data['ht_penjualan'] = $this->models->Get_Where(['id' => $id], 'ht_penjualan');
        $data['dt_penjualan'] = $this->models->Get_Where(['id_ht_penjualan' => $id], 'dt_penjualan');
		$data['no'] = 1;

        $this->load->view('layouts/auth/header', $header);
		$this->load->view('report/transaksi/index', $data);
        $this->load->view('layouts/auth/footer');
    }

    // ==========================================
    // Pembelian
    // ==========================================
    private $titlePembelian = 'Pembelian';
    private $titleReportPembelian = 'Laporan Transaksi Pembelian';

    public function pembelian()
    {
        // Footer
        $footer['script_loader'] = '<script src="'. base_url() .'assets/customjs/pembelian.js"></script>';

        // transaksi
		$select = $this->db->select('*');

        $header['title_page'] = $this->titlePembelian;
		$data['transaksi'] = $this->models->Get_All('ht_pembelian', $select);
        $data['supplier'] = $this->models->Get_All('supplier', $select);
        $data['produk'] = $this->models->Get_All('produk', $select);
		$data['no'] = 1;

        $this->load->view('layouts/header');
        $this->load->view('layouts/navbar', $header);
        $this->load->view('layouts/sidebar');
		$this->load->view('master/transaksi/pembelian', $data);
        $this->load->view('layouts/footer', $footer);
    }

    public function create_pembelian()
    {
        $result = $this->input->post('data');

        $data['id_supplier'] = $result['id_supplier'];
        $data['nama_supplier'] = $result['nama_supplier'];
        $data['total_bayar'] = $result['total_bayar'];
        $data['waktu'] = $result['waktu'];

        $this->models->Save($data, 'ht_pembelian');
        $lastData = $this->models->getLastData('ht_pembelian', 'id');
        $this->createDetailPembelian($result['data_produk'], $lastData);
        echo json_encode("Insert Success");
    }

    public function createDetailPembelian($result, $lastData)
    {
        $lengthData = count($result);
        $ht_id = $lastData->id;

        $data = [];
        for($i = 0; $i < $lengthData; $i++){
            $data[] = [
                'id_ht_pembelian' => $ht_id,
                'id_produk' => $result[$i]['id'],
                'nama_produk' => $result[$i]['nama'],
                'harga_beli' => $result[$i]['harga_beli'],
                'harga_jual' => $result[$i]['harga_jual'],
                'kuantitas' => $result[$i]['qty']
            ];

            // Get produk
            $produk = $this->models->Get_Where(['id' => $result[$i]['id']], 'produk');
            // Kurangi Stok produk
            $minProduk = $produk[0]->kuantitas + $result[$i]['qty'];
            $dataProduk['kuantitas'] = $minProduk;
            $where['id'] = $result[$i]['id'];
		    $this->models->Update($where, $dataProduk, 'produk');
        }

        $this->models->saveBatch($data, 'dt_pembelian');
    }

    public function delete_pembelian()
    {
        $id = $this->input->get('id');
        // get dt_pembelian
        $resultDtPembelian = $this->models->Get_Where(['id_ht_pembelian' => $id], 'dt_pembelian');
        foreach($resultDtPembelian as $value){
            echo json_encode($value->kuantitas);
            // Firt data
            $qty = $value->kuantitas;
            // Get data produk
            $produk = $this->models->Get_Where(['id' => $value->id_produk], 'produk');
            // Tambah stok produk
            $count = $produk[0]->kuantitas - $qty;
            // Update stok produk
            $data['kuantitas'] = $count;
            $this->models->Update(['id' => $value->id_produk], $data, 'produk');
        }

        // Hapus dt_pembelian
        $this->models->Delete(['id_ht_pembelian' => $id], 'dt_pembelian');
        // Hapus ht_pembelian
        $this->models->Delete(['id' => $id], 'ht_pembelian');
        redirect('Transaksi/pembelian');
    }
}
