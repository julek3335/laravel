@extends('adminlte::page')

@section('title', 'Dodawanie ubezpieczenia')

@section('content_header')
<h1>Dodawanie ubezpieczenia</h1>
@stop

@section('content')

<form action="{{ url('insurance/create-new/'.$id) }}" method="POST">
    @csrf
    <x-adminlte-input name="policy_number" type="text" label="Numer ubezpieczenia" placeholder="Numer ubezpieczenia" value="" disable-feedback />
    <x-adminlte-input name="expiration_date" type="text" label="Data wygaśnięcia" placeholder="Data wygaśnięcia" value="" disable-feedback />
    <x-adminlte-input name="cost" type="number" label="Koszt" placeholder="Koszt" value="" disable-feedback />
    <x-adminlte-input name="phone_number" type="number" label="Numer kontaktowy" placeholder="Numer kontaktowy" value="" disable-feedback />
    <x-adminlte-input name="vehicle_id" type="number" label="id pojazdu" placeholder="id pojazdu" value="{{$vehicle_id}}" disable-feedback disabled />
    <x-adminlte-button label="Zapisz" theme="success" type="submit" class="float-right" icon="fas fa-save" />
</form>
@stop

@section('css')

@stop