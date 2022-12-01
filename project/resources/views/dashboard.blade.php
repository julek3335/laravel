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
                <div class="float-left m-1">
                    @include('partials.vehicle.pickup')
                </div>
                <div class="float-left m-1">
                    @include('partials.vehicle.reservation')
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
                <div class="col-12 col-sm-6 col-md-4 col-xl-3">
                    <a href="/users">
                        <x-adminlte-info-box title="Użytkownicy" text="{{ $numberOfUsers }}" icon="fas fa-light fa-user"/>
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-xl-3">
                    <a href="/vehicles">
                        <x-adminlte-info-box title="Pojazdy" text="{{ $numberOfVehicles }}" icon="fas fa-light fa-car"/>
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-xl-3">
                    <a href="/incidents">
                        <x-adminlte-info-box title="Usterki" text="{{ $numberOfIncidents }}" icon="fas fa-light fa-triangle-exclamation"/>
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-xl-3">
                    <a href="/services">
                        <x-adminlte-info-box title="Akcje serwisowe" text="{{ $numberOfServices }}" icon="fas fa-light fa-wrench"/>
                    </a>
                </div>
            </div>
        </div>
    </div>
    @if($userJobs && (count($userJobs)>0))
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Aktywne trasy</h3>
        </div>
        <div class="card-body">
            <p>Posiadasz aktywne trasy</p>
            @include('partials.job.sectionList')
        </div>
    </div>
    @endif

    @if($userVehicles)
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Twoje pojazdy</h3>
        </div>
        <div class="card-body">
        @foreach($userVehicles as $vehicle)
            @if(isset($vehicle->license_plate))
                <a href="/vehicles/{{$vehicle->id}}"> <p>{{$vehicle->license_plate}}</p> </a>
           @endif
        @endforeach
        </div>
    </div>
    @else
        <div class="card-header">
            <h3 class="card-title">Nie posiadasz przypisanych pojazdów </h3>
        </div>
    @endif
@stop