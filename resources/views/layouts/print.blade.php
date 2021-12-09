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
<style>
body {
    background: #fff;
    color: #000;
}

#main-wrapper {
    width: 100%;
    padding: 0;
}

.section {
    padding: 10px;
    border: solid 1px #000;
    margin-bottom: 10px;
    position: relative;
    min-height: 150px;
}

.section-title {
    text-transform: uppercase;
    width: 16px;
    font-size: 18px;
    font-weight: bold;
    line-height: 2;
    word-break: break-all;
}

.section-info {
    margin: 0 15px 0 15px;
}

.section-info label {
    font-weight: bold;
}

.section-info.dimension {
    line-height: 64px;
    font-size: 32px;
}
.section-info.dimension span {
    font-size: 64px;
    margin: 0px 15px;
}

.red-section {
    padding: 5px;
    border:solid 5px #ff0000;
    margin-bottom: 10px;
}

label {
    margin-right: 1rem;
}

@page { margin: 20px 5px 0; size: landscape }
</style>
</head>
<body onload="window.print()">

    
    <div id="main-wrapper">
	    @yield('content')
    </div>
	
</body>
</html>