@extends('layouts.plane')

@section('title', 'Not Invoiced')

@section('content')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Not Invoiced - List</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Not Invoiced</li>
                </ol>
            
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">

            <div class="card">

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
        columnDefs: [ {
            targets: [ 0 ],
            orderData: [ 0, 1 ]
        }, {
            targets: [ 1 ],
            orderData: [ 1, 0 ]
        } ]
    } );
});
</script>
@endsection