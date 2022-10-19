@extends('adminlte::page')

@section('title', 'Użytkownik - ...')

@section('content_header')

@stop

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
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
                        <p class="text-muted">DODAC</p>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Aktywność</a></li>
                            <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li>
                            <li class="nav-item"><a class="nav-link" href="#edit" data-toggle="tab">Edycja</a></li>
                            <li class="nav-item"><a class="nav-link" href="#reservations" data-toggle="tab">Rezerwacje</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">

                            <!-- activity -->
                            <div class="active tab-pane" id="activity">
                                <div class="post">
                                    <div class="user-block">
                                        <span class="username">
                                            <a href="#">Jonathan Burke Jr.</a>
                                        </span>
                                        <span class="description">Shared publicly - 7:30 PM today</span>
                                    </div>
                                    <p>
                                        Lorem ipsum represents a long-held tradition for designers,
                                        typographers and the like. Some people hate it and argue for
                                        its demise, but others ignore the hate as they create awesome
                                        tools to help create filler text for everyone from bacon lovers
                                        to Charlie Sheen fans.
                                    </p>
                                </div>
                                <div class="post">
                                    <div class="user-block">
                                        <span class="username">
                                            <a href="#">Jonathan Burke Jr.</a>
                                        </span>
                                        <span class="description">Shared publicly - 7:30 PM today</span>
                                    </div>
                                    <p>
                                        Lorem ipsum represents a long-held tradition for designers,
                                        typographers and the like. Some people hate it and argue for
                                        its demise, but others ignore the hate as they create awesome
                                        tools to help create filler text for everyone from bacon lovers
                                        to Charlie Sheen fans.
                                    </p>
                                </div>
                            </div>

                            <!-- timeline -->
                            <div class="tab-pane" id="timeline">
                                <div class="timeline timeline-inverse">
                                    <div class="time-label">
                                        <span class="bg-danger">
                                            10 Feb. 2014
                                        </span>
                                    </div>
                                    <div>
                                        <i class="fas fa-envelope bg-primary"></i>
                                        <div class="timeline-item">
                                            <span class="time"><i class="far fa-clock"></i> 12:05</span>
                                            <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>
                                            <div class="timeline-body">
                                                Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                                weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                                jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                                quora plaxo ideeli hulu weebly balihoo...
                                            </div>
                                            <div class="timeline-footer">
                                                <a href="#" class="btn btn-primary btn-sm">Read more</a>
                                                <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <i class="fas fa-user bg-info"></i>
                                        <div class="timeline-item">
                                            <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>
                                            <h3 class="timeline-header border-0"><a href="#">Sarah Young</a> accepted your friend request
                                            </h3>
                                        </div>
                                    </div>
                                    <div>
                                        <i class="fas fa-comments bg-warning"></i>
                                        <div class="timeline-item">
                                            <span class="time"><i class="far fa-clock"></i> 27 mins ago</span>
                                            <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>
                                            <div class="timeline-body">
                                                Take me to your leader!
                                                Switzerland is small and neutral!
                                                We are more like Germany, ambitious and misunderstood!
                                            </div>
                                            <div class="timeline-footer">
                                                <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="time-label">
                                        <span class="bg-success">
                                            3 Jan. 2014
                                        </span>
                                    </div>
                                    <div>
                                        <i class="fas fa-camera bg-purple"></i>
                                        <div class="timeline-item">
                                            <span class="time"><i class="far fa-clock"></i> 2 days ago</span>
                                            <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>
                                            <div class="timeline-body">
                                                <img src="https://placehold.it/150x100" alt="...">
                                                <img src="https://placehold.it/150x100" alt="...">
                                                <img src="https://placehold.it/150x100" alt="...">
                                                <img src="https://placehold.it/150x100" alt="...">
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <i class="far fa-clock bg-gray"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- edycja -->
                            <div class="tab-pane" id="edit">
                                @include('partials.user.create_user_form')
                            </div>

                            <!-- rezerwacje -->
                            <div class="tab-pane" id="reservations">
                                @if($reservations)
                                <div style="overflow-y: scroll; height: 600px;">
                                    @foreach($reservations as $reservation)
                                    <div class="post">
                                        <div class="user-block">
                                            <span class="username">
                                                <a href="/vehicles/{{$reservation->vehicle_id}}">Nr. rejestracyjny: {{$reservation->vehicle_id}}</a>
                                            </span>
                                            <!-- <span class="description">Shared publicly - 7:30 PM today</span> -->
                                        </div>
                                        <p>Rezerwacja:</p>
                                        <p>od: {{$reservation->start_date}}</p>
                                        <p>do: {{$reservation->end_date}}</p>
                                    </div>
                                    @endforeach
                                </div>
                                @else
                                <p>Brak rezerwacji</p>
                                @endif
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
<link rel="stylesheet" href="/css/admin_custom.css">
@stop