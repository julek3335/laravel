{{-- Setup data for datatables --}}
@php
$headsActiveJobs = [
    'ID',
    'Pojazd',
    'Data rozpoczęcia',
    ['label' => 'Akcja', 'width' => 20, 'no-export' => true],
];
$dataTableActiveJobsConfig = [
    'language' => ['url' => '/vendor/datatables-plugins/i18n/pl.json'],
];
@endphp

<x-adminlte-datatable id="tableActiveJobs" :heads="$headsActiveJobs" :config="$dataTableActiveJobsConfig" striped hoverable with-buttons>
    @foreach ($userJobs as $key=>$job)
        <tr>
            <td>{{ $job->id }}</td>
            <td>
                <a href="/vehicles/{{ $job->vehicle_id }}">  
                    {{ $job->vehicle->license_plate }}</td>
                </a>
            <td>{{ $job->start_time }}</td>
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
