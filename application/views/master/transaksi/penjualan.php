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
                            <th>Customer</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Total Bayar</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($transaksi as $val) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $val->nama_customer ?></td>
                                <td><?= date('d-M-Y', strtotime($val->waktu)) ?></td>
                                <td><?= date('h:i:s', strtotime($val->waktu)) ?></td>
                                <td><?= $val->total_bayar ?></td>
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
<form name="form" action="" method="post" enctype="multipart/form-data" onsubmit="form_on_submit(event)" accept-charset="UTF-8" id="form-item">
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
                            <small><strong>Customer</strong></small>
                            <select class="form-control select2" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                <option selected="selected" data-select2-id="3">Alabama</option>
                                <option data-select2-id="34">Alaska</option>
                                <option data-select2-id="35">California</option>
                                <option data-select2-id="36">Delaware</option>
                                <option data-select2-id="37">Tennessee</option>
                                <option data-select2-id="38">Texas</option>
                                <option data-select2-id="39">Washington</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <small><strong>Produk</strong></small>
                            <select name="produk" id="produk" class="form-control">
                                <?php foreach($produk as $val){ ?>
                                <option value="<?= $val->id ?>"><?= $val->nama ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <small><strong>Harga</strong></small>
                            <input type="number" name="harga" class="form-control" required placeholder="Harga...">
                        </div>
                        <div class="form-group">
                            <small><strong>Qty</strong></small>
                            <input type="number" name="qty" onchange="on_key_down()" class="form-control" required placeholder="Qty...">
                        </div>
                        <div class="form-group">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Produk</th>
                                        <th>Harga</th>
                                        <th>Qty</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><span class="badge cursor-pointer p-2"><i class="fa fa-trash"></i></span></td>
                                    </tr>
                                </tbody>
                            </table>
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
    let data_transaksi = <?= json_encode($transaksi) ?>;
</script>