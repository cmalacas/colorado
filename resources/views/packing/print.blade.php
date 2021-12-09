<html>
    <head>
        <style>
            body {
                font-family: Arial;
                font-size: 12px;
            }

            td, th {
                font-size: 12px;
            }
        </style>
    </head>
    <body onload="window.print()">

        <div style="width: 800px; margin: 0 auto 0px">

            <div style="display: flex; margin-bottom:10px;">

                <div style="margin-right:50px;">

                    <img src="/assets/images/logo3.png" style="width: 250px;" />

                </div>

                <div style="width:100%">

                    <table width=100% >

                        <thead>
                            <tr>
                                <td colspan="2" style="text-align:center; padding: 10px 0;">2275 W. Midway, Unit A Broomfield, CO 80020</td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align:center; padding: 10px 0 30px; white-space: nowrap">
                                    PH.303-460-1387 / Fax.303-439-0588 / Email. service@coloradoenvelope.com
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:center; padding: 10px 0"><h3 style="margin-bottom:0;">PACKING SLIP</h3></td>
                                <td style="text-align:left; border-bottom: solid 1px #000; white-space: nowrap"><h3 style="margin-bottom:0"># {{ $id }}</h3></td>
                            </tr>
                        </thead>                
                    </table>

                </div>

            </div>



            <table cellpadding="5">
                <tbody>
                    <tr>
                        <td style="text-align: right; font-weight: bold; width: 200px;">Sold To:</td>
                        <td>{{ $order->customer->name }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: right; font-weight: bold; width: 200px;">Contact Name:</td>
                        <td>{{ $order->ContactName }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: right; font-weight: bold; width: 200px;">Phone #:</td>
                        <td>{{ $order->Phone }} {{ $order->PhoneExt }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: right; font-weight: bold; width: 200px;">Jot Title:</td>
                        <td>{{ $order->JobTitle }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: right; font-weight: bold; width: 200px;">Customer PO#:</td>
                        <td>{{ $order->CustPO }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: right; font-weight: bold; width: 200px;">Production Oder #:</td>
                        <td>{{ $order->id }}</td>
                    </tr>
                </tbody>
            </table>

            <table cellpadding="5">
                <tbody>
                    <td style="width: 600px; text-align: right">Order Status:</td>
                    <td style="width: 200px">{{ $packing->OrderStatus }}</td>
                </tbody>
            </table>

            <table width=100% cellpadding="5" >
                <tbody>
                    <tr>
                        <td style="width:35%; text-align:center">Date Shipped</td>
                        <td style="width:30%"></td>
                        <td style="width:35%; text-align:center">Total Shipped</td>
                    </tr>
                    <tr>
                        <td style="border:solid 1px #000; width:35%; text-align:center">{{ $packing->DateShip }}</td>
                        <td></td>
                        <td style="border:solid 1px #000; width:35%; text-align:center">{{ $packing->TotalShip }}</td>
                    </tr>
                </tbody>
            </table>

            <h3 style="text-align:center">SIZE DESCRIPTION</h3>

            <table cellpadding="5" style="width:100%; border:solid 1px #000">

                <tr>

                    <td style="text-align:center; font-weight:bold;"> Dim #1</td>
                    <td></td>
                    <td style="text-align:center; font-weight:bold"> Dim #2</td>
                    <td style="text-align:center; font-weight:bold;"> Description</td>

                </tr>

                <tr>

                    <td style="text-align:center">{{ $order->SizeDimension1}}</td>
                    <td>X</td>
                    <td style="text-align:center">{{ $order->SizeDimension2 }}</td>
                    <td style="text-align:center">{{ $order->Description }}</td>

                </tr>

            </table>

            <h3 style="margin-bottom:0;">DETAILS</h3>

            <table cellpadding="5" style="width:100%; border:solid 1px #000">

                <tr>
                    <td style="min-height:80px; height:80px; vertical-align: top">{{ $packing->Details }}</td>                    
                </tr>

            </table>

     
            <table style="width:100%">

                <tr>

                    <td style="text-align:center">

                        @if($order->CPU == 1)
                        
                            <input checked=true type="checkbox" /> 
                    
                        @else

                            <input type="checkbox" />

                        @endif
                    
                        CPU 
                    
                    
                        @if($order->SHIPVIA == 1)

                            <input checked="true" type="checkbox"> 

                        @else 

                            <input type="checkbox"> 

                        @endif

                        SHIP VIA
                        
                    </td>
                </tr>           

            </table>

        
            <table cellpadding="5" style="width:100%">

                <tr>
                    <td style="width:200px;" align="right">Ship To:</td>                
                    <td style="padding-left:30px">                    
                        @if ($order->ShipTo != '')

                            {{ $order->ShipTo}}<br />

                        @endif 
                    </td>
                </tr>
                <tr>
                    <td style="width:200px;" align="right">Address:</td>
                    <td style="padding-left:30px">

                        @if ($order->Address1 != '')

                            {{ $order->Address1}}<br />

                        @endif 
                    </td>
                </tr>
                <tr>
                    <td style="width:200px;" align="right">Address 2:</td>
                    <td style="padding-left:30px">

                        @if ($order->Address2 != '') 
                            
                            {{ $order->Address2 }}<br />

                        @endif

                </tr>
                <tr>
                    <td style="width:200px;" align="right">City:</td>                   
                    <td style="padding-left:30px">
                        {{ $order->City }}
                    </td>
                </tr>
                <tr>
                    <td style="width:200px;" align="right">State:</td>
                    <td style="padding-left:30px">{{ $order->ST }}</td>
                </tr>
                <tr>
                    <td style="width:200px;" align="right">Zip:</td>
                    <td style="padding-left:30px">{{ $order->Zip }}</td>                    
                </tr>           

            </table>

            <h3 style="text-align:center; margin-bottom: 0;">SHIPPING DETAILS</h3>

            <div style="padding:10px; border:solid 1px #000; min-height: 50px; margin-bottom:40px;">

            </div>

            <table width="100%" cellspacing=0>

                <tr>

                    <td style="border-bottom: solid 1px #000; padding: 5px; font-weight:bold; text-transform:uppercase ">Name of Courier</td>

                    <td style="border-bottom: solid 1px #000;"></td>

                </tr>

                <tr>

                    <td style="border-bottom: solid 1px #000; padding: 30px 5px 5px 5px; font-weight:bold; text-transform:uppercase ">Print Name</td>

                    <td style="border-bottom: solid 1px #000;"></td>

                </tr>


            </table>

        </div>

    </body>
</html>