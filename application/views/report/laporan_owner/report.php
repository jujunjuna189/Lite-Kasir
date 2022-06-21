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
                            <?php if(isset($table['nama_produk'])) : ?>
                                <th>Nama Produk</th>
                            <?php endif ?>
                            <?php if(isset($table['saldo_awal'])) : ?>
                                <th>Saldo Awal</th>
                            <?php endif ?>
                            <?php if(isset($table['saldo_akhir'])) : ?>
                                <th>Saldo Akhir</th>
                            <?php endif ?>
                            <?php if(isset($table['golongan'])) : ?>
                                <th>Golongan</th>
                            <?php endif ?>
                            <?php if(isset($table['kategori'])) : ?>
                                <th>Kategori</th>
                            <?php endif ?>
                            <?php if(isset($table['harga_beli_produk'])) : ?>
                                <th>Harga Beli</th>
                            <?php endif ?>
                            <?php if(isset($table['harga_jual_produk'])) : ?>
                                <th>Harga Jual</th>
                            <?php endif ?>
                            <?php if(isset($table['penjualan'])) : ?>
                                <th>Penjualan</th>
                            <?php endif ?>
                            <?php if(isset($table['qty'])) : ?>
                                <th>Qty</th>
                            <?php endif ?>
                            <?php if(isset($table['harga_beli'])) : ?>
                                <th>Harga Beli</th>
                            <?php endif ?>
                            <?php if(isset($table['harga_jual'])) : ?>
                                <th>Harga Jual</th>
                            <?php endif ?>
                            <?php if(isset($table['total_harga_beli'])) : ?>
                                <th>Total Harga Beli</th>
                            <?php endif ?>
                            <?php if(isset($table['margin_percent'])) : ?>
                                <th>% Margin</th>
                            <?php endif ?>
                            <?php if(isset($table['margin'])) : ?>
                                <th>Margin</th>
                            <?php endif ?>
                            <?php if(isset($table['total_margin'])) : ?>
                                <th>Total Margin</th>
                            <?php endif ?>
                            <?php if(isset($table['total_nominal_persedian'])) : ?>
                                <th>Total Nominal Persedian</th>
                            <?php endif ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($laporan as $val) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <?php if(isset($table['nama_produk'])) : ?>
                                    <td><?= $val->nama_produk ?></td>
                                <?php endif ?>
                                <?php if(isset($table['saldo_awal'])) : ?>
                                    <td><?= $val->kuantitas_produk ?></td>
                                <?php endif ?>
                                <?php if(isset($table['saldo_akhir'])) : ?>
                                    <td><?= $val->kuantitas_produk + ($val->total_kuantitas_pembelian - ($val->total_kuantitas_penjualan == null ? $val->total_kuantitas_penjualan : 0)) ?></td>
                                <?php endif ?>
                                <?php if(isset($table['golongan'])) : ?>
                                    <td>
                                        <?php if($val->nama_owner == 'RE') : ?>
                                            BD
                                        <?php else : ?>
                                            Konsinyasi
                                        <?php endif ?>
                                    </td>
                                <?php endif ?>
                                <?php if(isset($table['kategori'])) : ?>
                                    <td><?= $val->nama_kategori ?></td>
                                <?php endif ?>
                                <?php if(isset($table['harga_beli_produk'])) : ?>
                                    <td><?= $this->globalModel->format_currentcy($val->harga_beli_produk) ?></td>
                                <?php endif ?>
                                <?php if(isset($table['harga_jual_produk'])) : ?>
                                    <td><?= $this->globalModel->format_currentcy($val->harga_jual_produk) ?></td>
                                <?php endif ?>
                                <?php if(isset($table['penjualan'])) : ?>
                                    <td><?= $this->globalModel->format_currentcy($val->detail_harga_jual * $val->detail_kuantitas) ?></td>
                                <?php endif ?>
                                <?php if(isset($table['qty'])) : ?>
                                    <td><?= $val->detail_kuantitas ?></td>
                                <?php endif ?>
                                <?php if(isset($table['harga_beli'])) : ?>
                                    <td><?= $this->globalModel->format_currentcy($val->detail_harga_beli) ?></td>
                                <?php endif ?>
                                <?php if(isset($table['harga_jual'])) : ?>
                                    <td><?= $this->globalModel->format_currentcy($val->detail_harga_jual) ?></td>
                                <?php endif ?>
                                <?php if(isset($table['total_harga_beli'])) : ?>
                                    <td><?= $this->globalModel->format_currentcy($val->detail_harga_beli * $val->detail_kuantitas) ?></td>
                                <?php endif ?>
                                <?php if(isset($table['margin_percent'])) : ?>
                                    <td><?= $this->globalModel->format_percent(($val->detail_harga_jual - $val->detail_harga_beli) / $val->detail_harga_beli) ?></td>
                                <?php endif ?>
                                <?php if(isset($table['margin'])) : ?>
                                    <td><?= $this->globalModel->format_currentcy(($val->detail_harga_jual - $val->detail_harga_beli) * $val->detail_kuantitas) ?></td>
                                <?php endif ?>
                                <?php if(isset($table['total_margin'])) : ?>
                                    <td><?= $this->globalModel->format_currentcy((($val->detail_harga_jual - $val->detail_harga_beli) / $val->detail_harga_beli) * ($val->detail_harga_jual - $val->detail_harga_beli) * $val->detail_kuantitas) ?></td>
                                <?php endif ?> 
                                <?php if(isset($table['total_nominal_persedian'])) : ?>
                                    <td><?= $this->globalModel->format_currentcy(($val->kuantitas_produk * $val->harga_jual_produk)) ?></td>
                                <?php endif ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>