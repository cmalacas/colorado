    <td></td>
    
    <td>

        <input type="hidden" name="packing[ColoEnvPO]", value="{{ $packing->ColoEnvPO }}">

        @component('ui.inputs.text', 
            [
                'name' => 'packing[DateShip]', 
                'class' => 'form-control date',
                'withLabel' => false,
                'placeholder' => '',
                'value' => date("m-d-Y", strtotime($packing->DateShip))
            ])
        @endcomponent

    </td>
    
    <td>
                
        @component('ui.inputs.text', 
            [
                'name' => 'packing[TotalShip]', 
                'class' => 'form-control',
                'withLabel' => false,
                'placeholder' => '',
                'value' => $packing->TotalShip
            ])
        @endcomponent

    </td>

    <td>

        @component('ui.inputs.span', 
            [
                'name' => 'packing[Details]', 
                'class' => 'form-control',
                'withLabel' => false,
                'placeholder' => '',
                'value' => html_entity_decode($packing->Details)
            ])
        @endcomponent
    
    </td>

    <td>

        @component('ui.inputs.select', 
            [
                'name' => 'packing[OrderStatus]', 
                'class' => 'form-control',
                'withLabel' => false,
                'placeholder' => 'Status',
                'options' => ["PARTIAL", "COMPLETE"],
                'value' => $packing->OrderStatus
            ])
        @endcomponent        
    
    </td>

    <td>
        <a data-toggle="tooltip" title="Add New Packiing Slip" href="#" data-action="update" data-id="{{ $packing->id }}" class="btn btn-primary"><i class="fa fa-check"></i></a>         
    </td>