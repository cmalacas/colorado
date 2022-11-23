<div class="row mb-2">
    <div class="col-md-4">
        <div class="row">
            <label class="col-md-4 text-right" style="line-height:2; padding-right: 0">Size 1</label>
            <div class="col-md-4">
                <input tabindex="30" type="text" name="SizeDimension1" class="form-control" autocomplete="off"  value="{{ $data['SizeDimension1'] }}" style="margin-left: 18px" />
            </div>
            <div class="col-md-4 text-center">
                <label class="text-center" style="font-size: 28px; line-height:1">x</label>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="row">
            <label class="col-md-4 text-right" style="line-height:2">Size 2</label>
            <div class="col-md-8">
                <input tabindex="31" type="text" name="SizeDimension2" class="form-control" autocomplete="off"  value="{{ $data['SizeDimension2'] }}" />
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            <label class="col-md-3 text-right" style="line-height:2">Description</label>
            <div class="col-md-8">
                <input tabindex="32" style="margin-left: 7px;" type="text" name="Description" class="form-control" autocomplete="off"  value="{{ $data['Description'] }}" />
            </div>
        </div>
    </div>
</div>

<div class="row mb-2">
    <div class="col-md-3">
        <div class="row">
            <label  style="line-height:2" class="col-md-6 text-right">Seal Flap Size</label>
            <div class="col-md-6">
                <input tabindex="33" type="text" name="SealFlapSz" class="form-control" autocomplete="off"  value="{{ $data['SealFlapSz'] }}" />
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="row">
            <label  style="line-height:2" class="text-right pr-0 col-md-6">Type of Gum</label>
            <div class="col-md-6">
                <input tabindex="34" type="text" name="GumType" class="form-control" autocomplete="off"  value="{{ $data['GumType'] }}" style="margin-left:18px" />
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="row">
            <label  style="line-height:2" class="text-right col-md-5">Seal Flap</label>
            <div class="md-4">
                <input tabindex="35" type="text" name="SealFlap" class="form-control" autocomplete="off"  value="{{ $data['SealFlap'] }}" />
            </div>
        </div>
    </div>
</div>

<div class="row mb-2">
    <div class="col-md-3">
        <div class="row">
            <label  style="line-height:2" class="text-right col-md-6">Quantity Needed</label>
            <div class="col-md-6">
                <input tabindex="36" type="text" name="QtyNeeded" class="form-control" autocomplete="off"  value="{{ $data['QtyNeeded'] }}" />
            </div>
        </div>
    </div>

    <div class="col-1">
        <div class="row">
            <label class="col-md-12"  style="line-height:2"> <input type="checkbox" class="mr-2" {{ $data['RunAll'] == 1 ? 'checked' : '' }} name="RunAll" placeholder="Run All" tabindex="37" /> Run All</label> 
        </div>
    </div>
    <div class="col-md-4">
        <div class="row">
            <label class="text-right col-md-5" style="line-height:2">Overs Allowed (%)</label>
            <div class="col-md-4">
                <input tabindex="38" type="text" name="OversAllow" class="form-control" autocomplete="off"  value="{{ $data['OversAllow'] }}" />
            </div>
        </div>
    </div>
</div>


<div class="row mb-2">

    <div class="col-md-4">

        <div class="row">
            <label class="text-right col-md-4">Total Quantity</label>
            <div class="col-md-4">
                <input tabindex="39" style="margin-left: 17px;" type="text" readonly name="Total" class="form-control text-right" autocomplete="off"  value="{{ $data['Total'] }}" />
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="row">
            <label class="text-right col-md-5">Amount For Jets</label>
            <div class="col-md-4">
                <input tabindex="40" type="text" name="AmountForJets" class="form-control" autocomplete="off"  value="{{ $data['AmountForJets'] }}" />
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="row">
            <label class="text-right col-md-5">Windows Double Die</label>
            <div class="col-md-4">
                <input tabindex="41" type="text" name="WindowDoubleDie" class="form-control" autocomplete="off"  value="{{ $data['WindowDoubleDie'] }}" />
            </div>
        </div>
    </div>

</div>


<div class="row mb-2">

    <div class="col-md-4">
        <div class="row">
            <label class="text-right col-md-4">Window Size 1</label>
            <div class="col-md-8">
                <input tabindex="42" style="margin-left: 17px; type="text" name="WindowSz1" class="form-control" autocomplete="off"  value="{{ $data['WindowSz1'] }}" />
            </div>
        </div>    
    </div>

    <div class="col-md-4">
        <div class="row">
            <label class="text-right col-md-5">Window Position 1</label>
            <div class="col-md-7">
                <input tabindex="43" type="text" name="WindowPos1" class="form-control" autocomplete="off"  value="{{ $data['WindowPos1'] }}" />
            </div>
        </div>    
    </div>

    <div class="col-md-4">
        <div class="row">
            <label class="text-right col-md-5">Window Film 1</label>
            <div class="col-md-4">
                <input tabindex="43" type="text" name="OpenPolyWinPos1" class="form-control" autocomplete="off"  value="{{ $data['OpenPolyWinPos1'] }}" />
            </div>
        </div>   
    </div>

</div>

<div class="row mb-2">

    <div class="col-md-4">
        <div class="row">
            <label class="text-right col-md-4">Window Size 2</label>
            <div class="col-md-8">
                <input tabindex="43" style="margin-left: 17px; type="text" name="WindowSz2" class="form-control" autocomplete="off"  value="{{ $data['WindowSz2'] }}" />
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="row">
            <label class="text-right col-md-5">Window Position 2</label>
            <div class="col-md-7">
                <input tabindex="42" type="text" name="WindowPos2" class="form-control" autocomplete="off"  value="{{ $data['WindowPos2'] }}" />
            </div>
        </div>    
    </div>

    <div class="col-md-4">
        <div class="row">
            <label class="text-right col-md-5">Window Film 2</label>
            <div class="col-md-4">
                <input tabindex="43" type="text" name="OpenPolyWinPos2" class="form-control" autocomplete="off"  value="{{ $data['OpenPolyWinPos2'] }}" />
            </div>
        </div>   
    </div>

</div>

<div class="row mb-2">

    <div class="col-md-4">
        <div class="row">
            <label class="text-right col-md-4">Window Size 3</label>
            <div class="col-md-8">
                <input tabindex="44" style="margin-left: 17px; type="text" name="WindowSz3" class="form-control" autocomplete="off"  value="{{ $data['WindowSz3'] }}" />
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="row">
            <label class="text-right col-md-5">Window Position 3</label>
            <div class="col-md-7">
                <input tabindex="42" type="text" name="WindowPos3" class="form-control" autocomplete="off"  value="{{ $data['WindowPos3'] }}" />
            </div>
        </div>    
    </div>

    <div class="col-md-4">
        <div class="row">
            <label class="text-right col-md-5">Window Film 3</label>
            <div class="col-md-4">
                <input tabindex="43" type="text" name="OpenPolyWinPos3" class="form-control" autocomplete="off"  value="{{ $data['OpenPolyWinPos3'] }}" />
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

    <div class="col autoresize">
        <div class="form-group">
            <label>Special Converting Instructions</label>
            <div class="grow-wrap" data-replicated-value="{{ $data['SpecialConvInst'] }}">
                <textarea tabindex="51" name="SpecialConvInst" placeholder="Special Converting Instructions" onInput="this.parentNode.dataset.replicatedValue = this.value">{{ $data['SpecialConvInst'] }}</textarea>
            </div>
        </div>
        {{---   
        @component('ui.inputs.textarea', 
            ['name' => 'SpecialConvInst', 
                'class' => 'form-control', 
                'placeholder' => 'Special Converting Instructions',
                'tabindex' => 51,
            'value' => isset($data['SpecialConvInst']) ? $data['SpecialConvInst'] : ''
            ])
        @endcomponent
        --}}
    </div>

</div>