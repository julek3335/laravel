@extends('adminlte::page')

@section('title', 'Edycja ubezpieczenia')

@section('content_header')
<h1>Edycja ubezpieczenia o id  {{ $insurance->id }}</h1>
@stop

@section('content')
    @include('partials.insurance.edit')
@stop