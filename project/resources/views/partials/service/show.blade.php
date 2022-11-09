<div class="row">
    <div class="col-sm-5 mb-4">
        <h3>Konfiguracja akcji</h3>
        <ul class="mt-4 list-group list-group-unbordered">
            <li class="list-group-item">
                <strong>Nazwa</strong> <span class="float-right">{{ $service->name }}</span>
            </li>
            <li class="list-group-item">
                <strong>Opis</strong> <span class="float-right">{{ $service->description }}</span>
            </li>
            <li class="list-group-item">
                <strong>Następne wykonanie</strong> <span class="float-right">{{ $service->next_time }}</span>
            </li>
            <li class="list-group-item">
                <strong>Ostatnie wykonanie</strong> <span class="float-right">{{ $service->last_time }}</span>
            </li>
            <li class="list-group-item">
                <strong>Interwał (dni)</strong> <span class="float-right">{{ $service->interval }}</span>
            </li>
            <li class="list-group-item">
                <strong>Data utworzenia</strong> <span class="float-right">{{ $service->created_at }}</span>
            </li>
            <li class="list-group-item">
                <strong>Data aktualizacji</strong> <span class="float-right">{{ $service->updated_at }}</span>
            </li>
        </ul>
    </div>
    <div class="col-sm-6 offset-sm-1">
        <h3>Przypisane pojazdy do akcji</h3>
        <ul class="mt-4 list-group list-group-unbordered">
        @forelse($services_vehicles as $service_vehicle)
            <li class="list-group-item">
                <span><a href="/vehicle/{{ $service_vehicle->id }}">{{ $service_vehicle->name }}</a></span>
            </li>
        @empty
            <span>Brak przypisanych pojazdów</span>
        @endforelse
        </ul>
    </div>
</div>
