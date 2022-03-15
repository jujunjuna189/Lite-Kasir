<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="float-left">
                    <h3 class="card-title">DataTable with default features</h3>
                </div>
                <div class="float-right">
                    <button class="btn btn-primary" id="btn-create" onclick="#"><i class="fa fa-plus mr-2"></i>Create</button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Nama Produk</th>
                            <th>Kuantitas</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Margin</th>
                            <th>Owner</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($produk as $val) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $val->nama ?></td>
                                <td><?= $val->kuantitas ?></td>
                                <td><?= $this->globalModel->format_currentcy($val->harga_beli) ?></td>
                                <td><?= $this->globalModel->format_currentcy($val->harga_jual) ?></td>
                                <td><?= $this->globalModel->format_currentcy(($val->harga_jual - $val->harga_beli)) ?></td>
                                <td><?= $this->models->Get_Where(['id' => $val->id_owner], 'owner')[0]->nama_owner ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>