@extends('adminlte::page')

@section('title', 'Akcja serwisowa') 

@section('content_header')
    <h1>Akcja serwisowa {{ $service->name }}</h1>
@stop

@section('content')
    <x-adminlte-card title="Szczegóły akcji serwisowej" theme="lightblue" theme-mode="outline" collapsible maximizable>
        @include('partials.service.show')
            @if($entitlements == 0 || $entitlements == 1)
                <a href="/service/edit/{{ $service->id }}">
                    <x-adminlte-button label="Edytuj" icon="fas fa-light fa-edit"/>
                </a>
            @endif
        @include('partials.service.delete')
    </x-adminlte-card>
@stop