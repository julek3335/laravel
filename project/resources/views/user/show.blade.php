@extends('adminlte::page')

@section('title', 'Użytkownik')

@section('content_header')

@stop

@section('content')
@section('plugins.Fullcalendar', true)

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        @if (isset($user->photo))
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="{{$user->photo}}" alt="Zdjęcie profilowe - {{$user->name}} {{$user->last_name}}">
                        </div>
                        @endif
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
                            {{$user->driving_licence_category}}
                        </p>
                        <hr>
                        <strong><i class="far fa-envelope-open"></i> Email</strong>
                        <p class="text-muted">{{$user->email}}</p>
                        <hr>
                        <strong><i class="far fa-bell"></i> Status</strong>
                        <p class="text-muted">{{__('status.'.$user->status->name)}}</p>
                        <p>
                        <div>
                            @include('partials.user.deleteUser')
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link" href="#edit" data-toggle="tab">Edycja</a></li>
                            <li class="nav-item"><a class="nav-link active" href="#reservations" data-toggle="tab">Rezerwacje</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">

                            <!-- edycja -->
                            <div class="tab-pane" id="edit">
                                @include('partials.user.create_user_form')
                            </div>

                            <!-- rezerwacje -->
                            <div class="tab-pane active" id="reservations">
                                <div id="calendar"></div>
                                <script>
                                    var reservations = []
                                    @foreach($reservations as $reservation)
                                    reservations.push({
                                        title: 'Rezerwacja: {{$reservation->user_name}} {{$reservation->user_last_name}}, Pojazd: {{$reservation->vehicle_name}}',
                                        start: "{{$reservation->start_date}}",
                                        end: "{{$reservation->end_date}}",
                                        backgroundColor: '#f39c12', //yellow
                                        borderColor: '#f39c12' //yellow
                                    });
                                    @endforeach
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
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
            events: reservations
        });
        calendar.render();
    });
</script>
@stop