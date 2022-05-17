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
                            <th>Nama Owner</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($owner as $val) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $val->nama_owner ?></td>
                                <td><?= $val->status ?></td>
                                <td>
                                    <span class="badge badge-warning py-2 cursor-pointer" onclick="update('<?= $val->id ?>')"><i class="fas fa-pen"></i> Update</span>
                                    <span class="badge badge-danger py-2 cursor-pointer" onclick="delete_('<?= $val->id ?>')"><i class="fas fa-trash"></i> Delete</span>
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
                            <small><strong>Nama Owner</strong></small>
                            <input type="text" name="nama_owner" class="form-control" required placeholder="Nama Owner">
                        </div>
                        <div class="form-group">
                            <small><strong>Status</strong></small>
                            <input type="text" name="status" class="form-control" required placeholder="Status">
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
<!-- modal delete -->
<form name="form" action="" method="post" enctype="multipart/form-data" accept-charset="UTF-8" id="form-delete">
    <div id="Modal-delete" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="text-align:center">
                    <h5 id="modal-header">Hapus Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id">
                    <div id="modal-body-update-or-create">
                        <h6>Apakah anda yakin ingin menghapus data ini ?</h6>
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
    let data_owner = <?= json_encode($owner) ?>;
</script>