@extends('layouts.plane')

@section('title', 'Site Tables')

@section('content')

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Site Tables</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Site Tables</li>
            </ol>
        
        </div>
    </div>
</div>

<div class="row">

    <div class="col-md-12">

        <div class="card">

            <div class="card-body">

                <ul class="nav nav-tabs" role="tablist"> 
                    <li class="nav-item">
                        <a class="nav-link mr-1 active" id="location-tab" data-toggle="tab" href="#location" role="tab" aria-controls="general" aria-selected="true">Location</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mr-1" id="routing-tab" data-toggle="tab" href="#routing" role="tab" aria-controls="converting" aria-selected="false">Routing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mr-1" id="type-of-gum-tab" data-toggle="tab" href="#type-of-gum" role="tab" aria-controls="cutting" aria-selected="false">Type Of Gum</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mr-1" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="printing" aria-selected="false">Description</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mr-1" id="seal-flap-tab" data-toggle="tab" href="#seal-flap" role="tab" aria-controls="packaging" aria-selected="false">Seal Flap</a>
                    </li>
                   
                    <li class="nav-item">
                        <a class="nav-link mr-1" id="inside-tint-style-tab" data-toggle="tab" href="#inside-tint-style" role="tab" aria-controls="packing" aria-selected="false">Inside Tint Style</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mr-1" id="sides-tab" data-toggle="tab" href="#sides" role="tab" aria-controls="related" aria-selected="false">Ctn Size</a>
                    </li>                    
                    <li class="nav-item">
                        <a class="nav-link mr-1" id="ctn-size-tab" data-toggle="tab" href="#ctn-size" role="tab" aria-controls="related" aria-selected="false">Box Size</a>
                    </li>                    
                    <li class="nav-item">
                        <a class="nav-link mr-1" id="colo-stock-tab" data-toggle="tab" href="#colo-stock" role="tab" aria-controls="related" aria-selected="false">Colo Env Stock</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="printing-tab" data-toggle="tab" href="#printing" role="tab" aria-controls="related" aria-selected="false">Printing</a>
                    </li>                    
                    <li class="nav-item">
                        <a class="nav-link" id="schedule-tab" data-toggle="tab" href="#schedule" role="tab" aria-controls="related" aria-selected="false">Folding Status</a>
                    </li>                    
                    <li class="nav-item">
                        <a class="nav-link" id="jet-status-tab" data-toggle="tab" href="#jet-status" role="tab" aria-controls="related" aria-selected="false">Jet Status</a>
                    </li>  
                    
                    <li class="nav-item">
                        <a class="nav-link" id="window-film-tab" data-toggle="tab" href="#window-film" role="tab" aria-controls="related" aria-selected="false">Window Film</a>
                    </li>  

                    <li class="nav-item">
                        <a class="nav-link" id="ship-to-tab" data-toggle="tab" href="#ship-to" role="tab" aria-controls="related" aria-selected="false">Ship To</a>
                    </li> 
                    
                    <li class="nav-item">
                        <a class="nav-link" id="window-size-tab" data-toggle="tab" href="#window-size" role="tab" aria-controls="related" aria-selected="false">Window Sizes</a>
                    </li>  
                    
                </ul>

                <div class="tab-content tables" id="myTabContent">
                    
                    <div class="tab-pane fade show active" id="location" role="tabpanel" aria-labelledby="location-tab">
                        @include('tables.location')
                    </div>

                    <div class="tab-pane fade show" id="routing" role="tabpanel" aria-labelledby="routing-tab">
                        @include('tables.routing')
                    </div>

                    <div class="tab-pane fade show" id="type-of-gum" role="tabpanel" aria-labelledby="type-of-gum-tab">
                        @include('tables.type-of-gum')
                    </div>

                    <div class="tab-pane fade show" id="description" role="tabpanel" aria-labelledby="description-tab">
                        @include('tables.description')
                    </div>

                    <div class="tab-pane fade show" id="seal-flap" role="tabpanel" aria-labelledby="seal-flap-tab">
                        @include('tables.seal-flap')
                    </div>

                   

                    <div class="tab-pane fade show" id="inside-tint-style" role="tabpanel" aria-labelledby="inside-tint-style-tab">
                        @include('tables.inside-tint-style')
                    </div>

                    <div class="tab-pane fade show" id="sides" role="tabpanel" aria-labelledby="sides-tab">
                        @include('tables.sides')
                    </div>

                    <div class="tab-pane fade show" id="ctn-size" role="tabpanel" aria-labelledby="ctn-size-tab">
                        @include('tables.ctn-size')
                    </div>

                    <div class="tab-pane fade show" id="colo-stock" role="tabpanel" aria-labelledby="colo-stock-tab">
                        @include('tables.stock')
                    </div>

                    <div class="tab-pane fade show" id="printing" role="tabpanel" aria-labelledby="printing-tab">
                        @include('tables.printing')
                    </div>

                    <div class="tab-pane fade show" id="schedule" role="tabpanel" aria-labelledby="schedule-tab">
                        @include('tables.schedule')
                    </div>

                    <div class="tab-pane fade show" id="jet-status" role="tabpanel" aria-labelledby="jet-status-tab">
                        @include('tables.jet')
                    </div>

                    <div class="tab-pane fade show" id="jet-stock" role="tabpanel" aria-labelledby="jet-stock-tab">
                        @include('tables.jet-stock')
                    </div>

                    <div class="tab-pane fade show" id="window-film" role="tabpanel" aria-labelledby="window-film-tab">
                        @include('tables.window-film')
                    </div>

                    <div class="tab-pane fade show" id="ship-to" role="tabpanel" aria-labelledby="ship-to-tab">
                        @include('tables.ship-to')
                    </div>

                    <div class="tab-pane fade show" id="window-size" role="tabpanel" aria-labelledby="window-size-tab">
                        @include('tables.window-size')
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
@endsection