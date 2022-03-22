$(function () {
	$(".select2").select2({
		code: false,
		input: true,
		search: true,
	});

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
// Data const
let data_invoice = [];
// Page script

const remove_color_btn = () => {
	$("#modal-button").removeClass("btn-danger");
	$("#modal-button").removeClass("btn-primary");
	$("#modal-button").removeClass("btn-warning");
};

const form_on_submit = (e) => {
	e.preventDefault();
	console.log("Ok");
};

const on_key_down = () => {
	console.log("Ok Key Down");
};

const create = () => {
	$("#Modal").modal("show");

	$('[name="id"]').val("");
	$('[name="nama"]').val("");
	$('[name="kuantitas"]').val("");
	$('[name="harga_beli"]').val("");
	$('[name="harga_jual"]').val("");
	$('[name="id_owner"]').val("");

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

	$("#form-item").attr("action", base_url + "Produk/update");
};
