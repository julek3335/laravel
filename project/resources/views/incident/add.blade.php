@extends('adminlte::page')

@section('title', 'Dodawanie usterki') 
@section('plugins.BsCustomFileInput', true)

@section('content_header')
    <h1>Dodawanie usterki</h1>
@stop

@section('content')
<form action="/incident/add" method="POST" enctype="multipart/form-data">
    @csrf
    <x-adminlte-card title="Dane usterki" theme="lightblue" theme-mode="outline" collapsible maximizable>
        <div class="row">
                <div class="col-sm-12">
                    @php
                    $config = ['format' => 'DD.MM.YYYY HH:mm'];
                    @endphp
                    <x-adminlte-input-date name="date" :config="$config" label="Data">
                        <x-slot name="appendSlot">
                            <x-adminlte-button icon="fas fa-calendar-day"
                                title="Data"/>
                        </x-slot>
                    </x-adminlte-input-date>
                    <x-adminlte-input name="address" type="text" label="Adres" placeholder="Adres zdarzenia" disable-feedback/>
                    <x-adminlte-select-bs name="vehicle_id" label="Wybierz pojazd" 
                        data-title="Wybierz pojazd ..." data-live-search
                        data-live-search-placeholder="Wybierz pojazd ..." data-show-tick required>
                        <x-slot name="prependSlot">
                            <div class="input-group-text bg-gradient-info">
                                <i class="fas fa-car-side"></i>
                            </div>
                        </x-slot>
                        @foreach ($vehicles as $vehicle)
                        <option data-icon="fa fa-fw fa-car" value="{{ $vehicle->id }}">{{ $vehicle->name }}</option>
                        @endforeach
                    </x-adminlte-select-bs>
                    <x-adminlte-textarea name="description" label="Opis" placeholder="Krótko opisz zdarzenie" disable-feedback required/>
                    <x-adminlte-input-file name="photo" label="Zdjęcie" legend="Wybierz" placeholder="Wybierz lub upuść zdjęcie" required>
                        <x-slot name="prependSlot">
                            <div class="input-group-text bg-lightblue">
                                <i class="fas fa-upload"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input-file>
                    <x-adminlte-button label="Zapisz" type="submit" theme="success" class="float-right" icon="fas fa-save"/>
            </div>
        </div>
    </x-adminlte-card>
</form>
@stop
@section('js')
    <script>
        //Set datetime of datetime filed
        $(document).ready(function(){
            $('#date').datetimepicker("defaultDate", new Date());
        });
    </script>
@stop