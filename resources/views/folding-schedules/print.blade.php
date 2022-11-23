@extends('layouts.print')

@section('title', $machine->machine )

@section('content')


<div id="printout" style="padding: 0 30px 10px">

    <table style="width:100%" cellpadding=5>

        <thead>
            
            <tr>
                <th colspan="2">{{ $machine->machine }}</th>
                <th colspan="8" style="text-align:center"><span id="page"></span></th>
                <th colspan="4" style="text-align:right;">{{ date("l, F d, Y h:i:s A") }}</th>
            </tr>

            <tr style="background-color: #000; color: #fff">
                @foreach( $columns as $c )
                <th>{{ $c }}</th>
                @endforeach
            </tr>

        </thead>

        @php 
        
            $counter = 0; 
            $limit = 30;
            
        @endphp

        @foreach( $data as $row )

        @if ( $counter === 0 )

        <tbody>

        @endif
            
            <tr style="border-bottom: solid 1px #ccc; border-right: solid 1px #ccc; border-left: solid 1px #ccc;">

                <td>{{ $row->id }}</td>
                <td>{{ $row->customer->name }}</td>
                <td>{{ $row->QtyNeeded }}</td>
                <td style="white-space:nowrap">{{ $row->SizeDimension1 }}</td>
                <td>x</td>
                <td style="white-space:nowrap">{{ $row->SizeDimension2 }}</td>
                <td>{{ $row->Description }}</td>

                @if (
                        $machine->machine == 'Latex / PS' ||                  
                        $machine->machine == 'RA-1' || 
                        $machine->machine == 'RA-2' || 
                        $machine->machine == 'RA-3' || 
                        $machine->machine == 'RA-WEB'  ||
                        $machine->machine == 'RO-WEB' ||
                        $machine->machine == 'WR-1' ||
                        $machine->machine == 'WR-2' ||
                        $machine->machine == 'WR-3' ||
                        $machine->machine == 'MO' ||
                        $machine->machine == 'MOW' ||
                        $machine->machine == 'Straight Knife'
                    )

                    
                    <td>{{ $row->Printing }}</td>
                    <td>{{ $row->Location }}</td>
                    
                    <td style="white-space: nowrap">{!! Carbon\Carbon::parse($row->StockDueIn)->format("m-d-Y") !!}</td>
                    <td>{{ $row->FoldingOrder }}</td>
                    <td style="white-space: nowrap">{!! Carbon\Carbon::parse($row->DateDue)->format("m-d-Y") !!}</td>
                    <td>{{ $row->JobTitle }}</td>
                    <td>{{ $row->SHIPVIA == 1 ? 'YES' : 'NO' }}</td>

                @elseif (

                    $machine->machine == 'Super Jet 1' ||
                    $machine->machine == 'Super Jet 2'

                )

                    
                    
                    <td>{{ $row->Printing }}</td>
                    <td style="white-space:nowrap">{{ $row->Location }}</td>
                    <td>{{ Carbon\Carbon::parse($row->StockDueIn)->format("m-d-y") }}</td>
                    <td>{{ $row->JetOrder }}</td>
                    
                    <td>{{ $row->JobTitle }}</td>
                    <td>{{ $row->SHIPVIA == 1 ? 'YES' : 'NO' }}</td>

                
                @endif

            </tr>

            @if ( $counter == $limit )

            </tbody>

            @endif

            @php $counter = $counter < $limit ? $counter + 1 : 0;  @endphp

            @endforeach 



    </table>

</table>

@endsection