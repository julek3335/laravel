@extends('adminlte::page')

@section('title', 'Dodane ubezpieczenie')

@section('content_header')
<h1>Dodane ubezpieczenie</h1>
@stop

@section('content')
<x-adminlte-card title="Dodane ubezpieczenie" theme="lightblue" theme-mode="outline" collapsible maximizable>
    <div class="row">
        <div class="col-sm-6">
            <ul class="mt-4 list-group list-group-unbordered">
                <li class="list-group-item">
                    <strong>Numer ubezpieczenia</strong> <span class="float-right">{{ $policy_number }}</span>
                </li>
                <li class="list-group-item">
                    <strong>Data wygaśnięcia</strong> <a href="#" class="float-right">{{ $expiration_date }}</a>
                </li>
                <li class="list-group-item">
                    <strong>Koszt</strong> <a href="#" class="float-right">{{ $cost }}</a>
                </li>
                <li class="list-group-item">
                    <strong>Numer kontaktowy</strong> <a href="#" class="float-right">{{ $phone_number }}</a>
                </li>
                <li class="list-group-item">
                    <strong>Typ</strong> <span class="float-right">{{ $type }}</span>
                </li>
                <li class="list-group-item">
                    <strong>Nazwa ubezpieczyciela</strong> <span class="float-right">{{ $insurer_name }}</span>
                </li>
                <li class="list-group-item">
                    <strong>Opis</strong> <span class="float-right">{{ $description }}</span>
                </li>
            </ul>
            <div class="col-sm-6">
                <img src="{{asset('storage/incidents_photos/'. $photo)}}" class="img-fluid p-4">
            </div>
            <div class="row mt-4">
                <div class="col-sm-12">
                    <a href="{{'/vehicles/' .$vehicle_id}}">
                        <x-adminlte-button label="Powrót do widoku pojazdu" icon="fas fa-light fa-edit" />
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-adminlte-card>
@stop

@section('css')

@stop