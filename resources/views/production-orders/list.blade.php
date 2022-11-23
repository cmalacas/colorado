@extends('layouts.plane')

@section('title', 'Production Orders')

@section('content')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Production Orders - List</h4>
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
        order: [[ 0, 'desc']],
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
                targets: [ 9, 10, 11, 12, 13, 14, 15, 16],
                searchable: true,
                visible: false
            },
            {
                targets: [ 17 ],
                searchable: true,
                visible: false
            },
            {
                
                targets: [ 18 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 19 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 20 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 21 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 22 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 23 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 24 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 25 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 26 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 27 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 28 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 29 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 30 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 31 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 32 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 33 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 34 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 35 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 36 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 37 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 38 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 39 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 40 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 41 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 42 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 43 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 44 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 45 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 46 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 47 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 48 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 49 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 50 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 51 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 52 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 53 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 54 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 55 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 56 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 57 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 58 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 59 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 60 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 61 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 62 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 63 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 64 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 65 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 66 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 67 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 68 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 69 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 70 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 71 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 72 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 73 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 74 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 75 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 76 ],
                searchable: true,
                visible: false
            },
            {
                targets: [ 77 ],
                searchable: true,
                visible: false
            },
            
            {
                targets: [ 78 ],
                searchable: true,
                visible: false
            },
            
            
            
            {
                targets: [ 79 ],
                searchable: true,
                visible: false
            },
            
            {
                targets: [ 80 ],
                searchable: true,
                visible: false
            },
            
            {
                targets: [ 81 ],
                searchable: true,
                visible: false
            },
            
            {
                targets: [ 82 ],
                searchable: true,
                visible: false
            },
            
            {
                targets: [ 83 ],
                searchable: true,
                visible: false
            },
            
            {
                targets: [ 84 ],
                searchable: true,
                visible: false
            },
            
            {
                targets: [ 85 ],
                searchable: true,
                visible: false
            },
            
            {
                targets: [ 86 ],
                searchable: true,
                visible: false
            },
            
            {
                targets: [ 87 ],
                searchable: true,
                visible: false
            },
            
            {
                targets: [ 88 ],
                searchable: true,
                visible: false
            },
            
            {
                targets: [ 89 ],
                searchable: true,
                visible: false
            },
            
            {
                targets: [ 90 ],
                searchable: true,
                visible: false
            },
            
            {
                targets: [ 91 ],
                searchable: true,
                visible: false
            },
            
            {
                targets: [ 92 ],
                searchable: true,
                visible: false
            },
            
            {
                targets: [ 93 ],
                searchable: true,
                visible: false
            },
            
            {
                targets: [ 94 ],
                searchable: true,
                visible: false
            },
            
            {
                targets: [ 95 ],
                searchable: true,
                visible: false
            },
            
            {
                targets: [ 96 ],
                searchable: true,
                visible: false
            },
            
            {
                targets: [ 97 ],
                searchable: true,
                visible: false
            },
            
            {
                targets: [ 98 ],
                searchable: true,
                visible: false
            },
            
            {
                targets: [ 99 ],
                searchable: true,
                visible: false
            },
            
            {
                targets: [ 100 ],
                searchable: true,
                visible: false
            },
            
            {
                targets: [ 101 ],
                searchable: true,
                visible: false
            },
            
            {
                targets: [ 102 ],
                searchable: true,
                visible: false
            },
            
            {
                targets: [ 103 ],
                searchable: true,
                visible: false
            },
            
            {
                targets: [ 104 ],
                searchable: true,
                visible: false
            },
            
            {
                targets: [ 105 ],
                searchable: true,
                visible: false
            },
            
            {
                targets: [ 106 ],
                searchable: true,
                visible: false
            },
            
            {
                targets: [ 107 ],
                searchable: true,
                visible: false
            },
            
            {
                targets: [ 108 ],
                searchable: true,
                visible: false
            },

            {
                targets: [ 109 ],
                searchable: true,
                visible: false
            },

            {
                targets: [ 110 ],
                searchable: true,
                visible: false
            },

            {
                targets: [ 111 ],
                searchable: true,
                visible: false
            },

            {
                targets: [ 112 ],
                searchable: true,
                visible: false
            },

            {
                targets: [ 113 ],
                searchable: true,
                visible: false
            },

            
        ]
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