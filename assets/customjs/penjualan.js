$(function () {
	$(".select2").select2({
		code: false,
		input: true,
		search: true,
		dropdownParent: $("#Modal"),
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

	$("#Modal select[name='produk']").on("change", function () {
		let harga = data_produk.find((x) => x.id == $(this).val()).harga_jual;
		$("#Modal input[name='harga']").val(harga);
	});

	let draf_produk = [];

	$("#Modal input[name='qty']").on("keypress", function (e) {
		if (e.which == 13) {
			if ($("#Modal select[name='produk']").val() != null) {
				let id_produk = $("#Modal select[name='produk']").val();
				let produk = data_produk.find((x) => x.id == id_produk);

				produk = {
					...produk,
					qty: $(this).val(),
				};

				let indexDraf = draf_produk.findIndex((x) => x.id == produk.id);

				if (indexDraf < 0) {
					draf_produk.push(produk);
				} else {
					let finalQty =
						parseInt(draf_produk[indexDraf].qty) + parseInt($(this).val());
					draf_produk[indexDraf]["qty"] = finalQty;
				}

				setDrawDraf(draf_produk);
			}
		}
	});
});

const setDrawDraf = (array) => {
	// View
	let total = 0;
	$("#produk-list-draf").empty();
	$.each(array, function (i, row) {
		total += row.harga_jual * row.qty;
		let view =
			"<tr>" +
			"<td>" +
			row.nama +
			"</td>" +
			"<td>" +
			row.harga_jual +
			"</td>" +
			"<td>" +
			row.qty +
			"</td>" +
			"<td>" +
			row.harga_jual * row.qty +
			"</td>" +
			'<td><span class="badge cursor-pointer p-2"><i class="fa fa-trash"></i></span></td>' +
			"</tr>";
		$("#produk-list-draf").prepend(view);
	});

	let view =
		'<tr><th colspan="3">Total</th><th colspan="2">' + total + "</th></tr>";
	$("#produk-list-draf").append(view);
};

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

	// $("#form-item").attr("action", base_url + "Produk/create");
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

	// $("#form-item").attr("action", base_url + "Produk/update");
};
