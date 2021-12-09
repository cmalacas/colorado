<div class="row">
    <div class="col col-md-12">
        @component('ui.inputs.select', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'options' => $diagonalSeams,
            'placeholder' => '#Out - Diagonal Seam'])
        @endcomponent
    </div>
</div><div class="row">
    <div class="col col-md-12">
        @component('ui.inputs.select', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'options' => $sideSeams,
            'placeholder' => '#Out - Side Seam'])
        @endcomponent
    </div>
</div><div class="row">
    <div class="col col-md-12">
        @component('ui.inputs.select', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'options' => $openEnds,
            'placeholder' => 'MO Open-End'])
        @endcomponent
    </div>
</div><div class="row">
    <div class="col col-md-12">
        @component('ui.inputs.select', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'options' => $openSides, 
            'placeholder' => 'Mo Open-Side'])
        @endcomponent
    </div>
</div><div class="row">
    <div class="col col-md-12">
        @component('ui.inputs.select', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'options' => $coloStocks,
            'placeholder' => 'Colo Env Stock'])
        @endcomponent
    </div>
</div>


<div class="row">
    <div class="col col-md-12">
        @component('ui.inputs.textarea', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'placeholder' => 'Special Cutting Instructions'])
        @endcomponent
    </div>
</div>