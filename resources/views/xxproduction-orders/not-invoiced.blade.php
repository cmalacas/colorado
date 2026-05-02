@extends('layouts.plane')

@section('title', 'Production Orders - Not Invoiced')

@section('content')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Production Orders - Not Invoiced</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Production Orders</li>
                </ol>
            
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">

            <div class="card">

                <div class="card-body">

                    <div class="text-right p-2">
                        <a data-toggle='tooltip' title="Add Production Order" href="/production-orders/create" class="btn btn-primary" title="Add Production Order"><i class="fa fa-plus"></i></a>
                        <a data-toggle='tooltip' title="Advanced Search" href="#" class="btn btn-primary po-search-button" title="Advanced Search"><i class="fa fa-search"></i></a>
                        <a data-toggle='tooltip' title="Reset" href="/production-orders/reset" class="btn btn-primary" title="Reset"><i class="fa fa-sync"></i></a>
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

@section('modal')

@component('ui.modal-form', [
    'id' => 'production-orders-search-modal',
    'title' => 'Advanced Search',
    'form' => $search,
    'button' => 'Search'
])
@endcomponent

@endsection

@section('script')
<script>
$(document).ready(function() {

    

    $('.table').DataTable( {
        "order": [ [ 0, "desc" ] ]
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
                    url: '/production-orders/' + id,
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