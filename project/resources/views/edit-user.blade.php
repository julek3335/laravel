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


    <form action="{{ url('edit-user/'.$id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputName1">Imię</label>
                <input type="text" class="form-control" id="exampleInputName1" placeholder="imię" name="name" value={{$name}}>
            </div>
            <div class="form-group">
                <label for="exampleInputSurname1">Nazwisko</label>
                <input type="text" class="form-control" id="exampleInputSurname1" placeholder="nazwisko" name="last_name" value={{$last_name}}>
            </div>
            <div class="form-group">
                <label for="exampleStatus">Status</label>
                <input type="text" class="form-control" id="exampleStatus" placeholder="status" name="status" value={{$status}}>
            </div>
            <div class="form-group">
                <label for="exampleInputInputEmail">email</label>
                <input type="email" class="form-control" id="exampleInputEmail" placeholder="email" name="email" value={{$email}}>
            </div>
            <div class="form-group">
                <label for="exampleInputDrivingLicence">Prawo jazdy</label>
                <input type="text" class="form-control" id="exampleInputDrivingLicence" placeholder="Prawo jazdy" name="driving_licence_category" value={{$driving_licence_category}}>
            </div>
            <div class="form-group">
                <label for="#">Uprawienia</label>
                <div class="form-group">
                    <select class="form-control" id="#">
                        <option>Administrator</option>
                        <option>Użytkownik</option>
                        <option>Value 3</option>
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