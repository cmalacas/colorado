

@component('ui.inputs.text', 
    ['name' => 'PreviousOrder', 
    'class' => 'form-control', 
    'placeholder' => 'Previous Order #',
    'tabindex' => 6,
    'value' => isset($data['PreviousOrder']) ? $data['PreviousOrder'] : ''
    ])
@endcomponent

@component('ui.inputs.text', 
    ['name' => 'ofCopies', 
    'class' => 'form-control', 
    'placeholder' => '# of Copies',
    'tabindex' => 17,
    'value' => isset($data['ofCopies']) ? $data['ofCopies'] : ''
    ])
@endcomponent

@component('ui.inputs.text', 
    ['name' => 'Location', 
    'class' => 'form-control', 
    'options' => $locations,
    'placeholder' => 'Location',
    'tabindex' => 21,
    'value' => isset($data['Location']) ? $data['Location'] : ''
    ])
@endcomponent

<div class="p-4 bg-secondary">

    <h2>STEPS</h2>

    @component('ui.inputs.text', 
        ['name' => 'Machine1', 
        'class' => 'form-control', 
        'options' => $machines,
        'placeholder' => 'Step 1',
        'tabindex' => 24,
        'value' => isset($data['Machine1']) ? $data['Machine1'] : ''
        ])
    @endcomponent

    @component('ui.inputs.text', 
        ['name' => 'Machine2', 
        'class' => 'form-control', 
        'options' => $machines,
        'placeholder' => 'Step 2',
        'tabindex' => 25,
        'value' => isset($data['Machine2']) ? $data['Machine2'] : ''
        ])
    @endcomponent

    @component('ui.inputs.text', 
        ['name' => 'Machine3', 
        'class' => 'form-control', 
        'options' => $machines,
        'placeholder' => 'Step 3',
        'tabindex' => 26,
        'value' => isset($data['Machine3']) ? $data['Machine3'] : ''
        ])
    @endcomponent

    @component('ui.inputs.text', 
        ['name' => 'Machine4', 
        'class' => 'form-control', 
        'options' => $machines,
        'placeholder' => 'Step 4',
        'tabindex' => 27,
        'value' => isset($data['Machine4']) ? $data['Machine4'] : ''
        ])
    @endcomponent

    @component('ui.inputs.text', 
        ['name' => 'Machine5', 
        'class' => 'form-control', 
        'options' => $machines,
        'placeholder' => 'Step 5',
        'tabindex' => 28,
        'value' => isset($data['Machine5']) ? $data['Machine5'] : ''
        ])
    @endcomponent

    @component('ui.inputs.text', 
        ['name' => 'Machine6', 
        'class' => 'form-control', 
        'options' => $machines,
        'placeholder' => 'Step 6',
        'tabindex' => 29,
        'value' => isset($data['Machine6']) ? $data['Machine6'] : ''
        ])
    @endcomponent

</div>