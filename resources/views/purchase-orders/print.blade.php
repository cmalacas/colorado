<html>

<head>
  <meta charset="utf-8">
    
    <style>
      body {
        background: #fff;
        color: #000;
        font-family: 'Arial'; 
      }

      @page { margin: 0 5px 0; }

    </style>
</head>
@php 

      $values = $data;

      $data = $values['po'];

      $hasQuantityColumn = $values['hasQuantityColumn'];
      $hasDescriptionColumn = $values['hasDescriptionColumn'];
      $hasReceivedColumn = $values['hasReceivedColumn'];
      $hasPriceColumn = $values['hasPriceColumn'];
      $hasDateColumn = $values['hasDateColumn'];
      $hasProductionOrderColumn = $values['hasProductionOrderColumn'];

@endphp

<body onload="javascript:window.print()">

<div style="width:90%; max-width: 712px; margin: 30px auto">

  <div style="display:flex; padding-bottom: 5px; margin-bottom:5px; border-bottom: solid 3px #000;">

    <div style="width:33%">

      <p style="font-weight: bold; font-size: 14px; margin-bottom: 0;">PH: 303-460-1387</p>

      <p style="font-weight: bold; font-size: 14px; margin-bottom: 0">Fax: 303-439-0588</p>

      <p style="font-weight: bold; font-size: 14px;">Email: service@coloradoenvelope.com</p>

    </div>

    <div style="width:42%; text-align:center">

      <img src="/assets/images/colorado-logo-200.png" style="max-width:160px; " />

    </div>

    <div style="width:25%">

      <h3 style="font-size: 14px;">Purchase Order # {{ $data->id }}</h3>

      <p style="font-size: 14px; margin-bottom: 10px;">Todays Date: {{ Carbon\Carbon::parse($data->todaysdate)->format("m-d-Y") }}</p>

      <p style="font-size: 14px;">Date Required: {{ Carbon\Carbon::parse($data->datereqd)->format("m-d-Y") }}</p>

    </div>
  
  
  </div>

  <table style="border-bottom: solid 2px #000; margin-bottom: 20px; font-size: 14px;" width="100%" cellspacing=0 border=0>

    <tr>

      <td style="padding: 5px 0"><span style="font-weight: bold">To:</span> {{ $data->vendor->vendor }}</td>

      <td style="padding: 5px 0"><span style="font-weight: bold">For:</span> {{ $data->for }}</td>

      

    </tr>

    <tr>

      <td colspan="2" style="padding: 5px 0"><span style="font-weight: bold">Phone #:</span> {{ $data->phone }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-weight: bold">Mobile #:</span> {{ $data->cellphone }}</td>
      
    </tr>

    <tr>

      <td style="padding: 5px 0"><span style="font-weight: bold">Fax #:</span> {{ $data->fax }}</td>

      <td style="padding: 5px 0"><span style="font-weight: bold">Ship Via:</span> {{ $data->ship }}</td>

      
    </tr>

    <tr>

      <td style="padding: 5px 0 10px"><span style="font-weight: bold">Email:</span> {{ $data->email }}</td>

      
      <td style="padding: 5px 0 10px"><span style="font-weight: bold">Shipping Company:</span> {{ $data->shippingco }}</td>

      

    </tr>

  </table>
  

  <table width="100%" cellspacing=0 border=0>
      <thead>
        <tr>          

          @if( $hasQuantityColumn )

          <th style="font-size: 14px; font-weight:bold; text-align:center; padding: 5px; border-bottom:solid 1px #000; border-left: solid 1px #000; border-top: solid 1px #000; vertical-align:bottom; max-width:80px; width: 80px;">Quantity</th>

          @endif

          @if( $hasDescriptionColumn )

          <th style="font-size: 14px; font-weight:bold; text-align:center; padding: 5px; border-bottom:solid 1px #000; border-left: solid 1px #000; border-top: solid 1px #000; vertical-align:bottom">Description</th>

          @endif

          @if( $hasPriceColumn )

          <th style="font-size: 14px; font-weight:bold; text-align:center; padding: 5px; border-bottom:solid 1px #000;border-left: solid 1px #000; border-top: solid 1px #000; vertical-align:bottom; max-width:80px; width:80px;">Price</th>

          @endif

          @if( $hasReceivedColumn )

          <th style="font-size: 14px; font-weight:bold; text-align:center; padding: 5px; border-bottom:solid 1px #000;border-left: solid 1px #000; border-top: solid 1px #000; vertical-align:bottom; max-width: 80px; width: 80px;">Received</th>

          @endif

          @if ( $hasDateColumn )

          <th style="font-size: 14px; font-weight:bold; text-align:center; padding: 5px; border-bottom:solid 1px #000;border-left: solid 1px #000; border-top: solid 1px #000; vertical-align:bottom; max-width:80px; width: 80px;">Date</th>

          @endif

          @if ( $hasProductionOrderColumn )

          <th style="font-size: 14px; font-weight:bold; text-align:center; padding: 5px; border-bottom:solid 1px #000;border-left: solid 1px #000; border-top: solid 1px #000; border-right: solid 1px #000; max-width: 90px; width: 90px;">Colo Env<br />Production #</th>

          @endif

        </tr>
      </thead>
      <tbody>
        @foreach($data->items as $item)
          
          @php $strs = explode("\n", $item->description ) @endphp

          @for( $i = 0; $i < count( $strs ); $i++)
          <tr>

            @if( $hasQuantityColumn )

            <td style="font-size: 12px; min-height:20px; padding: 5px; border-bottom: solid 1px #000; border-left: solid 1px #000; border-right: solid 1px #000; text-align:center">{!! $i == 0 ? $item->qty : '&nbsp;' !!}</td>

            @endif

            @if( $hasDescriptionColumn )

            <td style="font-size: 12px; padding: 5px; border-bottom: solid 1px #000; border-right: solid 1px #000;">{{ $strs[$i] }}</td>

            @endif

            @if( $hasPriceColumn )

            <td style="font-size: 12px; padding: 5px; border-bottom: solid 1px #000; border-right: solid 1px #000; text-align:right">{{ $i == 0 ? $item->price : '' }}</td>

            @endif

            @if( $hasReceivedColumn )

            <td style="font-size: 12px; padding: 5px; border-bottom: solid 1px #000; border-right: solid 1px #000; text-align:center">{{ $i == 0 ?  $item->recvd : '' }}</td>

            @endif

            @if ( $hasDateColumn )

            <td style="font-size: 12px; padding: 5px; border-bottom: solid 1px #000; border-right: solid 1px #000; text-align:center">{{ $i == 0 ? $item->date : '' }}</td>

            @endif

            @if ( $hasProductionOrderColumn )

            <td style="font-size: 12px; padding: 5px; border-bottom: solid 1px #000; border-right: solid 1px #000; text-align:center">{{ $i == 0 ? $item->production_order_id : '' }}</td>

            @endif

          </tr>

          @endfor

        @endforeach
        
        @for($i=0; $i <= ( 9 - $data->items->count() ); $i++)

        <tr>

          @if( $hasQuantityColumn )

          <td style="font-size: 12px; padding: 5px; border-bottom: solid 1px #000; border-left: solid 1px #000; border-right: solid 1px #000; text-align:center">&nbsp;</td>

          @endif

          @if( $hasDescriptionColumn )
          
          <td style="padding: 5px; border-bottom: solid 1px #000; border-right: solid 1px #000;">&nbsp;</td>

          @endif

          @if( $hasPriceColumn )
          
          <td style="padding: 5px; border-bottom: solid 1px #000; border-right: solid 1px #000; text-align:right">&nbsp;</td>

          @endif

          @if( $hasReceivedColumn )
          
          <td style="padding: 5px; border-bottom: solid 1px #000; border-right: solid 1px #000; text-align:center">&nbsp;</td>

          @endif

          @if ( $hasDateColumn )
          
          <td style="padding: 5px; border-bottom: solid 1px #000; border-right: solid 1px #000; text-align:center">&nbsp;</td>

          @endif

          @if ( $hasProductionOrderColumn )
          
          <td style="padding: 5px; border-bottom: solid 1px #000; border-right: solid 1px #000; text-align:center">&nbsp;</td>

          @endif

        </tr>

        @endfor
        
      </tbody>
      <tfoot>

        <tr>

          <td colspan="6" style="vertical-align:top; padding: 5px; border-bottom: solid 1px #000; border-left: solid 1px #000; border-right: solid 1px #000; height: 100px; font-size: 14px;">
            <span style="font-weight: bold; display: block; margin-bottom: 20px; font-size: 14px; ">SHIP TO:</span>
            {!! str_replace("\n","<br />", $data->shipTo) !!}<br /><br />
            <span style="font-weight: bold; display: block; margin-bottom: 20px; font-size: 14px; ">COMMENTS:</span>
            {!! str_replace("\n","<br />", $data->comments) !!}
        </td>

        </tr>

      </tfoot>
  </table>

</div>


</body>
</html>

