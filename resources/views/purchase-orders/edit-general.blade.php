<div class="row">
    <div class="col col-md-12">
        @component('ui.inputs.text', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'placeholder' => 'Colorado Env Prod Order'])
        @endcomponent
    </div>
</div>
<div class="row">
    <div class="col col-md-12">
        @component('ui.inputs.text', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'placeholder' => 'Job Title'])
        @endcomponent
    </div>
</div>
<div class="row">
    <div class="col col-md-12">
        @component('ui.inputs.text', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'placeholder' => 'Order Date'])
        @endcomponent
    </div>
</div>
<div class="row">
    <div class="col col-md-12">
        @component('ui.inputs.text', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'placeholder' => 'Previous Order'])
        @endcomponent
    </div>
</div>
<div class="row">
    <div class="col">
        @component('ui.inputs.select', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'options' => $customers,
            'placeholder' => 'Sold To'])
        @endcomponent

        @component('ui.inputs.text', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'placeholder' => 'Contact Name'])
        @endcomponent

        @component('ui.inputs.text', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'placeholder' => 'Phone'])
        @endcomponent

        @component('ui.inputs.text', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'placeholder' => 'Fax'])
        @endcomponent

        @component('ui.inputs.text', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'placeholder' => 'Alt'])
        @endcomponent

    </div>
    <div class="col">

        @component('ui.inputs.text', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'placeholder' => 'Customer PO'])
        @endcomponent

        @component('ui.inputs.text', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'placeholder' => 'Quoted Price'])
        @endcomponent
        @component('ui.inputs.select', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'options' => $unitFigures,
            'placeholder' => 'Unit'])
        @endcomponent

        @component('ui.inputs.text', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'placeholder' => 'Additional Charges'])
        @endcomponent

        @component('ui.inputs.text', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'placeholder' => 'Stock Due In'])
        @endcomponent

        @component('ui.inputs.text', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'placeholder' => 'Date Stock In'])
        @endcomponent

        @component('ui.inputs.text', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'placeholder' => 'Date Due'])
        @endcomponent
       
    </div>
</div>
<div class="row">
    <div class="col">
        @component('ui.inputs.text', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'placeholder' => '# of Copies'])
        @endcomponent

        @component('ui.inputs.checkbox', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'placeholder' => 'Invoiced'])
        @endcomponent

    </div>
    <div class="col">
        <h2>MACHINES INVOLVED</h2>

        @component('ui.inputs.select', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'options' => $machines,
            'placeholder' => 'Machine 1'])
        @endcomponent

        @component('ui.inputs.select', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'options' => $machines,
            'placeholder' => 'Machine 2'])
        @endcomponent
    
        @component('ui.inputs.select', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'options' => $machines,
            'placeholder' => 'Machine 3'])
        @endcomponent

        @component('ui.inputs.select', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'options' => $machines,
            'placeholder' => 'Machine 4'])
        @endcomponent
    
        @component('ui.inputs.select', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'options' => $machines,
            'placeholder' => 'Machine 5'])
        @endcomponent
    
        @component('ui.inputs.select', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'options' => $machines,
            'placeholder' => 'Machine 6'])
        @endcomponent
        
    </div>
    <div class="col">

        @component('ui.inputs.checkbox', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'placeholder' => 'Sample Provided'])
        @endcomponent

        @component('ui.inputs.select', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'options' => $locations,
            'placeholder' => 'Location'])
        @endcomponent
        
    </div>
</div>
