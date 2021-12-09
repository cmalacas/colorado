<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    
    <title>{{ config('app.name') }} - @yield('title')</title>
    
    <!-- This page CSS -->    
    <!-- chartist CSS -->
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/vendor/jquery/ui/jquery-ui.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/node_modules/morrisjs/morris.css') }}" rel="stylesheet">
    
    <!--c3 plugins CSS -->
    <link href="{{ asset('assets/node_modules/c3-master/c3.min.css') }}" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    
    <!-- Dashboard 1 Page CSS -->
    <link href="{{ asset('assets/css/pages/dashboard1.css') }}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/datatables/datatables.min.css') }}"/>
    <meta name="google-site-verification" content="SEJFULDsS3L7PoRQ54zUue2PUMsZ7ruFG0THEDYccck" />
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    
    <!--[if lt IE 9]>
    
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    
    <![endif]-->

</head>
<body class="skin-default-dark fixed-layout">

   
    <div id="main-wrapper">
        
	    @include('layouts.header')
    	@include('layouts.left-sidebar')
      
        <div class="page-wrapper">
      
        	<div class="container-fluid">
	
        	</div>
			
			
        </div>			
        
    

		@include('layouts.footer')
      
    </div>

	
	
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!--morris JavaScript -->
    
    
    <script src="{{ asset('assets/node_modules/raphael/raphael-min.js') }}"></script>
    
    <!-- <script src="{{ asset('assets/node_modules/morrisjs/morris.min.js') }}"></script> -->

    
    <script src="{{ asset('assets/node_modules/d3/d3.min.js') }}"></script>
    <script src="{{ asset('assets/node_modules/c3-master/c3.min.js') }}"></script>
    

  
</body>
</html>