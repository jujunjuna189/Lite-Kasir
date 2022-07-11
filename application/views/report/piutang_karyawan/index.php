<div class="row">
    <div class="col-8">
        <div class="card">
            <div class="card-header">
                <div class="float-left">
                    <h2 class="card-title font-weight-bold"><i class="fa fa-filter"></i> Filter</h2>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="<?= base_url("Laporan/report_transaksi_piutang_karyawan") ?>" method="post">
                    <div class="form-group">
                        <label for="Start Date">Dari</label>
                        <input type="date" name="start_date" id="start_date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="Start Date">Sampai</label>
                        <input type="date" name="end_date" id="end_date" class="form-control">
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-filter"></i> Filter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>