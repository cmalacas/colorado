<div class="row">
    <div class="col col-md-6">
        @component('ui.inputs.text', 
            ['name' => 'Printing', 
            'class' => 'form-control', 
            'placeholder' => 'Printing',
            'value' => isset($data['Printing']) ? $data['Printing'] : '',
            ])
        @endcomponent
    
        @component('ui.inputs.text', 
            ['name' => 'InsideTintStyle', 
            'class' => 'form-control', 
            'options' => $styles,
            'placeholder' => 'Inside Tint Style',
            'value' => isset($data['InsideTintStyle']) ? $data['InsideTintStyle'] : '',
            ])
        @endcomponent
       
    
        @component('ui.inputs.text', 
            ['name' => 'Sides', 
            'class' => 'form-control', 
            'options' => [1,2],
            'placeholder' => 'Sides',
            'value' => isset($data['Sides']) ? $data['Sides'] : '',
            ])
        @endcomponent
    
        @component('ui.inputs.text', 
            ['name' => 'Colors1', 
            'class' => 'form-control', 
            'placeholder' => 'Color 1',
            'value' => isset($data['Colors1']) ? $data['Colors1'] : '',
            ])
        @endcomponent
    
        @component('ui.inputs.text', 
            ['name' => 'Colors2', 
            'class' => 'form-control', 
            'placeholder' => 'Color 2',
            'value' => isset($data['Colors2']) ? $data['Colors2'] : '',
            ])
        @endcomponent
    
        @component('ui.inputs.text', 
            ['name' => 'Colors3', 
            'class' => 'form-control', 
            'placeholder' => 'Color 3',
            'value' => isset($data['Colors3']) ? $data['Colors3'] : '',
            ])
        @endcomponent
    
        @component('ui.inputs.text', 
            ['name' => 'Colors4', 
            'class' => 'form-control', 
            'placeholder' => 'Color 4',
            'value' => isset($data['Colors4']) ? $data['Colors4'] : '',
            ])
        @endcomponent
    
        @component('ui.inputs.checkbox', 
            ['name' => 'ProofReqd', 
            'class' => 'form-control', 
            'placeholder' => 'Proof Required',
            'value' => isset($data['ProofReqd']) ? $data['ProofReqd'] : '',
            ])
        @endcomponent
    </div>
</div>
<div class="row d-none">
    <div class="col col-md-12">
        @component('ui.inputs.textarea', 
            ['name' => 'CustomerSup', 
            'class' => 'form-control', 
            'placeholder' => 'Customer Supplied',
            'value' => isset($data['CustomerSup']) ? $data['CustomerSup'] : '',
            ])
        @endcomponent
    </div>
</div>
<div class="row d-none">
    <div class="col col-md-12">
        @component('ui.inputs.textarea', 
            ['name' => 'SpecialPrintInst', 
            'class' => 'form-control', 
            'placeholder' => 'Special Printing Instructions',
            'value' => isset($data['SpecialPrintInst']) ? $data['SpecialPrintInst'] : '',
            ])
        @endcomponent
    </div>
</div>