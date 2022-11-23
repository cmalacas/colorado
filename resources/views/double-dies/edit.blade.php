@extends('layouts.plane')

@section('title', 'Double Dies')

@section('content')
<style>
.single-nav {
    display: flex;
    justify-content: flex-start;
}

.single-nav a {
    display:inline-block;
    max-height: 36px;
}

.single-nav .form-group {
    min-width: 200px;
}

.single-nav .form-group label {
    display: none;
}

.single-nav .form-group .col-md-8 {
    width: 80%;
    margin: 0 auto;
}
</style>
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Double Dies - Edit</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Double Dies</li>
                </ol>
            
            </div>
        </div>
    </div>

    <form method="POST" action="/double-die/{{ $info['id'] }}" id="doubleDieForm">

        @csrf
        @method('PUT')

       

    <div class="row">

        <div class="col-md-12">

            <div class="card">

                <div class="card-body">

                    @if (session('message'))

                        <div class="p-2 bg-success text-light">
                            {{session('message')}}
                        </div>

                    @endif

                    <div class="row">

                        

                        <div class="col-md-6 offset-md-6">

                            <div class="buttons text-right p-2">
                                <button data-action="save" class="btn btn-primary"><i class="fa fa-save"></i></button>                    
                                <button data-action="cancel" class="btn"><i class="fa fa-reply"></i></button>
                            </div>
                        </div>

                    </div>        

                    
                    {!! $FORM !!}
                    
                    
                </div>
            
            </div>

        </div>

    </div>

    </form>

@endsection

@section('modal')



@endsection

@section('script')

<script>

$(document).on('click', '.buttons button', function() {
        
    var action = $(this).data('action');

    if (action === 'save') {
        return $('#doubleDieForm').submit();
    }

    if (action === 'cancel') {
        window.location = '/double-die/';
    }        

    return false;
});

</script>

@endsection