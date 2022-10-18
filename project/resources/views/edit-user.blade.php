@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Edycja użytkownika</h1>
@stop

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Dane użytkownika</h3>
    </div>

    <!-- edit form -->
    @include('partials.user.create_user_form')

</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop