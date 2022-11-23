<tr>

    <td>
        @component('ui.inputs.select', [
            'name' => 'items['.$item.'][po]',
            'value' => $val['production_order_id'],
            'placeholder' => '',
            'withLabel' => false,
            'options' => $ColoEnvPO,
            'class' => 'form-control po'

        ])
        @endcomponent
    </td>

    <td>
        @component('ui.inputs.text', [
            'name' => 'items['.$item.'][qty]',
            'value' => $val['qty'],
            'placeholder' => '',
            'withLabel' => false,
            'class' => 'form-control qty'

        ])
        @endcomponent
    </td>   
    <td>
        @component('ui.inputs.text', [
            'name' => 'items['.$item.'][price]',
            'value' => $val['price'],
            'placeholder' => '',
            'withLabel' => false,
            'class' => 'form-control price'

        ])
        @endcomponent
    </td>
    <td>
        @component('ui.inputs.select', [
            'name' => 'items['.$item.'][recvd]',
            'value' => $val['recvd'],
            'placeholder' => '',
            'withLabel' => false,
            'options' => ['Partial', 'Complete'],
            'class' => 'form-control recvd'

        ])
        @endcomponent
    </td>
    <td>
        @component('ui.inputs.text', [
            'name' => 'items['.$item.'][date]',
            'value' => $val['date'],
            'placeholder' => '',
            'withLabel' => false,
            'class' => 'form-control date'

        ])
        @endcomponent
    </td>

    <td class="text-center align-middle" rowspan="2">

            <button data-toggle="tooltip" title="Remove" data-value="{{ $val['id'] }}" class="btn btn-danger btn-delete"><i class="fa fa-times"></i></button>

    </td>

</tr>
<tr>
   <td colspan="5" class="form-group">
      <textarea style="height: 100px;" class="form-control" name="items[{{ $item }}][desc]">{{ $val['description'] }}</textarea>
   </td>         
</tr>