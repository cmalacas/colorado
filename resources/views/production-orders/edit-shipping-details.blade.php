<table class="table shipping-details-table">
    <thead>
        <tr>
            <th class="text-nowrap">Packing Slip #</th>         
            <th class="text-nowrap">Date Shipped</th>
            <th class="text-nowrap">Total Shipped</th>
            <th class="text-nowrap">Details</th>
            <th class="text-nowrap">Order Status</th>
            <th></th>
        </tr>
    </thead>
    <tbody>

        
        
    </tbody>
    <tfoot>
        <tr>
            <td>
               
            </td>            
            <td>

                <input type="hidden" name="packing[ColoEnvPO]" value="{{ $data['id'] }}">

                @component('ui.inputs.text', 
                    [
                        'name' => 'packing[DateShip]', 
                        'class' => 'form-control date',
                        'withLabel' => false,
                        'placeholder' => ''
                    ])
                @endcomponent
            </td>
            <td>
                @component('ui.inputs.text', 
                    [
                        'name' => 'packing[TotalShip]', 
                        'class' => 'form-control',
                        'withLabel' => false,
                        'placeholder' => ''
                    ])
                @endcomponent
            </td>
            <td>
                @component('ui.inputs.span', 
                    [
                        'name' => 'packing[Details]', 
                        'class' => 'form-control',
                        'value' => '',
                        'withLabel' => false,
                        'placeholder' => ''
                    ])
                @endcomponent
            </td>
            <td>
                @component('ui.inputs.select', 
                    [
                        'name' => 'packing[OrderStatus]', 
                        'class' => 'form-control',
                        'withLabel' => false,
                        'placeholder' => '',
                        'withLabel' => false,
                        'options' => ["PARTIAL", "COMPLETE"]
                    ])
                @endcomponent
            </td>
            <td>
                <a href="#" class="btn btn-info btn-save"><i class="fa fa-check"></i></a>
            </td>
        </tr>
    </tfoot>
</table>