@extends('adminlte::page')

@section('title', 'Usterka')

@section('content_header')
<h1>Usterka pojazdu {{ $vehicle->name }}</h1>
@stop

@section('content')
<x-adminlte-card title="Szczegóły usterki" theme="lightblue" theme-mode="outline" collapsible maximizable>
    <div class="row">
        <div class="col-sm-6">
            @include('partials.incident.show')
        </div>
        <div class="col-sm-6">
            <img src="{{$incident->photo}}" class="img-fluid p-4">
        </div>
        @if($entitlements == 0 || $entitlements == 1)
            <a href="/incident/edit/{{$incident->id}}">
                <x-adminlte-button label="Edytuj usterke" icon="fas fa-edit" class="float-right mr-2" />
            </a>
            @include('partials.incident.delete')
        @endif
    </div>
</x-adminlte-card>
@stop