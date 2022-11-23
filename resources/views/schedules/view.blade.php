@extends('layouts.plane')

@section('title', $title)

@section('content')

<style>
input[type=number] {
    min-width: 50px;
}
</style>

    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">{{ $module }}</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">{{ $module }}</li>
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

@section('script')

<script>

const scheduleMatcher = (strs) => {
        
    return function findMatches(q, cb) {
        
        var matches, substringRegex;

        matches = [];

        substrRegex = new RegExp(q, 'i');

        $.each(strs, function(i, str) {
            if (substrRegex.test(str)) {
                matches.push(str);
            }
        });

        cb(matches);
    };
};

$(document).ready(function() {
    $('.date').datepicker({dateFormat: "mm-dd-yy"});    

    const locations = {!! $machines !!}

    const foldingSchedule = {!! $machines !!}



    $( "input[name=Location]" ).typeahead(
        {
            minLength: 0,
        },
        {
            limit: 99,
            name: 'unitFigure',
            source: scheduleMatcher(locations)
        }
    );

    $( "input[name=FoldingScheduleStatus]" ).typeahead(
        {
            minLength: 0,
        },
        {
            limit: 99,
            name: 'unitFigure',
            source: scheduleMatcher(foldingSchedule),
        }        
    );

    $('.table.schedule input').on('typeahead:selected', function(evt, item) {
        
    })

    $('.table.schedule input').on('keyup typeahead:selected change', function() {
        
        const row = $(this).closest('tr');

        const data = $('input', row).serialize();

        $.ajax( {
            url: '/production-orders/save-schedule',
            type: 'post',
            data: data,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: 'json',
            success: () => {
               
            }
        })
    })
})
</script>

@endsection