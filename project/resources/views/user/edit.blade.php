@extends('adminlte::page')

@section('title', 'Edycja użytkownika')

@section('content_header')
<h1>Edycja użytkownika</h1>
@stop

@section('content')
    <!-- edit form -->
    @include('partials.user.create_user_form')

@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop