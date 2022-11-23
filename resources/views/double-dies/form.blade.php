
<div class="row">

    <div class="col-md-6">

        @component('ui.inputs.text', 
            ['name' => 'WindowDoubleDie', 
            'class' => 'form-control', 
            'placeholder' => 'Window Double Die',    
            'value' => isset($info['WindowDoubleDie']) ? $info['WindowDoubleDie'] : ''
            ]),
        @endcomponent

        @component('ui.inputs.text', 
            ['name' => 'WindowSize1', 
            'class' => 'form-control', 
            'placeholder' => 'Window Size 1',    
            'value' => isset($info['WindowSize1']) ? $info['WindowSize1'] : ''
            ]),
        @endcomponent

        @component('ui.inputs.text', 
            ['name' => 'WindowSize2', 
            'class' => 'form-control', 
            'placeholder' => 'Window Size 2',    
            'value' => isset($info['WindowSize2']) ? $info['WindowSize2'] : ''
            ]),
        @endcomponent

        @component('ui.inputs.text', 
            ['name' => 'WindowSize3', 
            'class' => 'form-control', 
            'placeholder' => 'Window Size 3',    
            'value' => isset($info['WindowSize3']) ? $info['WindowSize3'] : ''
            ]),
        @endcomponent

        @component('ui.inputs.select', 
            ['name' => 'status', 
            'class' => 'form-control', 
            'placeholder' => 'Status',    
            'options' => ['Enabled','Disabled'],
            'value' => isset($info['status']) ? $info['status'] : 'Enabled'
            ]),
        @endcomponent

    </div>

    <div class="col-md-6">

        @component('ui.inputs.text', 
            ['name' => 'EnvelopeSize', 
            'class' => 'form-control', 
            'placeholder' => 'Envelope Size',    
            'value' => isset($info['EnvelopeSize']) ? $info['EnvelopeSize'] : ''
            ]),
        @endcomponent

        @component('ui.inputs.text', 
            ['name' => 'WindowPosition1', 
            'class' => 'form-control', 
            'placeholder' => 'Window Position 1',    
            'value' => isset($info['WindowPosition1']) ? $info['WindowPosition1'] : ''
            ]),
        @endcomponent

        @component('ui.inputs.text', 
            ['name' => 'WindowPosition2', 
            'class' => 'form-control', 
            'placeholder' => 'Window Position 2',    
            'value' => isset($info['WindowPosition2']) ? $info['WindowPosition2'] : ''
            ]),
        @endcomponent

        @component('ui.inputs.text', 
            ['name' => 'WindowPosition3', 
            'class' => 'form-control', 
            'placeholder' => 'Window Position 3',    
            'value' => isset($info['WindowPosition3']) ? $info['WindowPosition3'] : ''
            ]),
        @endcomponent

        

    </div>


</div>

