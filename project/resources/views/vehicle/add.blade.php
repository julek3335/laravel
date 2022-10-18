@extends('adminlte::page')

@section('title', 'Tworzenie pojazdu')

@section('content_header')
<h1>Tworzenie nowego pojazdu</h1>
@stop

@section('content')
<form action="/vehicle/add" method="POST">
    @csrf
    <x-adminlte-card title="Dane pojazdu" theme="lightblue" theme-mode="outline" collapsible maximizable>
        <div class="row">
            <div class="col-sm-6">
                <x-adminlte-input name="name" type="text" label="Nazwa" placeholder="Nazwa" disable-feedback />
                <x-adminlte-input name="mark" type="text" label="Marka" placeholder="Ford" value="Ford" disable-feedback />
                <x-adminlte-input name="model" type="text" label="Model" placeholder="Custom" value="Custom" disable-feedback />
                <x-adminlte-input name="license_plate" type="text" label="Numer rejestracyjny" placeholder="Numer rejestracyjny" disable-feedback />
                <x-adminlte-input name="vehicle_identification_number" type="text" label="Numer VIN" placeholder="Numer VIN" disable-feedback />
                <x-adminlte-select-bs name="selBsVehicle" label="Typ" data-title="Wybierz typ ..." data-live-search data-live-search-placeholder="Wybierz typ ..." data-show-tick>
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-gradient-info">
                            <i class="fas fa-car-side"></i>
                        </div>
                    </x-slot>
                    <option data-icon="fa fa-fw fa-car">Osobowy</option>
                    <option data-icon="fa fa-fw fa-truck" selected>Dostawczy</option>
                    <option data-icon="fa fa-fw fa-truck-moving">Ciężarowy</option>
                    <option data-icon="fa fa-fw fa-motorcycle">Motocykl</option>
                </x-adminlte-select-bs>
                <x-adminlte-input name="production_year" type="number" label="Rok produkcji" placeholder="2022" disable-feedback />
                <x-adminlte-input name="engine_capacity" type="number" label="Pojemność silnika (cm3)" placeholder="3000" disable-feedback />
                <x-adminlte-input name="engine_power" type="number" label="Moc silnika (KM)" placeholder="70" disable-feedback />
                <x-adminlte-input name="max_axle_load" type="number" label="Maksymalne obciążanie osi (KG)" placeholder="1400" disable-feedback />
                <x-adminlte-input name="max_towed_load" type="number" label="Maksymalne ciężar holowania (KG)" placeholder="1600" disable-feedback />
                <x-adminlte-input name="max_total_weight" type="number" label="Maksymalny ciężar całkowity" placeholder="1600" disable-feedback />
                <x-adminlte-input name="axle" type="number" label="Ilość osi" placeholder="2" disable-feedback />
                <x-adminlte-input name="siting_places" type="number" label="Ilość miejsc siedzących" placeholder="5" disable-feedback />
                <x-adminlte-input name="standing_places" type="number" label="Ilość miejsc stojących" placeholder="0" disable-feedback />
                <x-adminlte-button label="Zapisz" type="submit" theme="success" class="float-right" icon="fas fa-save" />
            </div>
        </div>
    </x-adminlte-card>
</form>
@stop

@section('css')

@stop