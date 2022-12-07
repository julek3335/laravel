@extends('adminlte::page')

@section('title', 'Użytkownik')

@section('content_header')

@stop

@section('content')
@section('plugins.Fullcalendar', true)

<section class="content">
    <div class="container-fluid">
        <div class="row pt-2">
            <div class="col-md-3">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        @isset($user->photo)
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="{{$user->photo}}" alt="Zdjęcie profilowe - {{$user->name}} {{$user->last_name}}">
                        </div>
                        @endisset
                        <h3 class="profile-username text-center">{{$user->name}} {{$user->last_name}}</h3>
                        <p class="text-muted text-center">Kierowca</p>
                    </div>
                </div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Informacje o użytkowniku</h3>
                    </div>
                    <div class="card-body">
                        <strong><i class="far fa-address-card"></i> Kategoria prawa jazdy</strong>
                        <p class="text-muted">
                            {{$user->qualifications[0]->code}}
                        </p>
                        <hr>
                        <strong><i class="far fa-envelope-open"></i> Email</strong>
                        <p class="text-muted">{{$user->email}}</p>
                        <hr>
                        <strong><i class="far fa-bell"></i> Status</strong>
                        <p class="text-muted">{{__('status.'.$user->status->name)}}</p>
                        <p>
                        <div>
                        @if($entitlements == 0 || $entitlements == 1)
                            @include('partials.user.deleteUser')
                        @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                        @if($entitlements == 0 || $entitlements == 1)
                            <li class="nav-item"><a class="nav-link" href="#edit" data-toggle="tab">Edycja</a></li>
                        @endif
                            <li class="nav-item"><a class="nav-link active" href="#reservations" data-toggle="tab">Rezerwacje</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">

                            <!-- edycja -->
                            <div class="tab-pane" id="edit">
                                <form id="user_form" action="{{ url('user/edit/'.$user->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @include('partials.user.fields')
                                </form>
                            </div>
                            <!-- rezerwacje -->
                            <div class="tab-pane active" id="reservations">
                                <div id="calendar"></div>
                                <script>
                                    var reservations = []
                                    @foreach($reservations as $reservation)
                                    reservations.push({
                                        title: 'Rezerwacja: {{$reservation->user->name}} {{$reservation->user->last_name}}, Pojazd: {{$reservation->vehicle->license_plate}}',
                                        start: "{{$reservation->start_date}}",
                                        end: "{{$reservation->end_date}}",
                                        extendedProps: {
                                            'user_name': "{{$user->name}}",
                                            'user_last_name': "{{$user->last_name}}",
                                            'user_id': "{{$user->id}}", 
                                            'vehicle_name': "{{$reservation->vehicle->name}}", 
                                            'vehicle_id': "{{$reservation->vehicle->id}}",
                                            'vehcile_license_plate': "{{$reservation->vehicle->license_plate}}"
                                        },
                                        backgroundColor: '#f39c12', //yellow
                                        borderColor: '#f39c12', //yellow
                                    });
                                    @endforeach
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-adminlte-card title="Przejechane trasy" theme="lightblue" theme-mode="outline" collapsible maximizable >   
            @php
            $heads = [
                'Status',
                'Numer rejestracyjny',
                'Dystans',
                'Data rozpoczęcia',
                'Data zakończenia',
                'Opis',
                'Miejsce rozpoczęcia',
                'Miejsce zakończenia',
            ];
            $dataTableConfig = [
                'language' => ['url' => '/vendor/datatables-plugins/i18n/pl.json'],
                'order' => [[0, 'asc']],
                'columns' => [null, null, null, null, null, null, null, ['orderable' => false]],
            ];
            @endphp

            <div class="card">
                <div class="card-body">
                    <x-adminlte-datatable id="table1" :heads="$heads" :config="$dataTableConfig" striped hoverable with-buttons>
                        @foreach ($userJobs as $key=>$userJob)
                            <tr>
                                <td>{{ $userJob->status->name }}</td>
                                <td>{{ isset($userJob->vehicle->license_plate) ? $userJob->vehicle->license_plate : 'Brak pojazdu'}}</td>
                                <td>{{ $userJob->distance }}</td>
                                <td>{{ $userJob->start_time }}</td>
                                <td>{{ $userJob->end_time }}</td>
                                <td>{{ $userJob->description }}</td>
                                <td>{{ $userJob->start_point }}</td>
                                <td>{{ $userJob->end_point }}</td>
                            </tr>
                        @endforeach
                    </x-adminlte-datatable>
                </div>
            </div>
        </x-adminlte-card>
    </div>
</section>

@include('partials.reservation.eventModal')
@stop

@section('css')

@stop

@section('js')
<script>
    $(document).ready(function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            locale: 'pl',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            themeSystem: 'bootstrap',
            selectable: true,
            displayEventTime: true,
            events: reservations, 
            eventClick: function(info) {
                $('#modal_event').modal();
                $('#modal_event_user_name')
                    .attr('href', '/user/' + info.event.extendedProps['user_id'])
                    .text(info.event.extendedProps['user_name'] + ' ' + info.event.extendedProps['user_last_name']);
                $('#modal_event_vehicle')
                    .attr('href', '/vehicles/' + info.event.extendedProps['vehicle_id'])
                    .text(info.event.extendedProps['vehicle_name']);
                $('#modal_event_vehcile_license_plate')
                    .attr('href', '/vehicles/' + info.event.extendedProps['vehicle_id'])
                    .text(info.event.extendedProps['vehcile_license_plate']);

                let date_format_options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric'};
                $('#modal_event_start')
                    .text(info.event.start.toLocaleDateString("pl-PL", date_format_options));
                $('#modal_event_end')
                    .text(info.event.end.toLocaleDateString("pl-PL", date_format_options));
            }
        });
        calendar.render();
    });
</script>
@stop