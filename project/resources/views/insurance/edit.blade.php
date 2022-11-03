@extends('adminlte::page')

@section('title', 'Edycja ubezpieczenia')

@section('content_header')
<h1>Edycja ubezpieczenia o id  {{ $insurance->id }}</h1>
@stop

@section('content')
<form action="{{ url('insurance/edit/'. $insurance->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('partials.insurance.edit')
</form>
@stop