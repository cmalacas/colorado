<table style="font-family: 'Dejavu Sans'; font-size: 12px; ">
  <thead>
      <tr>
          <td style="width: 25%">
            
            <p style="font-weight: bold; margin-bottom: 0">PH: 303-460-1387<br />
            Fax: 303-439-0588<br />
            Email:<br />service@coloradoenvelope.com
            </p>
          </td>

          <td style="text-align:center">

            <img style="margin: 0 30px" src="http://coloradoenvelope.muzeumdev.com/assets/images/colorado-logo-160.png"  />

          </td>

          <td style="width: 33%">

            <p style="font-size: 12px"><span style="font-size: 14px; font-weight: bold">Purchase Order # {{ $data->id }}</span><br />
            Todays Date: {{ Carbon\Carbon::parse($data->todaysdate)->format("m-d-Y") }}<br />
            Date Required: {{ Carbon\Carbon::parse($data->datereqd)->format("m-d-Y") }}
            </p>

          </td>
      </tr>
  </thead>
</table>


<div>

  <table style="font-family: 'Dejavu Sans'; font-size: 12px; border-bottom: solid 2px #000; border-top: solid 2px #000; margin-bottom: 20px; margin-top:20px" width="100%" cellspacing=0 border=0>

    <tr>

      <td style="padding: 5px 0 0"><strong>To:</strong> {{ $data->vendor->vendor }}</td>

      <td style="padding: 5px 0 0"><strong>For:</strong> {{ $data->for }}</td>
      
    </tr>

    <tr>

      <td><strong>Phone #:</strong> {{ $data->phone }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Mobile #:</strong> {{ $data->cellphone }}</td>
      
    </tr>

    <tr>

      <td><strong>Fax #:</strong> {{ $data->fax }}</td>

      <td><strong>Ship Via:</strong> {{ $data->ship }}</td>

    </tr>

    <tr>

      <td style="padding: 0 0 5px;"><strong>Email:</strong> {{ $data->email }}</td>

      <td style="padding: 0 0 5px;"><strong>Shipping Company:</strong> {{ $data->shippingco }}</td>

    </tr>

  </table>
  

  <table width="100%" cellspacing=0 border=0  style="font-family: 'Dejavu Sans'; font-size: 12px;margin-bottom: 20px" >
      <thead>
        <tr>   

          @php $columns = 0; @endphp
          
          @if( $hasQuantityColumn )

          @php $columns += 1; @endphp
        
          <th style="font-weight:bold; text-align:center; padding: 5px; border-bottom:solid 1px #000; border-top: solid 1px #000; border-left: solid 1px #000; vertical-align:bottom;">Quantity</th>

          @endif

          @if( $hasDescriptionColumn )

          @php $columns += 1; @endphp

          <th style="font-weight:bold; text-align:center; padding: 5px; border-bottom:solid 1px #000; border-left: solid 1px #000; border-top: solid 1px #000; vertical-align:bottom">Description</th>

          @endif

          @if( $hasPriceColumn )

          @php $columns += 1; @endphp

          <th style="font-weight:bold;  border-top: solid 1px #000; text-align:center; padding: 5px; border-bottom:solid 1px #000;border-left: solid 1px #000; vertical-align:bottom">Price</th>

          @endif

          @if( $hasReceivedColumn )

          @php $columns += 1; @endphp

          <th style="font-weight:bold;  border-top: solid 1px #000;text-align:center; padding: 5px; border-bottom:solid 1px #000;border-left: solid 1px #000; vertical-align:bottom">Received</th>

          @endif

          @if ( $hasDateColumn )

          @php $columns += 1; @endphp

          <th style="font-weight:bold;  border-top: solid 1px #000;text-align:center; padding: 5px; border-bottom:solid 1px #000;border-left: solid 1px #000; vertical-align:bottom">Date</th>

          @endif

          @if ( $hasProductionOrderColumn )

          @php $columns += 1; @endphp

          <th style="font-weight:bold;  text-align:center; padding: 5px; border: solid 1px #000;">Colo Env<br />Production #</th>

          @endif

        </tr>
      </thead>
      <tbody>
        @foreach($data->items as $item)
          
          @php $strs = explode("\n", $item->description ) @endphp

          @for( $i = 0; $i < count( $strs ); $i++)
          <tr>


            @if( $hasQuantityColumn )

            <td style="min-height:20px; padding: 5px; border-bottom: solid 1px #000; border-left: solid 1px #000; border-right: solid 1px #000; text-align:center">{!! $i == 0 ? $item->qty : '&nbsp;' !!}</td>

            @endif

            @if( $hasDescriptionColumn )

            <td style="padding: 5px; border-bottom: solid 1px #000; border-right: solid 1px #000;">{{ $strs[$i] }}</td>

            @endif

            @if( $hasPriceColumn )

            <td style="padding: 5px; border-bottom: solid 1px #000; border-right: solid 1px #000; text-align:right">{{ $i == 0 ? $item->price : '' }}</td>

            @endif

            @if( $hasReceivedColumn )

            <td style="padding: 5px; border-bottom: solid 1px #000; border-right: solid 1px #000; text-align:center">{{ $i == 0 ?  $item->recvd : '' }}</td>

            @endif

            @if ( $hasDateColumn )

            <td style="padding: 5px; border-bottom: solid 1px #000; border-right: solid 1px #000; text-align:center">{{ $i == 0 ? \Carbon\Carbon::parse($item->date)->format("m-d-Y") : '' }}</td>

            @endif

            @if ( $hasProductionOrderColumn )

            <td style="padding: 5px; border-bottom: solid 1px #000; border-right: solid 1px #000; text-align:center">{{ $i == 0 ? $item->production_order_id : '' }}</td>

            @endif 

          </tr>

          @endfor

        @endforeach
        
        @for($i=0; $i <= ( 9 - $data->items->count() ); $i++)

        <tr>

          @if( $hasQuantityColumn )

          <td style="padding: 5px; border-bottom: solid 1px #000; border-left: solid 1px #000; border-right: solid 1px #000; text-align:center">&nbsp;</td>

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

          <td colspan={{ $columns }} style="vertical-align:top; padding: 5px; border-bottom: solid 1px #000; border-left: solid 1px #000; border-right: solid 1px #000; height: 100px;">
            <span style="font-weight: bold; display: block; margin-bottom: 20px; ">SHIP TO:</span>
            {!! str_replace("\n","<br />", $data->shipTo) !!}<br /><br />
            <span style="font-weight: bold; display: block; margin-bottom: 20px; ">COMMENTS:</span>
            {!! str_replace("\n","<br />", $data->comments) !!}
        </td>

        </tr>

      </tfoot>
  </table>

</div>
