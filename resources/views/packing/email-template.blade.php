
    <table class="table table-bordered">
        <thead>
            <tr>
                <td>Date Shipped</td>
                <td>Total Shipped</td>
                <td>Details</td>
                <td>Order Status</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $packing['DateShip'] }}</td>
                <td>{{ $packing['TotalShip'] }}</td>
                <td>{!! $packing['Details'] !!}</td>
                <td>{{ $packing['OrderStatus'] }}</td>
            </tr>
        </tbody>
    </table>

    
    <table class="table table-bordered">
        <thead>
            <tr>
                <td>Remarks</td>                
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{!! $remarks !!}</td>
            </tr>
        </tbody>
    </table>