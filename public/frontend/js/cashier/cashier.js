/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 73);
/******/ })
/************************************************************************/
/******/ ({

/***/ 73:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(74);


/***/ }),

/***/ 74:
/***/ (function(module, exports, __webpack_require__) {

var storeId = $('#config').attr('storeId');
var rootPath = $('#config').attr('rootPath');

var Customer2Order = $('#config').attr('Customer2Order');
var WaiterToWaiterChannel = $('#config').attr('WaiterToWaiterChannel');

var Order2Kitchen = $('#config').attr('Order2Kitchen');
var Order2Cashier = $('#config').attr('Order2Cashier');
var Order2Other = $('#config').attr('Order2Other');

var paymentAll = [];

Storage.prototype.setObj = function (key, obj) {
	return this.setItem(key, JSON.stringify(obj));
};
Storage.prototype.getObj = function (key) {
	var data = this.getItem(key);
	console.log(data);
	if (data) {
		if (data.indexOf(',,') == -1) return JSON.parse(data);else {
			data = String(data).replace(/,/g, '').slice(0, -15).replace(/""/g, '","').replace(/}{/g, '},{');
			return JSON.parse(data);
		}
	} else return;
};

/*let newObj = {
	storeId: "1",
	orderId: "39"
}

RemoveDataFromLocalStorage(newObj)

var test456 = localStorage.getItem('cashierRollback')
// test456 = String(test456).replace(/,/g, '').slice(0, -15).replace(/""/g, '","')
console.log(test456)*/

$(document).ready(function () {
	$("#header-left a").click(function () {
		$(this).tab('show');
	});

	loadCashierTable();
	loadRollbackTable();
});

function loadJSON(file, callback) {

	var xobj = new XMLHttpRequest();
	xobj.overrideMimeType("application/json");
	xobj.open('GET', file, true); // Replace 'my_data' with the path to your file
	xobj.onreadystatechange = function () {
		if (xobj.readyState == 4 && xobj.status == "200") {
			// Required use of an anonymous callback as .open will NOT return a value but simply returns undefined in asynchronous mode
			callback(xobj.responseText);
		}
	};
	xobj.send(null);
}

function loadRollbackTable() {
	loadJSON(rootPath + '/api/v1/store/' + storeId + '/rollback_cashier.json', function (response) {
		var output = '<table id="roll-back" class="table table-hover red-blue-table"> <thead> <tr> <th class="sticky" style="width: 70%" data-field="invoice">Hóa đơn</th> <th class="sticky" style="width: 30%"></th> </tr> </thead> <tbody id="rollback-body">';
		var result = JSON.parse(response);
		console.log(result);
		for (var i in result) {
			var orderId = result[i].order_id;
			var beforeStatus = result[i].before_status;
			output += '<tr id="rollback-' + storeId + '-' + orderId + '" orderId="' + orderId + '" status="' + beforeStatus + '"> <td> <button type="button" class="btn btn-primary">#HĐ ' + orderId + '</button> </td> <td> <button class="btn btn-success rollback"><i class="fa fa-undo"></i></button> </td> </tr>';
		}
		output += '</tbody> <tfoot></tfoot> </table>';
		$('#rollback-thanh-toan').html(output);
	});
}

/*function loadRollbackTable() {
	var output='<table id="roll-back" class="table table-hover red-blue-table"> <thead> <tr> <th style="width: 40%" data-field="invoice">Hóa đơn</th> <th style="width: 30%" data-field="location">Bàn</th> <th style="width: 30%"></th> </tr> </thead> <tbody id="rollback-body">'
	let cashierRollback = localStorage.getObj('cashierRollback')
	if (cashierRollback!= null) {
		let a = cashierRollback
		for (var i=a.length-1;i>=0;i--) {
			if (a[i]) output+='<tr id="rollback-'+storeId+'-'+a[i].orderId+'" orderId="'+a[i].orderId+'"> <td> <button type="button" class="btn btn-primary">#HĐ '+a[i].orderId+'</button> </td> <td> <button type="button" class="btn btn-primary">'+a[i].locationName+'</button> </td> <td> <button class="btn btn-success rollback"><i class="fa fa-undo"></i></button> </td> </tr>'
		}
}
output+='</tbody> <tfoot></tfoot> </table>'
$('#rollback-thanh-toan').html(output)
}*/

/*function pushToloadRollbackTable(obj) {
	let cashierRollback = localStorage.getItem("cashierRollback")
	cashierRollback = [...cashierRollback, obj]
	localStorage.setItem("cashierRollback", cashierRollback)
	var current = $('#rollback-body').html()
	var newRow = '<tr id="rollback-'+storeId+'-'+obj.orderId+'"> <td> <button type="button" class="btn btn-primary">#HĐ '+obj.orderId+'</button> </td> <td> <button type="button" class="btn btn-primary">'+obj.locationName+'</button> </td> <td> <button class="btn btn-success"><i class="fa fa-undo rollback"></i></button> </td> </tr>'
	current = current + newRow
	$('#rollback-body').html(current)
}*/

function pushToloadRollbackTable(obj) {
	var current = $('#rollback-body').html();
	var newRow = '<tr id="rollback-' + storeId + '-' + obj.orderId + '" orderId="' + obj.orderId + '" status="' + obj.status + '"> <td> <button type="button" class="btn btn-primary">#HĐ ' + obj.orderId + '</button> </td> <td> <button class="btn btn-success rollback"><i class="fa fa-undo"></i></button> </td> </tr>';
	current = current + newRow;
	$('#rollback-body').html(current);
}

function loadCashierTable() {
	loadJSON(rootPath + '/api/v1/store/' + storeId + '/cashier.json', function (response) {
		var output = '<table id="bang-thu-ngan" class="table table-hover red-blue-table" data-toggle="table" data-search="true" responsive hover> <thead> <tr> <th style="width: 5%"></th> <th style="width: 10%">Hóa đơn</th> <th style="width: 20%">Vị trí</th> <th style="width: 10%">Tổng tiền</th> <th style="width: 10%">Thuế suất</th> <th style="width: 15%">Chiết khấu</th> <th style="width: 15%">Thành tiền</th> <th style="width: 15%"></th> </tr> </thead> <tbody>';
		var result = JSON.parse(response);
		for (var i in result.orders) {
			var id = result.orders[i].id;
			var name = result.orders[i].location;
			var floor = result.orders[i].floor;
			var sum = result.orders[i].sum;
			var status = result.orders[i].status;
			var locationFee = result.orders[i].locationFee;
			var total = parseInt(sum) + parseInt(locationFee);
			output += '<tr id="order-' + storeId + '-' + id + '" status="' + status + '" orderId="' + id + '" location="' + name + '" tax="10" discount="0" total="' + total + '" payment="' + sum * 1.1 + '"> <td><input class="checkbox" type="checkbox" value="#HĐ ' + id + '"></td> <td>#HĐ ' + id + '</td> <td> <button type="button" class="btn btn-primary"> <span class="badge badge-secondary">' + name + ' ' + floor + '</span></button> </td> <td class="money">' + parseInt(total).toLocaleString('us') + '</td> <td><input class="tax" type="number" value="10" min="0"></td> <td><input class="discount" type="number" value="0" min="0"></td> <td class="total">' + (total * 1.1).toLocaleString('us') + '</td> <td> <button class="btn btn-success" data-toggle="modal" data-target="#hd' + id + '"><i class="fa fa-eye"></i></button> </td> </tr>';
		}
		output += "</tbody> <tfoot></tfoot> </table>";
		$('#thu-ngan').html(output);
		output = '';
		for (var i in result.orders) {
			var orderId = result.orders[i].id;
			var locationFee = result.orders[i].locationFee;
			locationFee = parseInt(locationFee);
			var sum = result.orders[i].sum;
			sum = parseInt(sum);
			var tax = 10;
			var discount = 0;
			var status = result.orders[i].status;
			output += '<div class="modal fade" id="hd' + orderId + '" role="dialog"> <div class="modal-dialog"> <div class="modal-content">';
			output += '<table id="modal-' + orderId + '" storeId="' + storeId + '" orderId="' + orderId + '" status="' + status + '" class="table table-hover red-blue-table" data-toggle="table" style="margin-top: 10px;"> <thead> <tr> <th style="width: 55%">Tên món</th> <th style="width: 10%">Đơn giá</th> <th style="width: 15%">Số lượng</th> <th style="width: 20%">Thành tiền</th> </tr> </thead> <tbody>';
			for (var j in result.details[i]) {
				var foodId = result.details[i][j].id;
				var name = result.details[i][j].name;
				var price = result.details[i][j].price;
				price = parseInt(price);
				var quantity = result.details[i][j].quantity;
				var total = result.details[i][j].total;
				total = parseInt(total);
				output += '<tr> <td class="food">' + name + '</td> <td>' + price.toLocaleString('us') + '</td> <td>' + quantity + '</td> <td>' + total.toLocaleString('us') + '</td> </tr>';
			}
			output += '</tbody> <tfoot>';
			output += '<tr> <td colspan="2"></td> <td class="ta-right"> Phụ phí: </td> <td>' + locationFee.toLocaleString('us') + '</td> </tr>';
			output += '<tr> <td colspan="2"></td> <td class="ta-right"> Tổng tiền: </td> <td>' + (sum + locationFee).toLocaleString('us') + '</td> </tr>';
			output += '<tr class="tax"> <td colspan="2"></td> <td class="ta-right"> Thuế: </td> <td>' + tax + '</td> </tr>';
			output += '<tr class="discount"> <td colspan="2"></td> <td class="ta-right"> Chiết khấu: </td> <td>' + discount + '</td> </tr>';
			output += '<tr class="total"> <td colspan="2"></td> <td class="ta-right"> Thành tiền: </td> <td>' + ((sum + locationFee) * 1.1).toLocaleString('us') + '</td> </tr>';
			output += '<tr> <td colspan="4"> <div class="col-xs-12"> <div class="panel-group"> <div class=""> <div> <div class="btn-group pull-left"> <button class="btn btn-primary btn-lg pdf">In hóa đơn</button> </div> <div class="btn-group pull-center"> <button class="btn btn-primary btn-lg payment">Thanh toán: ' + ((sum + locationFee) * 1.1).toLocaleString('us') + '</button> </div> <div class="btn-group pull-right"> <button class="btn btn-primary btn-lg excel">Xuất ra Excel</button> </div> </div> </div> </div> </div> </td> </tr>';
			output += '</tfoot></table>';
			output += '</div> </div> </div>';
		}
		$('#invoices-details').html(output);
	});
}

/*function loadCustomer2CashierTable() {
	loadJSON('http://store.dev/api/v1/store/'+storeId+'/customer2cashier.json', function(response) {
		var output='<table id="bang-khach-yeu-cau-thanh-toan" status="3" class="table table-hover red-blue-table" data-toggle="table" data-search="true" responsive hover> <thead> <tr> <th style="width: 5%"></th> <th style="width: 10%">Hóa đơn</th> <th style="width: 20%">Vị trí</th> <th style="width: 10%">Tổng tiền</th> <th style="width: 10%">Thuế suất</th> <th style="width: 15%">Chiết khấu</th> <th style="width: 15%">Thành tiền</th> <th style="width: 15%"></th> </tr> </thead> <tbody>';
		var result = JSON.parse(response);
		for (var i in result.orders)
		{
			var id = result.orders[i].id
			var name = result.orders[i].location
			var sum = result.orders[i].sum
			var locationFee = result.orders[i].locationFee
			var total = parseInt(sum) + parseInt(locationFee)
			output+='<tr id="order-'+storeId+'-'+id+'" storeId="'+storeId+'" orderId="'+id+'" location="'+name+'" tax="10" discount="0" total="'+sum+'" payment="'+(sum*1.1)+'"> <td><input class="checkbox" type="checkbox" value="#HĐ '+id+'"></td> <td>#HĐ '+id+'</td> <td> <button type="button" class="btn btn-primary"> <span class="badge badge-secondary">'+name+'</span></button> </td> <td class="money">'+parseInt(total).toLocaleString('us')+'</td> <td><input class="tax" type="number" value="10" min="0"></td> <td><input class="discount" type="number" value="0" min="0"></td> <td class="total">'+(total*1.1).toLocaleString('us')+'</td> <td> <button class="btn btn-success" data-toggle="modal" data-target="#hd'+id+'"><i class="fa fa-eye"></i></button> </td> </tr>'
		}
		output+="</tbody> <tfoot></tfoot> </table>"
		$('#khach-thanh-toan').html(output)
		output=''
		for (var i in result.details)
		{
			var orderId = result.orders[i].id
			var locationFee = result.orders[i].locationFee
			locationFee = parseInt(locationFee)
			var sum = result.orders[i].sum
			sum = parseInt(sum)
			var tax = 10
			var discount = 0
			output+='<div class="modal fade" id="hd'+orderId+'" role="dialog"> <div class="modal-dialog"> <div class="modal-content">'
			output+= '<table orderId="'+orderId+'" status="3" class="table table-hover red-blue-table" data-toggle="table" style="margin-top: 10px;"> <thead> <tr> <th style="width: 55%">Tên món</th> <th style="width: 10%">Đơn giá</th> <th style="width: 15%">Số lượng</th> <th style="width: 20%">Thành tiền</th> </tr> </thead> <tbody>'
			for (var j in result.details[i]) {
				var foodId = result.details[i][j].id
				var name = result.details[i][j].name
				var price = result.details[i][j].price
				price = parseInt(price)
				var quantity = result.details[i][j].quantity
				var total = result.details[i][j].total
				total = parseInt(total)
				output+='<tr> <td class="food">'+name+'</td> <td>'+price.toLocaleString('us')+'</td> <td>'+quantity+'</td> <td>'+total.toLocaleString('us')+'</td> </tr>'
			}
			output+='</tbody> <tfoot>'
			output+='<tr> <td colspan="2"></td> <td class="ta-right"> Phụ phí: </td> <td>'+locationFee.toLocaleString('us')+'</td> </tr>'
			output+='<tr> <td colspan="2"></td> <td class="ta-right"> Tổng tiền: </td> <td>'+(sum+locationFee).toLocaleString('us')+'</td> </tr>'
			output+='<tr class="tax"> <td colspan="2"></td> <td class="ta-right"> Thuế: </td> <td>'+tax+'</td> </tr>'
			output+='<tr class="discount"> <td colspan="2"></td> <td class="ta-right"> Chiết khấu: </td> <td>'+discount+'</td> </tr>'
			output+='<tr class="total"> <td colspan="2"></td> <td class="ta-right"> Thành tiền: </td> <td>'+((sum+locationFee)*1.1).toLocaleString('us')+'</td> </tr>'
			output+='<tr> <td colspan="4"> <div class="col-xs-12"> <div class="panel-group"> <div class=""> <div> <div class="btn-group pull-left"> <button class="btn btn-primary btn-lg">In hóa đơn</button> </div> <div class="btn-group pull-center"> <button class="btn btn-primary btn-lg payment">Thanh toán: '+((sum+locationFee)*1.1).toLocaleString('us')+'</button> </div> <div class="btn-group pull-right"> <button class="btn btn-primary btn-lg">Xuất ra Excel</button> </div> </div> </div> </div> </div> </td> </tr>'
			output+='</tfoot></table>'
			output+= '</div> </div> </div>'
		}
		$('#invoices-details-2').html(output)
	})
}*/

document.getElementById("search").addEventListener("keyup", searchFor);
function searchFor() {
	var input,
	    filter,
	    table,
	    tr,
	    td,
	    i,
	    cl = false;
	input = document.getElementById("search");
	filter = input.value.toUpperCase();
	cl = filter ? true : false;
	table = document.getElementById("bang-thu-ngan");
	tr = table.getElementsByTagName("tr");
	for (i = 0; i < tr.length; i++) {
		td = tr[i].getElementsByTagName("td")[2];
		if (td) {
			if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
				tr[i].style.display = "";
			} else {
				tr[i].style.display = "none";
			}
		}
	}
	if (!cl) {
		$('.t-header-child').nextUntil('.t-header').slideToggle(0, function () {});
	}
}

/*$("#khach-thanh-toan").on('click','.checkbox',function(){

	var isChecked = $(this).prop('checked');

	var currentTotal = $("#payment-right").text();
	var currentInvoices = $("#invoice-id").text();
	var currentRow=$(this).closest("tr");

	if (currentInvoices) var invoices = currentInvoices.split(",");
	else var invoices = [];

	// var col1=currentRow.find("td:eq(1)").text();
	var col1 = currentRow.attr('orderId')
	var newValue = currentRow.attr('status')

	var col2=currentRow.find("td:eq(6)").text();
	var data=col1+"\n"+col2+"\n";

	if (isChecked) {
		invoices.push(col1);
		
		if (!currentTotal) currentTotal=parseInt(col2.replace(/,/g, ''));
		else currentTotal = parseInt(currentTotal.replace(/,/g, '')) +
			parseInt(col2.replace(/,/g, ''));

	} else {
		
		var index = invoices.indexOf(col1);
		if (index > -1) {
			invoices.splice( index, 1 );
		}
		currentTotal = parseInt(currentTotal.split(',').join('')) -
		parseInt(col2.split(',').join(''));
	}
	$("#invoice-id").text(invoices.toString());
	$("#payment-right").text(currentTotal.toLocaleString('us'));
})*/

$("#thu-ngan").on('click', '.checkbox', function () {

	var isChecked = $(this).prop('checked');

	var currentTotal = $("#payment-right").text();
	var currentInvoices = $("#invoice-id").text();
	var currentRow = $(this).closest("tr");

	if (currentInvoices) var invoices = currentInvoices.split(",");else var invoices = [];

	/*var col1=currentRow.find("td:eq(1)").text();*/
	var status = currentRow.attr('status');
	var col1 = currentRow.attr('orderId');
	var col2 = currentRow.find("td:eq(6)").text();
	var data = col1 + "\n" + col2 + "\n";

	var newData = {
		orderId: col1,
		status: status
	};

	if (isChecked) {
		paymentAll.push(newData);
		invoices.push(col1);
		console.log(paymentAll);
		status = $(this).parents("table").attr('status');
		if (!currentTotal) currentTotal = parseInt(col2.replace(/,/g, ''));else currentTotal = parseInt(currentTotal.replace(/,/g, '')) + parseInt(col2.replace(/,/g, ''));
	} else {
		var index2 = paymentAll.findIndex(function (x) {
			return x.order_id === col1;
		});
		if (index2 !== undefined) paymentAll.splice(index2, 1);
		console.log(paymentAll);
		var index = invoices.indexOf(col1);
		if (index > -1) {
			invoices.splice(index, 1);
		}
		currentTotal = parseInt(currentTotal.split(',').join('')) - parseInt(col2.split(',').join(''));
	}
	$("#invoice-id").text(invoices.toString());
	$("#invoice-id-status").text(status);
	$("#payment-right").text(currentTotal.toLocaleString('us'));
});

$(document).on("change", ".tax", function (e) {
	var tax = this.value;
	$(this).parents('tr').attr('tax', tax);
	var orderId = $(this).parents('tr').attr('orderId');
	$('#hd' + orderId + ' table tr.tax').find("td:eq(2)").text(tax);
	var discount = $(this).parents('tr').attr('discount');
	var total = $(this).parents('tr').attr('total');
	total = parseInt(total);
	tax = parseInt(tax);
	discount = parseInt(discount);
	total = total + total * (tax - discount) / 100;
	total = total.toLocaleString('us');
	$(this).parents('tr').attr('payment', total);
	$('#hd' + orderId + ' table tr.total').find("td:eq(2)").text(total);
	$('#hd' + orderId + ' table button.payment').find("td:eq(2)").text(total);
	$(this).parents('tr').children('.total').text(total);
});

$(document).on("change", ".discount", function (e) {
	var discount = this.value;
	$(this).parents('tr').attr('discount', discount);
	var orderId = $(this).parents('tr').attr('orderId');
	$('#hd' + orderId + ' table tr.discount').find("td:eq(2)").text(discount);
	var tax = $(this).parents('tr').attr('tax');
	var total = $(this).parents('tr').attr('total');
	total = parseInt(total);
	tax = parseInt(tax);
	discount = parseInt(discount);
	total = total + total * (tax - discount) / 100;
	total = total.toLocaleString('us');
	$(this).parents('tr').attr('payment', total);
	$('#hd' + orderId + ' table tr.total').find("td:eq(2)").text(total);
	$('#hd' + orderId + ' table button.payment').find("td:eq(2)").text(total);
	$(this).parents('tr').children('.total').text(total);
});

$(document).on("click", ".payment", function (e) {
	var listOrderId = [];
	var status = $(this).parents('table').attr('status');
	var orderId = $(this).parents('table').attr('orderId');
	listOrderId.push(orderId);
	var formData = {
		storeId: storeId,
		listOrderId: listOrderId,
		beforeStatus: status
	};

	$('#hd' + orderId).modal('toggle');

	$.ajax({
		type: 'POST',
		url: rootPath + '/payment-done',
		data: formData
	}).done(function (result) {
		console.log(result);
	}).fail(function () {
		console.log('false');
	});
});

$(document).on("click", "#thanh-toan-tat-ca", function (e) {
	for (var i in paymentAll) {
		var currentInvoices = paymentAll[i].orderId;
		var status = paymentAll[i].status;
		currentInvoices = JSON.parse('[' + currentInvoices + ']');
		var formData = {
			storeId: storeId,
			listOrderId: currentInvoices,
			beforeStatus: status
		};
		console.log(formData);
		$.ajax({
			type: 'POST',
			url: rootPath + '/payment-done',
			data: formData
		}).done(function (result) {
			console.log(result);
			$('#payment-right').html('');
			$('#invoice-id').html('');
		}).fail(function () {
			console.log('false');
		});
	}
	paymentAll = [];
});

$(document).on("click", "#in-tat-ca", function (e) {
	$('#multi-payments').removeClass('hidden');
	var currentInvoices = $('#invoice-id').text();
	currentInvoices = JSON.parse('[' + currentInvoices + ']');
	var formData = {
		storeId: storeId,
		listOrderId: currentInvoices
	};
	console.log(formData);
	$.ajax({
		type: 'POST',
		url: rootPath + '/api/v1/all-payments',
		data: formData
	}).done(function (result) {
		console.log(result);
		var output = '<table id="multi-payment" class="table table-hover red-blue-table" data-toggle="table" style="margin-top: 10px;"> <thead> <tr> <th>Tên</th> <th>Giá</th> <th>SL</th> <th>Thành tiền</th> </tr> </thead> <tbody>';
		var sum = 0;
		for (var i in result.details) {
			var foodId = result.details[i].id;
			var name = result.details[i].name;
			var price = result.details[i].price;
			price = parseInt(price) / 1000;
			var quantity = result.details[i].quantity;
			var total = quantity * price;
			total = parseInt(total);
			sum += total;
			output += '<tr> <td class="food">' + name + '</td> <td>' + price.toLocaleString('us') + '</td> <td>' + quantity + '</td> <td>' + total.toLocaleString('us') + '</td> </tr>';
		}
		sum = sum;
		var locationFee = result.locationFee[0].locationFee;
		locationFee = parseInt(locationFee) / 1000;
		var thanhTien = $('#payment-right').text().replace(',', '');
		thanhTien = parseInt(thanhTien) / 1000;
		output += '</tbody> <tfoot>';
		output += '<tr> <td colspan="2"></td> <td class="ta-right"> Phụ phí: </td> <td>' + locationFee.toLocaleString('us') + '</td> </tr>';
		output += '<tr> <td colspan="2"></td> <td class="ta-right"> Tổng tiền: </td> <td>' + (sum + locationFee).toLocaleString('us') + '</td> </tr>';
		output += '<tr class="total"> <td colspan="2"></td> <td class="ta-right"> Thành tiền: </td> <td>' + thanhTien.toLocaleString('us') + '</td> </tr>';
		output += '</tfoot></table>';
		$('#multi-payments').html(output);
		html2canvas($('#multi-payment')[0], {
			onrendered: function onrendered(canvas) {
				var data = canvas.toDataURL();
				var docDefinition = {
					content: [{
						image: data,
						width: 500
					}]
				};
				pdfMake.createPdf(docDefinition).download("Invoice.pdf");
				$('#multi-payments').addClass('hidden');
			}
		});
	}).fail(function () {
		console.log('false');
	});
});

$(document).on("click", ".excel", function (e) {

	var orderId = $(this).parents('table').attr('orderId');
	var ExportButtons = document.getElementById('modal-' + orderId);
	var instance = new TableExport(ExportButtons, {
		formats: ['xlsx'],
		exportButtons: false
	});
	var exportData = instance.getExportData()['modal-' + orderId]['xlsx'];
	instance.export2file(exportData.data, exportData.mimeType, exportData.filename, exportData.fileExtension);
});

$(document).on("click", ".pdf", function (e) {

	var orderId = $(this).parents('table').attr('orderId');
	html2canvas($('#modal-' + orderId)[0], {
		onrendered: function onrendered(canvas) {
			var data = canvas.toDataURL();
			var docDefinition = {
				content: [{
					image: data,
					width: 500
				}]
			};
			pdfMake.createPdf(docDefinition).download("Invoice.pdf");
		}
	});
});

$(document).on("click", ".rollback", function (e) {
	var orderId = $(this).parents('tr').attr('orderId');
	var status = $(this).parents('tr').attr('status');
	var formData = {
		storeId: storeId,
		orderId: orderId,
		status: status
	};
	console.log(formData);
	$('#rollback-' + storeId + '-' + orderId).addClass('hidden');
	$.ajax({
		type: 'POST',
		url: rootPath + '/rollback-payment',
		data: formData
	}).done(function (result) {
		console.log(result);
	}).fail(function () {
		console.log('false');
	});
});

var pusher = new Pusher("4f5dd81b5671af6c6fb2", {
	cluster: "ap1",
	encrypted: true
});

var order2chef = pusher.subscribe(md5(storeId) + '-' + Order2Cashier);
order2chef.bind(Order2Other, function (res) {
	loadCashierTable();
});

var cashier2cashier = pusher.subscribe(md5(storeId) + '-cashier2cashier');
cashier2cashier.bind('payment-done', function (res) {
	var listOrderId = res.listOrderId;
	var status = res.status;
	for (var i in listOrderId) {
		/*let locationName = $('#order-'+storeId+'-'+listOrderId[i]).attr('location')*/
		var obj = {
			orderId: listOrderId[i],
			/*locationName: locationName,*/
			status: status
		};
		console.log(obj);
		$('#order-' + storeId + '-' + listOrderId[i]).addClass('hidden');
		/*SaveDataToLocalStorage(obj)*/
		pushToloadRollbackTable(obj);
	}
});

cashier2cashier.bind('rollback-payment', function (res) {
	var orderId = res.orderId;
	/*$('#rollback-'+storeId+'-'+orderId).addClass('hidden')*/
	$('#order-' + storeId + '-' + orderId).removeClass('hidden');
	var obj = {
		storeId: storeId,
		orderId: orderId
		/*RemoveDataFromLocalStorage(obj)*/
	};loadCashierTable();
	loadRollbackTable();
});

function SaveDataToLocalStorage(obj) {
	var cashierRollback = localStorage.getObj('cashierRollback');
	if (cashierRollback != null) ;else cashierRollback = [];
	cashierRollback.push(obj);
	localStorage.setObj('cashierRollback', cashierRollback);
}

function RemoveDataFromLocalStorage(obj) {
	var cashierRollback = localStorage.getObj('cashierRollback');
	if (cashierRollback != null) ;else return;
	var dataRemoved = cashierRollback.filter(function (el) {
		return el.orderId !== obj.orderId;
	});
	localStorage.setObj('cashierRollback', dataRemoved);
}

/***/ })

/******/ });