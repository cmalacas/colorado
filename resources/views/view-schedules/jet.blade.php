@extends('layouts.plane')

@section('title', $title)

@section('content')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">{{$title}}</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    @foreach($breadcrumbs as $b)
                    <li class="breadcrumb-item"><a href="{{$b['url']}}">{{$b['name']}}</a></li>
                    @endforeach
                </ol>
            
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-10 offset-1">

            <div class="row">

                @foreach($links as $link)

                    <div class="{{$class}}">
                        <a href="{{$link['url']}}">{{$link['name']}}</a>
                    </div>

                @endforeach

            </div>

        </div>

    </div>

@endsection