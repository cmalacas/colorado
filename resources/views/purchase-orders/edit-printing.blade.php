<div class="row">
    <div class="col col-md-6">
        @component('ui.inputs.select', 
            ['name' => 'print', 
            'class' => 'form-control', 
            'options' => $printing,
            'placeholder' => 'Printing'])
        @endcomponent
    </div>
</div><div class="row">
    <div class="col col-md-12">
        @component('ui.inputs.select', 
            ['name' => 'style', 
            'class' => 'form-control', 
            'options' => $styles,
            'placeholder' => 'Style'])
        @endcomponent
        (Required for Inside Tint)
    </div>
</div><div class="row">
    <div class="col col-md-12">
        @component('ui.inputs.select', 
            ['name' => 'sides', 
            'class' => 'form-control', 
            'options' => [1,2],
            'placeholder' => 'Sides'])
        @endcomponent
    </div>
</div><div class="row">
    <div class="col col-md-12">
        @component('ui.inputs.text', 
            ['name' => 'color1', 
            'class' => 'form-control', 
            'placeholder' => 'Color 1'])
        @endcomponent
    </div>
</div><div class="row">
    <div class="col col-md-12">
        @component('ui.inputs.text', 
            ['name' => 'color2', 
            'class' => 'form-control', 
            'placeholder' => 'Color 2'])
        @endcomponent
    </div>
</div><div class="row">
    <div class="col col-md-12">
        @component('ui.inputs.text', 
            ['name' => 'color3', 
            'class' => 'form-control', 
            'placeholder' => 'Color 3'])
        @endcomponent
    </div>
</div><div class="row">
    <div class="col col-md-12">
        @component('ui.inputs.checkbox', 
            ['name' => 'proof_required', 
            'class' => 'form-control', 
            'placeholder' => 'Proof Required'])
        @endcomponent
    </div>
</div><div class="row">
    <div class="col col-md-12">
        @component('ui.inputs.textarea', 
            ['name' => 'customer_supplied', 
            'class' => 'form-control', 
            'placeholder' => 'Customer Supplied'])
        @endcomponent
    </div>
</div><div class="row">
    <div class="col col-md-12">
        @component('ui.inputs.textarea', 
            ['name' => 'printing_instructions', 
            'class' => 'form-control', 
            'placeholder' => 'Special Printing Instructions'])
        @endcomponent
    </div>
</div>