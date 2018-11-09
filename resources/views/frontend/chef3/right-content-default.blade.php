<!-- <div id="cho-cung-ung"></div>

<script>
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
</script>

<script>
	$(document).ready(function() {
		loadJSON("http://store.dev/api/v1/store/1/chef/17.json", function(response) {

			var actual_JSON = JSON.parse(response);
			console.log(actual_JSON);
		});

		$.ajax({
			type: "GET",
			dataType: 'json',
			url: "http://store.dev/api/v1/store/1/chef/17.json",
			success: function(res)
			{
				result = res;
				console.log(result);
				var output='<table id="cho-cung-ung" class="table table-hover red-blue-table"> <thead> <tr> <th colspan="2" style="width:40%">Hóa đơn</th> <th colspan="2" style="width:60%">Bàn/Phòng/Tầng</th> </tr> </thead> <tbody>';
				for (var i in result.orders)
				{
					var id = result.orders[i].id;
					var name = result.orders[i].name;
					output+='<tr class="t-header"> <td colspan="2"> <button type="button" class="t-header-collapse btn btn-primary"> <span>+</span>'+id+'</button> </td> <td colspan="2"> <button type="button" class="btn btn-primary"> <span class="badge badge-secondary">'+name+'</span> </button> </td> </tr><tr class="t-header-child"> <th style="width: 25%">Tên món</th> <th style="width: 15%">SL</th> <th style="width: 40%">Trạng thái</th> <th style="width: 20%"></th> </tr>';
					for (var i in result.details) {
						var name = result.details[i].name;
						var cooked = result.details[i].cooked;
						var quantity = result.details[i].quantity;
						output+='<tr> <td class="food food-right">'+name+'</td> <td>'+cooked+'/'+quantity+'</td> <td> <button type="button" class="btn btn-primary btn-sm">Đã nấu: <span class="badge badge-secondary">'+cooked+'</span></button> <button type="button" class="btn-group-kitchen btn btn-danger btn-sm">Đang nấu: <span class="badge badge-secondary">'+(quantity-cooked)+'</span></button> </td> <td> <button class="btn btn-warning"><i class="fa fa-angle-right"></i></button> <button class="btn-group-kitchen btn btn-danger"><i class="fa fa-angle-double-right"></i></button> </td> </tr>';
					}
				}
				output+="<tfoot></tfoot> </tbody> </table>";
			}
		});
		console.log(output);
		$('cho-cung-ung').html(output);
	});
</script>
<script>
	$('push-food').click(function(){
		var id = $(this ~ tr).attr("id");
		$.ajax(type: "POST",
			url: "/store/1/order/39/food/"+id+"/update",
			data: "id="+id,
			success: function(msg){
				$(id).remove();
			});
	});
	$("push-food").click(function(e) {
        /*e.preventDefault();*/
        var id = $(this ~ tr).attr("id");
        var formData = {
            /*_token: _token,*/
            storeId: storeId,
            orderId: orderId,
            foodId: foodId
        };
        $.ajax({
           type:"POST",
           url:"http:\/\/store.dev\/store\/1\/order\/39\/food\/"+id+"\/update",
           data: formData
        }).done(function(result) {
            
        }).fail(function() {
            
        });
    });
</script> -->