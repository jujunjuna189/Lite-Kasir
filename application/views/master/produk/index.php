<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="float-left">
                    <h3 class="card-title">DataTable with default features</h3>
                </div>
                <div class="float-right">
                    <button class="btn btn-primary" id="btn-create" onclick="create()"><i class="fa fa-plus mr-2"></i>Create</button>
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
                            <th></th>
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
                                <td>
                                    <span class="badge badge-warning py-2 cursor-pointer" onclick="update('<?= $val->id ?>')"><i class="fas fa-pen"></i> Update</span>
                                    <a href="#" class="badge badge-danger py-2"><i class="fas fa-trash"></i> Delete</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!--Modal-->
<form name="form" action="" method="post" enctype="multipart/form-data" accept-charset="UTF-8" id="form-item">
    <div id="Modal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="text-align:center">
                    <h5 id="modal-header"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id">
                    <div id="modal-body-update-or-create">
                        <div class="form-group">
                            <small><strong>Nama Produk</strong></small>
                            <input type="text" name="nama" class="form-control" required placeholder="Nama Produk">
                        </div>
                        <div class="form-group">
                            <small><strong>Kuantitas</strong></small>
                            <input type="number" name="kuantitas" class="form-control" required placeholder="Kuantitas">
                        </div>
                        <div class="form-group">
                            <small><strong>Harga Beli</strong></small>
                            <input type="text" name="harga_beli" class="form-control" required placeholder="Harga Beli">
                        </div>
                        <div class="form-group">
                            <small><strong>Harga Jual</strong></small>
                            <input type="text" name="harga_jual" class="form-control" required placeholder="Harga Jual">
                        </div>
                        <div class="form-group">
                            <small><strong>Owner</strong></small>
                            <select name="id_owner" id="id_owner" class="form-control" required>
                                <option value="" selected disabled>-- Pilih Owner --</option>
                                <?php foreach ($owner as $val) { ?>
                                    <option value="<?= $val->id ?>"><?= $val->nama_owner ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-hidden="true">Close</button>
                    <button type="submit" class="btn btn-primary" id="modal-button">Create</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!--Modal-->

<!-- Data send to javascript -->
<script>
    let data_produk = <?= json_encode($produk) ?>;
</script>