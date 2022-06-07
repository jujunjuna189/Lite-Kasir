let draf_produk = [];
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
			'<td><span class="badge cursor-pointer p-2" onclick="remove_draf(\'' +
			row.id +
			'\')"><i class="fa fa-trash"></i></span></td>' +
			"</tr>";
		$("#produk-list-draf").prepend(view);
	});

	let view =
		'<tr><th colspan="3">Total</th><th colspan="2">' + total + "</th></tr>";
	$("#produk-list-draf").append(view);
};

const remove_draf = (id) => {
	let filterDraf = draf_produk.filter((x) => x.id != id);
	draf_produk = filterDraf;
	setDrawDraf(draf_produk);
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

const getDataForm = () => {
	var id_supplier = $('[name="supplier"]').select2().val();
	var date = new Date();
	var dateNow =
		date.getFullYear() +
		"-" +
		setZeroNumber(date.getMonth() + 1) +
		"-" +
		setZeroNumber(date.getDate()) +
		" " +
		date.getHours() +
		":" +
		date.getMinutes() +
		":" +
		date.getSeconds();
	var nama_supplier = data_supplier.find(
		(x) => x.id == id_supplier
	).nama_supplier;

	var total_bayar = 0;
	$.each(draf_produk, function (i, row) {
		total_bayar =
			parseInt(row.harga_jual) * parseInt(row.qty) + parseInt(total_bayar);
	});

	let data = {
		id_supplier: id_supplier,
		nama_supplier: nama_supplier,
		total_bayar: total_bayar,
		waktu: dateNow,
		data_produk: draf_produk,
	};

	return data;
};

const create = () => {
	$("#Modal").modal("show");

	$('[name="id"]').val("");
	$('[name="supplier"]').select2().val("").trigger("change.select2");
	$('[name="produk"]').select2().val("").trigger("change.select2");
	$('[name="harga"]').val("");
	$('[name="qty"]').val("");

	$("#modal-header").html('<i class="fa fa-plus mr-2"></i> Create');
	$("#modal-body-update-or-create").removeClass("hidden");
	$("#modal-body-delete").addClass("hidden");
	$("#modal-button").html("Create");
	remove_color_btn();
	$("#modal-button").addClass("btn-primary");

	$("#Modal #modal-event").attr("onclick", "upload(event)");
};

const upload = (e) => {
	e.preventDefault();
	let dataUpload = getDataForm();

	let supplier = $('[name="supplier"]').val();
	let produk = $('[name="produk"]').val();
	let qty = $('[name="qty"]').val();

	// Validasi
	if (supplier != "" && produk != "" && qty != "") {
		$.ajax({
			url: base_url + "Transaksi/create_pembelian",
			type: "POST",
			dataType: "json",
			data: {
				data: dataUpload,
			},
			success: function (response) {
				location.reload();
			},
			error: function (response) {
				console.log(response);
			},
		});
	} else {
		alert("Cek data kembali");
	}
};

const update = (id) => {
	let modalParent = "#Modal";
	$(modalParent).modal("show");

	$(modalParent + " #modal-header").html('<i class="fa fa-pen"></i> Update');
	$(modalParent + " #modal-body-update-or-create").removeClass("hidden");
	$(modalParent + ' [name="img"]').removeClass("hidden");
	$(modalParent + " #modal-body-delete").addClass("hidden");
	$(modalParent + " #modal-button").html("Update");
	remove_color_btn();
	$(modalParent + " #modal-button").addClass("btn-warning");

	let data = data_transaksi.find((x) => x.id == id);

	var id = data.id;
	var id_supplier = data.id_supplier;

	$('[name="id"]').val(id);
	$('[name="supplier"]').select2().val(id_supplier).trigger("change.select2");

	// $("#form-item").attr("action", base_url + "Produk/update");
};

const delete_ = (id) => {
	$("#Modal-delete").modal("show");
	$("#Modal-delete .modal-header").html("Hapus Data");
	$("#Modal-delete .modal-body").html(
		"Apakah anda yakin ingin mangahapus data ini ?"
	);
	$("#Modal-delete #modal-button").addClass("btn-danger");
	$("#Modal-delete #modal-button").html("Hapus");

	$("#form-delete").attr(
		"action",
		base_url + "Transaksi/delete_pembelian?id=" + id
	);
};
