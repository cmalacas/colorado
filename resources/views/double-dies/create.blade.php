@extends('layouts.plane')

@section('title', 'Window Double Dies')

@section('content')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Window Double Dies - Create</h4>
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

    <form method="POST" action="/double-die" id="doubleDierForm">

        @csrf

    <div class="row">

        <div class="col-md-12">

            <div class="card">

                <div class="card-body">



                    <div class="text-right p-2">
                        <button onClick="return javascript:doubleDieForm.submit();"  class="btn btn-primary">Save</button>
                    </div>

                    
                    {!! $FORM !!}

                    
                    
                </div>
            
            </div>

        </div>

    </div>

    </form>

@endsection
