@extends('adminlte::page')

@section('title', 'Tworzenie pojazdu')

@section('content_header')
<h1>Tworzenie nowego pojazdu</h1>
@stop

@section('content')
@section('plugins.Jquery-validation', true)

<form id="addVehicleForm" action="/vehicle/add" method="POST" enctype="multipart/form-data">
    @csrf
    @if($entitlements == 0 || $entitlements == 1)
    <x-adminlte-card title="Dane pojazdu" theme="lightblue" theme-mode="outline" collapsible maximizable>
        <div class="row">
            <div class="col-sm-12">
                <x-adminlte-input name="name" type="text" label="Nazwa" placeholder="Nazwa" disable-feedback />
                <x-adminlte-input name="brand" type="text" label="Marka" placeholder="Marka" disable-feedback />
                <x-adminlte-select-bs name="user_id" label="Opiekun pojazdu" 
                    data-title="Wybierz opiekuna ..." data-live-search
                    data-live-search-placeholder="Wybierz opiekuna ..." data-show-tick>
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-gradient-info">
                            <i class="fas fa-person"></i>
                        </div>
                    </x-slot>
                    @foreach($users as $user)
                        <option value="{{$user->id}}">{{$user->name}} {{$user->last_name}}</option>
                    @endforeach
                </x-adminlte-select-bs>
                <x-adminlte-input name="model" type="text" label="Model" placeholder="Model" disable-feedback />
                <x-adminlte-input name="license_plate" type="text" label="Numer rejestracyjny" placeholder="Numer rejestracyjny" disable-feedback />
                <x-adminlte-input name="vehicle_identification_number" type="text" label="Numer VIN" placeholder="Numer VIN" disable-feedback />
                <x-adminlte-select-bs name="selBsVehicle" label="Typ" data-title="Wybierz typ ..." data-live-search data-live-search-placeholder="Wybierz typ ..." data-show-tick>
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-gradient-info">
                            <i class="fas fa-car-side"></i>
                        </div>
                    </x-slot>
                    @foreach($vehicle_types as $vehicle_type)
                        <option data-icon="{{$vehicle_type->icon}}">{{$vehicle_type->type}}</option>
                    @endforeach
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
                <x-adminlte-input-file name="photos[]" label="Zdjęcia" legend="Wybierz" placeholder="Wybierz lub upuść zdjęcia" multiple>
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-lightblue">
                            <i class="fas fa-upload"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input-file>
                <x-adminlte-button label="Zapisz" type="submit" theme="success" class="float-right" icon="fas fa-save" />
            </div>
        </div>
    </x-adminlte-card>
    @else
        <p>Nie posiadasz uprawnień do tworzenia pojazdów</p>
    @endif
</form>
@stop

@section('css')

@stop

@section('js')
<script>
    $(document).ready(function(){
        //Validate fields
        $("#addVehicleForm").validate({
            rules: {
                name: {
                    required: true,
                },
                brand: {
                    required: true,
                },
                user_id: {
                    required: true
                },
                model: {
                    required: true,
                },
                license_plate: {
                    required: true,
                    maxlength: 7,
                    minlength: 5
                },
                vehicle_identification_number: {
                    required: true,
                    maxlength: 17,
                    minlength: 17
                },
                selBsVehicle: {
                    required: true,
                },
                production_year: {
                    required: true,
                    digits: true
                },
                engine_capacity: {
                    required: true,
                    number: true
                },
                engine_power: {
                    required: true,
                    number: true
                },
                max_axle_load: {
                    required: true,
                    number: true
                },
                max_total_weight: {
                    required: true,
                    number: true,
                    minlength: 3
                },
                max_towed_load: {
                    required: true,
                    number: true,
                },
                siting_places: {
                    required: true,
                    number: true,
                },
                axle: {
                    required: true,
                    number: true,
                },
                standing_places: {
                    required: true,
                    number: true,
                },
            } 
        });
    })
</script>
@stop