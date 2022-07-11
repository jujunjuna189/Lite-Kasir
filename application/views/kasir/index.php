<!-- BAR CHART -->
<div class="card">
    <div class="card-header">
    <h3 class="card-title">Statistik Penjualan</h3>

    <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
        <i class="fas fa-minus"></i>
        </button>
        <button type="button" class="btn btn-tool" data-card-widget="remove">
        <i class="fas fa-times"></i>
        </button>
    </div>
    </div>
    <div class="card-body">
    <div class="chart">
        <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
    </div>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

<script>
    let penjualan = <?= json_encode($penjualan) ?>;
    let pembelian = <?= json_encode($pembelian) ?>;
    let laba = <?= json_encode($laba) ?>;
</script>