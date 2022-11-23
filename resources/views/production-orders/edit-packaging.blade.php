<div class="row">
    <div class="col col-md-6">
        @component('ui.inputs.checkbox', 
            ['name' => 'FoldingBox', 
            'class' => 'form-control', 
            'placeholder' => 'Folding Boxes',
            'value' => isset($data['FoldingBox']) ? $data['FoldingBox'] : ''
            ])
        @endcomponent
    
        @component('ui.inputs.text', 
            ['name' => 'BulkAmtPerBox', 
            'class' => 'form-control', 
            'placeholder' => 'Amt Per Box',
            'value' => isset($data['BulkAmtPerBox']) ? $data['BulkAmtPerBox'] : ''
            ])
        @endcomponent

        @component('ui.inputs.text', 
            ['name' => 'BulkBoxSz', 
            'options' => $boxSizes,
            'class' => 'form-control', 
            'placeholder' => 'Box Size',
            'value' => isset($data['BulkBoxSz']) ? $data['BulkBoxSz'] : ''
            ])
        @endcomponent
    
        @component('ui.inputs.checkbox', 
            ['name' => 'BulkPack', 
            'class' => 'form-control', 
            'placeholder' => 'Bulk Pack',
            'value' => isset($data['BulkPack']) ? $data['BulkPack'] : ''
            ])
        @endcomponent
    
        @component('ui.inputs.text', 
            ['name' => 'BulkAmtPerCtn', 
            'class' => 'form-control', 
            'placeholder' => 'Amt Per Ctn',
            'value' => isset($data['BulkAmtPerCtn']) ? $data['BulkAmtPerCtn'] : ''
            ])
        @endcomponent
    
        @component('ui.inputs.text', 
            ['name' => 'FoldingBoxSz', 
            'class' => 'form-control', 
            'options' => $ctnSizes,
            'placeholder' => 'Ctn Size',
            'value' => isset($data['FoldingBoxSz']) ? $data['FoldingBoxSz'] : ''
            ])
        @endcomponent
    </div>
</div>

<div class="row d-none">
    <div class="col col-md-12">
        @component('ui.inputs.text', 
            ['name' => 'FoldingAmtPerBox', 
            'class' => 'form-control', 
            'placeholder' => 'Amt Per Box',
            'value' => isset($data['FoldingAmtPerBox']) ? $data['FoldingAmtPerBox'] : ''
            ])
        @endcomponent
    </div>
</div>


<div class="row">
    <div class="col col-md-6">
        @component('ui.inputs.text', 
            ['name' => 'Labeling', 
            'class' => 'form-control', 
            'placeholder' => 'Labels on Box',
            'value' => isset($data['Labeling']) ? $data['Labeling'] : ''
            ])
        @endcomponent
    
        @component('ui.inputs.checkbox', 
            ['name' => 'SpecialLabels', 
            'class' => 'form-control', 
            'placeholder' => 'Special Labels',
            'value' => isset($data['SpecialLabels']) ? $data['SpecialLabels'] : ''
            ])
        @endcomponent
    </div>
</div>
<div class="row d-none">
    <div class="col col-md-12">
    REQUIRED IF SPECIAL LABEL IS REQUIRED
        @component('ui.inputs.text', 
            ['name' => 'MarkAs', 
            'class' => 'form-control', 
            'placeholder' => 'Marked As',
            'value' => isset($data['MarkAs']) ? $data['MarkAs'] : ''
            ])
        @endcomponent
    </div>
</div>