@extends('adminlte::page')

@section('title', 'Tworzenie nowego użytkownika')

@section('content_header')
<h1>Tworzenie nowego użytkownika</h1>
@stop

@section('content')
@section('plugins.Jquery-validation', true)

<form id="user_form" action="/user/add" method="POST" enctype="multipart/form-data">
    @csrf
    @if($entitlements == 0)
        @include('partials.user.fields')
    @else
        <p>Nie posiadasz uprawnień do tworzenia użytkownika</p>
    @endif
</form>
@stop