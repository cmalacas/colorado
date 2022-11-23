
@component('ui.inputs.text', 
    ['name' => 'JobTitle', 
    'class' => 'form-control', 
    'placeholder' => 'Job Title',
    'maxlength' => 40,
    'tabindex' => 2,
    'value' => isset($data['JobTitle']) ? $data['JobTitle'] : ''
    ])
@endcomponent

@component('ui.inputs.text', 
    ['name' => 'ContactName', 
    'class' => 'form-control', 
    'placeholder' => 'Contact Name',
    
    'tabindex' => 3,
    'value' => isset($data['ContactName']) ? $data['ContactName'] : ''
    ])
@endcomponent

@component('ui.inputs.text', 
    ['name' => 'job_no', 
    'class' => 'form-control', 
    'placeholder' => 'Job #',
    
    'tabindex' => 3,
    'value' => isset($data['job_no']) ? $data['job_no'] : ''
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





@component('ui.inputs.checkbox', 
    ['name' => 'our_stocks', 
    'class' => 'form-control', 
    'placeholder' => 'Our Stock',
    'tabindex' => 22,
    'value' => isset($data['our_stocks']) ? $data['our_stocks'] : ''
    ])
@endcomponent

@component('ui.inputs.checkbox', 
    ['name' => 'customer_stocks', 
    'class' => 'form-control', 
    'placeholder' => 'Customer Stock',
    'tabindex' => 23,
    'value' => isset($data['customer_stocks']) ? $data['customer_stocks'] : ''
    ])
@endcomponent