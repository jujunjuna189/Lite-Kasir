<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{

    private $title = "Laporan";

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Models', 'models');
        $this->load->model('GlobalModel', 'globalModel');
    }

    public function getLaporanGeneralPembelian($start_date, $end_date, $data = [])
    {
        $this->db->select('
            dt_pembelian.*, dt_pembelian.harga_jual as detail_harga_jual, dt_pembelian.harga_beli as detail_harga_beli, dt_pembelian.kuantitas as detail_kuantitas,
            ht_pembelian.*,
            produk.id_owner, produk.kuantitas as kuantitas_produk, produk.harga_beli as harga_beli_produk, produk.harga_jual as harga_jual_produk
        ');
        $this->db->from('dt_pembelian');
        $this->db->join('ht_pembelian', 'dt_pembelian.id_ht_pembelian = ht_pembelian.id');
        $this->db->join('produk', 'dt_pembelian.id_produk = produk.id');

        if ($start_date != '' && $end_date != '') {
            $this->db->where('ht_pembelian.waktu >=', $start_date);
            $this->db->where('ht_pembelian.waktu <=', $end_date);
        }
        if (isset($data['id_supplier'])) {
            $this->db->where('ht_pembelian.id_supplier', $data['id_supplier']);
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function getLaporanGeneral($start_date, $end_date, $id_owner = '')
    {
        $this->db->select('
            dt_penjualan.*, dt_penjualan.harga_jual as detail_harga_jual, dt_penjualan.harga_beli as detail_harga_beli, dt_penjualan.kuantitas as detail_kuantitas,
            ht_penjualan.*,
            produk.id_owner, produk.kuantitas as kuantitas_produk, produk.harga_beli as harga_beli_produk, produk.harga_jual as harga_jual_produk,
            owner.nama_owner
        ');
        $this->db->from('dt_penjualan');
        $this->db->join('ht_penjualan', 'dt_penjualan.id_ht_penjualan = ht_penjualan.id');
        $this->db->join('produk', 'dt_penjualan.id_produk = produk.id');
        $this->db->join('owner', 'produk.id_owner = owner.id');

        if ($start_date != '' && $end_date != '') {
            $this->db->where('ht_penjualan.waktu >=', $start_date);
            $this->db->where('ht_penjualan.waktu <=', $end_date);
        }
        if ($id_owner != '') {
            $this->db->where('produk.id_owner', $id_owner);
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function getLaporan($start_date, $end_date, $id_owner = '', $params = [])
    {
        $this->db->select('
            dt_penjualan.*, dt_penjualan.harga_jual as detail_harga_jual, dt_penjualan.harga_beli as detail_harga_beli, dt_penjualan.kuantitas as detail_kuantitas, sum(dt_penjualan.kuantitas) as total_kuantitas_penjualan,
            ht_penjualan.*, 
            sum(dt_pembelian.kuantitas) as total_kuantitas_pembelian,
            produk.id_owner, produk.kuantitas as kuantitas_produk, produk.harga_beli as harga_beli_produk, produk.harga_jual as harga_jual_produk,
            owner.nama_owner,
            kategori.nama_kategori
        ');
        $this->db->from('dt_penjualan');
        $this->db->join('ht_penjualan', 'dt_penjualan.id_ht_penjualan = ht_penjualan.id');
        $this->db->join('produk', 'dt_penjualan.id_produk = produk.id');
        $this->db->join('owner', 'produk.id_owner = owner.id');
        $this->db->join('kategori', 'produk.id_kategori = kategori.id');
        $this->db->join('dt_pembelian', 'produk.id = dt_pembelian.id_produk', 'left');
        if ($start_date != '' && $end_date != '') {
            $this->db->where('ht_penjualan.waktu >=', $start_date);
            $this->db->where('ht_penjualan.waktu <=', $end_date);
        }
        if ($id_owner != '') {
            $this->db->where('produk.id_owner', $id_owner);
        }
        if (isset($params['groupBy'])) {
            $this->db->group_by($params['groupBy']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    // Report RE
    public function report_filter_re()
    {
        $id = $this->input->get('id');
        // Footer
        $footer['script_loader'] = '';
        // transaksi
        $data['title_page'] = $this->title . ' Penjualan RE';
        $data['id_ht_penjualan'] = $id;
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

        // Get owner with name RE
        $id_owner_re = $this->models->Get_Where(['nama_owner' => 'RE'], 'owner');
        $id_owner = $id_owner_re[0]->id;
        // Header
        $header['auth_big_page'] = true;
        // Footer
        $footer['script_loader'] = '';
        // transaksi
        $data['title_page'] = $this->title . " Penjualan RE";
        $laporan = $this->getLaporanGeneral($start_date, $end_date, $id_owner);
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['laporan'] = $laporan;
        $data['no'] = 1;
        $data['table'] = [
            'nama_produk' => true,
            'penjualan' => true,
            'qty' => true,
            'harga_jual' => true,
            'harga_beli' => true,
            'total_harga_beli' => true,
            'margin_percent' => true,
            'margin' => true,
            'total_margin' => true,
        ];

        $this->load->view('layouts/auth/header', $header);
        $this->load->view('report/laporan_owner/report', $data);
        $this->load->view('layouts/auth/footer');
    }

    // Move to report controller
    public function report_filter_owner()
    {
        $id = $this->input->get('id');
        // Footer
        $footer['script_loader'] = '';
        // transaksi
        $owner = $this->getOwner();
        $data['title_page'] = $this->title . ' Penjualan Owner';
        $data['id_ht_penjualan'] = $id;
        $data['owner'] = $owner;
        $data['no'] = 1;

        $this->load->view('layouts/header');
        $this->load->view('layouts/navbar', $data);
        $this->load->view('layouts/sidebar');
        $this->load->view('report/laporan_owner/index', $data);
        $this->load->view('layouts/footer', $footer);
    }

    public function report_transaksi_owner()
    {
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $id_owner = $this->input->post('id_owner');
        // Header
        $header['auth_big_page'] = true;
        // Footer
        $footer['script_loader'] = '';
        // transaksi
        $data['title_page'] = $this->title . " Penjualan Owner";
        $laporan = $this->getLaporanGeneral($start_date, $end_date, $id_owner);

        if ($id_owner != '' && $laporan != []) {
            $data['personal'] = true;
            $data['title_'] = 'Nama Owner';
            $data['value_'] = $laporan[0]->nama_owner;
        }


        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['laporan'] = $laporan;
        $data['no'] = 1;
        $data['table'] = [
            'nama_produk' => true,
            'penjualan' => true,
            'qty' => true,
            'harga_jual' => true,
            'harga_beli' => true,
            'total_harga_beli' => true,
            'margin_percent' => true,
            'margin' => true,
            'total_margin' => true,
        ];

        $this->load->view('layouts/auth/header', $header);
        $this->load->view('report/laporan_owner/report', $data);
        $this->load->view('layouts/auth/footer');
    }

    public function getOwner()
    {
        $select = $this->db->select('*');
        $get = $this->models->Get_All('owner', $select);

        return $get;
    }

    public function getSupplier()
    {
        $select = $this->db->select('*');
        $get = $this->models->Get_All('supplier', $select);

        return $get;
    }

    public function report_filter_saldo_re()
    {
        // Footer
        $footer['script_loader'] = '';
        // transaksi
        $data['title_page'] = $this->title . ' Saldo Priode';
        $data['no'] = 1;

        $this->load->view('layouts/header');
        $this->load->view('layouts/navbar', $data);
        $this->load->view('layouts/sidebar');
        $this->load->view('report/laporan_saldo_priode/index', $data);
        $this->load->view('layouts/footer', $footer);
    }

    public function report_saldo_priode()
    {
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');

        // Header
        $header['auth_big_page'] = true;
        // Footer
        $footer['script_loader'] = '';
        // transaksi
        $data['title_page'] = $this->title . " Saldo Priode";
        $laporan = $this->getLaporan($start_date, $end_date, '', ['groupBy' => 'dt_penjualan.id_produk']);

        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['laporan'] = $laporan;
        $data['no'] = 1;
        $data['table'] = [
            'nama_produk' => true,
            'saldo_awal' => true,
            'saldo_akhir' => true,
            'golongan' => true,
            'kategori' => true,
            'harga_jual_produk' => true,
            'harga_beli_produk' => true,
            'total_nominal_persedian' => true
        ];

        $this->load->view('layouts/auth/header', $header);
        $this->load->view('report/laporan_owner/report', $data);
        $this->load->view('layouts/auth/footer');
    }

    // Report Pembelian Supplier
    public function report_pembelian_supplier()
    {
        $id = $this->input->get('id');
        // Footer
        $footer['script_loader'] = '';
        // transaksi
        $supplier = $this->getSupplier();
        $data['title_page'] = $this->title . ' Pebelian Supplier';
        $data['id_ht_penjualan'] = $id;
        $data['supplier'] = $supplier;
        $data['no'] = 1;

        $this->load->view('layouts/header');
        $this->load->view('layouts/navbar', $data);
        $this->load->view('layouts/sidebar');
        $this->load->view('report/laporan_pembelian_supplier/index', $data);
        $this->load->view('layouts/footer', $footer);
    }

    // Laporan transaksi pembelian supplier
    public function report_transaksi_pembelian_supplier()
    {
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $id_supplier = $this->input->post('id_supplier');
        // Header
        $header['auth_big_page'] = true;
        // Footer
        $footer['script_loader'] = '';
        // transaksi
        $data['title_page'] = $this->title . " Pembelian Supplier";
        $laporan = $this->getLaporanGeneralPembelian($start_date, $end_date, ['id_supplier' => $id_supplier]);

        if ($id_supplier != '' && $laporan != []) {
            $data['personal'] = true;
            $data['title_'] = 'Nama Supplier';
            $data['value_'] = $laporan[0]->nama_supplier;
        }
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['laporan'] = $laporan;
        $data['no'] = 1;
        $data['table'] = [
            'nama_produk' => true,
            'pembelian' => true,
            'qty' => true,
            'harga_jual' => true,
            'harga_beli' => true,
            'total_harga_beli' => true,
            'margin_percent' => true,
            'margin' => true,
            'total_margin' => true,
        ];

        $this->load->view('layouts/auth/header', $header);
        $this->load->view('report/laporan_owner/report', $data);
        $this->load->view('layouts/auth/footer');
    }

    // Report Pembelian Supplier
    public function report_pembelian_all_supplier()
    {
        // Footer
        $footer['script_loader'] = '';
        // transaksi
        $data['title_page'] = $this->title . ' Pebelian Supplier';
        $data['no'] = 1;

        $this->load->view('layouts/header');
        $this->load->view('layouts/navbar', $data);
        $this->load->view('layouts/sidebar');
        $this->load->view('report/laporan_pembelian_all_supplier/index', $data);
        $this->load->view('layouts/footer', $footer);
    }

    // Laporan transaksi pembelian supplier
    public function report_transaksi_pembelian_all_upplier()
    {
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        // Header
        $header['auth_big_page'] = true;
        // Footer
        $footer['script_loader'] = '';
        // transaksi
        $data['title_page'] = $this->title . " Pembelian Supplier";
        $laporan = $this->getLaporanGeneralPembelian($start_date, $end_date);
        $data['laporan'] = $laporan;
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['no'] = 1;
        $data['table'] = [
            'nama_produk' => true,
            'pembelian' => true,
            'qty' => true,
            'harga_jual' => true,
            'harga_beli' => true,
            'total_harga_beli' => true,
            'margin_percent' => true,
            'margin' => true,
            'total_margin' => true,
        ];

        $this->load->view('layouts/auth/header', $header);
        $this->load->view('report/laporan_owner/report', $data);
        $this->load->view('layouts/auth/footer');
    }

    // Report Pembelian Supplier
    public function report_piutang_karyawan()
    {
        // Footer
        $footer['script_loader'] = '';
        // transaksi
        $data['title_page'] = $this->title . ' Piutang Karyawan';
        $data['no'] = 1;

        $this->load->view('layouts/header');
        $this->load->view('layouts/navbar', $data);
        $this->load->view('layouts/sidebar');
        $this->load->view('report/piutang_karyawan/index', $data);
        $this->load->view('layouts/footer', $footer);
    }

    // Laporan transaksi pembelian supplier
    public function report_transaksi_piutang_karyawan()
    {
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        // Header
        $header['auth_big_page'] = true;
        // Footer
        $footer['script_loader'] = '';
        // transaksi
        $data['title_page'] = $this->title . " Piutang Karyawan";
        $laporan = $this->getLaporanGeneral($start_date, $end_date);

        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['laporan'] = $laporan;
        $data['no'] = 1;
        $data['table'] = [
            'nama_customer' => true,
            'qty' => true,
            'harga_jual' => true,
            'harga_beli' => true,
            'total_bayar' => true,
            'total_harga_jual' => true,
            'piutang' => true,
        ];

        $this->load->view('layouts/auth/header', $header);
        $this->load->view('report/laporan_owner/report', $data);
        $this->load->view('layouts/auth/footer');
    }
}
