<x-adminlte-modal id="modal_event" title="Szczegóły wpisu" theme="light" icon="fas fa-bolt">
    <ul class="mt-4 list-group list-group-unbordered">
        <li class="list-group-item">
            <strong>Typ</strong> <span class="float-right">Rezerwacja</span>
        </li>
        <li class="list-group-item">
            <strong>Użytkownik</strong> <a href="" class="float-right" id="modal_event_user_name"></a>
        </li>
        <li class="list-group-item">
            <strong>Pojazd</strong> <a href="" class="float-right" id="modal_event_vehicle"></a>
        </li>
        <li class="list-group-item">
            <strong>Numer rejestracyjny pojazdu</strong> <a href="" class="float-right" id="modal_event_vehcile_license_plate"></a>
        </li>
        <li class="list-group-item">
            <strong>Początek</strong> <span class="float-right" id="modal_event_start"></span>
        </li>
        <li class="list-group-item">
            <strong>Koniec</strong> <span class="float-right" id="modal_event_end"></span>
        </li>
    </ul>
    <x-slot name="footerSlot">
        <x-adminlte-button theme="danger" label="Zamknij" data-dismiss="modal"/>
    </x-slot>
</x-adminlte-modal>