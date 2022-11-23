@extends('layouts.plane')

@section('title', 'Purchase Orders')

@section('content')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Purchase Orders - List</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Purchase Orders</li>
                </ol>
            
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">

            <div class="card">

                <div class="text-right p-2">

                    <a href="/purchase-orders/create" class="btn btn-primary" title="Add Purchase Order"><i class="fa fa-plus"></i></a>
                    <span id="search-purchase-order"></span>

                </div>

                <div class="card-body">

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
        columnDefs: [ 
            {
                targets: [ 1 ],
                orderData: [ 1, 0 ],
                
            }, 
            {
                targets: [ 1 ],
                orderData: [ 1, 0 ],
               
            },            
            {
                targets: [ 6 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 7 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 8 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 9 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 10 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 11 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 12 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 13 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 14 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 15 ],
                searchable: true,
                visible: false
            }
        ]
    } );


    $('.table .btn').on('click', function(e) {
        
        var action = $(this).data('action');
        var tRow = $(this).closest('tr');

        if (action === 'delete') 
        {
            if (confirm("Are you sure you want to delete this?")) 
            {
                var id = $(this).data("id");
                var token = $("meta[name='csrf-token']").attr("content");

                $.ajax({
                    url: '/purchase-orders/delete',
                    type: 'post',
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