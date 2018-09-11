<div id="messages1">List order:</div>
<ul id="messages" class="list-group"></ul>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://js.pusher.com/4.1/pusher.min.js"></script>
<script>
    $(document).ready(function(){
        var pusher = new Pusher('{{env('PUSHER_APP_KEY')}}', {
            cluster: '{{env('PUSHER_APP_CLUSTER')}}',
            encrypted: true
        });
        var channel = pusher.subscribe('{{\App\Core\Common\OrderConst::OrderChannelToWaiter}}');
        var eventName= "{{\App\Core\Common\OrderConst::OrderEventName}}";
        channel.bind(eventName, addOrder);
    });
    //function add message
    function addOrder(data) {
        var entity = JSON.stringify(data.entity);
        var liTag = $("<li class='list-group-item'></li>");
        var order = "";
        $.each(data.entity,function(index,item){
            order+=item.id+"-"+item.quantity+"-"+item.price+"<br>";
        });
        liTag.html(order);
        $('#messages').append(liTag);
    }
</script>
