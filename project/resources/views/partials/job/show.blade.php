<ul class="mt-4 list-group list-group-unbordered">
    <li class="list-group-item">
        <strong>Data rozpoczecia</strong> <span class="float-right">{{ $job->start_time }}</span>
    </li>
    <li class="list-group-item">
        <strong>Data zakończenia</strong> <span class="float-right">{{ $job->end_time or '' }}</span>
    </li>
    <li class="list-group-item">
        <strong>Status</strong> <span class="float-right">{{ $job->status->name }}</span>
    </li>
    <li class="list-group-item">
        <strong>Pojazd</strong> <a href="/vehicles/{{ $job->vehicle_id }}" class="float-right">{{ $job->vehicle_id }}</a>
    </li>
    <li class="list-group-item">
        <strong>Użytkownik</strong> <a href="/user/{{ $job->user_id }}" class="float-right">{{ $job->user_id }}</a>
    </li>
    <li class="list-group-item">
        <strong>Dystans</strong> <span class="float-right">{{ $job->distance or '' }}</span>
    </li>
    <li class="list-group-item">
        <strong>Opis</strong> <span class="float-right">{{ $job->description or '' }}</span>
    </li>
    <li class="list-group-item">
        <strong>Lokalizacja początkowa</strong> <span class="float-right">{{ $job->start_point }}</span>
    </li>
    <li class="list-group-item">
        <strong>Lokalizacja końcowa</strong> <span class="float-right">{{ $job->end_point or '' }}</span>
    </li>
    <li class="list-group-item">
        <strong>Początkowy stan licznika</strong> <span class="float-right">{{ $job->start_odometer }}</span>
    </li>
    <li class="list-group-item">
        <strong>Końcowy stan licznika</strong> <span class="float-right">{{ $job->end_odometer or '' }}</span>
    </li>
</ul>