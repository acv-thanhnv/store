<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Real-time notifications in Laravel using Pusher</title>
 
  </head>
  <body>
    Test invoice: <div id="res"></div>
 
    <!-- Incldue Pusher Js Client via CDN -->
    <script src="https://js.pusher.com/4.2/pusher.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Alert whenever a new notification is pusher to our Pusher Channel -->
 
    <script>
    var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
      cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
      encrypted: true
    });
 
    var channel = pusher.subscribe('notify');
    channel.bind('acv-quangpkv', function(message) {
        $('#res').text(message);
    });
 
    </script>
  </body>
  
</html>