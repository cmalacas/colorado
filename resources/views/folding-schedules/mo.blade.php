@extends('layouts.plane')

@section('title', 'Folding Schedules')

@section('content')

    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Folding Schedules - MO</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Folding Schdules - MO</li>
                </ol>
            
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">

            <div class="card">

                <div class="card-body">

                    @component('layouts.table', [
                                'class' => 'table-bordered table-hover schedule', 
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

    @component('ui.modal-table',
    [
        'id' => 'schedule-table-modal',
        'title' => '',
        'table' => '',
        'button' => 'Save'
    ])
    @endcomponent

@endsection