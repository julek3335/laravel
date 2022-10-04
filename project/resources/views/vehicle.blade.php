@extends('adminlte::page')

@section('title', 'Pojazd - ...')

@section('content_header')
    <h1>Pojazd - {{ $vehicle->name }}</h1>
@stop

@section('content')
    <x-adminlte-alert theme="warning" title="Przegląd olejowy" dismissable>
        Zbliża się interwał serwisu olejowego. Do <strong>30.09.2022 r.</strong> należy wykonać serwis.
    </x-adminlte-alert>
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
                <x-adminlte-button label="Podejmij pojazd" icon="fas fa-light fa-plus"/>
            </div>
        </div>
        
    </x-adminlte-card>
    <x-adminlte-card title="Informacje o pojeździe" theme="lightblue" theme-mode="outline" collapsible maximizable>
        <div class="row">
            <div class="col-sm-6">
                <x-adminlte-input name="name" label="Nazwa" placeholder="Nazwa"
                    value="{{ $vehicle->name }}" disable-feedback/>
                <x-adminlte-input name="mark" label="Marka" placeholder="Ford"
                    value="Ford" disable-feedback/>
                <x-adminlte-input name="model" label="Model" placeholder="Custom"
                    value="Custom" disable-feedback/>
                <x-adminlte-input name="license_plate" label="Numer rejestracyjny" placeholder="Numer rejestracyjny"
                    value="{{ $vehicle->license_plate }}" disable-feedback/>
                <x-adminlte-input name="vehicle_identification_number" label="Numer VIN" placeholder="Numer VIN"
                    value="{{ $registration_card->vehicle_identification_number	}}" disable-feedback/>   
                <x-adminlte-select-bs name="selBsVehicle" label="Typ" 
                    data-title="Wybierz typ ..." data-live-search
                    data-live-search-placeholder="Wybierz typ ..." data-show-tick>
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
                <x-adminlte-select-bs name="selBsProductionYear" label="Rok produkcji" 
                    data-title="Wybierz rok ..." data-live-search
                    data-live-search-placeholder="Wybierz rok ..." data-show-tick>
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-gradient-info">
                            <i class="fas fa-calendar"></i>
                        </div>
                    </x-slot>
                    <option selected>2022</option>
                    <option>2021</option>
                    <option>2020</option>
                    <option>2019</option>
                    <option>2018</option>
                    <option>2017</option>
                    <option>2016</option>
                    <option>2015</option>
                    <option>2014</option>
                    <option>2013</option>
                    <option>2012</option>
                    <option>2011</option>
                    <option>2010</option>
                    <option>2009</option>
                    <option>2008</option>
                    <option>2007</option>
                    <option>2006</option>
                    <option>2005</option>
                    <option>2004</option>
                    <option>2003</option>
                    <option>2002</option>
                    <option>2001</option>
                    <option>2000</option>
                </x-adminlte-select-bs>
                <x-adminlte-select-bs name="selBsEngineCapacity" label="Pojemność silnika" 
                    data-title="Wybierz pojemność silnika ..." data-live-search
                    data-live-search-placeholder="Wybierz pojemność silnika ..." data-show-tick>
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-gradient-info">
                            <i class="fas fa-car"></i>
                        </div>
                    </x-slot>
                    <option selected>3 000 m3</option>
                    <option>1 400 m3</option>
                    <option>1 600 m3</option>
                    <option>1 800 m3</option>
                    <option>2 000 m3</option>
                    <option>5 000 m3</option>
                </x-adminlte-select-bs>

                <x-adminlte-button label="Zapisz" theme="success" class="float-right" icon="fas fa-save"/>
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