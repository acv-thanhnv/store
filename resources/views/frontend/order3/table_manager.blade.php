<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><strong>Chuyển bàn đến:</strong> </h4>
      </div>
      <div class="modal-body">
       <div class="room">
        <nav class="navbar navbar-inverse">
          <div class="container-fluid">
            <ul class="nav navbar-nav">
              <li class="active"><a href="#">Tầng 1</a></li>
              @for($i=2;$i<5;$i++)
              <li><a href="#">Tầng {{$i}}</a></li>
              @endfor
              <li><a href="#">More...</a></li> 
            </ul>
          </div>
        </nav>
      </div>

      <div id="table-list">
        @for($i=1;$i<30;$i++)
        <div class="wrap-table col-sm-2 img-thumbnail" >
          <span class="table-name">Bàn {{$i}}</span>
        </div>
        @endfor
      </div>

      </div>
      <div class="modal-footer" style="clear: both;">
        <div>
          <button type="button" class="btn btn-primary" data-dismiss="modal">Xác nhận</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>

  </div>
</div>

{{-- ////ghép bàn --}}

<div id="myModal2" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><strong>Ghép bàn:</strong> </h4>
      </div>
      <div class="modal-body">
       <div class="room">
        <nav class="navbar navbar-inverse">
          <div class="container-fluid">
            <ul class="nav navbar-nav">
              <li class="active"><a href="#">Tầng 1</a></li>
              @for($i=2;$i<5;$i++)
              <li><a href="#">Tầng {{$i}}</a></li>
              @endfor
              <li><a href="#">More...</a></li> 
            </ul>
          </div>
        </nav>
      </div>

      <div id="table-list">
        @for($i=1;$i<30;$i++)
        <div class="wrap-table col-sm-2 img-thumbnail" >
          <span class="table-name">Bàn {{$i}}</span>
        </div>
        @endfor
      </div>

      </div>
      <div class="modal-footer" style="clear: both;">
        <div>
          <button type="button" class="btn btn-primary" data-dismiss="modal">Xác nhận</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>

  </div>
</div>