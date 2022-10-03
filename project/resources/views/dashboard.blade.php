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
                    <x-adminlte-button label="Podejmij pojazd" icon="fas fa-light fa-plus"/>
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
                    <x-adminlte-info-box title="Pojazdy" text="15" icon="fas fa-light fa-car"/>
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