<form method="post" action="/production-orders/send-packing-slip">

    @csrf

    <input type="hidden" name="id" value={{ $packing['id'] }}>

    <div class="form-group">

        <label>To:</label>

        <input type="text" autocomplete="chrome-off" name="email" placeholder="Enter email address" class="form-control" />

    </div>

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

    
</form>
