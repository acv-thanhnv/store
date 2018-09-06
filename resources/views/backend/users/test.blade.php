<!DOCTYPE html>
<html>
<head>
	<title>test</title>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/izimodal/1.5.1/css/iziModal.css">
	<script src="https://code.jquery.com/jquery-2.2.4.js"></script>
</head>
<body>
  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<!-- Modal structure -->
<button class="open-default button">default</button>
<div id="modal-default">
  <div class="close">
    <a data-izimodal-close="">×</a>
  </div>
  <p>1232132131</p>
</div>
</body>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/izimodal/1.5.1/js/iziModal.js"></script>
</html>
<script type="text/javascript">
	var $=jQuery.noConflict();
	$(document).on('click', '.open-default', function(event) {
  event.preventDefault();
  $('#modal-default').iziModal('open');
});
$('#modal-default').iziModal();
</script>