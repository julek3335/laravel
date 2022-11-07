@extends('adminlte::page')

@section('title', 'Usterki')

@section('content_header')
    <h1>Trasy</h1>
@stop

@section('content')
    {{-- Setup data for datatables --}}
    @php
    $heads = [
        'ID',
        'Użytkownik',
        'Pojazd',
        'Status',
        'Data rozpoczęcia',
        'Data zakończenia',
        ['label' => 'Akcja', 'width' => 20, 'no-export' => true],
    ];
    $dataTableConfig = [
        'language' => ['url' => '/vendor/datatables-plugins/i18n/pl.json'],
    ];
    
    @endphp

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Lista tras</h3>
        </div>
        <div class="card-body">
            <x-adminlte-datatable id="table1" :heads="$heads" :config="$dataTableConfig" striped hoverable with-buttons>
                @foreach ($jobs as $key=>$job)
                    <tr>
                        <td>{{ $job->id }}</td>
                        <td>{{ $job->user_id }}</td>
                        <td>{{ $job->vehicle_id }}</td>
                        <td>{{ $job->status->name }}</td>
                        <td>{{ $job->start_time }}</td>
                        <td>{{ $job->end_time }}</td>
                        <td>
                            <a href="/jobs/{{ $job->id }}">
                                <button type="button" class="btn btn-outline-info ml-1 mr-1" data-toggle="tooltip" title="Szczegóły">
                                    <i class="fa fa-sm fa-fw fa-eye"></i>
                                </button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </x-adminlte-datatable>
        </div>
    </div>
@stop