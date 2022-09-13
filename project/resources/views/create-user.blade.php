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


    <form>
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Adres Email</label>
                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="wpisz adres email">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Hasło</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Hasło">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Imię</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Imię">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Nazwisko</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Nazwisko">
            </div>


            <!-- <div class="form-group">
                <label for="exampleInputFile">Imię</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                    <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                    </div>
                </div>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div> -->
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