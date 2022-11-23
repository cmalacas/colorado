@extends('layouts.plane')

@section('title', 'General Order Info')

@section('content')

    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">General Order Info</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">General Order Info</li>
                </ol>
            
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">

            <div class="card">

                <div class="card-body">

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Prod Order</th>
                                <th>Sold To</th>
                                <th>Job Title</th>
                                <th>Customer PO#</th>
                                <th>Previous Order #</th>
                                <th>Quoted Price</th>
                                <th>Additional Charges</th>
                                <th>Order Date</th>
                                <th>Stock Due In</th>
                                <th>Status</th>
                                <th>Stock Due</th>
                                <th>Order</th>
                                <th>Date Due</th>
                                <th>Job Title</th>
                                <th>Ship VIA</th>
                            </tr>
                        </thead>
                    </table>

                </div>

            </div>

        </div>

    </div>

@endsection