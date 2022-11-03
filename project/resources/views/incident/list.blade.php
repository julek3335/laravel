@extends('adminlte::page')

@section('title', 'Usterki')

@section('content_header')
    <h1>Usterki pojazdów</h1>
@stop

@section('content')
    {{-- Setup data for datatables --}}
    @php
    $heads = [
        'ID',
        'Data',
        'Status',
        'Id pojazdu',
        ['label' => 'Akcja', 'width' => 20, 'no-export' => true],
    ];
    $dataTableConfig = [
        'language' => ['url' => '/vendor/datatables-plugins/i18n/pl.json'],
    ];
    
    @endphp

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Lista usterek</h3>
        </div>
        <div class="card-body">
            <x-adminlte-datatable id="table1" :heads="$heads" :config="$dataTableConfig" striped hoverable with-buttons>
                @foreach ($incidents as $key=>$incident)
                    <tr>
                        <td>{{ $incident->id }}</td>
                        <td>{{ $incident->created_at }}</td>
                        <td>{{ $incident->status }}</td>
                        <td>{{ $incident->vehicle_id }}</td>
                        <td>
                            <a href="/incident/edit/{{ $incident->id }}">
                                <button type="button" class="btn btn-primary ml-1 mr-1" data-toggle="tooltip" title="Edytuj">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                        <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z">
                                        </path>
                                    </svg>
                                </button>
                            </a>
                            <button type="button" class="btn btn-outline-danger ml-1 mr-1" data-toggle="modal" data-target="#modal-danger-{{ $key }}" title="Usuń">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path>
                                </svg>
                            </button>
                            <a href="/incident/{{ $incident->id }}">
                                <button type="button" class="btn btn-outline-info ml-1 mr-1" data-toggle="tooltip" title="Szczegóły">
                                    <i class="fa fa-sm fa-fw fa-eye"></i>
                                </button>
                            </a>
                        </td>
                    </tr>
                    <form action="{{ url('/incidents/delete/'. $incident->id ) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('GET')
                        <div class="modal fade" id="modal-danger-{{ $key }}" style="display: none;" aria-modal="true" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content bg-danger">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Potwierdź usunięcie</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Czy na pewno chcesz usunąć incydent: <br> <strong>{{ $incident->id }}</strong></p>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Anuluj</button>
                                        <a href="/incidents/delete/{{$incident->id}}">
                                            <button type="button" class="btn btn-outline-light">Potwierdź</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                @endforeach
            </x-adminlte-datatable>
        </div>
    </div>
@stop

@section('css')

@stop