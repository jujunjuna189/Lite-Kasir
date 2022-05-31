<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="float-left">
                    <h2 class="card-title font-weight-bold"><?= $title_page ?? '' ?></h2>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="d-flex">
                    <label for="customer">Nama Customer : </label>
                    <h5><?= $ht_penjualan[0]->nama_customer ?></h5>
                </div>
                <div class="d-flex">
                    <label for="customer">Tanggal Pembelian : </label>
                    <h5><?= date('d-M-Y', strtotime($ht_penjualan[0]->waktu)) ?></h5>
                </div>
                <table id="example1" class="table table-bordered table-striped mt-3">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Kuantitas</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total_kuantitas = 0; ?>
                        <?php foreach ($dt_penjualan as $val) { ?>
                            <?php $total_kuantitas += $val->kuantitas ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $val->nama_produk ?></td>
                                <td><?= $this->globalModel->format_currentcy($val->harga_jual) ?></td>
                                <td><?= $val->kuantitas ?></td>
                                <td><?= $this->globalModel->format_currentcy($val->harga_jual * $val->kuantitas) ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" align="right">
                                <label for="Total">Total Pembayaran</label>
                            </td>
                            <td><?= $total_kuantitas ?></td>
                            <td><?= $this->globalModel->format_currentcy($ht_penjualan[0]->total_bayar) ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>