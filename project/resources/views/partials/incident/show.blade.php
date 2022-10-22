<ul class="mt-4 list-group list-group-unbordered">
    <li class="list-group-item">
        <strong>Data dodania</strong> <span class="float-right">{{ $incident->created_at }}</span>
    </li>
    <li class="list-group-item">
        <strong>Data aktualizacji</strong> <span class="float-right">{{ $incident->updated_at }}</span>
    </li>
    <li class="list-group-item">
        <strong>Data usterki</strong> <span class="float-right">{{ $incident->date }}</span>
    </li>
    <li class="list-group-item">
        <strong>Adres</strong> <span class="float-right">{{ $incident->address }}</span>
    </li>
    <li class="list-group-item">
        <strong>Status</strong> <span class="float-right">{{ $incident->status }}</span>
    </li>
    <li class="list-group-item">
        <strong>Pojazd</strong> <a href="/vehicles/{{ $vehicle->id }}" class="float-right">{{ $vehicle->name }}</a>
    </li>
    <li class="list-group-item">
        <strong>Opis</strong> <span class="float-right">{{ $incident->description }}</span>
    </li>
</ul>