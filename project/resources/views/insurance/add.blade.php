@extends('adminlte::page')

@section('title', 'Dodawanie ubezpieczenia')
@section('plugins.BsCustomFileInput', true)

@section('content_header')
<h1>Dodawanie ubezpieczenia</h1>
@stop

@section('content')
<form action="/add-new" method="POST" enctype="multipart/form-data">
    @csrf
    <x-adminlte-input name="policy_number" type="text" label="Numer ubezpieczenia" placeholder="Numer ubezpieczenia" value="" disable-feedback required />
    <x-adminlte-input name="expiration_date" type="text" label="Data wygaśnięcia" placeholder="Data wygaśnięcia" value="" disable-feedback required />
    <x-adminlte-input name="cost" type="number" label="Koszt" placeholder="Koszt" value="" disable-feedback />
    <x-adminlte-input name="phone_number" type="number" label="Numer kontaktowy" placeholder="Numer kontaktowy" value="" disable-feedback required />
    <x-adminlte-input name="insurer_name" type="text" label="Ubezpieczyciel" placeholder="Ubezpieczyciel" value="" disable-feedback />
    <x-adminlte-textarea name="description" type="text" label="Opis" placeholder="Opis" value="" disable-feedback required />
    <!-- <x-adminlte-input name="status" type="text" label="Status" placeholder="Status ubezpieczenia" value="" disable-feedback required /> -->
    <x-adminlte-select-bs name="selBsVehicle" label="Typ" data-title="Wybierz pojazd ..." data-live-search data-live-search-placeholder="Wybierz pojazd ..." data-show-tick>
        <x-slot name="prependSlot">
            <div class="input-group-text bg-gradient-info">
                <i class="fas fa-car-side"></i>
            </div>
        </x-slot>
        <option data-icon="fa fa-fw fa-car">OC</option>
        <option data-icon="fa fa-fw fa-truck" selected>AC</option>
        <option data-icon="fa fa-fw fa-truck-moving">NNW</option>
        <option data-icon="fa fa-fw fa-motorcycle">Assistance</option>
    </x-adminlte-select-bs>
    <x-adminlte-input-file name="photo" label="Zdjęcie" legend="Wybierz" placeholder="Wybierz lub upuść zdjęcie" required>
        <x-slot name="prependSlot">
            <div class="input-group-text bg-lightblue">
                <i class="fas fa-upload"></i>
            </div>
        </x-slot>
    </x-adminlte-input-file>
    <x-adminlte-select-bs name="selBsVehicle" label="Numer rejestracyjny pojazdu" data-title="Wybierz typ ..." data-live-search data-live-search-placeholder="Wybierz typ ..." data-show-tick>
        <x-slot name="prependSlot">
            <div class="input-group-text bg-gradient-info">
                <i class="fas fa-car-side"></i>
            </div>
        </x-slot>
        @foreach($vehicles as $vehicle)
            <option>{{$vehicle->license_plate}}</option>
        @endforeach
    </x-adminlte-select-bs>
    <x-adminlte-button label="Dodaj" theme="success" type="submit" class="float-right" icon="fas fa-save" />
</form>
@stop
