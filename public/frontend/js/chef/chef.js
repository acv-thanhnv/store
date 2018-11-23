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
/******/ 	return __webpack_require__(__webpack_require__.s = 72);
/******/ })
/************************************************************************/
/******/ ({

/***/ 72:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(73);


/***/ }),

/***/ 73:
/***/ (function(module, exports, __webpack_require__) {

var storeId = $('#config').attr('storeId');
var rootPath = $('#config').attr('rootPath');
var Customer2Order = $('#config').attr('Customer2Order');
var OtherToWaiterChannel = $('#config').attr('OtherToWaiterChannel');

var Order2Kitchen = $('#config').attr('Order2Kitchen');
var Order2Cashier = $('#config').attr('Order2Cashier');
var Order2Other = $('#config').attr('Order2Other');

$(document).ready(function () {
	$("#header-left a").click(function () {
		$(this).tab('show');
	});
	loadWaiterTable();
	loadRollbackTable();
	loadOrderListTable();
	loadQueueTable();
});

function pushToOrderListTable(result) {
	var output = '';
	var orderId = result.orderDetails.id;
	var table = result.orderDetails.table_name;
	var floor = result.orderDetails.floor_name;
	var priority_code = result.orderDetails.priority;
	var priority = result.orderDetails.type_name;

	for (var i in result.foodDetails) {
		var foodId = result.foodDetails[i].entities_id;
		var foodName = result.foodDetails[i].name;
		var quantity = result.foodDetails[i].quantity;
		var foodStatus = result.foodDetails[i].status;
		var cooked = result.foodDetails[i].cooked;
		$('#foodlist-' + storeId + '-' + orderId + '-' + foodId).removeClass('hidden');
		if ($('#foodlist-' + storeId + '-' + orderId + '-' + foodId)[0]) {
			$('#foodlist-' + storeId + '-' + orderId + '-' + foodId + ' td').eq(3).html(quantity - cooked);
		} else {
			if (priority !== 'Normal') {
				output = '<tr id="foodlist-' + storeId + '-' + orderId + '-' + foodId + '" class="vip foodlist foodlist-' + storeId + '-' + orderId + '"> <td class="food food-left"><span>' + foodName + '</span></td> <td><span class="badge badge-dark">' + orderId + '</span></td> <td><span class="badge badge-light">' + priority + '</span></td> <td>' + quantity + '</td> </tr>';
				if ($('#order-list').find('.vip:last')[0]) {
					$('#order-list').find('.vip:last').after(output);
				} else {
					loadOrderListTable();
				}
			} else {
				output = '<tr id="foodlist-' + storeId + '-' + orderId + '-' + foodId + '" class="normal foodlist foodlist-' + storeId + '-' + orderId + '"> <td class="food food-left"><span>' + foodName + '</span></td> <td><span class="badge badge-dark">' + orderId + '</span></td> <td></td> <td>' + quantity + '</td> </tr>';
				if ($('#order-list').find('.normal:last')[0]) {
					$('#order-list').find('.normal:last').after(output);
				} else {
					loadOrderListTable();
				}
			}
		}
		if (foodStatus == 2) $('#foodlist-' + storeId + '-' + orderId + '-' + foodId).addClass('hidden');else $('#foodlist-' + storeId + '-' + orderId + '-' + foodId).removeClass('hidden');
	}
}

function removeFromOrderListTable(result) {
	var orderId = result.order.id;
	if (result.result[0]) {
		for (var i in result.result) {
			var foodId = result.result[i].entities_id;
			var status = result.result[i].status;
			$('.foodlist-' + storeId + '-' + orderId).addClass('hidden');
			if (status) $('#foodlist-' + storeId + '-' + orderId + '-' + foodId).removeClass('hidden');
		}
	} else {
		$('.foodlist-' + storeId + '-' + orderId).addClass('hidden');
	}
}

function removeFromWaiterTable(result) {
	var orderId = result.order.id;
	if (result.result[0]) {
		for (var i in result.result) {
			var foodId = result.result[i].entities_id;
			var status = result.result[i].status;
			$('.foodline.' + storeId + '-' + orderId).addClass('hidden');
			if (status) $('#' + storeId + '-' + orderId + '-' + foodId).removeClass('hidden');
		}
	} else {
		$('.' + storeId + '-' + orderId).addClass('hidden');
	}
}

function updateQueueTable(foodId, push) {
	console.log('start');
	console.log(foodId);
	console.log(push);
	console.log('end');
	var tmp = $('#queue-' + storeId + '-' + foodId + ' td').eq(1).html();
	tmp = parseInt(tmp) + parseInt(push);
	if (tmp < 0) tmp = 0;
	$('#queue-' + storeId + '-' + foodId + ' td').eq(1).html(tmp);
	if (tmp === 0) $('#queue-' + storeId + '-' + foodId).addClass('hidden');else $('#queue-' + storeId + '-' + foodId).removeClass('hidden');
}

function updateOrderListTable(orderId, foodId, push) {
	var tmp = $('#foodlist-' + storeId + '-' + orderId + '-' + foodId + ' td').eq(3).html();
	tmp = parseInt(tmp) + parseInt(push);
	if (tmp < 0) tmp = 0;
	$('#foodlist-' + storeId + '-' + orderId + '-' + foodId + ' td').eq(3).html(tmp);
	if (tmp === 0) $('#foodlist-' + storeId + '-' + orderId + '-' + foodId).addClass('hidden');else $('#foodlist-' + storeId + '-' + orderId + '-' + foodId).removeClass('hidden');
}

function loadQueueTable() {
	loadJSON(rootPath + '/api/v1/store/' + storeId + '/chef_queue.json', function (response) {
		var result = JSON.parse(response);
		var output = '<table id="food-queue-table" class="table table-hover red-blue-table" data-search="false" data-toggle="table"> <thead> <tr> <th style="width: 90%" data-field="name">Tên món</th> <th style="width: 10%" data-field="quantity">SL</th> </tr> </thead> <tbody>';
		for (var i in result) {
			console.log(result);
			var foodId = result[i].id;
			var foodName = result[i].name;
			var quantity = result[i].quantity;
			quantity = parseInt(quantity);
			if (quantity === 0) {
				output += '<tr id="queue-' + storeId + '-' + foodId + '" class="hidden"><td class="food food-left">' + foodName + '</td>';
			} else {
				output += '<tr id="queue-' + storeId + '-' + foodId + '"><td class="food food-left">' + foodName + '</td>';
			}
			if (i != 0) {
				output += '<td>' + quantity + '</td></tr>';
			} else {
				// output+='<td><h3><span class="badge badge-danger">'+quantity+'</span></h3></td></tr>'
				output += '<td>' + quantity + '</td></tr>';
			}
		}
		output += "</tbody> <tfoot></tfoot> </table> </div> </div>";
		$('#food-queue-table').html(output);
	});
}

function loadOrderListTable() {
	loadJSON(rootPath + '/api/v1/store/' + storeId + '/chef_order_detail.json', function (response) {
		var result = JSON.parse(response);
		var output = '<table id="order-list" class="table table-hover red-blue-table" data-search="true" data-toggle="table"> <thead> <tr> <th class="sticky" style="width: 55%" data-field="name">Tên món</th> <th class="sticky" style="width: 20%" data-field="id" data-sortable="true">HĐ</th> <th class="sticky" style="width: 15%" data-field="priority" data-sortable="true">VIP</th> <th class="sticky" style="width: 10%" data-field="quantity">SL</th> </tr> </thead> <tbody id="order-list-table-body">';
		for (var i in result.orders) {
			var orderId = result.orders[i].id;
			var priority = result.orders[i].priority;
			for (var j in result.details[i]) {
				var foodId = result.details[i][j].id;
				var foodName = result.details[i][j].name;
				var quantity = result.details[i][j].quantity;
				var cooked = result.details[i][j].cooked;
				var pending = quantity - cooked;
				if (priority !== 'Normal') output += '<tr id="foodlist-' + storeId + '-' + orderId + '-' + foodId + '" class="vip foodlist foodlist-' + storeId + '-' + orderId + '"> <td class="food food-left"><span>' + foodName + '</span></td> <td><span class="badge badge-dark">' + orderId + '</span></td> <td><span class="badge badge-light">' + priority + '</span></td> <td>' + pending + '</td> </tr>';else output += '<tr id="foodlist-' + storeId + '-' + orderId + '-' + foodId + '" class="normal foodlist foodlist-' + storeId + '-' + orderId + '"> <td class="food food-left"><span>' + foodName + '</span></td> <td><span class="badge badge-dark">' + orderId + '</span></td> <td></td> <td>' + pending + '</td> </tr>';
			}
		}
		output += "</tbody> <tfoot></tfoot> </table>";
		$('#order-list-left').html(output);
	});
}

function pushToloadRollbackTable(obj) {
	var current = $('#rollback-body').html();
	var newRow = '<tr id="rollback-' + storeId + '-' + obj.orderId + '-' + obj.foodId + '-' + obj.time + '" storeId="' + storeId + '" orderId="' + obj.orderId + '" foodId="' + obj.foodId + '" quantity="' + obj.quantity + '" push="' + obj.push + '" time="' + obj.time + '"> <td>' + obj.foodName + '</td> <td> <button type="button" class="btn btn-primary">#HĐ ' + obj.orderId + '</button> </td> <td>' + obj.quantity + '</td> <td> <button type="button" class="btn btn-primary">Chuyển: <span class="badge badge-light">' + obj.push + '</span></button> </td> <td> <button class="btn btn-success"><i class="fa fa-undo rollback"></i></button> </td> </tr>';
	current = newRow + current;
	$('#rollback-body').html(current);
}

function loadRollbackTable() {
	loadJSON(rootPath + '/api/v1/store/' + storeId + '/chef_rollback.json', function (response) {
		var result = JSON.parse(response);
		var output = '<table id="roll-back" class="table table-hover red-blue-table" data-toggle="table" data-search="true"> <thead> <tr> <th class="sticky" style="width: 35%" data-field="name">Tên món</th> <th class="sticky" style="width:15%" data-field="invoice">Hóa đơn</th> <th class="sticky" style="width: 10%" data-field="quantity">SL</th> <th class="sticky" style="width: 30%" data-field="action">Thao tác</th> <th class="sticky" style="width: 20%"></th> </tr> </thead> <tbody id="rollback-body">';
		for (var i in result) {
			var orderId = result[i].order_id;
			var foodId = result[i].food_id;
			var foodName = result[i].name;
			var quantity = result[i].quantity;
			var push = result[i].push;
			var time = result[i].time;
			output += '<tr id="rollback-' + storeId + '-' + orderId + '-' + foodId + '-' + time + '" storeId="' + storeId + '" orderId="' + orderId + '" foodId="' + foodId + '" quantity="' + quantity + '" push="' + push + '" time="' + time + '"> <td>' + foodName + '</td> <td> <button type="button" class="btn btn-primary">#HĐ ' + orderId + '</button> </td> <td>' + quantity + '</td> <td> <button type="button" class="btn btn-primary">Chuyển: <span class="badge badge-light">' + push + '</span></button> </td> <td> <button class="btn btn-success"><i class="fa fa-undo rollback"></i></button> </td> </tr>';
		}
		output += "</tbody> <tfoot></tfoot> </table>";
		$('#undo-table').html(output);
	});
}

function pushToWaiterTable(result) {
	var output = '';
	var orderId = result.orderDetails.id;
	var table = result.orderDetails.table_name;
	var floor = result.orderDetails.floor_name;
	var priority = result.orderDetails.type_name;
	$('.t-header.' + storeId + '-' + orderId).removeClass('hidden');
	if ($('.' + storeId + '-' + orderId)[0]) {
		if (!$('.foodline.' + storeId + '-' + orderId).not('.hidden')[0]) loadWaiterTable();else {
			for (var i in result.foodDetails) {
				var foodId = result.foodDetails[i].entities_id;
				var foodName = result.foodDetails[i].name;
				var foodStatus = result.foodDetails[i].status;
				var quantity = result.foodDetails[i].quantity;
				var cooked = result.foodDetails[i].cooked;
				$('.t-header.' + storeId + '-' + orderId + '-' + foodId).removeClass('hidden');
				if ($('#' + storeId + '-' + orderId + '-' + foodId)[0]) {
					var text = $('#' + storeId + '-' + orderId + '-' + foodId + ' td').eq(1).html();
					var index = text.indexOf('/');
					var substring = text.substring(index);
					var newText = text.replace(substring, '/' + quantity);
					$('#' + storeId + '-' + orderId + '-' + foodId + ' td').eq(1).html(newText);
					$('#' + storeId + '-' + orderId + '-' + foodId + ' td').eq(2).find('span:last').text(quantity - cooked);
				} else {
					output += '<tr id="' + storeId + '-' + orderId + '-' + foodId + '" class="hidden foodline ' + storeId + '-' + orderId + '" storeId="' + storeId + '" orderId="' + orderId + '" foodId="' + foodId + '" foodName="' + name + '" quantity="' + quantity + '"> <td class="food food-right">' + foodName + '</td> <td>' + cooked + '/' + quantity + '</td> <td> <button type="button" class="btn btn-primary btn-sm">Đã nấu: <span class="badge badge-light">' + cooked + '</span></button> <button type="button" class="btn-group-kitchen btn btn-danger btn-sm">Đang nấu: <span class="badge badge-light">' + (quantity - cooked) + '</span></button> </td> <td> <button cooked="' + (cooked + 1) + '" push="1" class="btn btn-warning push-food-1"><i class="fa fa-angle-right"></i></button> <button cooked="' + quantity + '" push="' + (quantity - cooked) + '" class="btn-group-kitchen btn btn-danger push-food-all"><i class="fa fa-angle-double-right"></i></button> </td> </tr>';
				}
				if (foodStatus == 2) $('#' + storeId + '-' + orderId + '-' + foodId).addClass('hidden');else $('#' + storeId + '-' + orderId + '-' + foodId).removeClass('hidden');
			}
			$('#cho-cung-ung').find('.' + storeId + '-' + orderId + ':last').after(output);
		}
	} else {
		loadWaiterTable();
	}
}

function loadWaiterTable() {
	loadJSON(rootPath + '/api/v1/store/' + storeId + '/chef_order_detail.json', function (response) {
		var result = JSON.parse(response);
		var output = '<table id="cho-cung-ung" class="table table-hover red-blue-table" data-toggle="table" data-search="true"> <thead> <tr> <th class="sticky" colspan="2" style="width:40%">Hóa đơn</th> <th class="sticky" colspan="2" style="width:60%">Bàn/Phòng/Tầng</th> </tr> </thead> <tbody>';
		for (var i in result.orders) {
			var id = result.orders[i].id;
			var name = result.orders[i].name;
			var priority = result.orders[i].priority;
			var floor = result.orders[i].floor;
			if (result.details[i].length != 0) {
				if (priority !== 'Normal') output += '<tr class="t-header vip ' + storeId + '-' + id + '"> <td colspan="2"> <button type="button" class="t-header-collapse btn btn-primary order-detail"> <span status="+"><i class="fa fa-plus-circle" aria-hidden="true"></i></span> HĐ ' + id + '</button> </td> <td colspan="2"> <button type="button" class="btn btn-primary"> <span class="badge badge-light">' + name + ' ' + floor + '</span> </button> </td> </tr>';else output += '<tr class="t-header normal ' + storeId + '-' + id + '"> <td colspan="2"> <button type="button" class="t-header-collapse btn btn-primary order-detail"> <span status="+"><i class="fa fa-plus-circle" aria-hidden="true"></i></span> HĐ ' + id + '</button> </td> <td colspan="2"> <button type="button" class="btn btn-primary"> <span class="badge badge-light">' + name + ' ' + floor + '</span> </button> </td> </tr>';
				output += '<tr class="hidden t-header-child ' + storeId + '-' + id + '"> <th style="width: 25%">Tên món</th> <th style="width: 15%">SL</th> <th style="width: 40%">Trạng thái</th> <th style="width: 20%"></th> </tr>';
				for (var j in result.details[i]) {
					var foodId = result.details[i][j].id;
					var name = result.details[i][j].name;
					var cooked = result.details[i][j].cooked;
					var quantity = result.details[i][j].quantity;
					output += '<tr id="' + storeId + '-' + id + '-' + foodId + '" class="hidden foodline ' + storeId + '-' + id + '" storeId="' + storeId + '" orderId="' + id + '" foodId="' + foodId + '" foodName="' + name + '" quantity="' + quantity + '" cooked="' + cooked + '"> <td class="food food-right">' + name + '</td> <td>' + cooked + '/' + quantity + '</td> <td> <button type="button" class="btn btn-primary btn-sm">Đã nấu: <span class="badge badge-light">' + cooked + '</span></button> <button type="button" class="btn-group-kitchen btn btn-danger btn-sm">Đang nấu: <span class="badge badge-light">' + (quantity - cooked) + '</span></button> </td> <td> <button class="btn btn-warning push-food-1"><i class="fa fa-angle-right"></i></button> <button push="' + (quantity - cooked) + '" class="btn-group-kitchen btn btn-danger push-food-all"><i class="fa fa-angle-double-right"></i></button> </td> </tr>';
				}
			}
		}
		output += "<tfoot id='tfoot-table'></tfoot> </tbody></table>";
		$('#waiter-table').html(output);
	});
}

$(document).on("click", ".push-food-1", function (e) {
	var orderId = $(this).parents('tr').attr('orderId');
	var foodId = $(this).parents('tr').attr('foodId');
	var foodName = $(this).parents('tr').attr('foodName');
	var quantity = $(this).parents('tr').attr('quantity');
	var push = $(this).attr('push');
	var date = new Date();
	var currentTime = date.getTime();
	var formData = {
		storeId: storeId,
		orderId: orderId,
		foodId: foodId,
		time: currentTime
	};
	console.log(formData);
	$.ajax({
		type: 'POST',
		url: rootPath + '/kitchen/push-food-to-customer/1',
		data: formData
	}).done(function (result) {
		console.log(result);
	}).fail(function () {
		console.log('false');
	});
});

$(document).on("click", ".push-food-all", function (e) {
	var orderId = $(this).parents('tr').attr('orderId');
	var foodId = $(this).parents('tr').attr('foodId');
	var foodName = $(this).parents('tr').attr('foodName');
	var quantity = $(this).parents('tr').attr('quantity');
	var push = $(this).attr('push');
	var date = new Date();
	var currentTime = date.getTime();
	var formData = {
		storeId: storeId,
		orderId: orderId,
		foodId: foodId,
		time: currentTime
	};
	console.log(formData);
	$.ajax({
		type: 'POST',
		url: rootPath + '/kitchen/push-food-to-customer',
		data: formData
	}).done(function (result) {
		console.log(result);
	}).fail(function () {
		console.log('false');
	});
});

$(document).on("click", ".rollback", function (e) {
	var orderId = $(this).parents('tr').attr('orderId');
	var foodId = $(this).parents('tr').attr('foodId');
	var push = $(this).parents('tr').attr('push');
	var quantity = $(this).parents('tr').attr('quantity');
	quantity = parseInt(quantity);
	var cooked = $('#' + storeId + '-' + orderId + '-' + foodId).attr('cooked');
	cooked = parseInt(cooked);
	var cooked1 = cooked + 1;
	cooked = cooked - push;
	if (cooked < 0) cooked = 0;
	var time = $(this).parents('tr').attr('time');
	var id = $(this).parents('tr').attr('id');
	var detect = '#' + storeId + '-' + orderId + '-' + foodId;

	$('#rollback-' + storeId + '-' + orderId + '-' + foodId + '-' + time).addClass('hidden');
	var formData = {
		storeId: storeId,
		orderId: orderId,
		foodId: foodId,
		push: push,
		time: time
	};

	$.ajax({
		type: 'POST',
		url: rootPath + '/kitchen/rollback-food',
		data: formData
	}).done(function (result) {
		console.log(result);
		$(this).parents('tr').addClass('hidden');
	}).fail(function () {
		console.log('false');
	});
});

$(document).on("click", ".order-detail", function (e) {
	if ($(this).find("span:first").attr('status') !== '-') {
		$(this).parents('tr').nextUntil('tr.t-header').removeClass('hidden');
		$(this).find("span:first").attr('status', '-');
		$(this).removeClass('btn-primary');
		$(this).addClass('btn-danger');
		$(this).find("span:first").html('<i class="fa fa-minus" aria-hidden="true"></i>');
	} else {
		$(this).parents('tr').nextUntil('tr.t-header').addClass('hidden');
		$(this).find("span:first").attr('status', '+');
		$(this).removeClass('btn-danger');
		$(this).addClass('btn-primary');
		$(this).find("span:first").html('<i class="fa fa-plus-circle" aria-hidden="true"></i>');
	}
});

function loadJSON(file, callback) {

	var xobj = new XMLHttpRequest();
	xobj.overrideMimeType("application/json");
	xobj.open('GET', file, true); // Replace 'my_data' with the path to your file
	xobj.onreadystatechange = function () {
		if (xobj.readyState == 4 && xobj.status == "200") {
			callback(xobj.responseText);
		}
	};
	xobj.send(null);
}

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
	table = document.getElementById("cho-cung-ung");
	tr = table.getElementsByClassName("t-header");
	for (i = 0; i < tr.length; i++) {
		td = tr[i].getElementsByTagName("td")[1];
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

var pusher = new Pusher("4f5dd81b5671af6c6fb2", {
	cluster: "ap1",
	encrypted: true
});

var order2kitchen = pusher.subscribe(md5(storeId) + '-' + Order2Kitchen);
order2kitchen.bind(Order2Other, function (res) {
	pushToOrderListTable(res);
	pushToWaiterTable(res);
	loadQueueTable();
});

var customer2order = pusher.subscribe(md5(storeId) + '-' + Customer2Order);
customer2order.bind(Customer2Order, function (res) {
	removeFromOrderListTable(res);
	removeFromWaiterTable(res);
});

var other2waiter = pusher.subscribe(md5(storeId) + '-' + OtherToWaiterChannel);
other2waiter.bind(OtherToWaiterChannel, function (res) {
	var foodId = res.foodId;
	var rollback = res.rollback;
	if (parseInt(foodId) != 0) {
		console.log(res);
		var time = res.time;
		var orderId = res.orderId;
		var quantity = res.quantity;
		var cooked = res.cooked;
		var push = res.push;
		var cooked1 = parseInt(cooked) + 1;
		var detectOrder = '.' + storeId + '-' + orderId;
		var detect = '#' + storeId + '-' + orderId + '-' + foodId;
		var detectRollback = '#rollback-' + storeId + '-' + orderId + '-' + foodId + '-' + time;
		var foodName = $(detect).attr('foodName');
		if (!rollback) {
			var obj = {
				storeId: storeId,
				orderId: orderId,
				time: time,
				quantity: quantity,
				foodName: foodName,
				foodId: foodId,
				push: push
			};
			pushToloadRollbackTable(obj);
			console.log(obj);
			updateQueueTable(foodId, -push);
			updateOrderListTable(orderId, foodId, -push);
			if (quantity != cooked) {
				$(detect + ' td').eq(1).html(cooked + '/' + quantity);
				$(detect + ' td').eq(2).html('<button type="button" class="btn btn-primary btn-sm">Đã nấu: <span class="badge badge-light">' + cooked + '</span></button> <button type="button" class="btn-group-kitchen btn btn-danger btn-sm">Đang nấu: <span class="badge badge-light">' + (quantity - cooked) + '</span></button>');
				$(detect + ' td').eq(4).html('<button push="1" class="btn btn-warning push-food-1"><i class="fa fa-angle-right"></i></button> <button push="' + (quantity - cooked) + '" class="btn-group-kitchen btn btn-danger push-food-all"><i class="fa fa-angle-double-right"></i></button>');
			} else {
				$(detect).addClass('hidden');
				$('#foodlist-' + storeId + '-' + orderId + '-' + foodId).addClass('hidden');
			}
			if (!$('.foodline.' + storeId + '-' + orderId).not('.hidden')[0]) $('.' + storeId + '-' + orderId).addClass('hidden');
		} else {
			updateQueueTable(foodId, push);
			updateOrderListTable(orderId, foodId, push);
			if ($(detect)[0]) {
				if (quantity != cooked) {
					$(detect + ' td').eq(1).html(cooked + '/' + quantity);
					$(detect + ' td').eq(2).html('<button type="button" class="btn btn-primary btn-sm">Đã nấu: <span class="badge badge-light">' + cooked + '</span></button> <button type="button" class="btn-group-kitchen btn btn-danger btn-sm">Đang nấu: <span class="badge badge-light">' + (quantity - cooked) + '</span></button>');
					$(detect + ' td').eq(4).html('<button push="1" class="btn btn-warning push-food-1"><i class="fa fa-angle-right"></i></button> <button push="' + (quantity - cooked) + '" class="btn-group-kitchen btn btn-danger push-food-all"><i class="fa fa-angle-double-right"></i></button>');
				}
				$(detect).removeClass('hidden');
				$('.t-header-child.' + storeId + '-' + orderId).removeClass('hidden');
				$('.t-header.' + storeId + '-' + orderId).removeClass('hidden');
			} else {
				loadWaiterTable();
			}
		}
	} else {
		var orderId = res.orderId;
		if (rollback) {
			if ($("tr[id^='rollback-" + storeId + "-" + res.orderId[i] + "']")[0]) {
				for (var i in res.orderId) {
					$("tr[id^='rollback-" + storeId + "-" + res.orderId[i] + "']").removeClass('hidden');
				}
			} else {
				loadRollbackTable();
			}
		} else {
			for (var i in res.orderId) {
				$("tr[id^='rollback-" + storeId + "-" + res.orderId[i] + "']").addClass('hidden');
			}
		}
	}
});

/***/ })

/******/ });