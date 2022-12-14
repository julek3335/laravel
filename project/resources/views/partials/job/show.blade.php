<ul class="mt-4 list-group list-group-unbordered">
    <li class="list-group-item">
        <strong>Data rozpoczecia</strong> <span class="float-right">{{ $job->start_time }}</span>
    </li>
    <li class="list-group-item">
        <strong>Data zakończenia</strong> <span class="float-right">{{ $job->end_time }}</span>
    </li>
    <li class="list-group-item">
        <strong>Status</strong> <span class="float-right">{{ __('status.'.$job->status->name) }}</span>
    </li>
    <li class="list-group-item">
        <strong>Pojazd</strong> <a href="/vehicles/{{ $job->vehicle_id }}" class="float-right">{{ $job->vehicle->license_plate }}</a>
    </li>
    <li class="list-group-item">
        <strong>Użytkownik</strong> <a href="/user/{{ $job->user_id }}" class="float-right">{{ $job->user->name }} {{ $job->user->last_name }}</a>
    </li>
    <li class="list-group-item">
        <strong>Dystans</strong> <span class="float-right">{{ $job->distance }}</span>
    </li>
    <li class="list-group-item">
        <strong>Opis</strong> <span class="float-right">{{ $job->description }}</span>
    </li>
    <li class="list-group-item">
        <strong>Lokalizacja początkowa</strong> <span class="float-right">{{ $job->start_point }}</span>
    </li>
    <li class="list-group-item">
        <strong>Lokalizacja końcowa</strong> <span class="float-right">{{ $job->end_point }}</span>
    </li>
    <li class="list-group-item">
        <strong>Początkowy stan licznika</strong> <span class="float-right">{{ $job->start_odometer }}</span>
    </li>
    <li class="list-group-item">
        <strong>Końcowy stan licznika</strong> <span class="float-right">{{ $job->end_odometer }}</span>
    </li>
</ul>