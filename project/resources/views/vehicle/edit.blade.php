@extends('adminlte::page')

@section('title', 'Edycja pojazdu')

@section('content_header')
<h1>Edycja pojazdu  {{ $vehicle->name }}</h1>
@stop

@section('content')
<form action="{{ url('vehicle/edit/'. $vehicle->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('partials.vehicle.edit')
</form>
@include('partials.vehicle.deletePhoto')
@stop