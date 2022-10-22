@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<!-- <h1>Dodaj rezerwację</h1> -->
@stop

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Aktualne rezerwacje</h3>
    </div>

    <div class="card-footer">
        <div class="col-6 col-sm-4 col-md-3 col-xl-2">
            @include('partials.vehicle.reservation')
        </div>
    </div>

    <div style="overflow: auto; height: 700px;">

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        @if($reservations)
                        @foreach($reservations as $reservation)
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{$reservation->vehicle_id}} (linkowanie do profilu kierowcy)</h3>
                            </div>
                            <div class="card-body">
                                Od: {{$reservation->start_date}}
                            </div>
                            <div class="card-body">
                                Do: {{$reservation->end_date}}
                            </div>
                            <div class="card-footer">
                                Nr rejestracyjny pojazdu: {{$reservation->id}}
                            </div>
                        </div>
                        @endforeach
                        @else
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Brak rezerwacji</h3>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>

</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop