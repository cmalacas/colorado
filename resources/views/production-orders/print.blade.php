@extends('layouts.print')

@section('title', 'Print Production Order')

@section('content')

@php //print_r($data); @endphp


<table style="width:100%">
  <tr>
    <td>
      <h3>Colo Env Prod Order # {{ $data['id'] }}</h3>
    </td>
    <td>
      <h3>Due Date: {{ \Carbon\Carbon::parse($data['DateDue'])->format('m-d-Y') }}</h3>
    </td>
  </tr>
  </table>

  <div style="margin-bottom:10px; display:flex">
    
    <div class="section-title" style="margin-right:10px; line-height:1.7">General</div>
  
    <div class="section-details" style="border: solid 2px #000; padding: 5px; width:100%">

      <table style="width:100%">
      
          <tr>
            <td style="padding: 3px 0; font-size: 16px;">Sold To: <strong>{{ $data['customer']['name'] }}</strong></td>
            <td style="padding: 3px 0; font-size: 16px;">Order Date: <strong>{{ \Carbon\Carbon::parse($data['OrderDate'])->format('m-d-Y') }}</strong></td>
            <td style="padding: 3px 0; font-size: 16px;" colspan="2">Stock Due In: <strong>{{ \Carbon\Carbon::parse($data['StockDueIn'])->format('m-d-Y') }}</strong></td>
          </tr>

          <tr>
            <td style="padding: 3px 0; font-size: 16px;" colspan="2">Customer PO: <strong>{{ $data['CustPO'] }}</strong></td>
            <td style="padding: 3px 0; font-size: 16px;" colspan="2">Date Stock In: <strong>{{ \Carbon\Carbon::parse($data['DateStockIn'])->format('m-d-Y') }}</strong></td>
          </tr>

          <tr>
            <td style="padding: 3px 0; font-size: 16px;" colspan="2">Job Title: <strong>{{ $data['JobTitle'] }}</strong></td>
            <td style="padding: 3px 0; font-size: 16px;" colspan="2">Contact Name: <strong>{{ $data['ContactName'] }}</strong></td>
          </tr>

          <tr>

            <td style="padding: 3px 0; font-size: 16px;">Email: <strong>{{ $data['Email'] }}</strong></td>

            <td style="padding: 3px 0; font-size: 16px;">Phone #: <strong>{{ $data['Phone'] }} @if(!empty($data['PhoneExt'])) ext: {{ $data['PhoneExt'] }} @endif</strong></td>

            <td style="padding: 3px 0; font-size: 16px;" colspan="2">Cell #: <strong>{{ $data['Mobile'] }}</td>

          </tr>

          <tr>

            <td style="padding: 3px 0; font-size: 16px;">Quantity: <strong>{{ $data['QtyNeeded'] + 0 }}M</strong></td>

            <td style="padding: 3px 0; font-size: 16px;">Overs Allowed: <strong>{{ $data['OversAllow'] }} %</strong></td>

            <td style="padding: 3px 0; font-size: 16px;" colspan="2">Quoted Price: <strong>{{ $data['QuotedPrice'] }} {{ $data['UnitFigure'] }}</strong></td>

          </tr>

          <tr>

            <td style="padding: 3px 0; font-size: 16px;">CPU: <strong>@if($data['CPU'] == 1) Yes @endif</strong></td>

            <td style="padding: 3px 0; font-size: 16px;">Shipping: <strong>@if($data['SHIPVIA'] == 1) Yes @if(!empty($data['ShipViaDetail'])) {{ $data['ShipViaDetail'] }} @endif @endif</strong></td>

            <td style="padding: 3px 0; font-size: 16px;">Our Stock: <strong>{{ $data['our_stocks'] }}</strong></td>

            <td style="padding: 3px 0; font-size: 16px;">Cust Stock: <strong>{{ $data['customer_stocks'] }}</strong></td>

        </tr>

        <tr>

          <td style="padding: 3px 0; font-size: 16px" colspan="4">Additional Changes: <strong>{{ $data['AdditionalChg'] }}</strong></td>

        </tr>

      </table>
    
    </div>
  
  </div>

  <div style="display: flex">

    <div class="section-title" style="margin-right: 10px; color: #ff0000">Converting</div>


    <div style="border: solid 2px #ff0000; padding:0; margin-bottom:10px; vertical-align:top; width:100%">

      <div style="display:flex">

        <div style="border-right: solid 2px #ff0000; width:30%; padding: 0 10px 10px;">

          <table style="width:100%">

            <tr>

              <td>

                <h2 style="text-align:center; font-size: 22px;">Routing:</h2>

              </td>

            </td>

            <tr>

              <td style="font-size: 16px; padding: 0 0 3px;">1.: <strong>{{ $data['Machine1'] }}</strong></td>

            </tr>

            <tr>

              <td style="font-size: 16px; padding: 0 0 3px;">2.: <strong>{{ $data['Machine2'] }}</strong></td>

            </tr>

            <tr>

              <td style="font-size: 16px; padding: 0 0 3px;">3.: <strong>{{ $data['Machine3'] }}</strong></td>

            </tr>

            <tr>

              <td style="font-size: 16px; padding: 0 0 3px;">4.: <strong>{{ $data['Machine4'] }}</strong></td>

            </tr>

            <tr>

              <td style="font-size: 16px; padding: 0 0 3px;">5.: <strong>{{ $data['Machine5'] }}</strong></td>

            </tr>

            <tr>

              <td style="font-size: 16px; padding: 0 0 3px;">6.: <strong>{{ $data['Machine6'] }}</strong></td>

            </tr>

          </table>

        </div>

        <div style="margin-left:10px; margin-top:10px; width:68%; display:inline-block;">

          <table style="width:100%">

            <tr>

              <td colspan="2"><h2 style="font-size:36px; white-space: nowrap">Total Quantity: <strong>{{ $data['Total'] + 0 }}M</strong></h2></td>

              <td><h2 style="font-size: 22px; white-space: nowrap">RUN ALL: <strong>@if($data['RunAll'] == 1) Yes @endif</strong></h2></td>

            </tr>

            <tr>

              <td colspan="3">
              
                <h1 style="text-align:center; margin-top:20px;">{{ $data['SizeDimension1'] }} x {{ $data['SizeDimension2'] }}</h1>
                <p style="font-size:16px; text-align:center"><strong>{{ $data['Description'] }}</strong></p>
              
              </td>

            </tr>

            <tr>

              <td colspan="3">&nbsp;</td>

            </tr>


            <tr>

              <td style="font-size: 16px;">Seal Flap Size: <strong>{{ $data['SealFlapSz'] }}</strong></td>

              <td style="font-size: 16px;"># of Copies: <strong>{{ $data['ofCopies'] }}</strong></td>

              <td>&nbsp;</td>

            </tr>         

          </table>      
        
        </div>

      </div>

      <div style="display:flex; justify-content: flex-start; border-top:solid 2px #ff0000">

          @if(!empty($data['SealFlap']) || !empty($data['GumType']) || !empty($data['AmountForJets']))

          <div style="width:33%; padding-left: 10px; padding-top:10px; border-right: solid 2px #ff0000; min-height: 150px;">

              @if (!empty($data['SealFlap']))

              <p style="font-size: 16px; margin-bottom: 5px;">Seal Flap: <strong>{{ $data['SealFlap'] }}</strong></p>

           
              @endif

              @if (!empty($data['GumType']))

              <p style="font-size: 16px; margin-bottom: 5px;">Type Of Gum: <strong>{{ $data['GumType'] }}</strong></p>

           
              @endif

              @if (!empty($data['AmountForJets']))

              <p style="font-size: 16px; margin-bottom: 5px;">Amount For Jets: <strong>{{ $data['AmountForJets'] }}</strong></p>

              <p><h4>SAMPLE PROVIDED</h4></p>

           
              @endif

          </div>

          @endif

          @if (!empty($data['WindowSz1']) || !empty($data['WindowSz2']) || !empty($data['WindowSz3']) || !empty($data['WindowDoubleDie']))

          <div style="width:33%; padding-left: 10px; padding-top: 10px;  border-right: solid 2px #ff0000">

            <h4 style="text-align:center">Window Size</h4>

            @if (!empty($data['WindowSz1']))

            <p style="font-size: 16px; margin-bottom: 5px;">1.: <strong>{{ $data['WindowSz1'] }}</strong></p>

            @endif

            @if (!empty($data['WindowSz2']))

            <p style="font-size: 16px; margin-bottom: 5px;">2.: <strong>{{ $data['WindowSz2'] }}</strong></p>

            @endif

            @if (!empty($data['WindowSz3']))

            <p style="font-size: 16px; margin-bottom: 5px;">3.: <strong>{{ $data['WindowSz3'] }}</strong></p>

            @endif 

            @if (!empty($data['WindowDoubleDie']))

            <p style="font-size: 16px; margin-bottom: 5px;">Double Window <strong>{{ $data['WindowDoubleDie'] }}</strong></p>

            @endif

          </div>

          @endif

          @if (!empty($data['WindowPos1']) || !empty($data['WindowPos2']) || !empty($data['WindowPos3']))

          <div style="width:33%; padding-left: 10px; padding-top: 10px; ">

            <h4 style="text-align:center">Window Position</h4>

            @if (!empty($data['WindowPos1']))

            <p style="font-size: 16px; margin-bottom: 5px;">1.: <strong><span style="display:inline-block; width: 200px;">{{ $data['WindowPos1'] }}</span> {{ $data['OpenPolyWinPos1'] }}</strong></p>

            @endif

            @if (!empty($data['WindowPos2']))

            <p style="font-size: 16px; margin-bottom: 5px;">2.: <strong><span style="display:inline-block; width: 200px;">{{ $data['WindowPos2'] }}</span> {{ $data['OpenPolyWinPos2'] }}</strong></p>

            @endif

            @if (!empty($data['WindowPos3']))

            <p style="font-size: 16px; margin-bottom: 5px;">3.: <strong><span style="display:inline-block; width: 200px;">{{ $data['WindowPos3'] }}</span> {{ $data['OpenPolyWinPos3'] }}</strong></p>

            @endif

          </div>

          @endif

        </div>

    </div>

  </div>

  <div style="display: flex">

    <div class="section-title" style="margin-right:10px; line-height:1.5; color: #00f">Instruction</div>

    <div style="border: solid 2px #00f; padding:0 10px; margin-bottom:10px; vertical-align:top; height: 300px; width: 100%">

      <h2 style="text-align:center">* SPECIAL INSTRUCTIONS *</h2>

      {{ $data['SpecialConvInst'] }}

    </div>

  </div>

  @if ( !empty($data['out_diagonal_die_size']) || 
        !empty($data['out_diagonal_die_size']) ||
        !empty($data['out_diagonal_sheet_size']) || 
        !empty($data['out_diagonal_number_out']) || 
        !empty($data['out_diagonal_die_number']) || 
        !empty($data['out_diagonal_seal_flap_size']) || 
        !empty($data['out_mo_booklet_die_size']) || 
        !empty($data['out_mo_booklet_sheet_size']) || 
        !empty($data['out_mo_booklet_number_out']) || 
        !empty($data['out_mo_booklet_die_number']) || 
        !empty($data['out_mo_booklet_flat_size']) || 
        !empty($data['out_mo_booklet_seal_flap_size']) || 
        !empty($data['out_mo_catalog_die_size']) || 
        !empty($data['out_mo_catalog_sheet_size']) || 
        !empty($data['out_mo_catalog_number_out']) || 
        !empty($data['out_mo_catalog_die_number']) || 
        !empty($data['out_mo_catalog_flat_size']) || 
        !empty($data['out_mo_catalog_seal_flap_size']) || 
        !empty($data['out_side_seam_die_size']) || 
        !empty($data['out_side_seam_sheet_size']) || 
        !empty($data['out_side_seam_number_out'] ) || 
        !empty($data['out_side_seam_die_number'] ) || 
        !empty($data['out_side_seam_flat_size']) || 
        !empty($data['out_side_seam_seal_flap_size']) || 
        !empty($data['adjustable_die_size']) || 
        !empty($data['adjustable_sheet_size']) || 
        !empty($data['adjustable_number_out']) || 
        !empty($data['adjustable_die_number']) || 
        !empty($data['adjustable_flat_size']) || 
        !empty($data['adjustable_seal_flap_size']) || 
        !empty($data['web_ro_die_size']) || 
        !empty($data['web_ro_sheet_size']) || 
        !empty($data['web_ro_number_out']) || 
        !empty($data['web_ro_die_number']) || 
        !empty(  $data['web_ro_flat_size']) || 
        !empty($data['web_ro_seal_flap_size'])

  )

  <div style="display: flex">

    <div class="section-title" style="margin-right:10px; line-height:5; color: #cc6600">Cut</div>

    <div style="border: solid 2px #cc6600; padding:0 10px; margin-bottom:10px; vertical-align:top; width:100%">

      <h2>STOCK: {{ $data['ColoEnvStock'] }}</H2>

      <table width="100%" cellspacing=0 border=0>

        <thead>
          <tr>
            <td style="border-bottom:solid 1px #000;">&nbsp;</td>
            <td style="font-weight:bold; border-bottom: solid 1px #000; font-size: 16px;">Die Size</td>
            <td style="font-weight:bold; border-bottom: solid 1px #000; font-size: 16px;">Sheet Roll / Size</td>
            <td style="font-weight:bold; border-bottom: solid 1px #000; font-size: 16px;">#Out</td>
            <td style="font-weight:bold; border-bottom: solid 1px #000; font-size: 16px;">Die #</td>
            <td style="font-weight:bold; border-bottom: solid 1px #000; font-size: 16px;">Flat / Pull Size</td>
            <td style="font-weight:bold; border-bottom: solid 1px #000; font-size: 16px;">Seal Flap Size</td>
          </tr>
        </thead>
        <tbody>

          @if(!empty($data['out_diagonal_die_size']) ||
              !empty($data['out_diagonal_sheet_size']) ||
              !empty($data['out_diagonal_number_out']) ||
              !empty($data['out_diagonal_die_number']) ||
              !empty($data['out_diagonal_seal_flap_size'])
            )

          <tr>
            <td style="font-size: 16px; padding:3px 0;">Out Diagonals</td>
            <td style="font-size: 16px; padding:3px 0;"><strong>{{ $data['out_diagonal_die_size'] }}</strong></td>
            <td style="font-size: 16px; padding:3px 0;"><strong>{{ $data['out_diagonal_sheet_size'] }}</strong></td>
            <td style="font-size: 16px; padding:3px 0;"><strong>{{ $data['out_diagonal_number_out'] }}</strong></td>
            <td style="font-size: 16px; padding:3px 0;"><strong>{{ $data['out_diagonal_die_number'] }}</strong></td>
            <td style="font-size: 16px; padding:3px 0;">&nbsp;</td>
            <td style="font-size: 16px; padding:3px 0;"><strong>{{ $data['out_diagonal_seal_flap_size'] }}</td>
          </tr>

          @endif

          @if(!empty($data['out_mo_booklet_die_size']) ||
              !empty($data['out_mo_booklet_sheet_size']) || 
              !empty($data['out_mo_booklet_number_out']) ||
              !empty($data['out_mo_booklet_die_number']) || 
              !empty($data['out_mo_booklet_flat_size']) || 
              !empty($data['out_mo_booklet_seal_flap_size'])
            )
          <tr>
            <td style="font-size: 16px; padding:3px 0;">Out MO Booklet</td>
            <td style="font-size: 16px; padding:3px 0;"><strong>{{ $data['out_mo_booklet_die_size'] }}</strong></td>
            <td style="font-size: 16px; padding:3px 0;"><strong>{{ $data['out_mo_booklet_sheet_size'] }}</strong></td>
            <td style="font-size: 16px; padding:3px 0;"><strong>{{ $data['out_mo_booklet_number_out'] }}</strong></td>
            <td style="font-size: 16px; padding:3px 0;"><strong>{{ $data['out_mo_booklet_die_number'] }}</strong></td>
            <td style="font-size: 16px; padding:3px 0;"><strong>{{ $data['out_mo_booklet_flat_size'] }}</strong></td>
            <td style="font-size: 16px; padding:3px 0;"><strong>{{ $data['out_mo_booklet_seal_flap_size'] }}</strong></td>
          </tr>
          @endif

          @if(!empty($data['out_mo_catalog_die_size']) ||
              !empty($data['out_mo_catalog_sheet_size']) ||
              !empty($data['out_mo_catalog_number_out']) ||
              !empty($data['out_mo_catalog_die_number']) ||
              !empty($data['out_mo_catalog_flat_size']) ||
              !empty($data['out_mo_catalog_seal_flap_size'])
            )
          <tr>
            <td style="font-size: 16px; padding:3px 0;">Out MO Catalog</td>
            <td style="font-size: 16px; padding:3px 0;"><strong>{{ $data['out_mo_catalog_die_size'] }}</strong></td>
            <td style="font-size: 16px; padding:3px 0;"><strong>{{ $data['out_mo_catalog_sheet_size'] }}</strong></td>
            <td style="font-size: 16px; padding:3px 0;"><strong>{{ $data['out_mo_catalog_number_out'] }}</strong></td>
            <td style="font-size: 16px; padding:3px 0;"><strong>{{ $data['out_mo_catalog_die_number'] }}</strong></td>
            <td style="font-size: 16px; padding:3px 0;"><strong>{{ $data['out_mo_catalog_flat_size'] }}</strong></td>
            <td style="font-size: 16px; padding:3px 0;"><strong>{{ $data['out_mo_catalog_seal_flap_size'] }}</strong></td>
          </tr>
          @endif

          @if(!empty($data['out_side_seam_die_size']) ||
              !empty($data['out_side_seam_sheet_size']) ||
              !empty($data['out_side_seam_number_out']) ||
              !empty($data['out_side_seam_die_number']) ||
              !empty($data['out_side_seam_flat_size']) ||
              !empty($data['out_side_seam_seal_flap_size'])
          )
          <tr>
            <td style="font-size: 16px; padding:3px 0;">Outside Seam</td>
            <td style="font-size: 16px; padding:3px 0;"><strong>{{ $data['out_side_seam_die_size'] }}</strong></td>
            <td style="font-size: 16px; padding:3px 0;"><strong>{{ $data['out_side_seam_sheet_size'] }}</strong></td>
            <td style="font-size: 16px; padding:3px 0;"><strong>{{ $data['out_side_seam_number_out'] }}</strong></td>
            <td style="font-size: 16px; padding:3px 0;"><strong>{{ $data['out_side_seam_die_number'] }}</strong></td>
            <td style="font-size: 16px; padding:3px 0;"><strong>{{ $data['out_side_seam_flat_size'] }}</strong></td>
            <td style="font-size: 16px; padding:3px 0;"><strong>{{ $data['out_side_seam_seal_flap_size'] }}</strong></td>
          </tr>
          @endif

          @if(!empty($data['adjustable_die_size']) || 
              !empty($data['adjustable_sheet_size']) || 
              !empty($data['adjustable_number_out']) || 
              !empty($data['adjustable_die_number']) || 
              !empty($data['adjustable_flat_size']) || 
              !empty($data['adjustable_seal_flap_size'])
          )
          <tr>
            <td style="font-size: 16px; padding:3px 0;">Adjustable</td>
            <td style="font-size: 16px; padding:3px 0;"><strong>{{ $data['adjustable_die_size'] }}</td>
            <td style="font-size: 16px; padding:3px 0;"><strong>{{ $data['adjustable_sheet_size'] }}</td>
            <td style="font-size: 16px; padding:3px 0;"><strong>{{ $data['adjustable_number_out'] }}</td>
            <td style="font-size: 16px; padding:3px 0;"><strong>{{ $data['adjustable_die_number'] }}</td>
            <td style="font-size: 16px; padding:3px 0;"><strong>{{ $data['adjustable_flat_size'] }}</td>
            <td style="font-size: 16px; padding:3px 0;"><strong>{{ $data['adjustable_seal_flap_size'] }}</td>
          </tr>
          @endif

          @if(!empty($data['web_ro_die_size']) ||
              !empty($data['web_ro_sheet_size']) || 
              !empty($data['web_ro_number_out']) ||
              !empty($data['web_ro_die_number']) ||
              !empty($data['web_ro_flat_size']) ||
              !empty($data['web_ro_seal_flap_size'])
            )
          <tr>
            <td style="font-size: 16px; padding:3px 0;">WEB - RA</td>
            <td style="font-size: 16px; padding:3px 0;"><strong>{{ $data['web_ro_die_size'] }}</strong></td>
            <td style="font-size: 16px; padding:3px 0;"><strong>{{ $data['web_ro_sheet_size'] }}</strong></td>
            <td style="font-size: 16px; padding:3px 0;"><strong>{{ $data['web_ro_number_out'] }}</strong></td>
            <td style="font-size: 16px; padding:3px 0;"><strong>{{ $data['web_ro_die_number'] }}</strong></td>
            <td style="font-size: 16px; padding:3px 0;"><strong>{{ $data['web_ro_flat_size'] }}</strong></td>
            <td style="font-size: 16px; padding:3px 0;"><strong>{{ $data['web_ro_seal_flap_size'] }}</strong></td>
          </tr>
          @endif
        </tbody>

      </table>

    </div>

  </div>

  @endif

  <div style="display: flex;">

    @if ( !empty($data['Printing']) || !empty($data['Sides']) || !empty($data['InsideTintStyle']) || !empty($data['Colors1']) || !empty($data['Colors2']) || !empty($data['Colors3']) || !empty($data['CustomerSup']))


    
      <div class="section-title" style="margin-right:10px; line-height: 2.6; color: #336600">Print</div>
      <div style="border: solid 2px #336600; padding: 10px; width:48%; margin-right: 10px">

        @if (!empty($data['Printing']))

        <p style="font-size: 16px; margin-bottom: 5px;">Printing: <strong>{{ $data['Printing'] }}</strong></p>

        @endif 


        @if (!empty($data['Sides']))

        <p style="font-size: 16px; margin-bottom: 5px;">Sides: <strong>{{ $data['Sides'] }}</strong></p>

        @endif 

        @if (!empty($data['InsideTintStyle']))

        <p style="font-size: 16px; margin-bottom: 5px;">Inside Tint Style: <strong>{{ $data['InsideTintStyle'] }}</strong></p>

        @endif

        @if (!empty($data['Colors1']))
        <p style="font-size: 16px; margin-bottom: 5px;">Color 1: <strong>{{ $data['Colors1'] }}</strong></p>
        @endif

        @if (!empty($data['Colors2']))
        <p style="font-size: 16px; margin-bottom: 5px;">Color 2: <strong>{{ $data['Colors2'] }}</strong></p>
        @endif

        @if (!empty($data['Colors3']))
        <p style="font-size: 16px; margin-bottom: 5px;">Color 3: <strong>{{ $data['Colors3'] }}</strong></p>
        @endif

        @if (!empty($data['Colors4']))
        <p style="font-size: 16px; margin-bottom: 5px;">Color 4: <strong>{{ $data['Colors4'] }}</strong></p>
        @endif


        

      </div>

    @endif

    @if ($data['BulkPack'] == 1 || !empty($data['BuilkAmtPerCtn']) || !empty($data['FoldingBoxSz']) || $data['FoldingBox'] == 1 || !empty($data['BulkBoxSz']) || !empty($data['BulkAmtPerBox']) || !empty($data['Labeling']) || $data['SpecialLabels'] == 1)

    <div class="section-title" style="margin-right:10px; line-height:1.5; color: #670099">
      Packaging
    </div>

    <div style="border: solid 2px #660099; padding: 10px; width:50%">
      <div style="display: flex; justify-content: flex-start; padding-bottom: 10px;">

        @if ($data['BulkPack'] == 1)
        
        <div style="font-size: 16px; margin-right: 30px">Bulk Pack: <strong>{{ $data['BulkPack'] == 1 ? 'Yes' : 'No'}}</strong></div>

        @endif

        @if (!empty($data['FoldingBoxSz']))

        <div style="font-size: 16px;">Carton Size: <strong>{{ $data['FoldingBoxSz'] }}</strong></div>

        @endif


      </div>

       @if (!empty($data['BulkAmtPerCtn']))

      <div style="font-size:18px; padding-bottom:10px;">Amount Per Ctn: <strong>{{ $data['BulkAmtPerCtn'] }}</strong></div>

      @endif


      <div style="display: flex; justify-content: space-between">

        @if ($data['FoldingBox'] == 1)

        <div style="font-size: 16px; padding-bottom: 10px;">Folding Boxes: <strong>{{ $data['FoldingBox'] == 1 ? "Yes" : 'No'}}</strong></div>

        @endif 

        @if (!empty($data['BulkBoxSz']))
        <div style="font-size: 16px; padding-bottom: 10px;">Box Size: <strong>{{ $data['BulkBoxSz'] }}</strong></div>
        @endif

      </div>


      @if (!empty($data['BulkAmtPerBox']))
      <div style="font-size: 16px; padding-bottom: 10px;">Amt Per Box: <strong>{{ $data['BulkAmtPerBox'] }}</strong></div>
      @endif 

      @if (!empty($data['Labeling']))
      <div style="font-size: 16px; padding-bottom: 10px;">Labeling: <strong>{{ $data['Labeling'] }}</strong></div>
      @endif

      @if ($data['SpecialLabels'] == 1)
      <div style="font-size: 16px; padding-bottom: 10px;">Special Labels: <strong>{{ $data['SpecialLabels'] == 1 ? 'Yes' : 'No' }}</strong></div>
      @endif
    </div>

    @endif
  
  </div>

@endsection
