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
		var id_owner = $(this).data("id_owner");

		$('[name="id"]').val(id);
		$('[name="nama"]').val(nama);
		$('[name="kuantitas"]').val(kuantitas);
		$('[name="harga_jual"]').val(harga_jual);
		$('[name="harga_beli"]').val(harga_beli);
		$('[name="id_owner"]').val(id_owner);

		document.form.action = "<?php echo base_url(); ?>Kasir/Create1";
	});

	$(document).on("click", "#btn-delete", function () {
		$("#Modal").modal("show");
		$("#modal-button").html("Delete");
		$("#modal-button").removeClass("btn-success");
		$("#modal-button").addClass("btn-danger");
		$("#modal-body-update-or-create").addClass("hidden");
		$("#modal-body-delete").removeClass("hidden");
		$("#modal-header").html('<i class="fa fa-trash"></i> Delete');

		var id = $(this).data("id");
		var nama = $(this).data("nama");

		$('[name="id"]').val(id);
		$("#name-delete").html(text);

		document.form.action = "<?php echo base_url(); ?>Crud/Delete1";
	});
});

const remove_color_btn = () => {
	$("#modal-button").removeClass("btn-danger");
	$("#modal-button").removeClass("btn-primary");
	$("#modal-button").removeClass("btn-warning");
};

const create = () => {
	$("#Modal").modal("show");

	$("#modal-header").html('<i class="fa fa-plus mr-2"></i> Create');
	$("#modal-body-update-or-create").removeClass("hidden");
	$('[name="img"]').addClass("hidden");
	$("#modal-body-delete").addClass("hidden");
	$("#modal-button").html("Create");
	remove_color_btn();
	$("#modal-button").addClass("btn-primary");

	$("#form-item").attr("action", base_url + "Produk/create");
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

	let data = data_produk.find((x) => x.id == id);

	var id = data.id;
	var nama = data.nama;
	var kuantitas = data.kuantitas;
	var harga_beli = data.harga_beli;
	var harga_jual = data.harga_jual;
	var id_owner = data.id_owner;

	$('[name="id"]').val(id);
	$('[name="nama"]').val(nama);
	$('[name="kuantitas"]').val(kuantitas);
	$('[name="harga_beli"]').val(harga_beli);
	$('[name="harga_jual"]').val(harga_jual);
	$('[name="id_owner"]').val(id_owner);

	document.form.action = "<?php echo base_url(); ?>Kasir/Create1";
};
