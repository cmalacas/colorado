<div style="margin-bottom:10px; display:flex">
    
    <div class="section-title" style="margin-right:10px; line-height:1.7">General</div>
  
    <div class="section-details" style="border: solid 2px #000; padding: 5px; width:100%">

      <table style="width:100%">
      
          <tr>
            <td style="padding: 3px 0; font-size: 10px;">Sold To: <span style="font-size:20px"><strong>{{ $data['customer']['name'] }}</strong></span></td>
            <td style="padding: 3px 0; font-size: 10px;">Order Date: <strong>{{ \Carbon\Carbon::parse($data['OrderDate'])->format('m-d-Y') }}</strong></td>
            <td style="padding: 3px 0; font-size: 10px;" colspan="2">Stock Due In: <strong>{{ \Carbon\Carbon::parse($data['StockDueIn'])->format('m-d-Y') }}</strong></td>
          </tr>

          <tr>
            <td style="padding: 3px 0; font-size: 10px;">Customer PO: <strong>{{ $data['CustPO'] }}</strong></td>
            <td style="padding: 3px 0; font-size: 10px;">Job #: <strong>{{ $data['job_no'] }}</strong></td>
            <td style="padding: 3px 0; font-size: 10px;" colspan="2">Date Stock In: <strong>{{ \Carbon\Carbon::parse($data['DateStockIn'])->format('m-d-Y') }}</strong></td>
          </tr>

          <tr>
            <td style="padding: 3px 0; font-size: 10px;">Job Title: <strong>{{ $data['JobTitle'] }}</strong></td>
            <td style="padding: 3px 0; font-size: 10px;">Previous Order #: <strong>{{ $data['PreviousOrder'] }}</strong></td>
            <td style="padding: 3px 0; font-size: 10px;" colspan="2">Contact Name: <strong>{{ $data['ContactName'] }}</strong></td>
          </tr>

          <tr>

            <td style="padding: 3px 0; font-size: 10px;">Email: <strong>{{ $data['Email'] }}</strong></td>

            <td style="padding: 3px 0; font-size: 10px;">Phone #: <strong>{{ $data['Phone'] }} @if(!empty($data['PhoneExt'])) ext: {{ $data['PhoneExt'] }} @endif</strong></td>

            <td style="padding: 3px 0; font-size: 10px;" colspan="2">Cell #: <strong>{{ $data['Mobile'] }}</td>

          </tr>

          <tr>

            <td style="padding: 3px 0; font-size: 10px;">Quantity: <strong>{{ $data['QtyNeeded'] + 0 }}M</strong></td>

            <td style="padding: 3px 0; font-size: 10px;">Overs Allowed: <strong>{{ $data['OversAllow'] }} %</strong></td>

            <td style="padding: 3px 0; font-size: 10px;" colspan="2">Quoted Price: <strong>{{ $data['QuotedPrice'] }} {{ $data['UnitFigure'] }}</strong></td>

          </tr>

          <tr>

            <td style="padding: 3px 0; font-size: 10px;">CPU: <strong>@if($data['CPU'] == 1) Yes @endif</strong></td>

            <td style="padding: 3px 0; font-size: 10px;">Shipping: <strong>@if($data['SHIPVIA'] == 1) Yes @if(!empty($data['ShipViaDetail'])) {{ $data['ShipViaDetail'] }} @endif @endif</strong></td>

            <td style="padding: 3px 0; font-size: 10px;">Our Stock: <strong>@if($data['our_stocks'] == 1 ) Yes @endif</strong></td>

            <td style="padding: 3px 0; font-size: 10px;">Cust Stock: <strong>@if( $data['customer_stocks'] == 1 ) Yes @endif</strong></td>

        </tr>

        <tr>

          <td style="padding: 3px 0; font-size: 10px" colspan="4">Additional Charges: <strong>{{ $data['AdditionalChg'] }}</strong></td>

        </tr>

      </table>
    
    </div>
  
  </div>