<div style="display: flex;">

@if ( !empty($data['Printing']) || !empty($data['Sides']) || !empty($data['InsideTintStyle']) || !empty($data['Colors1']) || !empty($data['Colors2']) || !empty($data['Colors3']) || !empty($data['CustomerSup']))



  <div class="section-title" style="margin-right:10px; line-height: 2.6; color: #336600">Print</div>
  <div style="border: solid 2px #336600; padding: 10px; width:48%; margin-right: 10px">

    @if (!empty($data['Printing']))

    <p style="font-size: 12px; margin-bottom: 0px; margin-top:5px;">Printing: <strong>{{ $data['Printing'] }}</strong></p>

    @endif 


    @if (!empty($data['Sides']))

    <p style="font-size: 12px; margin-bottom: 0px; margin-top:5px;">Sides: <strong>{{ $data['Sides'] }}</strong></p>

    @endif 

    @if (!empty($data['InsideTintStyle']))

    <p style="font-size: 12px; margin-bottom: 0px; margin-top:5px;">Inside Tint Style: <strong>{{ $data['InsideTintStyle'] }}</strong></p>

    @endif

    @if (!empty($data['Colors1']))
    <p style="font-size: 12px; margin-bottom: 0px; margin-top:5px;">Color 1: <strong>{{ $data['Colors1'] }}</strong></p>
    @endif

    @if (!empty($data['Colors2']))
    <p style="font-size: 12px; margin-bottom: 0px; margin-top:5px;">Color 2: <strong>{{ $data['Colors2'] }}</strong></p>
    @endif

    @if (!empty($data['Colors3']))
    <p style="font-size: 12px; margin-bottom: 0px; margin-top:5px;">Color 3: <strong>{{ $data['Colors3'] }}</strong></p>
    @endif

    @if (!empty($data['Colors4']))
    <p style="font-size: 12px; margin-bottom: 0px; margin-top:5px;">Color 4: <strong>{{ $data['Colors4'] }}</strong></p>
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
    
    <div style="font-size: 12px; margin-right: 30px">Bulk Pack: <strong>{{ $data['BulkPack'] == 1 ? 'Yes' : 'No'}}</strong></div>

    @endif

    @if (!empty($data['FoldingBoxSz']))

    <div style="font-size: 12px;">Carton Size: <strong>{{ $data['FoldingBoxSz'] }}</strong></div>

    @endif


  </div>

   @if (!empty($data['BulkAmtPerCtn']))

  <div style="font-size:18px; padding-bottom:10px;">Amount Per Ctn: <strong>{{ $data['BulkAmtPerCtn'] }}</strong></div>

  @endif


  <div style="display: flex; justify-content: space-between">

    @if ($data['FoldingBox'] == 1)

    <div style="font-size: 12px; padding-bottom: 10px;">Folding Boxes: <strong>{{ $data['FoldingBox'] == 1 ? "Yes" : 'No'}}</strong></div>

    @endif 

    @if (!empty($data['BulkBoxSz']))
    <div style="font-size: 12px; padding-bottom: 10px;">Box Size: <strong>{{ $data['BulkBoxSz'] }}</strong></div>
    @endif

  </div>


  @if (!empty($data['BulkAmtPerBox']))
  <div style="font-size: 12px; padding-bottom: 10px;">Amt Per Box: <strong>{{ $data['BulkAmtPerBox'] }}</strong></div>
  @endif 

  @if (!empty($data['Labeling']))
  <div style="font-size: 12px; padding-bottom: 10px;">Labeling: <strong>{{ $data['Labeling'] }}</strong></div>
  @endif

  @if ($data['SpecialLabels'] == 1)
  <div style="font-size: 12px; padding-bottom: 10px;">Special Labels: <strong>{{ $data['SpecialLabels'] == 1 ? 'Yes' : 'No' }}</strong></div>
  @endif
</div>

@endif

</div>