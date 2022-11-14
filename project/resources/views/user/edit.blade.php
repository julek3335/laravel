@extends('adminlte::page')

@section('title', 'Edycja użytkownika')

@section('content_header')
<h1>Edycja użytkownika</h1>
@stop

@section('content')
    <form id="user_form" action="{{ url('user/edit/'.$user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('partials.user.fields')
    </form>

@stop