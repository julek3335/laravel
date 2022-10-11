@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Szybkie akcje</h3>
        </div>
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-6 col-sm-4 col-md-3 col-xl-2">
                    @include('partials.vehicle.pickup')
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Statystyki</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6 col-sm-4 col-md-3 col-xl-2">
                    <x-adminlte-info-box title="Pojazdy" text="{{ $numberOfVehicles }}" icon="fas fa-light fa-car"/>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')

@stop

@section('js')

@stop