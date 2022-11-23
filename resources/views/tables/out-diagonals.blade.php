@extends('layouts.plane')

@section('title', 'Site Tables')

@section('content')

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Diagonals</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Diagonals</li>
            </ol>
        
        </div>
    </div>
</div>

<div class="row">

    <div class="col-md-12">
        
        <div class="card">

            <div class="card-body">

                {!! $table !!}

            </div>

        </div>

    </div>
</div>

@endsection

@section('script')
<script>
$(document).ready(function() {

    $('.table').DataTable( {
        "order": [ [ 0, "desc"] ]
    } );  
});
</script>
@endsection