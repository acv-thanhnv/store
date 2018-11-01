storeId = $('#config').attr('storeId')

localStorage.removeItem('cashierRollback');

if (localStorage.getItem("cashierRollback") === null) {
	var a = [];
	a.push(JSON.parse(localStorage.getItem('cashierRollback')));
	localStorage.setItem('cashierRollback', JSON.stringify(a));
}

/*var newObj = {
	orderId: 39,
	location: 11
}
var a = [];
a.push(JSON.parse(localStorage.getItem('cashierRollback')));
localStorage.setItem('cashierRollback', JSON.stringify(a));

SaveDataToLocalStorage(newObj)

console.log(localStorage.cashierRollback)*/

$(document).ready(function(){
	$("#header-left a").click(function(){
		$(this).tab('show');
	});
	loadCashierTable()
	loadCustomer2CashierTable()
	loadRollbackTable()
})

function loadJSON(file, callback) {   

	var xobj = new XMLHttpRequest();
	xobj.overrideMimeType("application/json");
    xobj.open('GET', file, true); // Replace 'my_data' with the path to your file
    xobj.onreadystatechange = function () {
    	if (xobj.readyState == 4 && xobj.status == "200") {
            // Required use of an anonymous callback as .open will NOT return a value but simply returns undefined in asynchronous mode
            callback(xobj.responseText);
        }
    }
    xobj.send(null)
}

function loadRollbackTable() {
	var output='<table id="roll-back" class="table table-hover red-blue-table"> <thead> <tr> <th style="width: 40%" data-field="invoice">Hóa đơn</th> <th style="width: 30%" data-field="location">Bàn</th> <th style="width: 30%"></th> </tr> </thead> <tbody id="rollback-body">'
	if (localStorage.getItem("cashierRollback") != null) {
	let a = localStorage.getItem('cashierRollback')
	console.log(a[1])
	for (var i in a) {
		if (a[i]) output+='<tr> <td> <button type="button" class="btn btn-primary">#HĐ '+a[i].orderId+'</button> </td> <td> <button type="button" class="btn btn-primary">'+a[i].locationName+'</button> </td> <td> <button class="btn btn-success"><i class="fa fa-undo"></i></button> </td> </tr>'
	}
}
	output+='</tbody> <tfoot></tfoot> </table>'
	$('#rollback-thanh-toan').html(output)
}

function pushToloadRollbackTable(obj) {
	let cashierRollback = localStorage.getItem("cashierRollback")
	cashierRollback = [...cashierRollback, obj]
	localStorage.setItem("cashierRollback", cashierRollback)
	var current = $('#rollback-body').html()
	var newRow = '<tr> <td> <button type="button" class="btn btn-primary">#HĐ '+obj.orderId+'</button> </td> <td> <button type="button" class="btn btn-primary">'+obj.locationName+'</button> </td> <td> <button class="btn btn-success"><i class="fa fa-undo"></i></button> </td> </tr>'
	current = current + newRow
	$('#rollback-body').html(current)
}

function loadCashierTable() {
	loadJSON('http://store.dev/api/v1/store/'+storeId+'/cashier.json', function(response) {
		var output='<table id="bang-thu-ngan" class="table table-hover red-blue-table" data-toggle="table" data-search="true" responsive hover> <thead> <tr> <th style="width: 5%"></th> <th style="width: 10%">Hóa đơn</th> <th style="width: 20%">Vị trí</th> <th style="width: 10%">Tổng tiền</th> <th style="width: 10%">Thuế suất</th> <th style="width: 15%">Chiết khấu</th> <th style="width: 15%">Thành tiền</th> <th style="width: 15%"></th> </tr> </thead> <tbody>';
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
		$('#thu-ngan').html(output)
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
			output+= '<table storeId="'+storeId+'" orderId="'+orderId+'" class="table table-hover red-blue-table" data-toggle="table" style="margin-top: 10px;"> <thead> <tr> <th style="width: 55%">Tên món</th> <th style="width: 10%">Đơn giá</th> <th style="width: 15%">Số lượng</th> <th style="width: 20%">Thành tiền</th> </tr> </thead> <tbody>'
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
		$('#invoices-details').html(output)
	})
}

function loadCustomer2CashierTable() {
	loadJSON('http://store.dev/api/v1/store/'+storeId+'/customer2cashier.json', function(response) {
		var output='<table id="bang-khach-yeu-cau-thanh-toan" class="table table-hover red-blue-table" data-toggle="table" data-search="true" responsive hover> <thead> <tr> <th style="width: 5%"></th> <th style="width: 10%">Hóa đơn</th> <th style="width: 20%">Vị trí</th> <th style="width: 10%">Tổng tiền</th> <th style="width: 10%">Thuế suất</th> <th style="width: 15%">Chiết khấu</th> <th style="width: 15%">Thành tiền</th> <th style="width: 15%"></th> </tr> </thead> <tbody>';
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
			output+= '<table orderId="'+orderId+'" class="table table-hover red-blue-table" data-toggle="table" style="margin-top: 10px;"> <thead> <tr> <th style="width: 55%">Tên món</th> <th style="width: 10%">Đơn giá</th> <th style="width: 15%">Số lượng</th> <th style="width: 20%">Thành tiền</th> </tr> </thead> <tbody>'
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
}

document.getElementById("search").addEventListener("keyup", searchFor)
function searchFor() {
	var input, filter, table, tr, td, i, cl=false;
	input = document.getElementById("search");
	filter = input.value.toUpperCase();
	cl = filter?true:false;
	table = document.getElementById("bang-thu-ngan")
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
		$('.t-header-child').nextUntil('.t-header').slideToggle(0, function(){});
	}
}

$("#khach-thanh-toan").on('click','.checkbox',function(){

	var isChecked = $(this).prop('checked');

	var currentTotal = $("#payment-right").text();
	var currentInvoices = $("#invoice-id").text();
	var currentRow=$(this).closest("tr");

	if (currentInvoices) var invoices = currentInvoices.split(",");
	else var invoices = [];

	/*var col1=currentRow.find("td:eq(1)").text();*/
	var col1 = currentRow.attr('orderId')
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
})

$("#thu-ngan").on('click','.checkbox',function(){

	var isChecked = $(this).prop('checked');

	var currentTotal = $("#payment-right").text();
	var currentInvoices = $("#invoice-id").text();
	var currentRow=$(this).closest("tr");

	if (currentInvoices) var invoices = currentInvoices.split(",");
	else var invoices = [];

	/*var col1=currentRow.find("td:eq(1)").text();*/
	var col1 = currentRow.attr('orderId')
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
})

$(document).on("change",".tax",function(e){
	let tax=this.value
	$(this).parents('tr').attr('tax',tax);
	let orderId = $(this).parents('tr').attr('orderId')
	$('#hd'+orderId+' table tr.tax').find("td:eq(2)").text(tax)
	let discount = $(this).parents('tr').attr('discount')
	let total = $(this).parents('tr').attr('total')
	total = parseInt(total)
	tax = parseInt(tax)
	discount = parseInt(discount)
	total = total + total*(tax - discount)/100
	total = total.toLocaleString('us')
	$(this).parents('tr').attr('payment',total);
	$('#hd'+orderId+' table tr.total').find("td:eq(2)").text(total)
	$('#hd'+orderId+' table button.payment').find("td:eq(2)").text(total)
	$(this).parents('tr').children('.total').text(total)
});

$(document).on("change",".discount",function(e){
	let discount = this.value
	$(this).parents('tr').attr('discount',discount);
	let orderId = $(this).parents('tr').attr('orderId')
	$('#hd'+orderId+' table tr.discount').find("td:eq(2)").text(discount)
	let tax = $(this).parents('tr').attr('tax')
	let total = $(this).parents('tr').attr('total')
	total = parseInt(total)
	tax = parseInt(tax)
	discount = parseInt(discount)
	total = total + total*(tax - discount)/100
	total = total.toLocaleString('us')
	$(this).parents('tr').attr('payment',total);
	$('#hd'+orderId+' table tr.total').find("td:eq(2)").text(total)
	$('#hd'+orderId+' table button.payment').find("td:eq(2)").text(total)
	$(this).parents('tr').children('.total').text(total)
});

$(document).on("click",".payment",function(e){
	let listOrderId = []
	let orderId = $(this).parents('table').attr('orderId')
	listOrderId.push(orderId)
	let formData = {
		storeId: storeId,
		listOrderId: listOrderId
	}
	console.log(formData)
	$.ajax({
		type:'POST',
		url:'/payment-done',
		data: formData
	}).done(function(result) {
		console.log(result)
	}).fail(function() {
		console.log('false')
	})
})

$(document).on("click","#thanh-toan-tat-ca",function(e){
	let currentInvoices = $("#invoice-id").text()
	currentInvoices = JSON.parse('[' + currentInvoices + ']')
	let formData = {
		storeId: storeId,
		listOrderId: currentInvoices
	}
	console.log(formData)
	$.ajax({
		type:'POST',
		url:'/payment-done',
		data: formData
	}).done(function(result) {
		console.log(result)
		$('#payment-right').html('')
		$('#invoice-id').html('')
	}).fail(function() {
		console.log('false')
	})
})


var pusher = new Pusher(process.env.MIX_PUSHER_APP_KEY, {
	cluster: process.env.MIX_PUSHER_APP_CLUSTER,
	encrypted: true
});

var order2cashier = pusher.subscribe('1-customer2cashier');
order2cashier.bind('new-payment', function(res) {
	loadCustomer2CashierTable()
})

var order2chef = pusher.subscribe('1-order2chef');
order2chef.bind('new-order', function(res) {
	loadCashierTable()
})

var cashier2cashier = pusher.subscribe('1-cashier2cashier')
cashier2cashier.bind('payment-done', function(res) {
	var listOrderId = res.listOrderId
	for (var i in listOrderId) {
		let locationName = $('#order-'+storeId+'-'+listOrderId[i]).attr('location')
		let obj = {
			orderId: listOrderId[i],
			locationName: locationName
		}
		SaveDataToLocalStorage(obj)
		pushToloadRollbackTable(obj)
		$('#order-'+storeId+'-'+listOrderId[i]).addClass('hidden')
	}
})

function SaveDataToLocalStorage(data)
{
	var a = [];
    a = JSON.parse(localStorage.getItem('cashierRollback'));
    a.push(data);
    localStorage.setItem('cashierRollback', JSON.stringify(a));
}