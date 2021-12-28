<table class="table table-striped">
    <thead>
        <tr>
            <td>Purchase Order</td>
            <td>To</td>
            <td>Desc</td>
            <td>Qty</td>
        </tr>
    </thead>
    <tbod>
        @foreach($data->purchase_order_items as $item)
        <tr>
            <td><a href="/purchase-orders/{{ $item->purchase_order_id }}/edit" target="_blank">{{ $item->purchase_order_id }}</a></td>
            <td>{{ $item->purchase_order && $item->purchase_order->vendor ? $item->purchase_order->vendor->vendor : '---' }}</td>
            <td>{{ $item->description }}</td>
            <td>{{ $item->qty }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

