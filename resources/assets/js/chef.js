storeId = $('#config').attr('storeId')
	//js here
	$(document).ready(function(){
		$("#header-left a").click(function(){
			$(this).tab('show');
		});
		loadWaiterTable();
		loadRollbackTable();
	});

	function loadRollbackTable() {
		var output='<table id="roll-back" class="table table-hover red-blue-table" data-toggle="table" data-search="true"> <thead> <tr> <th style="width: 35%" data-field="name">Tên món</th> <th style="width:15%" data-field="invoice">Hóa đơn</th> <th style="width: 10%" data-field="quantity">SL</th> <th style="width: 30%" data-field="action">Thao tác</th> <th style="width: 20%"></th> </tr> </thead> <tbody id="rollback-body">';
		output+="</tbody> <tfoot></tfoot> </table>";
		$('#hoan-tac').html(output)
	}

	function pushToloadRollbackTable(obj) {
		var current = $('#rollback-body').html();
		var newRow = '<tr id="'+obj.id+'" storeId="'+obj.storeId+'" orderId="'+obj.orderId+'" foodId="'+obj.foodId+'" push="'+obj.push+'"> <td>'+obj.foodName+'</td> <td> <button type="button" class="btn btn-primary">#HĐ '+obj.orderId+'</button> </td> <td>'+obj.quantity+'</td> <td> <button type="button" class="btn btn-primary">Chuyển: <span class="badge badge-secondary">'+obj.push+'</span></button> </td> <td> <button class="btn btn-success"><i class="fa fa-undo rollback"></i></button> </td> </tr>'
		current = newRow + current;
		$('#rollback-body').html(current)
	}

	function loadWaiterTable() {
		loadJSON('http://store.dev/api/v1/store/'+storeId+'/chef_order_detail.json', function(response) {
			var result = JSON.parse(response);
			var output='<table id="cho-cung-ung" class="table table-hover red-blue-table" data-toggle="table" data-search="true"> <thead> <tr> <th colspan="2" style="width:40%">Hóa đơn</th> <th colspan="2" style="width:60%">Bàn/Phòng/Tầng</th> </tr> </thead> <tbody>';
			for (var i in result.orders)
			{
				var id = result.orders[i].id;
				var name = result.orders[i].name;
				if (result.details[i].length!=0) {
					output+='<tr class="t-header '+storeId+'-'+id+'"> <td colspan="2"> <button type="button" class="t-header-collapse btn btn-primary"> <span>+</span>#HĐ '+id+'</button> </td> <td colspan="2"> <button type="button" class="btn btn-primary"> <span class="badge badge-secondary">'+name+'</span> </button> </td> </tr><tr class="t-header-child '+storeId+'-'+id+'"> <th style="width: 25%">Tên món</th> <th style="width: 15%">SL</th> <th style="width: 40%">Trạng thái</th> <th style="width: 20%"></th> </tr>';
					for (var j in result.details[i]) {
						var foodId = result.details[i][j].id;
						var name = result.details[i][j].name;
						var cooked = result.details[i][j].cooked;
						var quantity = result.details[i][j].quantity;
						output+='<tr id="'+storeId+'-'+id+'-'+foodId+'" storeId="'+storeId+'" orderId="'+id+'" foodId="'+foodId+'" foodName="'+name+'" quantity="'+quantity+'"> <td class="food food-right">'+name+'</td> <td>'+cooked+'/'+quantity+'</td> <td> <button type="button" class="btn btn-primary btn-sm">Đã nấu: <span class="badge badge-secondary">'+cooked+'</span></button> <button type="button" class="btn-group-kitchen btn btn-danger btn-sm">Đang nấu: <span class="badge badge-secondary">'+(quantity-cooked)+'</span></button> </td> <td> <button cooked="'+(cooked+1)+'" push="1" class="btn btn-warning push-food"><i class="fa fa-angle-right"></i></button> <button cooked="'+quantity+'" push="'+(quantity-cooked)+'" class="btn-group-kitchen btn btn-danger push-food"><i class="fa fa-angle-double-right"></i></button> </td> </tr>';
					}
				}
			}
			output+="<tfoot></tfoot> </tbody></table><script>$('tr.t-header').nextUntil('tr.t-header').slideToggle(0, function(){}); $('.t-header-collapse').click(function(){ $(this).find('span:first-child').text(function(_, value){return value=='-'?'+':'-'}); $(this).parents('tr').nextUntil('tr.t-header').slideToggle(100, function(){ }); });$('push-food').click(function(e) { /*e.preventDefault();*/ var id = $(this).parents('tr').attr('id'); var formData = { /*_token: _token,*/ storeId: storeId, orderId: orderId, foodId: foodId }; $.ajax({ type:'POST', url:'http:\/\/store.dev\/store\/1\/order\/39\/food\/"+id+"\/update', data: formData }).done(function(result) { }).fail(function() { }); });</script>";
			$('#uu-tien').html(output);
		});
	}

	$(document).on("click",".push-food",function(e){
		/*e.preventDefault();*/
		var orderId = $(this).parents('tr').attr('orderId');
		var foodId = $(this).parents('tr').attr('foodId');
		var foodName = $(this).parents('tr').attr('foodName');
		var quantity = $(this).parents('tr').attr('quantity');
		var cooked = $(this).attr('cooked');
		var push = $(this).attr('push');
		let formData = {
			storeId: storeId,
			orderId: orderId,
			foodId: foodId,
			cooked: cooked
		};
		var date = new Date();
		var currentTime = date.getTime();
		let obj = {
			storeId: storeId,
			foodId: foodId,
			foodName: foodName,
			orderId: orderId,
			quantity: quantity,
			cooked: cooked,
			push: push,
			id: 'rollback-'+storeId+'-'+orderId+'-'+foodId+'-'+currentTime
		};
		pushToloadRollbackTable(obj)
		$.ajax({
			type:'POST',
			url:'/update',
			data: formData
		}).done(function(result) {
			console.log(result)
		}).fail(function() {
			console.log('false')
		});
	});

	$(document).on("click",".rollback",function(e){
		/*e.preventDefault();*/
		var orderId = $(this).parents('tr').attr('orderId');
		var foodId = $(this).parents('tr').attr('foodId');
		var push = $(this).parents('tr').attr('push');
		let id = $(this).parents('tr').attr('id');
		let formData = {
			storeId: storeId,
			orderId: orderId,
			foodId: foodId,
			push: push
		};
		$('#'+id).addClass('hidden')
		$.ajax({
			type:'POST',
			url:'/rollback',
			data: formData
		}).done(function(result) {
			console.log(result)
		}).fail(function() {
			console.log('false')
		});
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

/*$('tr.t-header2').nextUntil('tr.t-header2').slideToggle(0, function(){

});
$('.t-header2-collapse').click(function(){
	$(this).find('span:first-child').text(function(_, value){return value=='-'?'+':'-'});
	$(this).parents('tr').nextUntil('tr.t-header2').slideToggle(100, function(){

	});
});*/

var pusher = new Pusher(process.env.MIX_PUSHER_APP_KEY, {
	cluster: process.env.MIX_PUSHER_APP_CLUSTER,
	encrypted: true
});

var order2chef = pusher.subscribe('1-order2chef');
order2chef.bind('new-order', function(res) {
	var count = $('#order-list').bootstrapTable('getData').length;
	res.entity.forEach( function(item) {
		$('#order-list').bootstrapTable('insertRow',{
			index: count,
			row: {name: item.name, id: res.orderId, priority: res.priority, quantity: item.quantity}
		});
		$('#order-trend').bootstrapTable('refresh');
	});
	loadWaiterTable();
});

var waiter2waiter = pusher.subscribe('1-waiter2waiter')
waiter2waiter.bind('update-order-cooked', function(res) {
	console.log(res)
	var orderId = res.orderId
	var foodId = res.foodId
	var quantity = res.quantity
	var clear = res.clear
	var cooked = res.cooked
	var cooked1 = parseInt(cooked)+1
	var detectOrder = '.'+storeId+'-'+orderId
	console.log(detectOrder)
	var detect = '#'+storeId+'-'+orderId+'-'+foodId
	if (clear==1) $(detectOrder).addClass('hidden')
		if (clear==2) $(detectOrder).removeClass('hidden')
			if (quantity!=cooked) {
				$(detect+' td').eq(1).html(cooked+'/'+quantity)
				$(detect+' td').eq(2).html('<td> <button type="button" class="btn btn-primary btn-sm">Đã nấu: <span class="badge badge-secondary">'+cooked+'</span></button> <button type="button" class="btn-group-kitchen btn btn-danger btn-sm">Đang nấu: <span class="badge badge-secondary">'+(quantity-cooked)+'</span></button> </td>')
				$(detect+' td').eq(4).html('<td> <button cooked="'+(cooked1)+'" push="1" class="btn btn-warning push-food"><i class="fa fa-angle-right"></i></button> <button cooked="'+quantity+'" push="'+(quantity-cooked)+'" class="btn-group-kitchen btn btn-danger push-food"><i class="fa fa-angle-double-right"></i></button> </td>')
			}
			else $(detect).addClass('hidden')
				if (clear==2) $(detect).removeClass('hidden')
			});