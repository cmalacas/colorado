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

    <link href="/assets/fonts/5.0/css/all.min.css" />    
    
    <meta name="google-site-verification" content="SEJFULDsS3L7PoRQ54zUue2PUMsZ7ruFG0THEDYccck" />
    
    
<style>
body {
    background: #fff;
    color: #000;
    font-size: 11px;
    font-family: "Rubik", sans-serif;
}

#main-wrapper {
    width: 96%;
    margin: 0 auto;
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
    width: 9px;
    font-size: 11px;
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

@page { margin: 20px 5px 0; size: portrait }
</style>
</head>
<body onload="window.print()">

    
    <div id="main-wrapper">
	    @yield('content')
    </div>
	
</body>
</html>