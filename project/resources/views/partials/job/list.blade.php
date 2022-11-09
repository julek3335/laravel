<ul class="mt-4 list-group list-group-unbordered">
    @forelse($services_vehicles as $service_vehicle)
        <li class="list-group-item">
            <span><a href="/jobs/{{ $job->id }}">{{ $service_vehicle->name }}</a></span>
        </li>
    @empty
        <span>Brak przypisanych pojazdów</span>
    @endforelse
</ul>