@extends('adminlte::page')

@section('title', 'Pojazd') 

@section('content_header')
    <h1>Pojazd {{ $vehicle->name }}</h1>
@stop

@section('content')
@section('plugins.PhotoSwipe', true)

    <x-adminlte-alert theme="warning" title="Przegląd olejowy" dismissable>
        Zbliża się interwał serwisu olejowego. Do <strong>30.09.2022 r.</strong> należy wykonać serwis.
    </x-adminlte-alert>

     @if( $insuranceEnds )
     @foreach($insuranceEnds as $insuranceEnd)
            <x-adminlte-alert theme="warning" title="Ubezpieczenie straci ważność w przeciągu tygodnia!" dismissable>
            Ubezpieczenie {{$insuranceEnd->type}} straci ważność dnia: <strong>{{ $insuranceEnd->expiration_date }}</strong> należy wykupić nowe.
            </x-adminlte-alert>
            @endforeach
    @endif

    @if( count($activeInsurance)==0 )
        <x-adminlte-alert theme="danger" title="Brak ważnych ubezpieczeń!" dismissable>
            Brak ważnych ubezpieczeń! Należy wykupić nowe
        </x-adminlte-alert>
    @endif

    @if( count($activeInsuraneOC) == 0 )
        <x-adminlte-alert theme="danger" title="Brak ważnego ubezpieczenia OC!" dismissable>
            Należy wykupić ubezpieczenie OC
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
            <div clas="col-sm-12">
                <div class="float-left m-1">
                    @include('partials.vehicle.pickup')
                </div>
                <div class="float-left m-1">
                    @include('partials.vehicle.reservation')
                </div>
                <div class="float-left m-1">
                    @include('partials.insurance.add')
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div clas="col-sm-12">
                <div class="float-left m-1">
                    <a href="/vehicle/edit/{{$vehicle->id}}">
                        <x-adminlte-button label="Edytuj pojazd" icon="fas fa-edit" class="float-right mr-2"/>
                    </a>
                </div>
            </div>
        </div>
    </x-adminlte-card>
    <x-adminlte-card title="Informacje o pojeździe" theme="lightblue" theme-mode="outline" collapsible="collapsed" maximizable>
        <div class="row">
            <div class="col-sm-6">
                <ul class="mt-4 list-group list-group-unbordered">
                    <li class="list-group-item">
                        <strong>Nazwa</strong> <span class="float-right">{{ $vehicle->name }}</span>
                    </li>
                    <li class="list-group-item">
                        <strong>Marka</strong> <span class="float-right">{{ $registration_card->brand }}</span>
                    </li>
                    <li class="list-group-item">
                        <strong>Model</strong> <span class="float-right">{{ $registration_card->model }}</span>
                    </li>
                    <li class="list-group-item">
                        <strong>Numer rejestracyjny</strong> <span class="float-right">{{ $vehicle->license_plate }}</span>
                    </li>
                    <li class="list-group-item">
                        <strong>Numer VIN</strong> <span class="float-right">{{ $registration_card->vehicle_identification_number	}}</span>
                    </li>
                    <li class="list-group-item">
                        <strong>Typ</strong> <span class="float-right">{{$vehicle->type}}</span>
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
                        <strong>Status</strong> <a href="#" class="float-right">{{__('status.'.$vehicle->status->name)}}</a>
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
                        <strong>Ilość miejsc stojących</strong> <span class="float-right">{{ $registration_card->standing_places }}</span>
                    </li>
                    <li class="list-group-item">
                        <strong>Data utworzenia</strong> <span class="float-right">{{ date('m:H d.m.Y', strtotime($vehicle->created_at)) }}</span>
                    </li>
                    <li class="list-group-item">
                        <strong>Opiekun pojazdu</strong> <span class="float-right"><a href="/user/{{$assignedUser->id}}">{{ $assignedUser -> name }} {{ $assignedUser -> last_name }}</a></span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row mt-4">
            @if($entitlements == 0 || $entitlements == 1)
                <div class="col-sm-12">
                    <a href="/vehicle/edit/{{ $vehicle->id }}">
                        <x-adminlte-button label="Edytuj" icon="fas fa-light fa-edit"/>
                    </a>
                </div>
            @endif
        </div>
    </x-adminlte-card>
    <x-adminlte-card title="Galeria zdjęć" theme="lightblue" theme-mode="outline" collapsible="collapsed" maximizable>
        {{-- @if(isset($vehicle->photos) && !empty($vehicle->photos))
        <div class="vehicle-gallery">
            <div class="row">
                @foreach($vehicle->photos as $photo)
                @php
                    $photo_size = getimagesize( $photo );          
                @endphp
                <div class="col-sm-4 p-2">
                    <a href="{{$photo}}" data-pswp-width="{{$photo_size[0]}}" data-pswp-height="{{$photo_size[1]}}">
                        <img src="{{$photo}}" alt="" class="img-fluid"/>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        @else
        <p>Brak zdjęć pojazdu</p>
        @endif --}}
    </x-adminlte-card>
    @section('plugins.Fullcalendar', true)
    <x-adminlte-card title="Kalendarz pojazdu" theme="lightblue" theme-mode="outline" collapsible="collapsed" maximizable>
        <div id='calendar'></div>
    </x-adminlte-card>
    <script>
        var events = []
        @foreach ($reservations as $reservation)
            events.push({
                title: 'Rezerwacja - Użytkownik {{$reservation->user_name}}', 
                start: "{{$reservation->start_date}}", 
                end: "{{$reservation->end_date}}",
                backgroundColor: '#f39c12', //yellow
                borderColor    : '#f39c12' //yellow
            });
        @endforeach
    </script>
    <x-adminlte-card title="Aktualne ubezpieczenie pojazdu" theme="lightblue" theme-mode="outline" collapsible="collapsed" maximizable>   
        @if($activeInsurance)
            @foreach($activeInsurance as $insurance)
                @if( $insurance->status->name == 'ACTIVE')
                    <div class="row">
                        <div class="col-sm-6">
                            <ul class="mt-4 list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <strong>Numer ubezpieczenia</strong> <span class="float-right">{{ $insurance->policy_number }}</span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Data wygaśnięcia</strong> <span class="float-right">{{ $insurance->expiration_date }}</span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Koszt</strong> <span class="float-right">{{ $insurance->cost }}</span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Numer Kontaktowy</strong> <span class="float-right">{{ $insurance->phone_number }}</span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Typ</strong> <span class="float-right">{{ $insurance->type }}</span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Nazwa ubezpieczyciela</strong> <span class="float-right">{{ $insurance->insurer_name }}</span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Opis</strong> <span class="float-right">{{ $insurance->description }}</span>
                                </li>
                            </ul>
                        </div>
                        <div class="col-sm-5 offset-sm-1">
                            <ul class="mt-4 list-group list-group-unbordered">
                                <img src="{{asset('storage/insurance_photos/'. $insurance->photo)}}" class="img-fluid p-4">
                            </ul>
                        </div>
                        @include('partials.insurance.delete')
                        <a href="/insurance/edit/{{$insurance->id}}">
                            <x-adminlte-button label="Edytuj ubezpieczenie" icon="fas fa-edit" class="float-right mr-2"/>
                        </a>
                    </div>
                @endif
            @endforeach
        @else
        <p>Brak danych o ubezpieczeniach</p>
        @endif
    </x-adminlte-card>
    <x-adminlte-card title="Usterki pojazdu" theme="lightblue" theme-mode="outline" collapsible="collapsed" maximizable>   
        @if($incidents_others || $incidents_resolved)
        <div id="accordion_incidents">
            <div class="card">
                <div class="card-header" id="accordion_incidents_others">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse_incidents_others" aria-expanded="true" aria-controls="collapse_incidents_others">
                        Wymagające uwagi
                        </button>
                    </h5>
                </div>

                <div id="collapse_incidents_others" class="collapse show" aria-labelledby="accordion_incidents_others" data-parent="#accordion_incidents">
                    <div class="card-body">
                    @foreach ($incidents_others as $incident)
                    <div class="row">
                        <div class="col-sm-6">
                            @include('partials.incident.show')
                        </div>
                        <div class="col-sm-6">
                            <img src="{{asset('storage/incidents_photos/'. $incident->photo)}}" class="img-fluid p-4">
                        </div>
                    </div>
                    @endforeach
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="accordion_incidents_resolved">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse_incidents_resolved" aria-expanded="false" aria-controls="collapse_incidents_resolved">
                        Rozwiązane
                        </button>
                    </h5>
                </div>

                <div id="collapse_incidents_resolved" class="collapse" aria-labelledby="accordion_incidents_resolved" data-parent="#accordion_incidents">
                    <div class="card-body">
                    @foreach ($incidents_resolved as $incident)
                    <div class="row">
                        <div class="col-sm-6">
                            @include('partials.incident.show')
                        </div>
                        <div class="col-sm-6">
                            <img src="{{asset('storage/incidents_photos/'. $incident->photo)}}" class="img-fluid p-4">
                        </div>
                    </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="row">
            <div class="col-sm-12">
                <p>Brak danych o userkach</p>
            </div>
        </div>
        @endif
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

@stop

@section('js')
<script>
    /*
    ** Calendar
    */
    $(document).ready(function(){
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            locale: 'pl',
            headerToolbar: {
                left  : 'prev,next today',
                center: 'title',
                right : 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            themeSystem: 'bootstrap',
            selectable: true,
            events: events
        });

        calendar.render();
    });

    /*
    ** PhotoSwipe
    */
    var lightbox = new PhotoSwipeLightbox({
        gallery: '.vehicle-gallery',
        children: 'a',
        // dynamic import is not supported in UMD version
        pswpModule: PhotoSwipe 
      });
      lightbox.init();
</script>
@stop
