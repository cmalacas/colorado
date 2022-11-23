<div class="row mb-2">
    <div class="col d-flex">

        <label><input name="CPU" @if($data['CPU'] == 1 ) checked @endif type="checkbox" class="mr-2" /> CPU</label>

        <label class="ml-4"><input name="SHIPVIA" @if($data['SHIPVIA'] == 1 ) checked @endif type="checkbox" class="mr-2" /> SHIP VIA</label>
        
    </div>
</div>

<div class="row">
    <div class="col d-flex">

        <div class="form-group mb-2 d-flex">
            <label class="mr-2 text-nowrap">Shipping Company</label>
            <input type="text" name="ShipViaDetail" value="{{ $data['ShipViaDetail'] }}" class="form-control mr-4" />

            <label class="ml-4 mr-2 text-nowrap">Account #</label>
            <input type="text" name="Account" value="{{ $data['Account'] }}" class="form-control" />
        </div>

    </div>
</div>

<label class="d-block mb-2 font-weight-bold">SHIPPING INFORMATION</label>

<div class="row">
    <div class="col-md-6">
        <div class="form-group inline d-flex mb-2 row">
            <label class="col-md-2">Ship To</label>
            <div class="col-md-10">
                <input type="text" name="ShipTo" value="{{ $data['ShipTo'] }}" class="form-control" />
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group inline d-flex mb-2 row">
            <label class="col-md-2 text-nowrap">Address 1</label>            
            <div class="col-md-10">
                <input type="text" name="Address1" value="{{ $data['Address1'] }}" class="form-control" />
            </div>            
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group inline d-flex mb-2 row">
            <label class="col-md-2 text-nowrap">Address 2</label>
            <div class="col-md-10">
                <input type="text" name="Address2" value="{{ $data['Address2'] }}" class="form-control" />
            </div>          
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group inline d-flex mb-2 row">
            <label class="col-md-2 text-nowrap">City</label>
            <div class="col-md-4">
                <input type="text" name="City" value="{{ $data['City'] }}" class="form-control" />
            </div>
            <label class="col-md-1 text-nowrap">State</label>
            <div class="col-md-2">
                <input type="text" name="ST" value="{{ $data['ST'] }}" class="form-control" />
            </div>
            <label class="col-md-1 text-nowrap">Zip</label>
            <div class="col-md-2">
                <input type="text" name="Zip" value="{{ $data['Zip'] }}" class="form-control" />
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group inline d-flex mb-2 row">
            <label class="col-md-2 text-nowrap">Attn</label>
            <div class="col-md-4">
                <input type="text" name="ShipAttn" value="{{ $data['ShipAttn'] }}" class="form-control" />
            </div>
            <label class="col-md-1 text-nowrap">Phone</label>
            <div class="col-md-5">
                <input type="text" name="ShipContactPhone" value="{{ $data['ShipContactPhone'] }}" class="form-control" />          
            </div>  
        </div>
    </div>
</div>



<div class="row">
    <div class="col col-md-6">
    <h2 class="text-center m-4 mb-2"></h2>
        @component('ui.inputs.textarea', 
            ['name' => 'SHIPPINGINSTRUCTIONS', 
            'class' => 'form-control', 
            'placeholder' => 'SHIPPING INSTRUCTIONS',
            'value' => isset($data['SHIPPINGINSTRUCTIONS']) ? $data['SHIPPINGINSTRUCTIONS'] : ''
            ])
        @endcomponent
    </div>
</div>