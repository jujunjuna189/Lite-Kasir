$(function () {
	$("#example1")
		.DataTable({
			responsive: true,
			lengthChange: false,
			autoWidth: false,
			buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
		})
		.buttons()
		.container()
		.appendTo("#example1_wrapper .col-md-6:eq(0)");
});
// Data table end....

// Page script

$(document).ready(function () {
	var myTable = $("#table").DataTable({});

	$(document).on("click", "#btn-update", function () {
		$("#Modal").modal("show");

		$("#modal-header").html('<i class="fa fa-pencil"></i> Update');
		$("#modal-body-update-or-create").removeClass("hidden");
		$('[name="img"]').removeClass("hidden");
		$("#modal-body-delete").addClass("hidden");
		$("#modal-button").html("Update");
		$("#modal-button").removeClass("btn-danger");
		$("#modal-button").addClass("btn-success");

		var id = $(this).data("id");
		var nama = $(this).data("nama");
		var kuantitas = $(this).data("kuantitas");
		var harga_jual = $(this).data("harga_jual");
		var harga_beli = $(this).data("harga_beli");
		var id_supplier = $(this).data("id_supplier");

		$('[name="id"]').val(id);
		$('[name="nama"]').val(nama);
		$('[name="kuantitas"]').val(kuantitas);
		$('[name="harga_jual"]').val(harga_jual);
		$('[name="harga_beli"]').val(harga_beli);
		$('[name="id_supplier"]').val(id_supplier);

		document.form.action = "<?php echo base_url(); ?>Kasir/Create1";
	});
});

const remove_color_btn = () => {
	$("#modal-button").removeClass("btn-danger");
	$("#modal-button").removeClass("btn-primary");
	$("#modal-button").removeClass("btn-warning");
};

const create = () => {
	$("#Modal").modal("show");

	$('[name="id"]').val("");
	$('[name="nama_supplier"]').val("");
	$('[name="no_hp"]').val("");

	$("#modal-header").html('<i class="fa fa-plus mr-2"></i> Create');
	$("#modal-body-update-or-create").removeClass("hidden");
	$('[name="img"]').addClass("hidden");
	$("#modal-body-delete").addClass("hidden");
	$("#modal-button").html("Create");
	remove_color_btn();
	$("#modal-button").addClass("btn-primary");

	$("#form-item").attr("action", base_url + "Supplier/create");
};

const update = (id) => {
	$("#Modal").modal("show");

	$("#modal-header").html('<i class="fa fa-pen"></i> Update');
	$("#modal-body-update-or-create").removeClass("hidden");
	$('[name="img"]').removeClass("hidden");
	$("#modal-body-delete").addClass("hidden");
	$("#modal-button").html("Update");
	remove_color_btn();
	$("#modal-button").addClass("btn-warning");

	let data = data_supplier.find((x) => x.id == id);

	var id = data.id;
	var nama_supplier = data.nama_supplier;
	var no_hp = data.no_hp;

	$('[name="id"]').val(id);
	$('[name="nama_supplier"]').val(nama_supplier);
	$('[name="no_hp"]').val(no_hp);

	$("#form-item").attr("action", base_url + "Supplier/update");
};

const delete_ = (id) => {
	$("#Modal-delete").modal("show");
	$("#Modal-delete .modal-header").html("Hapus Data");
	$("#Modal-delete .modal-body").html(
		"Apakah anda yakin ingin mangahapus data ini ?"
	);
	$("#Modal-delete #modal-button").addClass("btn-danger");
	$("#Modal-delete #modal-button").html("Hapus");

	$("#form-delete").attr("action", base_url + "Supplier/delete?id=" + id);
};
