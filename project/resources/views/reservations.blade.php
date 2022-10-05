@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<!-- <h1>Dodaj rezerwację</h1> -->
@stop

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Aktualne rezerwacje</h3>
    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Dodaj nową rezerwację</button>
    </div>

    <div style="overflow: auto; height: 500px;">

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Jan Kowalski (linkowanie do profilu kierowcy)</h3>
                                <div class="card-tools">
                                    <!-- <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button> -->
                                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                Od: 1.10.2022
                            </div>
                            <div class="card-body">
                                Do: 1.12.2022
                            </div>
                            <div class="card-footer">
                                Nr rejestracyjny pojazdu (linkowanie do profilu pojazdu)
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Title</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                Start creating your amazing application!
                            </div>

                            <div class="card-footer">
                                Footer
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Title</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                Start creating your amazing application!
                            </div>

                            <div class="card-footer">
                                Footer
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Title</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                Start creating your amazing application!
                            </div>

                            <div class="card-footer">
                                Footer
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </section>

    </div>




</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop