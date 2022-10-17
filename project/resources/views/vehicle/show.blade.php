@extends('adminlte::page')

@section('title', 'Pojazd') 

@section('content_header')
    <h1>Pojazd {{ $vehicle->name }}</h1>
@stop

@section('content')
    <x-adminlte-modal id="modalEditVehicle" title="Edycja danych pojazdu" theme="light" icon="fas fa-bolt">
        <form action="{{ url('vehicle/edit/'. $vehicle->id) }}" method="POST">
            @csrf
            @include('partials.vehicle.edit')
            <x-slot name="footerSlot">
                <x-adminlte-button theme="danger" label="Zamknij" data-dismiss="modal"/>
            </x-slot>
        </form>
    </x-adminlte-modal>

    <x-adminlte-alert theme="warning" title="Przegląd olejowy" dismissable>
        Zbliża się interwał serwisu olejowego. Do <strong>30.09.2022 r.</strong> należy wykonać serwis.
    </x-adminlte-alert>

     @if( $insurance_importance_in_7_days )
            <x-adminlte-alert theme="warning" title="Ubezpieczenie straci ważność w przeciągu tygodnia!" dismissable>
            Ubezpieczenie straci ważność dnia: <strong>{{ $insurances->expiration_date }}</strong> należy wykupić nowe.
            </x-adminlte-alert>
    @endif

    @if( $insurance_importance_end )
            <x-adminlte-alert theme="danger" title="Ubezpieczenie pojazdu straciło ważność!" dismissable>
            Ubezpieczenie straciło ważność dnia: <strong>{{ $insurances->expiration_date }}</strong> należy wykupić nowe.
            </x-adminlte-alert>
    @endif

    <x-adminlte-card title="Szybki skrót" theme="lightblue" theme-mode="outline" collapsible maximizable>   
        <div class="row">
            <div class="col-sm-4">
                <x-adminlte-info-box title="Przebieg" text="125 458 km" icon="fas fa-light fa-car"/>
            </div>
            <div class="col-sm-4">
                <x-adminlte-info-box title="Przegląd olejowy" text="14500/15000 km" icon="fas fa-regular fa-oil-can"
                    progress=96 progress-theme="dark" description="Pozostało: 500 km, 28 dni."/>
            </div>
        </div>
    </x-adminlte-card>
    <x-adminlte-card title="Akcje" theme="lightblue" theme-mode="outline" collapsible maximizable>   
        <div class="row">
            <div class="col-6 col-sm-4 col-md-3 col-xl-2">
                @include('partials.vehicle.pickup')
            </div>
            <div class="col-6 col-sm-4 col-md-3 col-xl-2">
                <a href="/calendar/{{ $vehicle->id }}">
                    <x-adminlte-button label="Zarezerwuj pojazd" icon="fas fa-light fa-plus"/>
                </a>
            </div>
        </div>
    </x-adminlte-card>
    <x-adminlte-card title="Informacje o pojeździe" theme="lightblue" theme-mode="outline" collapsible maximizable>
        <div class="row">
            <div class="col-sm-6">
                <ul class="mt-4 list-group list-group-unbordered">
                    <li class="list-group-item">
                        <strong>Nazwa</strong> <span class="float-right">{{ $vehicle->name }}</span>
                    </li>
                    <li class="list-group-item">
                        <strong>Marka</strong> <span class="float-right">Ford</span>
                    </li>
                    <li class="list-group-item">
                        <strong>Model</strong> <span class="float-right">Custom</span>
                    </li>
                    <li class="list-group-item">
                        <strong>Numer rejestracyjny</strong> <span class="float-right">{{ $vehicle->license_plate }}</span>
                    </li>
                    <li class="list-group-item">
                        <strong>Numer VIN</strong> <span class="float-right">{{ $registration_card->vehicle_identification_number	}}</span>
                    </li>
                    <li class="list-group-item">
                        <strong>Typ</strong> <span class="float-right">Osobowy</span>
                    </li>
                    <li class="list-group-item">
                        <strong>Rok produkcji</strong> <span class="float-right">{{ $registration_card->production_year }}</span>
                    </li>
                    <li class="list-group-item">
                        <strong>Pojemność silnika (cm3)</strong> <span class="float-right">{{ $registration_card->engine_capacity }}</span>
                    </li>
                    <li class="list-group-item">
                        <strong>Moc silnika (KM)</strong> <span class="float-right">{{ $registration_card->engine_power }}</span>
                    </li>
                    <li class="list-group-item">
                        <strong>Maksymalne obciążanie osi (KG)</strong> <span class="float-right">{{ $registration_card->max_axle_load }}</span>
                    </li>
                    <li class="list-group-item">
                        <strong>Maksymalne ciężar całkowity</strong> <span class="float-right">{{ $registration_card->max_towed_load }}</span>
                    </li>
                    <li class="list-group-item">
                        <strong>Ilość osi</strong> <span class="float-right">{{ $registration_card->axle }}</span>
                    </li>
                    <li class="list-group-item">
                        <strong>Ilość miejsc siedzących</strong> <span class="float-right">{{ $registration_card->siting_places }}</span>
                    </li>
                    <li class="list-group-item">
                        <strong>Ilość miejsc stojących</strong> <span class="float-right">{{ $registration_card->standing_places }}</span>
                    </li>
                </ul>
            </div>
            <div class="col-sm-5 offset-sm-1">
                <ul class="mt-4 list-group list-group-unbordered">
                    <li class="list-group-item">
                        <strong>Przebieg</strong> <span class="float-right">125 458 km</span>
                    </li>
                    <li class="list-group-item">
                        <strong>Status</strong> <a href="#" class="float-right">{{ $vehicle->status }}</a>
                    </li>
                    <li class="list-group-item">
                        <strong>Akcje serwisowe</strong> <a href="#" class="float-right">5</a>
                    </li>
                    <li class="list-group-item">
                        <strong>Aktywne zgłoszenia</strong> <a href="#" class="float-right">2</a>
                    </li>
                    <li class="list-group-item">
                        <strong>Zarejestrowane trasy</strong> <a href="#" class="float-right">254</a>
                    </li>
                    <li class="list-group-item">
                        <strong>Data utworzenia</strong> <span class="float-right">{{ date('m:H d.m.Y', strtotime($vehicle->updated_at)) }}</span>
                    </li>
                    <li class="list-group-item">
                        <strong>Ostatnia aktualizacja</strong> <span class="float-right">{{ date('m:H d.m.Y', strtotime($vehicle->updated_at)) }}</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-sm-12">
                <a href="/vehicle/edit/{{ $vehicle->id }}">
                    <x-adminlte-button label="Edytuj" icon="fas fa-light fa-edit"/>
                </a>
                <x-adminlte-button label="Edytuj - modal" icon="fas fa-light fa-edit" data-toggle="modal" data-target="#modalEditVehicle" id="modalEditVehicle"/>
            </div>
        </div>
    </x-adminlte-card>
    <x-adminlte-card title="Ubezpieczenie pojazdu" theme="lightblue" theme-mode="outline" collapsible maximizable>   
        <div class="row">
            <div class="col-sm-6">
                @if($insurances)
                <x-adminlte-input name="policy_number" type="text" label="Numer ubezpieczenia" placeholder="Numer ubezpieczenia"
                    value="{{ $insurances->policy_number }}" disable-feedback/>
                <x-adminlte-input name="expiration_date" type="text" label="Data wygaśnięcia" placeholder="Data wygaśnięcia"
                    value="{{ $insurances->expiration_date }}" disable-feedback/>
                <x-adminlte-input name="cost" type="text" label="Koszt" placeholder="Koszt"
                    value="{{ $insurances->cost }}" disable-feedback/>
                <x-adminlte-input name="contact_number" type="text" label="Numer kontaktowy" placeholder="Numer kontaktowy"
                    value="{{ $insurances->phone_number }}" disable-feedback/>
                <x-adminlte-button label="Zapisz" theme="success" class="float-right" icon="fas fa-save"/>
                @else
                <p>Brak danych o ubezpieczeniach</p>
                @endif
            </div>
        </div>
    </x-adminlte-card>
    <x-adminlte-card title="Historia" theme="lightblue" theme-mode="outline" collapsible="collapsed" maximizable>   
        <div class="timeline">
            <div class="time-label">
                <span class="bg-blue">{{ date('d.m.Y', strtotime($vehicle->updated_at)) }}</span>
            </div>

            <div>
                <i class="fas fa-save bg-yellow"></i>
                <div class="timeline-item">
                    <span class="time"><i class="fas fa-clock"></i> {{ date('m:H', strtotime($vehicle->updated_at)) }}</span>
                    <h3 class="timeline-header"><a href="#">Aktualizacja</a></h3>
                    <div class="timeline-body">
                        Aktualizacja danych.
                    </div>
                </div>
            </div>

            <div class="time-label">
                <span class="bg-green">{{ date('d.m.Y', strtotime($vehicle->created_at)) }}</span>
            </div>

            <div>
                <i class="fa fa-car bg-yellow"></i>
                <div class="timeline-item">
                    <span class="time"><i class="fas fa-clock"></i> {{ date('m:H', strtotime($vehicle->created_at)) }}</span>
                    <h3 class="timeline-header"><a href="#">Utworzenie pojazdu</a></h3>
                    <div class="timeline-body">
                        <p>Pojazd został stworzony</p>
                    </div>
                </div>
            </div>

            <div>
                <i class="fas fa-clock bg-gray"></i>
            </div>
        </div><!-- .timeline -->
    </x-adminlte-card>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop