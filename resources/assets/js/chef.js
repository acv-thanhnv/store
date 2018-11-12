const storeId = $('#config').attr('storeId')

const rootPath = $('#config').attr('rootPath')

$(document).ready(function(){
	$("#header-left a").click(function(){
		$(this).tab('show');
	});
	loadWaiterTable()
	loadRollbackTable()
	loadOrderListTable()
});

function pushToOrderListTable(result) {
	console.log(result)
	var output=''
	var orderId = result.orderDetails[0].order_id
	var table = result.orderDetails[0].table
	var floor = result.orderDetails[0].floor
	var priority = result.orderDetails[0].priority

	for (var i in result.foodDetails) {
		let foodId = result.foodDetails[i].food_id
		let foodName = result.foodDetails[i].food_name
		let quantity = result.foodDetails[i].quantity
		let cooked = 0

		if (priority!=='Normal') {
			output='<tr id="foodlist-'+storeId+'-'+orderId+'-'+foodId+'" class="vip"> <td class="food food-left"><span>'+foodName+'</span></td> <td>#HĐ '+orderId+'</td> <td><span class="badge badge-secondary">'+priority+'</span></td> <td>'+quantity+'</td> </tr>'
			$('#order-list').find('.vip:last').after(output)
		}
		else {
			output='<tr id="foodlist-'+storeId+'-'+orderId+'-'+foodId+'" class="normal"> <td class="food food-left"><span>'+foodName+'</span></td> <td>#HĐ '+orderId+'</td> <td></td> <td>'+quantity+'</td> </tr>'
			$('#order-list').find('.normal:last').after(output)
		}
	}
}

function loadOrderListTable() {
	loadJSON(rootPath+'/api/v1/store/'+storeId+'/chef_order_detail.json', function(response) {
		var result = JSON.parse(response)
		var output='<table id="order-list" class="table table-hover red-blue-table" data-search="true" data-toggle="table"> <thead> <tr> <th style="width: 55%" data-field="name">Tên món</th> <th style="width: 20%" data-field="id" data-sortable="true">Hóa đơn</th> <th style="width: 15%" data-field="priority" data-sortable="true">VIP</th> <th style="width: 10%" data-field="quantity">SL</th> </tr> </thead> <tbody id="order-list-table-body">'
		for (var i in result.orders)
		{
			var orderId = result.orders[i].id
			var priority = result.orders[i].priority
			for (var j in result.details[i]) {
				var foodId = result.details[i][j].id
				var foodName = result.details[i][j].name
				var quantity = result.details[i][j].quantity
				if (priority!=='Normal') output+='<tr id="foodlist-'+storeId+'-'+orderId+'-'+foodId+'" class="vip"> <td class="food food-left"><span>'+foodName+'</span></td> <td>#HĐ '+orderId+'</td> <td><span class="badge badge-secondary">'+priority+'</span></td> <td>'+quantity+'</td> </tr>'
					else output+='<tr id="foodlist-'+storeId+'-'+orderId+'-'+foodId+'" class="normal"> <td class="food food-left"><span>'+foodName+'</span></td> <td>#HĐ '+orderId+'</td> <td></td> <td>'+quantity+'</td> </tr>'
				}
		}
		output+="</tbody> <tfoot></tfoot> </table>"
		$('#order-list-left').html(output)
	})
}

function pushToloadRollbackTable(obj) {
	var current = $('#rollback-body').html();
	var newRow = '<tr id="rollback-'+storeId+'-'+obj.orderId+'-'+obj.foodId+'-'+obj.time+'" storeId="'+storeId+'" orderId="'+obj.orderId+'" foodId="'+obj.foodId+'" quantity="'+obj.quantity+'" push="'+obj.cooked+'" time="'+obj.time+'"> <td>'+obj.foodName+'</td> <td> <button type="button" class="btn btn-primary">#HĐ '+obj.orderId+'</button> </td> <td>'+obj.quantity+'</td> <td> <button type="button" class="btn btn-primary">Chuyển: <span class="badge badge-secondary">'+obj.push+'</span></button> </td> <td> <button class="btn btn-success"><i class="fa fa-undo rollback"></i></button> </td> </tr>'
	current = newRow + current;
	$('#rollback-body').html(current)
}

function loadRollbackTable() {
	loadJSON(rootPath+'/api/v1/store/'+storeId+'/chef_rollback.json', function(response) {
		var result = JSON.parse(response)
		var output='<table id="roll-back" class="table table-hover red-blue-table" data-toggle="table" data-search="true"> <thead> <tr> <th style="width: 35%" data-field="name">Tên món</th> <th style="width:15%" data-field="invoice">Hóa đơn</th> <th style="width: 10%" data-field="quantity">SL</th> <th style="width: 30%" data-field="action">Thao tác</th> <th style="width: 20%"></th> </tr> </thead> <tbody id="rollback-body">'
		for (var i in result)
		{
			let orderId = result[i].order_id
			let foodId = result[i].food_id
			let foodName = result[i].name
			let quantity = result[i].quantity
			let cooked = result[i].cooked
			let push = cooked
			let time = result[i].time
			output+='<tr id="rollback-'+storeId+'-'+orderId+'-'+foodId+'-'+time+'" storeId="'+storeId+'" orderId="'+orderId+'" foodId="'+foodId+'" quantity="'+quantity+'" push="'+cooked+'" time="'+time+'"> <td>'+foodName+'</td> <td> <button type="button" class="btn btn-primary">#HĐ '+orderId+'</button> </td> <td>'+quantity+'</td> <td> <button type="button" class="btn btn-primary">Chuyển: <span class="badge badge-secondary">'+push+'</span></button> </td> <td> <button class="btn btn-success"><i class="fa fa-undo rollback"></i></button> </td> </tr>'
		}
		output+="</tbody> <tfoot></tfoot> </table>"
		$('#hoan-tac').html(output)
	})
}

function pushToWaiterTable(result) {
	var output=''
	var orderId = result.orderDetails[0].order_id
	var table = result.orderDetails[0].table
	var floor = result.orderDetails[0].floor
	var priority = result.orderDetails[0].priority
	if ( $('.'+storeId+'-'+orderId)[0] ) {
		for (var i in result.foodDetails) {
			var foodId = result.foodDetails[i].food_id
			var foodName = result.foodDetails[i].food_name
			var quantity = result.foodDetails[i].quantity
			var cooked = 0
			output+='<tr id="'+storeId+'-'+orderId+'-'+foodId+'" class="hidden '+storeId+'-'+orderId+'" storeId="'+storeId+'" orderId="'+orderId+'" foodId="'+foodId+'" foodName="'+name+'" quantity="'+quantity+'"> <td class="food food-right">'+foodName+'</td> <td>'+cooked+'/'+quantity+'</td> <td> <button type="button" class="btn btn-primary btn-sm">Đã nấu: <span class="badge badge-secondary">'+cooked+'</span></button> <button type="button" class="btn-group-kitchen btn btn-danger btn-sm">Đang nấu: <span class="badge badge-secondary">'+(quantity-cooked)+'</span></button> </td> <td> <button cooked="'+(cooked+1)+'" push="1" class="btn btn-warning push-food"><i class="fa fa-angle-right"></i></button> <button cooked="'+quantity+'" push="'+(quantity-cooked)+'" class="btn-group-kitchen btn btn-danger push-food"><i class="fa fa-angle-double-right"></i></button> </td> </tr>'
		}
		$('#cho-cung-ung').find('.'+storeId+'-'+orderId+':last').after(output)
	}
	else {
		if (priority!=='Normal') output+='<tr class="t-header vip '+storeId+'-'+orderId+'"> <td colspan="2"> <button type="button" class="t-header-collapse btn btn-primary order-detail"> <span>+</span>#HĐ '+orderId+'</button> </td> <td colspan="2"> <button type="button" class="btn btn-primary"> <span class="badge badge-secondary">'+table+' '+floor+'</span> </button> </td> </tr>'
			else output+='<tr class="t-header normal '+storeId+'-'+orderId+'"> <td colspan="2"> <button type="button" class="t-header-collapse btn btn-primary order-detail"> <span>+</span>#HĐ '+orderId+'</button> </td> <td colspan="2"> <button type="button" class="btn btn-primary"> <span class="badge badge-secondary">'+table+' '+floor+'</span> </button> </td> </tr>'
				output+='<tr class="hidden t-header-child '+storeId+'-'+orderId+'"> <th style="width: 25%">Tên món</th> <th style="width: 15%">SL</th> <th style="width: 40%">Trạng thái</th> <th style="width: 20%"></th> </tr>'
			for (var i in result.foodDetails) {
				var foodId = result.foodDetails[i].food_id
				var foodName = result.foodDetails[i].food_name
				var quantity = result.foodDetails[i].quantity
				var cooked = 0
				output+='<tr id="'+storeId+'-'+orderId+'-'+foodId+'" class="hidden '+storeId+'-'+id+'" storeId="'+storeId+'" orderId="'+orderId+'" foodId="'+foodId+'" foodName="'+name+'" quantity="'+quantity+'"> <td class="food food-right">'+foodName+'</td> <td>'+cooked+'/'+quantity+'</td> <td> <button type="button" class="btn btn-primary btn-sm">Đã nấu: <span class="badge badge-secondary">'+cooked+'</span></button> <button type="button" class="btn-group-kitchen btn btn-danger btn-sm">Đang nấu: <span class="badge badge-secondary">'+(quantity-cooked)+'</span></button> </td> <td> <button cooked="'+(cooked+1)+'" push="1" class="btn btn-warning push-food"><i class="fa fa-angle-right"></i></button> <button cooked="'+quantity+'" push="'+(quantity-cooked)+'" class="btn-group-kitchen btn btn-danger push-food"><i class="fa fa-angle-double-right"></i></button> </td> </tr>'
			}
			if (priority!=='Normal') $('#cho-cung-ung').find('.normal:first').before(output)
				else $('#cho-cung-ung').find('.hidden:last').after(output)
			}
	}

	function loadWaiterTable() {
		loadJSON(rootPath+'/api/v1/store/'+storeId+'/chef_order_detail.json', function(response) {
			var result = JSON.parse(response);
			var output='<table id="cho-cung-ung" class="table table-hover red-blue-table" data-toggle="table" data-search="true"> <thead> <tr> <th colspan="2" style="width:40%">Hóa đơn</th> <th colspan="2" style="width:60%">Bàn/Phòng/Tầng</th> </tr> </thead> <tbody>'
			for (var i in result.orders)
			{
				var id = result.orders[i].id
				var name = result.orders[i].name
				var priority = result.orders[i].priority
				let floor = result.orders[i].floor
				if (result.details[i].length!=0) {
					if (priority!=='Normal') output+='<tr class="t-header vip '+storeId+'-'+id+'"> <td colspan="2"> <button type="button" class="t-header-collapse btn btn-primary order-detail"> <span>+</span>#HĐ '+id+'</button> </td> <td colspan="2"> <button type="button" class="btn btn-primary"> <span class="badge badge-secondary">'+name+' '+floor+'</span> </button> </td> </tr>'
						else output+='<tr class="t-header normal '+storeId+'-'+id+'"> <td colspan="2"> <button type="button" class="t-header-collapse btn btn-primary order-detail"> <span>+</span>#HĐ '+id+'</button> </td> <td colspan="2"> <button type="button" class="btn btn-primary"> <span class="badge badge-secondary">'+name+' '+floor+'</span> </button> </td> </tr>'
							output+='<tr class="hidden t-header-child '+storeId+'-'+id+'"> <th style="width: 25%">Tên món</th> <th style="width: 15%">SL</th> <th style="width: 40%">Trạng thái</th> <th style="width: 20%"></th> </tr>'
						for (var j in result.details[i]) {
							var foodId = result.details[i][j].id;
							var name = result.details[i][j].name;
							var cooked = result.details[i][j].cooked;
							var quantity = result.details[i][j].quantity;
							output+='<tr id="'+storeId+'-'+id+'-'+foodId+'" class="hidden '+storeId+'-'+id+'" storeId="'+storeId+'" orderId="'+id+'" foodId="'+foodId+'" foodName="'+name+'" quantity="'+quantity+'" cooked="'+cooked+'"> <td class="food food-right">'+name+'</td> <td>'+cooked+'/'+quantity+'</td> <td> <button type="button" class="btn btn-primary btn-sm">Đã nấu: <span class="badge badge-secondary">'+cooked+'</span></button> <button type="button" class="btn-group-kitchen btn btn-danger btn-sm">Đang nấu: <span class="badge badge-secondary">'+(quantity-cooked)+'</span></button> </td> <td> <button cooked="'+(cooked+1)+'" push="1" class="btn btn-warning push-food"><i class="fa fa-angle-right"></i></button> <button cooked="'+quantity+'" push="'+(quantity-cooked)+'" class="btn-group-kitchen btn btn-danger push-food"><i class="fa fa-angle-double-right"></i></button> </td> </tr>';
						}
					}
				}
				output+="<tfoot id='tfoot-table'></tfoot> </tbody></table>"
								//output+="<script>$('tr.t-header').nextUntil('tr.t-header').slideToggle(0, function(){}); $('.t-header-collapse').click(function(){ $(this).find('span:first-child').text(function(_, value){return value=='-'?'+':'-'}); $(this).parents('tr').nextUntil('tr.t-header').slideToggle(100, function(){ }); });$('push-food').click(function(e) { /*e.preventDefault();*/ var id = $(this).parents('tr').attr('id'); var formData = { /*_token: _token,*/ storeId: storeId, orderId: orderId, foodId: foodId }; $.ajax({ type:'POST', url:'http:\/\/store.dev\/store\/1\/order\/39\/food\/"+id+"\/update', data: formData }).done(function(result) { }).fail(function() { }); });</script>"
								$('#uu-tien').html(output);
								/*reloadToggle()*/
							});
	}

	$(document).on("click",".push-food",function(e){
		var orderId = $(this).parents('tr').attr('orderId');
		var foodId = $(this).parents('tr').attr('foodId');
		var foodName = $(this).parents('tr').attr('foodName');
		var quantity = $(this).parents('tr').attr('quantity');
		var cooked = $(this).attr('cooked');
		cooked = parseInt(cooked)
		var cooked1 = cooked+1
		var push = $(this).attr('push')
		var date = new Date()
		var currentTime = date.getTime()
		let formData = {
			storeId: storeId,
			orderId: orderId,
			foodId: foodId,
			cooked: cooked,
			time: currentTime
		}
		console.log(formData)
		/*let obj = {
			storeId: storeId,
			foodId: foodId,
			foodName: foodName,
			orderId: orderId,
			quantity: quantity,
			cooked: cooked,
			push: push,
			id: 'rollback-'+storeId+'-'+orderId+'-'+foodId+'-'+currentTime
		}
		pushToloadRollbackTable(obj)*/
		var detect = '#'+storeId+'-'+orderId+'-'+foodId
		if (quantity!=cooked) {
			$(detect).attr('cooked', cooked)
			$(detect+' td').eq(1).html(cooked+'/'+quantity)
			$(detect+' td').eq(2).html('<button type="button" class="btn btn-primary btn-sm">Đã nấu: <span class="badge badge-secondary">'+cooked+'</span></button> <button type="button" class="btn-group-kitchen btn btn-danger btn-sm">Đang nấu: <span class="badge badge-secondary">'+(quantity-cooked)+'</span></button>')
			$(detect+' td').eq(4).html('<button cooked="'+(cooked1)+'" push="1" class="btn btn-warning push-food"><i class="fa fa-angle-right"></i></button> <button cooked="'+quantity+'" push="'+(quantity-cooked)+'" class="btn-group-kitchen btn btn-danger push-food"><i class="fa fa-angle-double-right"></i></button>')
		}
		$.ajax({
			type:'POST',
			url:rootPath+'/update',
			data: formData
		}).done(function(result) {
			console.log(result)
		}).fail(function() {
			console.log('false')
		})
	})

	$(document).on("click",".rollback",function(e){
		var orderId = $(this).parents('tr').attr('orderId');
		var foodId = $(this).parents('tr').attr('foodId');
		var push = $(this).parents('tr').attr('push')
		var quantity = $(this).parents('tr').attr('quantity')
		quantity = parseInt(quantity)
		var cooked = $('#'+storeId+'-'+orderId+'-'+foodId).attr('cooked')
		cooked = parseInt(cooked)
		var cooked1 = cooked+1
		cooked = cooked - push
		if (cooked<0) cooked=0
			let time = $(this).parents('tr').attr('time')
		let id = $(this).parents('tr').attr('id');
		var detect = '#'+storeId+'-'+orderId+'-'+foodId
		let test = {
			push: push,
			quantity: quantity,
			cooked: cooked,
			cooked1: cooked1
		}
		console.log(test)

		if (quantity!=cooked) {
			$(detect).attr('cooked', cooked)
			$(detect+' td').eq(1).html(cooked+'/'+quantity)
			$(detect+' td').eq(2).html('<button type="button" class="btn btn-primary btn-sm">Đã nấu: <span class="badge badge-secondary">'+cooked+'</span></button> <button type="button" class="btn-group-kitchen btn btn-danger btn-sm">Đang nấu: <span class="badge badge-secondary">'+(quantity-cooked)+'</span></button>')
			$(detect+' td').eq(4).html('<button cooked="'+(cooked1)+'" push="1" class="btn btn-warning push-food"><i class="fa fa-angle-right"></i></button> <button cooked="'+quantity+'" push="'+(quantity-cooked)+'" class="btn-group-kitchen btn btn-danger push-food"><i class="fa fa-angle-double-right"></i></button>')
		} else {

		}

		$('#rollback-'+storeId+'-'+orderId+'-'+foodId+'-'+time).addClass('hidden')

		let formData = {
			storeId: storeId,
			orderId: orderId,
			foodId: foodId,
			push: push,
			time: time
		};
		
		$.ajax({
			type:'POST',
			url:rootPath+'/rollback',
			data: formData
		}).done(function(result) {
			console.log(result)
			$(this).parents('tr').addClass('hidden')
		}).fail(function() {
			console.log('false')
		});
	});

	$(document).on("click",".order-detail",function(e){
		if ( $(this).find("span:first").text() !== '-' ) {
			$(this).parents('tr').nextUntil('tr.t-header').removeClass('hidden')
			$(this).find("span:first").text('-')
		} else {
			$(this).parents('tr').nextUntil('tr.t-header').addClass('hidden')
			$(this).find("span:first").text('+')
		}
	})

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

document.getElementById("search").addEventListener("keyup", searchFor)
function searchFor() {
	var input, filter, table, tr, td, i, cl=false;
	input = document.getElementById("search");
	filter = input.value.toUpperCase();
	cl = filter?true:false;
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
		$('.t-header-child').nextUntil('.t-header').slideToggle(0, function(){});
	}
}

var pusher = new Pusher(process.env.MIX_PUSHER_APP_KEY, {
	cluster: process.env.MIX_PUSHER_APP_CLUSTER,
	encrypted: true
});

var order2kitchen = pusher.subscribe(md5(storeId)+'-order2kitchen');
order2kitchen.bind('update-order-at-kichen', function(res) {
	pushToOrderListTable(res)
	pushToWaiterTable(res)
})

var waiter2waiter = pusher.subscribe(md5(storeId)+'-waiter2waiter')
waiter2waiter.bind('update-order-at-kichen', function(res) {
	loadRollbackTable()
	loadOrderListTable()
	console.log(res)
	var time = res.time
	var orderId = res.orderId
	var foodId = res.foodId
	var quantity = res.quantity
	var clearAll = res.clearAll
	var rollback = res.rollback
	var cooked = res.cooked
	var cooked1 = parseInt(cooked)+1
	var detectOrder = '.'+storeId+'-'+orderId
	var detect = '#'+storeId+'-'+orderId+'-'+foodId
	var detectRollback = '#rollback-'+storeId+'-'+orderId+'-'+foodId+'-'+time
	var foodName = $(detect).attr('foodName')
	if (!rollback) {
		let obj = {
			storeId: storeId,
			foodId: foodId,
			foodName: foodName,
			orderId: orderId,
			quantity: quantity,
			push: cooked,
			id: 'rollback-'+storeId+'-'+orderId+'-'+foodId+'-'+time
		}
		console.log(obj)
		pushToloadRollbackTable(obj)
		if (clearAll==1) {
			$(detectOrder).addClass('hidden')
			loadWaiterTable()
		}
			if (quantity!=cooked) {
				$(detect+' td').eq(1).html(cooked+'/'+quantity)
				$(detect+' td').eq(2).html('<button type="button" class="btn btn-primary btn-sm">Đã nấu: <span class="badge badge-secondary">'+cooked+'</span></button> <button type="button" class="btn-group-kitchen btn btn-danger btn-sm">Đang nấu: <span class="badge badge-secondary">'+(quantity-cooked)+'</span></button>')
				$(detect+' td').eq(4).html('<button cooked="'+(cooked1)+'" push="1" class="btn btn-warning push-food"><i class="fa fa-angle-right"></i></button> <button cooked="'+quantity+'" push="'+(quantity+cooked)+'" class="btn-group-kitchen btn btn-danger push-food"><i class="fa fa-angle-double-right"></i></button>')
			}
			else $(detect).addClass('hidden')
		} else {
			$(detectRollback).addClass('hidden')
			$(detectOrder).removeClass('hidden')
			$(detect).removeClass('hidden')
			if ( (!$(detect).length) || (!$(detectOrder).length) ) loadWaiterTable()
				if (quantity!=cooked) {
					$(detect).attr('cooked', cooked)
					$(detect+' td').eq(1).html(cooked+'/'+quantity)
					$(detect+' td').eq(2).html('<button type="button" class="btn btn-primary btn-sm">Đã nấu: <span class="badge badge-secondary">'+cooked+'</span></button> <button type="button" class="btn-group-kitchen btn btn-danger btn-sm">Đang nấu: <span class="badge badge-secondary">'+(quantity-cooked)+'</span></button>')
					$(detect+' td').eq(4).html('<button cooked="'+(cooked1)+'" push="1" class="btn btn-warning push-food"><i class="fa fa-angle-right"></i></button> <button cooked="'+quantity+'" push="'+(quantity+cooked)+'" class="btn-group-kitchen btn btn-danger push-food"><i class="fa fa-angle-double-right"></i></button>')
				} else {

				}
			}
		})