<!---
<div class="row">
    <div class="col col-md-6">
        @component('ui.inputs.select', 
            ['name' => 'Desc', 
            'class' => 'form-control', 
            'options' => ["Open Side Diangonal Seam","Open Side Side Seam","Open Side Booklet","Open End Catalog","Open Side Adjustable","Open End Adjustable"],
            'placeholder' => 'Description',
            'value' => isset($data['Desc']) ? $data['Desc'] : ''
            ])
        @endcomponent

        @component('ui.inputs.select', 
            ['name' => 'SizeDimension1', 
            'class' => 'form-control', 
            'options' => $dieDiagonal,
            'placeholder' => 'Size - Diagonal',
            'value' => isset($data['SizeDimension1']) ? $data['SizeDimension1'] : ''
            ])
        @endcomponent
    </div>

    <div class="col-md-6">
        @component('ui.inputs.select', 
            ['name' => 'SizeDimension2', 
            'class' => 'form-control', 
            'options' => $dieSeam,
            'placeholder' => 'Size - Side Seam',
            'value' => isset($data['SizeDimension2']) ? $data['SizeDimension2'] : ''
            ])
        @endcomponent

        @component('ui.inputs.select', 
            ['name' => 'SizeMO', 
            'class' => 'form-control', 
            'options' => $dieMO,
            'placeholder' => 'Size - MO',
            'value' => isset($data['SizeMO']) ? $data['SizeMO'] : ''
            ])
        @endcomponent
    </div>
</div>

--->

<div class="row">

    <div class="col-md-12">
        <h2>SHIPPING DETAILS</h2>
    </div>

    <div class="col-md-12">
        @include('production-orders.edit-shipping-details')
    </div>

</div>