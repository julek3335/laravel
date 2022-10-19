@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Tworzenie nowego użytkownika</h1>
@stop

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Dane użytkownika</h3>
    </div>


    <form action="/users" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputName1">Imię</label>
                <input type="text" class="form-control" id="exampleInputName1" placeholder="imię" name="name">
            </div>
            <div class="form-group">
                <label for="exampleInputSurname1">Nazwisko</label>
                <input type="text" class="form-control" id="exampleInputSurname1" placeholder="nazwisko" name="last_name">
            </div>
            <div class="form-group">
                <label for="exampleInputInputEmail">email</label>
                <input type="email" class="form-control" id="exampleInputEmail" placeholder="email" name="email">
            </div>
            <div class="form-group">
                <label for="exampleInputDrivingLicence">Prawo jazdy</label>
                <input type="text" class="form-control" id="exampleInputDrivingLicence" placeholder="Prawo jazdy" name="driving_licence_category">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword">Hasło</label>
                <input type="text" class="form-control" id="exampleInputPassword" placeholder="Hasło" name="password">
            </div>
            <div class="form-group">
                <label for="#">Uprawienia</label>
                <div class="form-group">
                    <select class="form-control" id="#" name="auth_level">
                        <option value="0" >Administrator</option>
                        <option value="1" >Edytor</option>
                        <option value="2" >Użytkownik</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Zatwierdź</button>
        </div>
    </form>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop