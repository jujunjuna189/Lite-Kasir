    <!-- jQuery -->
    <script src="<?= base_url('assets') ?>/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('assets') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Modal & Alert -->
    <script src="<?= base_url('assets') ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="<?= base_url('assets') ?>/plugins/toastr/toastr.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('assets') ?>/dist/js/adminlte.min.js"></script>
    <!-- Set Toastr -->
    <?php if($this->session->flashdata('flash')){ ?>
    <script>
        toastr.info('<?= $this->session->flashdata('flash')['message'] ?>');
    </script>
    <?php } ?>
</body>
</html>