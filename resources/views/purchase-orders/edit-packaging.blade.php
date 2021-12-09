<div class="row">
    <div class="col col-md-12">
        @component('ui.inputs.checkbox', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'placeholder' => 'Bulk Pack'])
        @endcomponent
    </div>
</div>
<div class="row">
    <div class="col col-md-12">
        @component('ui.inputs.text', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'placeholder' => 'Amt Per Box'])
        @endcomponent
    </div>
</div><div class="row">
    <div class="col col-md-12">
        @component('ui.inputs.select', 
            ['name' => 'CustPO', 
            'options' => ["#10 Bulk","#518","9 x 12","A-7 Bulk","#577","R-24","R-591"],
            'class' => 'form-control', 
            'placeholder' => 'Box Size'])
        @endcomponent
    </div>
</div><div class="row">
    <div class="col col-md-12">
        @component('ui.inputs.checkbox', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'placeholder' => 'Folding Boxes'])
        @endcomponent
    </div>
</div><div class="row">
    <div class="col col-md-12">
        @component('ui.inputs.text', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'placeholder' => 'Amt Per Ctn'])
        @endcomponent
    </div>
</div><div class="row">
    <div class="col col-md-12">
        @component('ui.inputs.select', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'options' => ["#9","#10","#10-14","#6 3/4","#11"],
            'placeholder' => 'Ctn Size'])
        @endcomponent
    </div>
</div><div class="row">
    <div class="col col-md-12">
        @component('ui.inputs.text', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'placeholder' => 'Amt Per Box'])
        @endcomponent
    </div>
</div><div class="row">
    <div class="col col-md-12">
        @component('ui.inputs.select', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'options' => ["#10 Bulk","#518","9 x 12","A-7 Bulk","#577","R-24","R-591"],
            'placeholder' => 'Box Size'])
        @endcomponent
    </div>
</div><div class="row">
    <div class="col col-md-12">
        @component('ui.inputs.text', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'placeholder' => 'Labels on Box'])
        @endcomponent
    </div>
</div>
<div class="row">
    <div class="col col-md-12">
        @component('ui.inputs.checkbox', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'placeholder' => 'Special Labels'])
        @endcomponent
    </div>
</div>
<div class="row">
    <div class="col col-md-12">
    REQUIRED IF SPECIAL LABEL IS REQUIRED
        @component('ui.inputs.text', 
            ['name' => 'CustPO', 
            'class' => 'form-control', 
            'placeholder' => 'Marked As'])
        @endcomponent
    </div>
</div>