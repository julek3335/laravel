@extends('adminlte::page')

@section('title', 'Edycja akcji serwisowej')

@section('content_header')
<h1>Edycja akcji serwisowej - {{$service->name}}</h1>
@stop

@section('content')
@php
    $config_next_time_filed = ['format' => 'YYYY-MM-DD'];
@endphp

<form action="/service/edit/{{$service->id}}" method="POST">
    @csrf
    @method('PUT')
    <x-adminlte-card title="Dane akcji serwisowej" theme="lightblue" theme-mode="outline" collapsible maximizable>
        <div class="row">
            <div class="col-sm-6">
                @include('partials.service.fields')
            </div>
        </div>
    </x-adminlte-card>
</form>
@stop

@section('css')

@stop