<div class="row">
    <div class="col">
        @component('ui.inputs.text', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'tabindex' => 30,
            'placeholder' => 'Size 1'])
        @endcomponent
    </div>
    <div class="col text-center">x</div>
    <div class="col">
        @component('ui.inputs.text', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'placeholder' => 'Size 2'])
        @endcomponent
    </div>
    <div class="col">
        @component('ui.inputs.select', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'options' => $descriptions,
            'placeholder' => 'Description'])
        @endcomponent

    </div>
</div>
<div class="row">
    <div class="col col-md-12">
        @component('ui.inputs.text', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'placeholder' => 'Seal Flap Size'])
        @endcomponent
    </div>
</div><div class="row">
    <div class="col col-md-12">
        @component('ui.inputs.text', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'placeholder' => 'Quantity Needed'])
        @endcomponent
        @component('ui.inputs.checkbox', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'placeholder' => 'Run All'])
        @endcomponent
    </div>
</div><div class="row">
    <div class="col col-md-12">
        @component('ui.inputs.text', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'placeholder' => 'Overs Allowed'])
        @endcomponent
    </div>
</div><div class="row">
    <div class="col col-md-12">
        @component('ui.inputs.text', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'placeholder' => 'Total'])
        @endcomponent
    </div>
</div><div class="row">
    <div class="col">
        <h2>CONVERTING</h2>
        @component('ui.inputs.select', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'options' => $windowSizes,
            'placeholder' => 'Window Size 1'])
        @endcomponent

        @component('ui.inputs.select', 
            ['name' => 'CustPO', 
            'class' => 'form-control',
            'options' => $windowSizes, 
            'placeholder' => 'Window Size 2'])
        @endcomponent

        @component('ui.inputs.select', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'options' => $windowSizes,
            'placeholder' => 'Window Size 3'])
        @endcomponent
    </div>

    <div class="col">
        @component('ui.inputs.text', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'placeholder' => 'Window Position 1'])
        @endcomponent
        @component('ui.inputs.select', 
            ['name' => 'CustPO', 
            'class' => 'form-control',
            'options' => $openPolies, 
            'placeholder' => 'Unit 1'])
        @endcomponent

        @component('ui.inputs.text', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'placeholder' => 'Window Position 2'])
        @endcomponent
        @component('ui.inputs.select', 
            ['name' => 'CustPO', 
            'class' => 'form-control',
            'options' => $openPolies,  
            'placeholder' => 'Unit 2'])
        @endcomponent

        @component('ui.inputs.text', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'placeholder' => 'Window Position 3'])
        @endcomponent
        @component('ui.inputs.select', 
            ['name' => 'CustPO', 
            'options' => $openPolies, 
            'class' => 'form-control', 
            'placeholder' => 'Unit 3'])
        @endcomponent
    </div>
</div>
<div class="row">
    <div class="col col-md-12">
        @component('ui.inputs.select', 
            ['name' => 'CustPO', 
            'class' => 'form-control',
            'options' => $seals,  
            'placeholder' => 'Seal Flap'])
        @endcomponent
    </div>
</div><div class="row">
    <div class="col col-md-12">
        @component('ui.inputs.select', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'options' => $gums,  
            'placeholder' => 'Type of Gum'])
        @endcomponent
    </div>
</div><div class="row">
    <div class="col col-md-12">
        @component('ui.inputs.text', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'placeholder' => 'Amount For Jets'])
        @endcomponent
    </div>
</div><div class="row">
    <div class="col col-md-12">
        @component('ui.inputs.select', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'options' => $dies,  
            'placeholder' => 'Windows Double Die'])
        @endcomponent
    </div>
</div><div class="row">
    <div class="col col-md-12">
        @component('ui.inputs.textarea', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'placeholder' => 'Special Converting Instructions'])
        @endcomponent
    </div>
</div>
