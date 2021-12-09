<div class="row">
    <div class="col col-md-6">
        @component('ui.inputs.checkbox', 
            ['name' => 'CPU', 
            'class' => 'form-control', 
            'placeholder' => 'CPU',
            'value' => isset($data['CPU']) ? $data['CPU'] : ''
            ])
        @endcomponent
    
        @component('ui.inputs.checkbox', 
            ['name' => 'SHIPVIA', 
            'class' => 'form-control', 
            'placeholder' => 'SHIP VIA',
            'value' => isset($data['SHIPVIA']) ? $data['SHIPVIA'] : ''
            ])
        @endcomponent
    
        @component('ui.inputs.text', 
            ['name' => 'ShipViaDetail', 
            'class' => 'form-control', 
            'placeholder' => 'Shipping Company',
            'autocomplete' => false,
            'value' => isset($data['ShipViaDetail']) ? $data['ShipViaDetail'] : ''
            ])
        @endcomponent
    
        @component('ui.inputs.text', 
            ['name' => 'Account', 
            'class' => 'form-control', 
            'placeholder' => 'Account #',
            'value' => isset($data['Account']) ? $data['Account'] : ''
            ])
        @endcomponent
    </div>
</div>

<div class="row">
    <div class="col col-md-6">
    <h2 class="text-center m-4 mb-2">SHIPPING INFORMATION</h2>
        @component('ui.inputs.text', 
            ['name' => 'ShipTo', 
            'class' => 'form-control', 
            'placeholder' => 'Ship To',
            'value' => isset($data['ShipTo']) ? $data['ShipTo'] : ''
            ])
        @endcomponent
    
        @component('ui.inputs.text', 
            ['name' => 'Address1', 
            'class' => 'form-control', 
            'placeholder' => 'Address 1',
            'value' => isset($data['Address1']) ? $data['Address1'] : ''
            ])
        @endcomponent
    
        @component('ui.inputs.text', 
            ['name' => 'Address2', 
            'class' => 'form-control', 
            'placeholder' => 'Address 2',
            'value' => isset($data['Address2']) ? $data['Address2'] : ''
            ])
        @endcomponent
    
        @component('ui.inputs.text', 
            ['name' => 'City', 
            'class' => 'form-control', 
            'placeholder' => 'City',
            'value' => isset($data['City']) ? $data['City'] : ''
            ])
        @endcomponent
    
        @component('ui.inputs.text', 
            ['name' => 'ST', 
            'class' => 'form-control', 
            'placeholder' => 'State',
            'value' => isset($data['ST']) ? $data['ST'] : ''
            ])
        @endcomponent
    
        @component('ui.inputs.text', 
            ['name' => 'Zip', 
            'class' => 'form-control', 
            'placeholder' => 'Zip',
            'value' => isset($data['Zip']) ? $data['Zip'] : ''
            ])
        @endcomponent
    
        @component('ui.inputs.text', 
            ['name' => 'ShipAttn', 
            'class' => 'form-control', 
            'placeholder' => 'Attn',
            'value' => isset($data['ShipAttn']) ? $data['ShipAttn'] : ''
            ])
        @endcomponent
    
        @component('ui.inputs.text', 
            ['name' => 'ShipContactPhone', 
            'class' => 'form-control phone', 
            'placeholder' => 'Phone',
            'value' => isset($data['ShipContactPhone']) ? $data['ShipContactPhone'] : ''
            ])
        @endcomponent
    
        @component('ui.inputs.textarea', 
            ['name' => 'SHIPPINGINSTRUCTIONS', 
            'class' => 'form-control', 
            'placeholder' => 'SHIPPING INSTRUCTIONS',
            'value' => isset($data['SHIPPINGINSTRUCTIONS']) ? $data['SHIPPINGINSTRUCTIONS'] : ''
            ])
        @endcomponent
    </div>
</div>