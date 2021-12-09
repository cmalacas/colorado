<div class="row">
    <div class="col col-md-12">
        @component('ui.inputs.text', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'placeholder' => 'Colorado Envelope Prod Order'])
        @endcomponent
    </div>
</div>
<div class="row">
    <div class="col col-md-12">
        @component('ui.inputs.text', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'placeholder' => 'Customer PO'])
        @endcomponent
    </div>
</div>
<div class="row">
    <div class="col col-md-12">
        @component('ui.inputs.text', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'placeholder' => 'Sold To'])
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
</div
><div class="row">
    <div class="col col-md-12">
        @component('ui.inputs.select', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'options' => ["Open Side Diangonal Seam","Open Side Side Seam","Open Side Booklet","Open End Catalog","Open Side Adjustable","Open End Adjustable"],
            'placeholder' => 'Description'])
        @endcomponent
    </div>
</div>
<div class="row">
    <div class="col col-md-12">
        @component('ui.inputs.select', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'options' => $dieDiagonal,
            'placeholder' => 'Size - Diagonal'])
        @endcomponent
    </div>
</div>
<div class="row">
    <div class="col col-md-12">
        @component('ui.inputs.select', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'options' => $dieSeam,
            'placeholder' => 'Size - Side Seam'])
        @endcomponent
    </div>
</div>
<div class="row">
    <div class="col col-md-12">
        @component('ui.inputs.select', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'options' => $dieMO,
            'placeholder' => 'Size - MO'])
        @endcomponent
    </div>
</div>