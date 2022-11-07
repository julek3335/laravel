@extends('adminlte::page')

@section('title', 'Trasa') 

@section('content_header')
    <h1>Trasa</h1>
@stop

@section('content')
    <x-adminlte-card title="Trasa" theme="lightblue" theme-mode="outline" collapsible maximizable>
        <div class="row">
            <div class="col-sm-12">
                @include('partials.job.end')
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                @include('partials.job.show')
            </div>
        </div>
    </x-adminlte-card>
@stop