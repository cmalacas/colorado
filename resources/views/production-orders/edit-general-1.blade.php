
<div class="form-group row">

<label class="col-md-3 text-right">Sold To</label>

<div class="col-md-7">

    <select tabindex="1" id="CustomerId" name="CustomerId" class="form-control">
        <option value="0">----</option>
        @foreach($customers as $customer)

            @if (isset($data['CustomerId']) && $data['CustomerId'] == $customer['id'])

            <option selected="selected" value={{ $customer['id'] }}>{{ $customer['name'] }}</option>

            @else

            <option value={{ $customer['id'] }}>{{ $customer['name'] }}</option>

            @endif

        @endforeach
    </select>

</div>

{{-- <a data-toggle="tooltip" title="Select customer" href="#" class="btn btn-primary btn-customer"><i class="fa fa-users"></i></a>--}}

<div id="contact-button">xxx</div>


</div>




<div class="row">
    <div class="col col-md-12">
        @component('ui.inputs.text', 
            ['name' => 'OrderDate', 
            'class' => 'form-control date', 
            'placeholder' => 'Order Date',
            'tabindex' => 4,
            'value' => isset($data['OrderDate']) ? $data['OrderDate'] : date("m-d-Y")
            ])
        @endcomponent
    </div>
</div>

@component('ui.inputs.text', 
    ['name' => 'CustPO', 
    'class' => 'form-control', 
    'placeholder' => 'Customer PO',
    'tabindex' => 8,
    'value' => isset($data['CustPO']) ? $data['CustPO'] : ''
    ])
@endcomponent


@component('ui.inputs.text', 
    ['name' => 'QuotedPrice', 
    'class' => 'form-control', 
    'placeholder' => 'Quoted Price',
    'tabindex' => 10,
    'value' => isset($data['QuotedPrice']) ? $data['QuotedPrice'] : ''
    ])
@endcomponent

@component('ui.inputs.text', 
    ['name' => 'UnitFigure', 
    'class' => 'form-control', 
    'options' => $unitFigures,
    'placeholder' => 'Unit',
    'tabindex' => 12,
    'value' => isset($data['UnitFigure']) ? $data['UnitFigure'] : ''
    ])
@endcomponent

@component('ui.inputs.text', 
    ['name' => 'AdditionalChg', 
    'class' => 'form-control', 
    'placeholder' => 'Additional Charges',
    'tabindex' => 14,
    'value' => isset($data['AdditionalChg']) ? $data['AdditionalChg'] : ''
    ])
@endcomponent

@component('ui.inputs.text', 
    ['name' => 'StockDueIn', 
    'class' => 'form-control date', 
    'placeholder' => 'Stock Due In',
    'tabindex' => 15,
    'value' => isset($data['StockDueIn']) ? $data['StockDueIn'] : ''
    ])
@endcomponent

@component('ui.inputs.text', 
    ['name' => 'DateStockIn', 
    'class' => 'form-control date', 
    'placeholder' => 'Date Stock In',
    'tabindex' => 16,   
    'value' => isset($data['DateStockIn']) ? $data['DateStockIn'] : ''
    ])
@endcomponent

@component('ui.inputs.text', 
    ['name' => 'DateDue', 
    'class' => 'form-control date', 
    'placeholder' => 'Date Due',
    'tabindex' => 18,
    'value' => isset($data['DateDue']) ? $data['DateDue'] : ''
    ])
@endcomponent