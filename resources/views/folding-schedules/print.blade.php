@extends('layouts.print')

@section('title', $machine->machine )

@section('content')


<div style="padding:30px">

    <div style="display: flex; justify-content: space-between">

        <h1>{{ $machine->machine }}</h2>

        <div style="">{{ date("l, F d, Y h:i:s A") }}</div>

    </div>

    <table style="width:100%" cellpadding=5>

        <thead style="background-color: #000; color: #fff">
            <tr>
                @foreach( $columns as $c )
                <th>{{ $c }}</th>
                @endforeach
            </tr>
        </thead>

        <tbody>

            @foreach( $data as $row )

            <tr style="border-bottom: solid 1px #ccc; border-right: solid 1px #ccc; border-left: solid 1px #ccc;">

                <td>{{ $row->id }}</td>
                <td>{{ $row->customer->name }}</td>
                <td>{{ $row->QtyNeeded }}</td>
                <td>{{ $row->SizeDimension1 }}</td>
                <td>x</td>
                <td>{{ $row->SizeDimension2 }}</td>
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
                        $machine->machine == 'Straight Knife'
                    )

                    
                    <td>{{ $row->Printing }}</td>
                    <td>{{ $row->Location }}</td>
                    <td>{{ $row->FoldingScheduleStatus }}</td>
                    <td>{{ $row->StockDueIn }}</td>
                    <td>{{ $row->FoldingOrder }}</td>
                    <td>{{ $row->DateDue }}</td>
                    <td>{{ $row->JobTitle }}</td>
                    <td>{{ $row->SHIPVIA == 1 ? 'YES' : 'NO' }}</td>

                @elseif (

                    $machine->machine == 'Super Jet 1' ||
                    $machine->machine == 'Super Jet 2'

                )

                    
                    
                    <td>{{ $row->Printing }}</td>
                    <td>{{ $row->Location }}</td>
                    <td>{{ $row->StockDueIn }}</td>
                    <td>{{ $row->JetOrder }}</td>
                    <td>{{ $row->JetScheduleStatus }}</td>
                    <td>{{ $row->JobTitle }}</td>
                    <td>{{ $row->SHIPVIA == 1 ? 'YES' : 'NO' }}</td>

                
                @endif

            </tr>

            @endforeach 

        </tbody>

    </table>

</table>

@endsection