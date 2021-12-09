<div class="form-group row">

    <label class="col-md-3 text-right">Sold To</label>

    <div class="col-md-7">

        <select tabindex="1" name="CustomerId" class="form-control">
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

    <a data-toggle="tooltip" title="Select customer" href="#" class="btn btn-primary btn-customer"><i class="fa fa-users"></i></a>


</div>

@component('ui.inputs.text', 
    ['name' => 'ContactName', 
    'class' => 'form-control', 
    'placeholder' => 'Contact Name',
    'help' => 'Type a keyword to search',
    'tabindex' => 3,
    'value' => isset($data['ContactName']) ? $data['ContactName'] : ''
    ])
@endcomponent



@component('ui.inputs.text', 
    ['name' => 'Email', 
    'class' => 'form-control', 
    'placeholder' => 'Email',
    'tabindex' => 5,
    'value' => isset($data['Email']) ? $data['Email'] : ''
    ])
@endcomponent

@component('ui.inputs.text', 
    ['name' => 'Phone', 
    'class' => 'form-control', 
    'placeholder' => 'Phone',
    'tabindex' => 7,
    'value' => isset($data['Phone']) ? $data['Phone'] : ''
    ])
@endcomponent

@component('ui.inputs.text', 
    ['name' => 'PhoneExt', 
    'class' => 'form-control', 
    'placeholder' => 'Phone Ext',
    'tabindex' => 9,
    'value' => isset($data['PhoneExt']) ? $data['PhoneExt'] : ''
    ])
@endcomponent

@component('ui.inputs.text', 
    ['name' => 'Mobile', 
    'class' => 'form-control', 
    'placeholder' => 'Mobile',
    'tabindex' => 11,
    'value' => isset($data['Mobile']) ? $data['Mobile'] : ''
    ])
@endcomponent

@component('ui.inputs.text', 
    ['name' => 'Fax', 
    'class' => 'form-control', 
    'placeholder' => 'Fax',
    'tabindex' => 13,
    'value' => isset($data['Fax']) ? $data['Fax'] : ''
    ])
@endcomponent

@component('ui.inputs.checkbox', 
    ['name' => 'SampleProv', 
        'class' => 'form-control', 
        'placeholder' => 'Sample Provided',
        'tabindex' => 20,
        'value' => isset($data['SampleProv']) ? $data['SampleProv'] : ''
    ])
@endcomponent





@component('ui.inputs.text', 
    ['name' => 'our_stocks', 
    'class' => 'form-control', 
    'placeholder' => 'Our Stock',
    'tabindex' => 22,
    'value' => isset($data['our_stocks']) ? $data['our_stocks'] : ''
    ])
@endcomponent

@component('ui.inputs.text', 
    ['name' => 'customer_stocks', 
    'class' => 'form-control', 
    'placeholder' => 'Customer Stock',
    'tabindex' => 23,
    'value' => isset($data['customer_stocks']) ? $data['customer_stocks'] : ''
    ])
@endcomponent