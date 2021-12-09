<div class="row">

    <div class="col-md-6 d-flex">

        
        @component('ui.inputs.text', 
            ['name' => 'SizeDimension1', 
            'class' => 'form-control', 
            'placeholder' => 'Size 1',
            'tabindex' => 30,
            'value' => isset($data['SizeDimension1']) ? $data['SizeDimension1'] : ''
            ])
        @endcomponent
        
        <div class="text-center ml-4 mr-4">x</div>
        
        @component('ui.inputs.text', 
            ['name' => 'SizeDimension2', 
            'class' => 'form-control', 
            'placeholder' => 'Size 2',
            'tabindex' => 31,
            'value' => isset($data['SizeDimension2']) ? $data['SizeDimension2'] : ''
            ])
        @endcomponent

        


    </div>

    <div class="col-md-6">

        @component('ui.inputs.text', 
            ['name' => 'Description', 
            'class' => 'form-control', 
            'options' => $descriptions,
            'placeholder' => 'Description',
            'tabindex' => 32,
            'value' => isset($data['Description']) ? $data['Description'] : ''
            ])
        @endcomponent        

    </div>

</div>

<div class="row">

    <div class="col-md-4">

        @component('ui.inputs.text', 
            ['name' => 'SealFlapSz', 
            'class' => 'form-control', 
            'placeholder' => 'Seal Flap Size',
            'tabindex' => 33,
            'value' => isset($data['SealFlapSz']) ? $data['SealFlapSz'] : ''
            ])
        @endcomponent

        @component('ui.inputs.text', 
            ['name' => 'GumType', 
            'class' => 'form-control', 
            'options' => $gums,  
            'tabindex' => 35,
            'placeholder' => 'Type of Gum',
            'value' => isset($data['GumType']) ? $data['GumType'] : ''
            ])
        @endcomponent

    </div>

    <div class="col-md-6 offset-md-2">

        @component('ui.inputs.text', 
            ['name' => 'SealFlap', 
            'class' => 'form-control',
            'options' => $seals,  
            'placeholder' => 'Seal Flap',
            'tabindex' => 34,
            'value' => isset($data['SealFlap']) ? $data['SealFlap'] : ''
            ])
        @endcomponent

    </div>

</div>

<div class="row">

    <div class="col-md-4">

        @component('ui.inputs.text', 
            ['name' => 'QtyNeeded', 
            'class' => 'form-control text-right', 
            'placeholder' => 'Quantity Needed',
            'tabindex' => 36,
            'value' => isset($data['QtyNeeded']) ? $data['QtyNeeded'] : ''
            ])
        @endcomponent

    </div>

    <div class="col-md-2">

        @component('ui.inputs.checkbox', 
            ['name' => 'RunAll', 
            'class' => 'form-control', 
            'placeholder' => 'Run All',
            'tabindex' => 37,
            'value' => isset($data['RunAll']) ? $data['RunAll'] : ''
            ])
        @endcomponent

    </div>

    <div class="col-md-6">

        @component('ui.inputs.text', 
            ['name' => 'OversAllow', 
            'class' => 'form-control text-right', 
            'placeholder' => 'Overs Allowed (%)',
            'tabindex' => 38,
            'value' => isset($data['OversAllow']) ? $data['OversAllow'] : ''
            ])
        @endcomponent

    </div>

</div>

<div class="row">

    <div class="col-md-4">

        @component('ui.inputs.text', 
            ['name' => 'Total', 
            'class' => 'form-control text-right', 
            'placeholder' => 'Total Quantity',
            'readonly' => true,
            'tabindex' => 39,
            'value' => isset($data['Total']) ? $data['Total'] : ''
            ])
        @endcomponent

    </div>

</div>

<div class="row">

    <div class="col-md-4">

        @component('ui.inputs.text', 
            ['name' => 'AmountForJets', 
            'class' => 'form-control', 
            'placeholder' => 'Amount For Jets',
            'tabindex' => 40,
            'value' => isset($data['AmountForJets']) ? $data['AmountForJets'] : ''
            ])
        @endcomponent


    </div>

</div>

<div class="row">

    <div class="col-md-4">

        @component('ui.inputs.text', 
            [
                'name' => 'WindowDoubleDie',
                'class' => 'form-control',
                'placeholder' => 'Windows Double Die',
                'tabindex' => 41,
                'value' => isset($data['WindowDoubleDie']) ? $data['WindowDoubleDie'] : ''
            ])
        @endcomponent        


    </div>

</div>

<div class="row">

    <div class="col-md-4">

        @component('ui.inputs.text', 
            [
                'name' => 'WindowSz1', 
                'class' => 'form-control', 
                'placeholder' => 'Window Size 1',
                'tabindex' => 42,
                'value' => isset($data['WindowSz1']) ? $data['WindowSz1'] : ''
            ]
        )
        @endcomponent

        @component('ui.inputs.text', 
            [
                'name' => 'WindowSz2', 
                'class' => 'form-control', 
                'placeholder' => 'Window Size 2',
                'tabindex' => 45,
                'value' => isset($data['WindowSz2']) ? $data['WindowSz2'] : ''
            ]
        )
        @endcomponent

        @component('ui.inputs.text', 
            [
                'name' => 'WindowSz3', 
                'class' => 'form-control', 
                'placeholder' => 'Window Size 3',
                'tabindex' => 48,
                'value' => isset($data['WindowSz3']) ? $data['WindowSz3'] : ''
            ]
        )
        @endcomponent

    </div>

    <div class="offset-md-2 col-md-6">

        <div class="row">

            <div class="col-md-9">

                @component('ui.inputs.text', 
                    ['name' => 'WindowPos1', 
                    'class' => 'form-control', 
                    'placeholder' => 'Window Position 1',
                    'tabindex' => 43,
                    'value' => isset($data['WindowPos1']) ? $data['WindowPos1'] : ''
                    ])
                @endcomponent

            </div>

            <div class="col-md-3">
                @component('ui.inputs.text', 
                    ['name' => 'OpenPolyWinPos1', 
                    'class' => 'form-control',
                    'options' => $openPolies, 
                    'placeholder' => 'Unit 1',
                    'tabindex' => 44,
                    'value' => isset($data['OpenPolyWinPos1']) ? $data['OpenPolyWinPos1'] : '',
                    'withLabel' => false
                    ])
                @endcomponent
            </div>
        </div>
        
        <div class="row">  

            <div class="col-md-9">

                @component('ui.inputs.text', 
                    ['name' => 'WindowPos2', 
                    'class' => 'form-control', 
                    'placeholder' => 'Window Position 2',
                    'tabindex' => 46,
                    'value' => isset($data['WindowPos2']) ? $data['WindowPos2'] : ''
                    ])
                @endcomponent

            </div>

            <div class="col-md-3">    
                @component('ui.inputs.text', 
                    ['name' => 'OpenPolyWinPos2', 
                    'class' => 'form-control',
                    'options' => $openPolies,  
                    'placeholder' => 'Unit 2',
                    'tabindex' => 47,
                    'value' => isset($data['OpenPolyWinPos2']) ? $data['OpenPolyWinPos2'] : '',
                    'withLabel' => false
                    ])
                @endcomponent
            </div>
        </div>       

        <div class="row">  

            <div class="col-md-9">

                @component('ui.inputs.text', 
                    ['name' => 'WindowPos3', 
                    'class' => 'form-control', 
                    'placeholder' => 'Window Position 3',
                    'tabindex' => 49,
                    'value' => isset($data['WindowPos3']) ? $data['WindowPos3'] : ''
                    ])
                @endcomponent
            </div>

            <div class="col-md-3">
                @component('ui.inputs.text', 
                    ['name' => 'OpenPolyWinPos3', 
                    'options' => $openPolies, 
                    'class' => 'form-control', 
                    'placeholder' => 'Unit 3',
                    'tabindex' => 50,
                    'value' => isset($data['OpenPolyWinPos3']) ? $data['OpenPolyWinPos3'] : '',
                    'withLabel' => false
                    ])
                @endcomponent

            </div>

        </div>    

    </div>

</div>


    
<div class="row d-none">
    <div class="col col-md-6">
        

        @component('ui.inputs.text', 
            ['name' => 'SealFlapStyle', 
            'class' => 'form-control',
            'options' => $seals,  
            'placeholder' => 'Seal Flap Style',
            'value' => isset($data['SealFlapStytle']) ? $data['SealFlapStyle'] : ''
            ])
        @endcomponent

        

        

       

    </div>

    <div class="col-md-6">

        

    </div>

</div>

<div class="row">

    <div class="col">
            
        @component('ui.inputs.textarea', 
            ['name' => 'SpecialConvInst', 
                'class' => 'form-control', 
                'placeholder' => 'Special Converting Instructions',
                'tabindex' => 51,
            'value' => isset($data['SpecialConvInst']) ? $data['SpecialConvInst'] : ''
            ])
        @endcomponent

    </div>

</div>