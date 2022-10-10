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
                    <x-adminlte-button label="Podejmij pojazd" icon="fas fa-light fa-plus" data-toggle="modal" data-target="#modalGetCar"/>
                    <x-adminlte-modal id="modalGetCar" title="Podjęcie pojazdu" theme="light"
                        icon="fas fa-bolt">
                        <x-adminlte-select-bs name="carsList" label="Wybierz pojazd" 
                            data-title="Wybierz pojazd ..." data-live-search
                            data-live-search-placeholder="Wybierz pojazd ..." data-show-tick>
                            <x-slot name="prependSlot">
                                <div class="input-group-text bg-gradient-info">
                                    <i class="fas fa-car-side"></i>
                                </div>
                            </x-slot>
                            @foreach ($availableVehicles as $vehicle)
                            <option data-icon="fa fa-fw fa-car">{{ $vehicle->name }}</option>
                            @endforeach
                        </x-adminlte-select-bs>
                        <x-adminlte-button label="Podejmij pojazd" theme="success" class="float-right" icon="fas arrow-down"/>
                    </x-adminlte-modal>
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
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop