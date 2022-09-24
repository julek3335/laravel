@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Pojazdy</h1>
@stop

@section('content')
    {{-- Setup data for datatables --}}
    @php
    $heads = [
        'ID',
        'Typ',
        'Nazwa',
        ['label' => 'Akcja', 'width' => 5],
    ];

    $btnEdit = '<button type="button" class="btn btn-primary ml-1 mr-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                        <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"></path>
                    </svg>
                    Edytuj
                </button>';
    $btnDelete = '<button type="button" class="btn btn-outline-danger ml-1 mr-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path>
                        </svg>
                        Usuń
                    </button>';
    $btnDetail = '<a href="/example-car">
                    <button type="button" class="btn btn-outline-info ml-1 mr-1">
                        <i class="fa fa-sm fa-fw fa-eye"></i>
                        Szczegóły
                    </button>
                </a>';
    
    $config = [
        'data' => [
            [1, 'Samochód dostawczy', 'Zielony Ford Transit', '<nobr>'.$btnEdit.$btnDelete.$btnDetail.'</nobr>'],
            [2, 'Samochód osobowy', 'Srebrny Opel Astra', '<nobr>'.$btnEdit.$btnDelete.$btnDetail.'</nobr>'],
            [3, 'Samochód ciężarowy', 'Duże Iveco', '<nobr>'.$btnEdit.$btnDelete.$btnDetail.'</nobr>'],
        ],
        'order' => [[1, 'asc']],
        'columns' => [null, null, null, ['orderable' => false]],
    ];
    @endphp

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Lista pojazdów</h3>
        </div>
        <div class="card-body">
            {{-- Minimal example / fill data using the component slot --}}
            <x-adminlte-datatable id="table1" :heads="$heads" striped hoverable>
                @foreach($config['data'] as $row)
                    <tr>
                        @foreach($row as $cell)
                            <td>{!! $cell !!}</td>
                        @endforeach
                    </tr>
                @endforeach
            </x-adminlte-datatable>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop