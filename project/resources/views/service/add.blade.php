@extends('adminlte::page')

@section('title', 'Tworzenie akcji serwisowej')

@section('content_header')
<h1>Tworzenie akcji serwisowej</h1>
@stop

@section('content')

<form action="/service/add" method="POST">
    @csrf
    <x-adminlte-card title="Dane akcji serwisowej" theme="lightblue" theme-mode="outline" collapsible maximizable>
        <div class="row">
            <div class="col-sm-12">
                @include('partials.service.fields')
            </div>
        </div>
    </x-adminlte-card>
</form>
@stop

@section('css')

@stop