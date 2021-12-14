<html>

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

    </style>
</head>

<body onload="window.print()">

<div style="width:90%; margin: 30px auto">

  <div style="display:flex; padding-bottom: 20px; margin-bottom:20px; border-bottom: solid 3px #000;">

    <div style="width:39%; margin-right: 4%">

      <p style="color: #673091; font-weight: bold; font-size: 18px; margin-bottom:50px;">PH: 303-460-1387</p>

      <p style="color: #673091; font-weight: bold; font-size: 18px;">Fax: 303-439-0588</p>

      <p style="color: #673091; font-weight: bold; font-size: 18px;">Email: service@coloradoenvelope.com</p>

    </div>

    <div style="width:25%; margin-right:4%">

      <img src="/assets/images/logo2.png" style="max-width:100%" />

    </div>

    <div style="width:33%">

      <h3>Purchase Order # {{ $data->id }}</h3>

      <p style="margin-bottom:50px; font-size: 18px;">Todays Date: {{ $data->todaysdate }}</p>

      <p style="font-size: 18px;">Date Required: {{ $data->datereqd }}</p>

    </div>
  
  
  </div>

  <table style="border-bottom: solid 2px #000; margin-bottom: 20px" width="100%" cellspacing=0 border=0>

    <tr>

      <td style="padding: 5px 0">To:</td>

      <td style="width:500px">{{ $data->vendor->vendor }}</td>

      <td style="width:150px; padding: 5px 0">For:</td>

      <td style="padding: 5px 0">{{ $data->for }}</td>

    </tr>

    <tr>

      <td style="padding: 5px 0">Phone #</td>

      <td colspan="3">{{ $data->phone }}</td>      

    </tr>

    <tr>

      <td style="padding: 5px 0">Fax #</td>

      <td style="padding: 5px 0">{{ $data->fax }}</td>

      <td style="padding: 5px 0">Ship Via:</td>

      <td style="padding: 5px 0">{{ $data->ship }}</td>

    </tr>

    <tr>

      <td style="padding: 5px 0 10px">Email:</td>

      <td style="padding: 5px 0 10px">{{ $data->email }}</td>

      <td style="padding: 5px 0 10px">Shipping Company:</td>

      <td style="padding: 5px 0 10px">{{ $data->shippingco }}</td>

    </tr>

  </table>
  

  <table width="100%" cellspacing=0 border=0>
      <thead>
        <tr>          
          <th style="font-size: 18px; font-weight:bold; text-align:center; padding: 5px; border-bottom:solid 1px #000; vertical-align:bottom;">Quantity</th>
          <th style="font-size: 18px; font-weight:bold; text-align:center; padding: 5px; border-bottom:solid 1px #000; border-left: solid 1px #000;; vertical-align:bottom">Description</th>
          <th style="font-size: 18px; font-weight:bold; text-align:center; padding: 5px; border-bottom:solid 1px #000;border-left: solid 1px #000;; vertical-align:bottom">Price</th>
          <th style="font-size: 18px; font-weight:bold; text-align:center; padding: 5px; border-bottom:solid 1px #000;border-left: solid 1px #000;; vertical-align:bottom">Received</th>
          <th style="font-size: 18px; font-weight:bold; text-align:center; padding: 5px; border-bottom:solid 1px #000;border-left: solid 1px #000;; vertical-align:bottom">Date</th>
          <th style="font-size: 18px; font-weight:bold; text-align:center; padding: 5px; border-bottom:solid 1px #000;border-left: solid 1px #000;">Colo Env<br />Production #</th>
        </tr>
      </thead>
      <tbody>
        @foreach($data->items as $item)
          
          @php $strs = explode("\n", $item->description ) @endphp

          @for( $i = 0; $i < count( $strs ); $i++)
          <tr>
            <td style="min-height:20px; padding: 5px; border-bottom: solid 1px #000; border-left: solid 1px #000; border-right: solid 1px #000; text-align:center">{!! $i == 0 ? $item->qty : '&nbsp;' !!}</td>
            <td style="padding: 5px; border-bottom: solid 1px #000; border-right: solid 1px #000;">{{ $strs[$i] }}</td>
            <td style="padding: 5px; border-bottom: solid 1px #000; border-right: solid 1px #000; text-align:right">{{ $i == 0 ? $item->price : '' }}</td>
            <td style="padding: 5px; border-bottom: solid 1px #000; border-right: solid 1px #000; text-align:center">{{ $i == 0 ?  $item->recvd : '' }}</td>
            <td style="padding: 5px; border-bottom: solid 1px #000; border-right: solid 1px #000; text-align:center">{{ $i == 0 ? $item->date : '' }}</td>
            <td style="padding: 5px; border-bottom: solid 1px #000; border-right: solid 1px #000; text-align:center">{{ $i == 0 ? $item->production_order_id : '' }}</td>
          </tr>

          @endfor

        @endforeach
        
        @for($i=0; $i <= ( 20 - $data->items->count() ); $i++)

        <tr>

          <td style="padding: 5px; border-bottom: solid 1px #000; border-left: solid 1px #000; border-right: solid 1px #000; text-align:center">&nbsp;</td>
          <td style="padding: 5px; border-bottom: solid 1px #000; border-right: solid 1px #000;">&nbsp;</td>
          <td style="padding: 5px; border-bottom: solid 1px #000; border-right: solid 1px #000; text-align:right">&nbsp;</td>
          <td style="padding: 5px; border-bottom: solid 1px #000; border-right: solid 1px #000; text-align:center">&nbsp;</td>
          <td style="padding: 5px; border-bottom: solid 1px #000; border-right: solid 1px #000; text-align:center">&nbsp;</td>
          <td style="padding: 5px; border-bottom: solid 1px #000; border-right: solid 1px #000; text-align:center">&nbsp;</td>

        </tr>

        @endfor
        
      </tbody>
      <tfoot>

        <tr>

          <td colspan="6" style="font-weight:bold; vertical-align:top; padding: 5px; border-bottom: solid 1px #000; border-left: solid 1px #000; border-right: solid 1px #000; height: 200px;">COMMENTS:</td>

        </tr>

      </tfoot>
  </table>

</div>


</body>
</html>