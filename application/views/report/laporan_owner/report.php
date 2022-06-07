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
                <table id="example1" class="table table-bordered table-striped mt-3">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Nama Produk</th>
                            <th>Penjualan</th>
                            <th>Qty</th>
                            <th>Harga Jual</th>
                            <th>Harga Beli</th>
                            <th>Total Harga Beli</th>
                            <th>% Margin</th>
                            <th>Margin</th>
                            <th>Total Margin</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($laporan as $val) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $val->nama_produk ?></td>
                                <td><?= $this->globalModel->format_currentcy($val->detail_harga_jual * $val->detail_kuantitas) ?></td>
                                <td><?= $val->detail_kuantitas ?></td>
                                <td><?= $this->globalModel->format_currentcy($val->detail_harga_jual) ?></td>
                                <td><?= $this->globalModel->format_currentcy($val->detail_harga_beli) ?></td>
                                <td><?= $this->globalModel->format_currentcy($val->detail_harga_beli * $val->detail_kuantitas) ?></td>
                                <td><?= $this->globalModel->format_percent(($val->detail_harga_jual - $val->detail_harga_beli) / $val->detail_harga_beli) ?></td>
                                <td><?= $this->globalModel->format_currentcy(($val->detail_harga_jual - $val->detail_harga_beli) * $val->detail_kuantitas) ?></td>
                                <td><?= $this->globalModel->format_currentcy((($val->detail_harga_jual - $val->detail_harga_beli) / $val->detail_harga_beli) * ($val->detail_harga_jual - $val->detail_harga_beli) * $val->detail_kuantitas) ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>