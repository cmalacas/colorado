@extends('layouts.print-single-production-order')

@section('title', 'Print Production Order')

@section('content')

@php //print_r($data); @endphp


<table style="width:100%">
  <tr>
    <td>
      <h3 style="margin-top:5px; margin-bottom:5px; line-height:2;">Colo Env Prod Order # <span style="font-size:20px;">{{ $data['id'] }}</span></h3>
    </td>
    <td>
      <h3 style="margin-top:5px; margin-bottom:5px; font-size:20px">Due Date: {{ \Carbon\Carbon::parse($data['DateDue'])->format('m-d-Y') }}</h3>
    </td>
  </tr>
  </table>

  @include('production-orders.print-general')

  @include('production-orders.print-converting')

  @include('production-orders.print-instruction')

  @if ( !empty($data['out_diagonal_die_size']) || 
        !empty($data['out_diagonal_die_size']) ||
        !empty($data['out_diagonal_sheet_size']) || 
        !empty($data['out_diagonal_number_out']) || 
        !empty($data['out_diagonal_die_number']) || 
        !empty($data['out_diagonal_seal_flap_size']) || 
        !empty($data['out_mo_booklet_die_size']) || 
        !empty($data['out_mo_booklet_sheet_size']) || 
        !empty($data['out_mo_booklet_number_out']) || 
        !empty($data['out_mo_booklet_die_number']) || 
        !empty($data['out_mo_booklet_flat_size']) || 
        !empty($data['out_mo_booklet_seal_flap_size']) || 
        !empty($data['out_mo_catalog_die_size']) || 
        !empty($data['out_mo_catalog_sheet_size']) || 
        !empty($data['out_mo_catalog_number_out']) || 
        !empty($data['out_mo_catalog_die_number']) || 
        !empty($data['out_mo_catalog_flat_size']) || 
        !empty($data['out_mo_catalog_seal_flap_size']) || 
        !empty($data['out_side_seam_die_size']) || 
        !empty($data['out_side_seam_sheet_size']) || 
        !empty($data['out_side_seam_number_out'] ) || 
        !empty($data['out_side_seam_die_number'] ) || 
        !empty($data['out_side_seam_flat_size']) || 
        !empty($data['out_side_seam_seal_flap_size']) || 
        !empty($data['adjustable_die_size']) || 
        !empty($data['adjustable_sheet_size']) || 
        !empty($data['adjustable_number_out']) || 
        !empty($data['adjustable_die_number']) || 
        !empty($data['adjustable_flat_size']) || 
        !empty($data['adjustable_seal_flap_size']) || 
        !empty($data['web_ro_die_size']) || 
        !empty($data['web_ro_sheet_size']) || 
        !empty($data['web_ro_number_out']) || 
        !empty($data['web_ro_die_number']) || 
        !empty(  $data['web_ro_flat_size']) || 
        !empty($data['web_ro_seal_flap_size'])

  )

  @include('production-orders.print-cut')

  @endif

 @include('production-orders.print-print')

@endsection
