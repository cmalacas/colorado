<div style="display: flex">

    <div class="section-title" style="margin-right: 10px; color: #ff0000">Converting</div>


    <div style="border: solid 2px #ff0000; padding:0; margin-bottom:10px; vertical-align:top; width:100%">

      <div style="display:flex">

        <div style="border-right: solid 2px #ff0000; width:30%; padding: 0 10px">

          <table style="width:100%">

            <tr>

              <td>

                <h2 style="text-align:center; font-size: 16px; margin-top:5px; margin-bottom:5px;">Routing:</h2>

              </td>

            </td>

            <tr>

              <td style="font-size: 12px; padding: 0 0 3px;">1.: <strong>{{ $data['Machine1'] }}</strong></td>

            </tr>

            <tr>

              <td style="font-size: 12px; padding: 0 0 3px;">2.: <strong>{{ $data['Machine2'] }}</strong></td>

            </tr>

            <tr>

              <td style="font-size: 12px; padding: 0 0 3px;">3.: <strong>{{ $data['Machine3'] }}</strong></td>

            </tr>

            <tr>

              <td style="font-size: 12px; padding: 0 0 3px;">4.: <strong>{{ $data['Machine4'] }}</strong></td>

            </tr>

            <tr>

              <td style="font-size: 12px; padding: 0 0 3px;">5.: <strong>{{ $data['Machine5'] }}</strong></td>

            </tr>

            <tr>

              <td style="font-size: 12px; padding: 0 0 3px;">6.: <strong>{{ $data['Machine6'] }}</strong></td>

            </tr>

          </table>

        </div>

        <div style="margin-left:10px; margin-top:5px; width:68%; display:inline-block;">

          <table style="width:100%">

            <tr>

              <td colspan="2"><h2 style="font-size:18px; white-space: nowrap; margin:0">Total Quantity: <strong>{{ $data['Total'] + 0 }}M</strong></h2></td>

              <td><h2 style="font-size: 18px; white-space: nowrap; margin: 0">RUN ALL: <strong>@if($data['RunAll'] == 1) Yes @endif</strong></h2></td>

            </tr>

            <tr>

              <td colspan="3">
              
                <h1 style="text-align:center; margin-top:5px; margin-bottom:5px">{{ $data['SizeDimension1'] }} x {{ $data['SizeDimension2'] }}</h1>
                <p style="font-size:12px; text-align:center"><strong>{{ $data['Description'] }}</strong></p>
              
              </td>

            </tr>

            <tr>

              <td colspan="3">&nbsp;</td>

            </tr>


            <tr>

              <td style="font-size: 12px;">Seal Flap Size: <strong>{{ $data['SealFlapSz'] }}</strong></td>

              <td style="font-size: 12px;"># of Copies: <strong>{{ $data['ofCopies'] }}</strong></td>

              <td>&nbsp;</td>

            </tr>         

          </table>      
        
        </div>

      </div>

      <div style="display:flex; justify-content: flex-start; border-top:solid 2px #ff0000">

          @if(!empty($data['SealFlap']) || !empty($data['GumType']) || !empty($data['AmountForJets']))

          <div style="width:33%; padding-left: 10px; padding-top:5px; border-right: solid 2px #ff0000; min-height: 75px;">

              @if (!empty($data['SealFlap']))

              <p style="font-size: 12px; margin-bottom: 0px; margin-top:5px;">Seal Flap: <strong>{{ $data['SealFlap'] }}</strong></p>

           
              @endif

              @if (!empty($data['GumType']))

              <p style="font-size: 12px; margin-bottom: 0px; margin-top:5px">Type Of Gum: <strong>{{ $data['GumType'] }}</strong></p>

           
              @endif

              @if (!empty($data['AmountForJets']))

              <p style="font-size: 12px; margin-bottom: 0px; margin-top:5px">Amount For Jets: <strong>{{ $data['AmountForJets'] }}</strong></p>

              @endif

              @if($data['SampleProv'])

              <p><h4>SAMPLE PROVIDED</h4></p>

              @endif
              

          </div>

          @endif

          @if (!empty($data['WindowSz1']) || !empty($data['WindowSz2']) || !empty($data['WindowSz3']) || !empty($data['WindowDoubleDie']))

          <div style="width:33%; padding-left: 10px; padding-top: 5px;  border-right: solid 2px #ff0000">

            <h4 style="text-align:center; margin-top:5px; margin-bottom:5px">Window Size</h4>

            @if (!empty($data['WindowSz1']))

            <p style="font-size: 12px; margin-bottom: 0px; margin-top:5px;">1.: <strong>{{ $data['WindowSz1'] }}</strong></p>

            @endif

            @if (!empty($data['WindowSz2']))

            <p style="font-size: 12px; margin-bottom: 0px; margin-top:5px;">2.: <strong>{{ $data['WindowSz2'] }}</strong></p>

            @endif

            @if (!empty($data['WindowSz3']))

            <p style="font-size: 12px; margin-bottom: 0px; margin-top:5px;">3.: <strong>{{ $data['WindowSz3'] }}</strong></p>

            @endif 

            @if (!empty($data['WindowDoubleDie']))

            <p style="font-size: 12px; margin-bottom: 0px; margin-top:5px;">Double Window <strong>{{ $data['WindowDoubleDie'] }}</strong></p>

            @endif

          </div>

          @endif

          @if (!empty($data['WindowPos1']) || !empty($data['WindowPos2']) || !empty($data['WindowPos3']))

          <div style="width:33%; padding-left: 10px; padding-top: 10px; ">

            <h4 style="text-align:center; margin-top:5px; margin-bottom:5px;">Window Position</h4>

            @if (!empty($data['WindowPos1']))

            <p style="font-size: 12px; margin-bottom: 0px; margin-top:5px;">1.: <strong><span style="display:inline-block; width: 50%;">{{ $data['WindowPos1'] }}</span> {{ $data['OpenPolyWinPos1'] }}</strong></p>

            @endif

            @if (!empty($data['WindowPos2']))

            <p style="font-size: 12px; margin-bottom: 5px;">2.: <strong><span style="display:inline-block; width: 50%;">{{ $data['WindowPos2'] }}</span> {{ $data['OpenPolyWinPos2'] }}</strong></p>

            @endif

            @if (!empty($data['WindowPos3']))

            <p style="font-size: 12px; margin-bottom: 0px; margin-top:5px">3.: <strong><span style="display:inline-block; width: 50%;">{{ $data['WindowPos3'] }}</span> {{ $data['OpenPolyWinPos3'] }}</strong></p>

            @endif

          </div>

          @endif

        </div>

    </div>

  </div>