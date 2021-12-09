<div class="schedule-form">
    <form>
        <input type="hidden" name="id" value="{{ $order->id }}" />

        <table class="table table-bordered table-hover table-stripped">
            <thead class="bg bg-info text-white">
                <tr>
                    <td>Customer</td>
                    <td>Qty</td>
                    <td>Size 1</td>
                    <td>Size 2</td>
                    <td>Description</td>
                    <td>Due</td>
                    <td>Printing</td>
                </tr>
            </thead>
            <tbody>                
                <tr>
                   
                    <td>
                        <select name="CustomerId" class="form-control">
                            
                            @foreach($customers as $customer)

                                @if (isset($order->CustomerId) && $order->CustomerId == $customer['id'])

                                <option selected="selected" value={{ $customer['id'] }}>{{ $customer['name'] }}</option>

                                @else

                                <option value={{ $customer['id'] }}>{{ $customer['name'] }}</option>

                                @endif

                            @endforeach

                        </select>
                    </td>
                    <td>
                        <input type="text" name="QtyNeeded" value="{{ $order->QtyNeeded }}" class="form-control" />
                    </td>
                    <td>
                        <input type="text" name="SizeDimension1" value="{{ $order->SizeDimension1 }}" class="form-control" />
                    </td>
                    <td>
                        <input type="text" name="SizeDimension2" value="{{ $order->SizeDimension2 }}" class="form-control" />
                    </td>
                    <td>
                        <input type="text" name="Description" value="{{ $order->Description }}" class="form-control" />
                    </td>
                    <td>
                        <input type="text" name="FoldingDue" value="{{ $order->FoldingDue }}" class="date form-control" />
                    </td>
                    <td>
                        <input type="text" name="Printing" value="{{ $order->Printing }}" class="form-control" />
                    </td>
                </tr>
            </tbody>
        </table>

        <table class="mt-2 table table-bordered table-hover table-stripped">
            <thead class="bg bg-info text-white">
                <tr>                    
                    <td>Location</td>
                    <td>Status</td>
                    <td>Stock Due</td>
                    <td>Order</td>
                    <td>Date Due</td>
                    <td>Job Title</td>
                    <td>Ship VIA</td>                    
                </td>
            </thead>
            <tbody>
                <tr>
                    
                    <td>
                        <input type="text" name="Location" value="{{ $order->Location }}" class="form-control" />
                    </td>
                    <td>
                        <input type="text" name="FoldingScheduleStatus" value="{{ $order->FoldingScheduleStatus }}" class="form-control" />
                    </td>
                    <td>
                        <input type="text" name="StockDueIn" value="{{ $order->StockDueIn }}" class="date form-control" />
                    </td>
                    <td>
                        <input type="number" name="FoldingOrder" value="{{ $order->FoldingOrder }}" class="form-control" />
                    </td>
                    <td>
                        <input type="text" name="DateDue" value="{{ $order->DateDue }}" class="date form-control" />
                    </td>
                    <td>
                        <input type="text" name="JobTitle" value="{{ $order->JobTitle}}" class="form-control" />
                    </td>
                    <td class="text-center">
                        <input type="checkbox" {{ $order->SHIPVIA == 1  ? 'checked' : '' }} name="SHIPVIA" value="{{ $order->SHIPVIA }}" class="form-control" />
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</div>