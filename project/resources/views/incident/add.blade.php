@extends('adminlte::page')

@section('title', 'Dodawanie usterki') 

@section('content_header')
    <h1>Dodawanie usterki</h1>
@stop

@section('content')
<form action="/incident/add" method="POST">
    @csrf
    <x-adminlte-card title="Dane usterki" theme="lightblue" theme-mode="outline" collapsible maximizable>
        <div class="row">
                <div class="col-sm-12">
                    <x-adminlte-input name="address" type="text" label="Adres" placeholder="Adres zdarzenia" disable-feedback/>
                    <x-adminlte-select-bs name="carsList" label="Wybierz pojazd" 
                        data-title="Wybierz pojazd ..." data-live-search
                        data-live-search-placeholder="Wybierz pojazd ..." data-show-tick>
                        <x-slot name="prependSlot">
                            <div class="input-group-text bg-gradient-info">
                                <i class="fas fa-car-side"></i>
                            </div>
                        </x-slot>
                        @if (isset($vehicles))
                            @foreach ($vehicles as $vehicle)
                            <option data-icon="fa fa-fw fa-car">{{ $vehicle->name }}</option>
                            @endforeach
                        @else
                            <option data-icon="fa fa-fw fa-car" selected>{{ $vehicle->name }}</option>
                        @endif
                    </x-adminlte-select-bs>
                    <x-adminlte-textarea name="description" label="Opis" placeholder="Krótko opisz zdarzenie" disable-feedback/>
                    <x-adminlte-button label="Zapisz" type="submit" theme="success" class="float-right" icon="fas fa-save"/>
            </div>
        </div>
    </x-adminlte-card>
</form>
@stop