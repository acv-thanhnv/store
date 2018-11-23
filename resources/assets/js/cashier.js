const storeId = $('#config').attr('storeId')
const rootPath = $('#config').attr('rootPath')

const Customer2Order = $('#config').attr('Customer2Order')
const WaiterToWaiterChannel = $('#config').attr('WaiterToWaiterChannel')

const Order2Kitchen = $('#config').attr('Order2Kitchen')
const Order2Cashier = $('#config').attr('Order2Cashier')
const Order2Other = $('#config').attr('Order2Other')

var paymentAll = []

Storage.prototype.setObj = function(key, obj) {
	return this.setItem(key, JSON.stringify(obj))
}
Storage.prototype.getObj = function(key) {
	let data = this.getItem(key)
	console.log(data)
	if (data) {
		if (data.indexOf(',,')==-1) return JSON.parse(data)
			else {
				data = String(data).replace(/,/g, '').slice(0, -15).replace(/""/g, '","').replace(/}{/g, '},{')
				return JSON.parse(data)
			}
		}
		else return
	}

$(document).ready(function(){
	$("#header-left a").click(function(){
		$(this).tab('show')
	})
	loadCashierTable()
	loadRollbackTable()
})

function loadJSON(file, callback) {   

	var xobj = new XMLHttpRequest()
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
	loadJSON(rootPath+'/api/v1/store/'+storeId+'/rollback_cashier.json', function(response) {
		var output='<table id="roll-back" class="table table-hover red-blue-table"> <thead> <tr> <th class="sticky" style="width: 70%" data-field="invoice">Hóa đơn</th> <th class="sticky" style="width: 30%"></th> </tr> </thead> <tbody id="rollback-body">'
		var result = JSON.parse(response)
		console.log(result)
		for (var i in result)
		{
			var orderId = result[i].order_id
			var beforeStatus = result[i].before_status
			output+='<tr id="rollback-'+storeId+'-'+orderId+'" orderId="'+orderId+'" status="'+beforeStatus+'"> <td> <button type="button" class="btn btn-primary">#HĐ '+orderId+'</button> </td> <td> <button class="btn btn-success rollback"><i class="fa fa-undo"></i></button> </td> </tr>'
		}
		output+='</tbody> <tfoot></tfoot> </table>'
		$('#undo-table').html(output)
	})
}

function pushToRollbackTable(obj) {
	var current = $('#rollback-body').html()
	var newRow = '<tr id="rollback-'+storeId+'-'+obj.orderId+'" orderId="'+obj.orderId+'" status="'+obj.status+'"> <td> <button type="button" class="btn btn-primary">#HĐ '+obj.orderId+'</button> </td> <td> <button class="btn btn-success rollback"><i class="fa fa-undo"></i></button> </td> </tr>'
	current = current + newRow
	$('#rollback-body').html(current)
}

function loadCashierTable() {
	loadJSON(rootPath+'/api/v1/store/'+storeId+'/cashier.json', function(response) {
		var output='<table id="bang-thu-ngan" class="table table-hover red-blue-table" data-toggle="table" data-search="true" responsive hover> <thead> <tr> <th class="sticky-under" style="width: 5%"></th> <th class="sticky-under" style="width: 10%">Hóa đơn</th> <th class="sticky-under" style="width: 20%">Vị trí</th> <th class="sticky-under" style="width: 10%">Tổng tiền</th> <th class="sticky-under" style="width: 15%">Thuế suất</th> <th class="sticky-under" style="width: 15%">Chiết khấu</th> <th class="sticky-under" style="width: 15%">Thành tiền</th> <th class="sticky-under" style="width: 10%"></th> </tr> </thead> <tbody>'
		var result = JSON.parse(response)
		for (var i in result.orders)
		{
			var id = result.orders[i].id
			var name = result.orders[i].location
			var floor = result.orders[i].floor
			var sum = result.orders[i].sum
			var status = result.orders[i].status
			var locationFee = result.orders[i].locationFee
			var total = parseInt(sum) + parseInt(locationFee)
			output+='<tr id="order-'+storeId+'-'+id+'" status="'+status+'" orderId="'+id+'" location="'+name+'" tax="10" discount="0" total="'+total+'" payment="'+(sum*1.1)+'"> <td><input class="checkbox" type="checkbox" value="#HĐ '+id+'"></td> <td><span class="badge badge-dark">'+id+'</span> <td> <button type="button" class="btn btn-primary"> <span class="badge badge-light">'+name+' '+floor+'</span></button> </td> <td class="money">'+parseInt(total).toLocaleString('us')+'</td> <td><span type="button" class="dec badge badge-dark"> <i class="fa fa-minus-square" aria-hidden="true"></i> </span> <input class="tax" type="number" value="10" min="0"> <span class="inc badge badge-dark"> <i class="fa fa-plus-square" aria-hidden="true"></i> </span></td> <td><span class="dec badge badge-dark"> <i class="fa fa-minus-square" aria-hidden="true"></i> </span> <input class="discount" type="number" value="0" min="0"> <span class="inc badge badge-dark"> <i class="fa fa-plus-square" aria-hidden="true"></i> </span></td> <td class="total">'+parseInt(total*1.1).toLocaleString('us')+'</td> <td> <button class="btn btn-success" data-toggle="modal" data-target="#hd'+id+'"><i class="fa fa-eye"></i></button> </td> </tr>'
		}
		output+="</tbody> <tfoot></tfoot> </table>"
		$('#cashier-table').html(output)
		output=''
		for (var i in result.orders)
		{
			var orderId = result.orders[i].id
			var locationFee = result.orders[i].locationFee
			locationFee = parseInt(locationFee)
			var sum = result.orders[i].sum
			sum = parseInt(sum)
			var tax = 10
			var discount = 0
			var status = result.orders[i].status
			output+='<div id="hd'+orderId+'" class="modal fade" role="dialog"> <div class="modal-dialog"> <div class="modal-content">'
			output+= '<table id="modal-'+orderId+'" storeId="'+storeId+'" orderId="'+orderId+'" status="'+status+'" class="table table-hover red-blue-table" data-toggle="table" style="margin-top: 10px;"> <thead> <tr> <th style="width: 45%">Tên món</th> <th style="width: 10%">Đơn giá</th> <th style="width: 25%">Số lượng</th> <th style="width: 20%">Thành tiền</th> </tr> </thead> <tbody>'
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
			output+='<tr> <td colspan="2"></td> <td class="ta-right"> Phụ phí: </td> <td>'+parseInt(locationFee).toLocaleString('us')+'</td> </tr>'
			output+='<tr> <td colspan="2"></td> <td class="ta-right"> Tổng tiền: </td> <td>'+parseInt(sum+locationFee).toLocaleString('us')+'</td> </tr>'
			output+='<tr class="tax"> <td colspan="2"></td> <td class="ta-right"> Thuế: </td> <td>'+tax+'</td> </tr>'
			output+='<tr class="discount"> <td colspan="2"></td> <td class="ta-right"> Chiết khấu: </td> <td>'+discount+'</td> </tr>'
			output+='<tr class="total"> <td colspan="2"></td> <td class="ta-right"> Thành tiền: </td> <td>'+parseInt((sum+locationFee)*1.1).toLocaleString('us')+'</td> </tr>'
			output+='<tr> <td colspan="4"> <div class="col-xs-12"> <div class="panel-group"> <div class=""> <div> <div class="btn-group pull-left"> <button class="btn btn-primary pdf">In hóa đơn</button> </div> <div class="btn-group pull-center"> <button class="btn btn-primary payment" data-dismiss="modal" aria-label="Close">Thanh toán: '+parseInt((sum+locationFee)*1.1).toLocaleString('us')+'</button> </div> <div class="btn-group pull-right"> <button class="btn btn-primary excel">Xuất ra Excel</button> </div> </div> </div> </div> </div> </td> </tr>'
			output+='</tfoot></table>'
			output+= '</div> </div> </div>'
		}
		$('#invoices-details').html(output)
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

$("#cashier-table").on('click','.checkbox',function(){

	var isChecked = $(this).prop('checked');

	var currentTotal = $("#payment-right").text();
	var currentInvoices = $("#invoice-id").text();
	var currentRow=$(this).closest("tr");

	if (currentInvoices.includes('< trống >')) currentInvoices=false

		if (currentInvoices) var invoices = currentInvoices.split(",");
	else var invoices = [];

	var status = currentRow.attr('status')
	var col1 = currentRow.attr('orderId')
	var col2=currentRow.find("td:eq(6)").text()
	var data=col1+"\n"+col2+"\n"
	
	let newData = {
		orderId: col1,
		status: status
	}

	if (isChecked) {
		paymentAll.push(newData)
		invoices.push(col1)
		console.log(paymentAll)
		status = $(this).parents("table").attr('status')
		if (!currentTotal) currentTotal=parseInt(col2.replace(/,/g, ''));
		else currentTotal = parseInt(currentTotal.replace(/,/g, '')) +
			parseInt(col2.replace(/,/g, ''));

	} else {
		var index2 = paymentAll.findIndex(x => x.order_id === col1)
		if (index2 !== undefined) paymentAll.splice(index2, 1)
			console.log(paymentAll)
		var index = invoices.indexOf(col1);
		if (index > -1) {
			invoices.splice( index, 1 );
		}
		currentTotal = parseInt(currentTotal.split(',').join('')) -
		parseInt(col2.split(',').join(''));
	}
	if (invoices[0]) {
		$("#invoice-id").text(invoices.toString())
	} else {
		$("#invoice-id").text('< trống >')
	}
	$("#invoice-id-status").text(status)
	$("#payment-right").text(currentTotal.toLocaleString('us'));
})

$(document).on("click",".inc",function(e){
	let value = $(this).parents('td').find('input').attr('value')
	value = parseInt(value)+1
	$(this).parents('td').find('input').attr('value', value)
})

$(document).on("click",".dec",function(e){
	let value = $(this).parents('td').find('input').attr('value')
	value = parseInt(value)-1
	if (value<0) value=0
	$(this).parents('td').find('input').attr('value', value)
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
	total = parseInt(total).toLocaleString('us')
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
	total = parseInt(total).toLocaleString('us')
	$(this).parents('tr').attr('payment',total);
	$('#hd'+orderId+' table tr.total').find("td:eq(2)").text(total)
	$('#hd'+orderId+' table button.payment').find("td:eq(2)").text(total)
	$(this).parents('tr').children('.total').text(total)
});

$(document).on("click",".payment",function(e){
	let listOrderId = []
	let listBeforeStatus = []
	let beforeStatus = $(this).parents('table').attr('status')
	let orderId = $(this).parents('table').attr('orderId')
	listOrderId.push(orderId)
	listBeforeStatus.push(beforeStatus)

	let formData = {
		storeId: storeId,
		listOrderId: listOrderId,
		listBeforeStatus: listBeforeStatus
	}

	$('#hd'+orderId).modal('toggle')

	$.ajax({
		type:'POST',
		url:rootPath+'/payment-done',
		data: formData
	}).done(function(result) {
		console.log(result)
	}).fail(function() {
		console.log('false')
	})
})

$(document).on("click","#thanh-toan-tat-ca",function(e){
	var listBeforeStatus = []
	var listOrderId = []
	for (var i in paymentAll) {
		listOrderId.push(paymentAll[i].orderId)
	}
	
	for (var i in listOrderId) {
		let beforeStatus = $('#order-'+storeId+'-'+listOrderId[i]).attr('status')
		listBeforeStatus.push(beforeStatus)
	}
	
	listBeforeStatus = JSON.parse('[' + listBeforeStatus + ']')
	let formData = {
		storeId: storeId,
		listOrderId: listOrderId,
		listBeforeStatus: listBeforeStatus
	}

	console.log(formData)
	$.ajax({
		type:'POST',
		url:rootPath+'/payment-done',
		data: formData
	}).done(function(result) {
		console.log(result)
		$('#payment-right').html('')
		$('#invoice-id').html('')
	}).fail(function() {
		console.log('false')
	})
	paymentAll = []
	
})

$(document).on("click","#in-tat-ca",function(e){
	$('#multi-payments').removeClass('hidden')
	let currentInvoices = $('#invoice-id').text()
	currentInvoices = JSON.parse('[' + currentInvoices + ']')
	let formData = {
		storeId: storeId,
		listOrderId: currentInvoices
	}
	console.log(formData)
	$.ajax({
		type:'POST',
		url:rootPath+'/api/v1/all-payments',
		data: formData
	}).done(function(result) {
		console.log(result)
		let output = '<table id="multi-payment" class="table table-hover red-blue-table" data-toggle="table" style="margin-top: 10px;"> <thead> <tr> <th>Tên</th> <th>Giá</th> <th>SL</th> <th>Thành tiền</th> </tr> </thead> <tbody>'
		var sum=0
		for (var i in result.details) {
			var foodId = result.details[i].id
			var name = result.details[i].name
			var price = result.details[i].price
			price = parseInt(price)/1000
			var quantity = result.details[i].quantity
			let total = quantity*price
			total = parseInt(total)
			sum+=total
			output+='<tr> <td class="food">'+name+'</td> <td>'+price.toLocaleString('us')+'</td> <td>'+quantity+'</td> <td>'+total.toLocaleString('us')+'</td> </tr>'
		}
		sum = sum
		let locationFee = result.locationFee[0].locationFee
		locationFee = parseInt(locationFee)/1000
		let thanhTien = $('#payment-right').text().replace(',','')
		thanhTien = parseInt(thanhTien)/1000	
		output+='</tbody> <tfoot>'
		output+='<tr> <td colspan="2"></td> <td class="ta-right"> Phụ phí: </td> <td>'+locationFee.toLocaleString('us')+'</td> </tr>'
		output+='<tr> <td colspan="2"></td> <td class="ta-right"> Tổng tiền: </td> <td>'+(sum+locationFee).toLocaleString('us')+'</td> </tr>'
		output+='<tr class="total"> <td colspan="2"></td> <td class="ta-right"> Thành tiền: </td> <td>'+parseInt(thanhTien).toLocaleString('us')+'</td> </tr>'
		output+='</tfoot></table>'
		$('#multi-payments').html(output)
		html2canvas($('#multi-payment')[0], {
			onrendered: function (canvas) {
				var data = canvas.toDataURL();
				var docDefinition = {
					content: [{
						image: data,
						width: 500
					}]
				};
				pdfMake.createPdf(docDefinition).download("Invoice.pdf");
				$('#multi-payments').addClass('hidden')
			}
		})

	}).fail(function() {
		console.log('false')
	})

})

$(document).on("click",".excel",function(e){

	let orderId = $(this).parents('table').attr('orderId')
	var ExportButtons = document.getElementById('modal-'+orderId);
	var instance = new TableExport(ExportButtons, {
		formats: ['xlsx'],
		exportButtons: false
	});
	var exportData = instance.getExportData()['modal-'+orderId]['xlsx'];
	instance.export2file(exportData.data, exportData.mimeType, exportData.filename, exportData.fileExtension);
})

$(document).on("click",".pdf",function(e){

	let orderId = $(this).parents('table').attr('orderId')
	html2canvas($('#modal-'+orderId)[0], {
		onrendered: function (canvas) {
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
})

$(document).on("click",".rollback",function(e){
	var orderId = $(this).parents('tr').attr('orderId')
	var status = $(this).parents('tr').attr('status')
	let formData = {
		storeId: storeId,
		orderId: orderId,
		status: status
	}
	console.log(formData)
	$('#rollback-'+storeId+'-'+orderId).addClass('hidden')
	$.ajax({
		type:'POST',
		url:rootPath+'/rollback-payment',
		data: formData
	}).done(function(result) {
		console.log(result)
	}).fail(function() {
		console.log('false')
	});
})

var pusher = new Pusher(process.env.MIX_PUSHER_APP_KEY, {
	cluster: process.env.MIX_PUSHER_APP_CLUSTER,
	encrypted: true
});

var order2chef = pusher.subscribe(md5(storeId)+'-'+Order2Cashier);
order2chef.bind(Order2Other, function(res) {
	loadCashierTable()
})

var cashier2cashier = pusher.subscribe(md5(storeId)+'-cashier2cashier')
cashier2cashier.bind('payment-done', function(res) {
	var listOrderId = res.listOrderId
	var listBeforeStatus = res.status
	let status = res.status
	for (var i in listOrderId) {
		let obj = {
			orderId: listOrderId[i],
			status: listBeforeStatus[i]
		}
		console.log(obj)
		$('#order-'+storeId+'-'+listOrderId[i]).addClass('hidden')
		pushToRollbackTable(obj)
	}
})

cashier2cashier.bind('rollback-payment', function(res) {
	var orderId = res.orderId
	/*$('#rollback-'+storeId+'-'+orderId).addClass('hidden')*/
	if ($('#order-'+storeId+'-'+orderId)[0]) {
		$('#order-'+storeId+'-'+orderId).removeClass('hidden')
	} else {
		loadCashierTable()
	}
	if ($('#rollback-'+storeId+'-'+orderId)[0]) {
		$('#rollback-'+storeId+'-'+orderId).addClass('hidden')
	} else {
		loadRollbackTable()
	}
})

function SaveDataToLocalStorage(obj)
{
	let cashierRollback = localStorage.getObj('cashierRollback')
	if (cashierRollback!=null);
	else cashierRollback = []
		cashierRollback.push(obj)
	localStorage.setObj('cashierRollback',cashierRollback)
}

function RemoveDataFromLocalStorage(obj)
{
	let cashierRollback = localStorage.getObj('cashierRollback')
	if (cashierRollback!=null);
	else return
		const dataRemoved = cashierRollback.filter((el) => {
			return el.orderId !== obj.orderId
		})
	localStorage.setObj('cashierRollback',dataRemoved)
}

