@extends('adminlte::page')

@section('title', 'Dodawanie ubezpieczenia')

@section('content_header')
<h1>Dodawanie ubezpieczenia</h1>
@stop

@section('content')
@section('plugins.Jquery-validation', true)

<form id="addInsuranceForm" action="/add-new" method="POST" enctype="multipart/form-data">
    @csrf
    <x-adminlte-card title="Dane pojazdu" theme="lightblue" theme-mode="outline" collapsible maximizable>
        <div class="row">
            <div class="col-sm-12">
                <x-adminlte-input name="policy_number" type="text" label="Numer ubezpieczenia" placeholder="Numer ubezpieczenia" disable-feedback required />
                <x-adminlte-input name="expiration_date" type="text" label="Data wygaśnięcia" placeholder="Data wygaśnięcia" disable-feedback required />
                <x-adminlte-input name="cost" type="number" label="Koszt" placeholder="Koszt" disable-feedback />
                <x-adminlte-input name="phone_number" type="tel" label="Numer kontaktowy" placeholder="Numer kontaktowy" disable-feedback required />
                <x-adminlte-input name="insurer_name" type="text" label="Ubezpieczyciel" placeholder="Ubezpieczyciel" disable-feedback required />
                <x-adminlte-textarea name="description" type="text" label="Opis" placeholder="Opis" disable-feedback required />
                {{-- <x-adminlte-input name="status" type="text" label="Status" placeholder="Status ubezpieczenia" value="" disable-feedback required /> --}}
                <x-adminlte-select-bs name="selBsVehicle" label="Typ" data-title="Wybierz typ ubezpieczenia ..." data-live-search data-live-search-placeholder="Wybierz pojazd ..." data-show-tick>
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-gradient-info">
                            <i class="fas fa-car-side"></i>
                        </div>
                    </x-slot>
                    @foreach(App\Enums\InsuranceTypeEnum::cases() as $status_option)
                        <option value="{{ $status_option->value }}">{{ $status_option->name }}</option>
                    @endforeach>
                </x-adminlte-select-bs>
                <x-adminlte-input-file name="photo" label="Zdjęcie" legend="Wybierz" placeholder="Wybierz lub upuść zdjęcie" >
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-lightblue">
                            <i class="fas fa-upload"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input-file>
                <x-adminlte-select-bs name="license_plate" label="Numer rejestracyjny pojazdu" data-title="Wybierz pojazd ..." data-live-search data-live-search-placeholder="Wybierz typ ..." data-show-tick>
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
            </div>
        </div>
    </x-adminlte-card>
</form>
@stop

@section('js')
<script>
    $(document).ready(function(){
        $("#addInsuranceForm").validate({
            rules: {
                policy_number: {
                    required: true,
                    decimal: true,
                },
                expiration_date: {
                    required: true,
                },
                cost: {
                    required: true,
                    number: true
                },
                phone_number: {
                    required: true,
                    phonePL: true
                },
                insurer_name: {
                    require: true
                },
                description: {
                    required: true,
                },
                selBsVehicle: {
                    required: true,
                },
                license_plate: {
                    required: true,
                },
            }
        });
    });
</script>
@stop