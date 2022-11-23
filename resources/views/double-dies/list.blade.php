@extends('layouts.plane')

@section('title', 'Window Double Dies')

@section('content')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Window Double Dies - List</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Window Double Dies</li>
                </ol>
            
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">

            <div class="card">

                <div class="card-body">

                    <div class="text-right p-2">
                        <a href="/double-die/create" class="btn btn-primary" title="Add Window Double Die"><i class="fa fa-plus"></i></a>
                        <!-- <a href="/double-die/show-all" class="btn btn-success" title="Add Window Double Die"><i class="fa fa-eye"></i></a> -->
                    </div>

                        @component('layouts.table', [
                                    'class' => 'table-bordered table-hover', 
                                    'theads' => $theads,
                                    'tbody' => $tbody
                                ])
                        @endcomponent
                </div>
            
            </div>

        </div>

    </div>

@endsection

@section('script')
<script>
$(document).ready(function() {

    

    $('.table').DataTable( {
        order: [[ 0, 'desc']],
        columnDefs: [ 
            {
                targets: [ 0 ],
                orderData: [ 0, 1 ],
                visible: false
            }, 
            {
                targets: [ 1 ],
                orderData: [ 1, 0 ]
            }, 
            {
                targets: [ 4 ],
                orderData: [ 4, 0 ]
            } ]
    } );

    $(document).on('click', '.table .btn', function(e) {

        var action = $(this).data('action');
        var tRow = $(this).closest('tr');

        if (action === 'delete') 
        {
            if (confirm("Are you sure you want to delete this?")) 
            {
                var id = $(this).data("id");
                var token = $("meta[name='csrf-token']").attr("content");

                $.ajax({
                    url: '/double-die/' + id,
                    type: 'DELETE',
                    data: {"id": id, "_token": token},
                    success: function() {
                        $(tRow).remove();
                    }
                })
            }            

            return false;

        } else {

            return true;
        }

    });    
});
</script>
@endsection