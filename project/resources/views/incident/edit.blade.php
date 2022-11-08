@extends('adminlte::page')

@section('title', 'Edycja usterki')
@section('plugins.BsCustomFileInput', true)

@section('content_header')
<h1>Edycja usterki</h1>
@stop

@section('content')
@section('plugins.Jquery-validation', true)

<form id="addIncidentForm" action="{{url('/incident/edit/'. $incident->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    <x-adminlte-card title="Dane usterki" theme="lightblue" theme-mode="outline" collapsible maximizable>
        <div class="row">
            <div class="col-sm-12">
                <x-adminlte-input-date name="date" value="{{$incident->date}}" label="Data">
                    <x-slot name="appendSlot">
                        <x-adminlte-button icon="fas fa-calendar-day" title="Data" />
                    </x-slot>
                </x-adminlte-input-date>
                <x-adminlte-input name="address" value="{{$incident->address}}" type="text" label="Adres" placeholder="Adres zdarzenia" disable-feedback />
                <x-adminlte-select-bs name="vehicle_id" label="Wybierz pojazd" data-title="Wybierz pojazd ..." data-live-search data-live-search-placeholder="Wybierz pojazd ..." data-show-tick required>
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-gradient-info">
                            <i class="fas fa-car-side"></i>
                        </div>
                    </x-slot>
                    <option value="{{ $thisCar->id }}" selected>{{$thisCar->license_plate}}</option>
                    @foreach ($vehicles as $vehicle)
                    <option data-icon="fa fa-fw fa-car" value="{{ $vehicle->id }}">{{ $vehicle->license_plate }}</option>
                    @endforeach
                </x-adminlte-select-bs>
                <x-adminlte-textarea name="description" label="Opis" placeholder="Krótko opisz zdarzenie" disable-feedback required>
                    {{$incident->description}}
                </x-adminlte-textarea>
                <x-adminlte-select-bs name="status" label="Status zdarzenia" data-title="Wybierz status ..." data-live-search data-live-search-placeholder="Wybierz status ..." data-show-tick required>
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-gradient-info">
                            <i class="fas fa-car-side"></i>
                        </div>
                    </x-slot>
                    <option value="{{ $incident->status }}" selected>{{ $incident->status }}</option>
                    <option data-icon="fa fa-fw fa-car">in_progress</option>
                    <option data-icon="fa fa-fw fa-car">resolved</option>
                    <option data-icon="fa fa-fw fa-car">unprocessed</option>
                </x-adminlte-select-bs>
                
                <x-adminlte-button label="Zapisz" type="submit" theme="success" class="float-right" icon="fas fa-save" />
            </div>
        </div>
    </x-adminlte-card>
</form>
@stop
@section('js')
<script>
    //Set datetime of datetime filed
    $(document).ready(function() {
        $('#date').datetimepicker("defaultDate", new Date());
    });

    $("#addIncidentForm").validate({
        rules: {
            date: {
                required: true,
            },
            address: {
                required: true,
            },
            incident_id: {
                required: true,
            },
            description: {
                required: true,
            },
            // photo: {
            //     require: true
            // },
        },
        highlight: function(element) {
            $(element).parent().css('color', 'red')
        },
    });
</script>

@stop