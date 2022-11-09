@extends('adminlte::page')

@section('title', 'Tworzenie nowego użytkownika')

@section('content_header')
<h1>Tworzenie nowego użytkownika</h1>
@stop

@section('content')
@section('plugins.Jquery-validation', true)

<form id="createUserForm" action="/user/add" method="POST" enctype="multipart/form-data">
    @csrf
    <x-adminlte-card title="Dane użytkownika" theme="lightblue" theme-mode="outline" collapsible maximizable>
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputName1">Imię</label>
                <input type="text" class="form-control" id="exampleInputName1" placeholder="Imię" name="name" required>
            </div>
            <div class="form-group">
                <label for="exampleInputSurname1">Nazwisko</label>
                <input type="text" class="form-control" id="exampleInputSurname1" placeholder="Nazwisko" name="last_name" required>
            </div>
            <div class="form-group">
                <label for="exampleInputInputEmail">Email</label>
                <input type="email" class="form-control" id="exampleInputEmail" placeholder="Email" name="email" required>
            </div>
            <x-adminlte-select-bs name="status" label="Status" data-title="Wybierz status ..." data-live-search data-live-search-placeholder="Wybierz status ..." data-show-tick required>
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-info">
                        <i class="fas fa-user-check"></i>
                    </div>
                </x-slot>
                @foreach(App\Enums\UserStatusEnum::cases() as $status_option)
                <option value="{{ $status_option->value }}">{{ $status_option->name }}</option>
                @endforeach>
            </x-adminlte-select-bs>
            <div class="form-group">
                <label for="exampleInputDrivingLicence">Prawo jazdy</label>
                <input type="text" class="form-control" id="exampleInputDrivingLicence" placeholder="Prawo jazdy" name="driving_licence_category" required>
            </div>
            <x-adminlte-input-file name="photo" label="Zdjęcie profilowe" legend="Wybierz" placeholder="Wybierz lub upuść zdjęcie" required>
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-lightblue">
                        <i class="fas fa-upload"></i>
                    </div>
                </x-slot>
            </x-adminlte-input-file>
            <div class="form-group">
                <label for="exampleInputPassword">Hasło</label>
                <input type="text" class="form-control" id="exampleInputPassword" placeholder="Hasło" name="password" required>
            </div>
            <div class="form-group">
                <label for="#">Uprawienia</label>
                <div class="form-group">
                    <select class="form-control" id="#" name="auth_level">
                        <option value="0">Administrator</option>
                        <option value="1">Edytor</option>
                        <option value="2">Użytkownik</option>
                    </select>
                </div>
            </div>
        </div>
        <x-adminlte-button label="Zapisz" type="submit" theme="success" class="float-right" icon="fas fa-save" />
    </x-adminlte-card>
</form>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    $("#createUserForm").validate({
        rules: {
            name: {
                required: true,
                minlength: 4,
                maxlength: 10
            },
            last_name: {
                required: true,
                minlength: 4,
                maxlength: 10
            },
            email: {
                required: true,
                email: true
            },
            status: "required",
            driving_licence_category: "required",
            password: {
                required: true,
                minlength: 8,
            },
            photo: "required",
        },
        highlight: function(element) {
            $(element).parent().css('color', 'red')
        },
    });
</script>
@stop