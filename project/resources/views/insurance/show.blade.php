@extends('adminlte::page')

@section('title', 'Dodane ubezpieczenie')

@section('content_header')
<h1>Ubezpieczenie</h1>
@stop

@section('content')
<x-adminlte-card title="Dodane ubezpieczenie" theme="lightblue" theme-mode="outline" collapsible maximizable>
    <div class="row">
        <div class="col-sm-6">
            <ul class="mt-4 list-group list-group-unbordered">
                <li class="list-group-item">
                    <strong>Status</strong> <span class="float-right">{{__('status.'.$insurance -> status -> name)}}</span>
                </li>
                <li class="list-group-item">
                    <strong>Numer ubezpieczenia</strong> <span class="float-right">{{$insurance -> policy_number }}</span>
                </li>
                <li class="list-group-item">
                    <strong>Data wygaśnięcia</strong> <a href="#" class="float-right">{{ $insurance -> expiration_date }}</a>
                </li>
                <li class="list-group-item">
                    <strong>Koszt</strong> <a href="#" class="float-right">{{ $insurance -> cost }}</a>
                </li>
                <li class="list-group-item">
                    <strong>Numer kontaktowy</strong> <a href="#" class="float-right">{{$insurance -> phone_number }}</a>
                </li>
                <li class="list-group-item">
                    <strong>Typ</strong> <span class="float-right">{{ $insurance -> type }}</span>
                </li>
                <li class="list-group-item">
                    <strong>Nazwa ubezpieczyciela</strong> <span class="float-right">{{$insurance -> insurer_name }}</span>
                </li>
                <li class="list-group-item">
                    <strong>Opis</strong> <span class="float-right">{{ $insurance -> description }}</span>
                </li>
            </ul>
            <div class="col-sm-6">
                <img src="{{asset($insurance -> photo)}}" class="img-fluid p-4">
            </div>
            <div class="row mt-4">
                @include('partials.insurance.delete')
            </div>
        </div>
    </div>
</x-adminlte-card>
@stop

@section('css')

@stop