<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <title>Ela - Bootstrap Admin Dashboard Template</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{asset('frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{asset('frontend/css/helper.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/style1.css')}}" rel="stylesheet">
    <!--User custom css-->
    <style type="text/css">
    	#slide{
    		height: 100px;
    		background: green;
    		color: white;
    	}
    	#sidebar {
    		background-color:#fff;
    		height:100%;
    		position:fixed;
    		right:0;
    		box-shadow: 1px 0 20px rgba(0, 0, 0, 0.08);
    	}
    </style>
    @stack("cs")
</head>

<body class="fix-header fix-sidebar">
    <!-- Preloader - style you can find in spinners.css -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
			<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- Main wrapper  -->
    <div id="main-wrapper">
        <!-- header header  -->
        <div class="header">
        	<!--Slide Show-->
        		<div id="slide">
        			this is slide show
        		</div>
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
            	<!--Slide bar-->
            	<div class="navbar-collapse">
            		<!-- toggle and nav items -->
            		<ul class="navbar-nav pull-right mt-md-0">
            			<!-- This is  -->
            			<li class="nav-item"> 
            				<a class="nav-link nav-toggler hidden-md-up text-muted  " href="javascript:void(0)">
            					<i class="mdi mdi-menu"></i>
            				</a> 
            			</li>
            			<li class="nav-item m-l-10"> 
            				<a class="nav-link sidebartoggler hidden-sm-down text-muted  " href="javascript:void(0)">
            					<i class="ti-menu"></i>
            				</a> 
            			</li>
            			<!-- Messages -->
            			<li class="nav-item dropdown mega-dropdown"> 
            				<a class="nav-link dropdown-toggle text-muted  " href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            					<i class="fa fa-th-large"></i>
            				</a>
            				<div class="dropdown-menu animated zoomIn">
            					<ul class="mega-dropdown-menu row">
            						<li class="col-lg-3  m-b-30">
            							<h4 class="m-b-20">CONTACT US</h4>
            							<!-- Contact -->
            							<form>
            								<div class="form-group">
            									<input type="text" class="form-control" id="exampleInputname1" placeholder="Enter Name"> 
            								</div>
         									<div class="form-group">
         										<input type="email" class="form-control" placeholder="Enter email"> 
         									</div>
	   										<div class="form-group">
	   											<textarea class="form-control" id="exampleTextarea" rows="3" placeholder="Message"></textarea>
	   										</div>
            								<button type="submit" class="btn btn-info">Submit
            								</button>
            							</form>
            						</li>
            					</ul>
            				</div>
            			</li>
            			<!-- End Messages -->
            		</ul>
            	</div>
                <!-- Logo -->
               <div class="navbar-header">
                	<a class="navbar-brand" href="index.html">
                		<!-- Logo icon -->
                		<b><img src="frontend/img/logo/logo.png" alt="homepage" class="dark-logo" /></b>
                		<!--End Logo icon -->
                		<!-- Logo text -->
                		<span><img src="frontend/img/logo/logo-text.png" alt="homepage" class="dark-logo" /></span>
                	</a>
                </div>
                <!-- End Logo -->
            </nav>
        </div>
        <!-- End header header -->
        <!-- Right Sidebar  -->
        <div class="left-sidebar" id="sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
            </div>
            <!-- End Sidebar scroll-->
        </div>
        <!-- End Right Sidebar  -->
    </div>
    <!-- End Wrapper -->
</body>
</html>
<!-- All Jquery -->
<script src="{{asset('frontend/js/jquery.min.js')}}"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{asset('frontend/js/popper.min.js')}}"></script>
<script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="{{asset('frontend/js/jquery.slimscroll.js')}}"></script>
<!--Menu sidebar -->
<script src="{{asset('frontend/js/sidebarmenu.js')}}"></script>
<!--stickey kit -->
<script src="{{asset('frontend/js/sticky-kit.min.js')}}"></script>
<!--Custom JavaScript -->
<script src="{{asset('frontend/js/custom.min.js')}}"></script>
<!--Comon js-->
<script src="{{asset('js/common.js')}}"></script>
<!--User Custom-->
@stack("js")