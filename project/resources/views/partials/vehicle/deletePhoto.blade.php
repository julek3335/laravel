<form action="/vehicle/{{$vehicle->id}}/delete/photo/" method="POST" id="form_delete_photo">
    @csrf
    <x-adminlte-modal id="modalDeleteVehiclePhoto" title="Usuwanie zdjęcia pojazdu" theme="light" icon="fas fa-bolt">
        <h5>Uwaga!</h5>
        <p>Usuwasz zdjęcie pojazdu. Ta czynność wymaga przeładowania strony. Jeżeli edytowałeś dane pojazdu upewnij się, że zapisałeś swoje zmiany.</p>
        <img src="" id="photo_to_delete" alt="" class="img-fluid"/>
        <x-slot name="footerSlot">
            <x-adminlte-button label="Usuń zdjęcie" type="submit" theme="danger" class="mr-auto" icon="fas fa-trash"/>
            <x-adminlte-button theme="info" label="Zamknij" data-dismiss="modal"/>
        </x-slot>
    </x-adminlte-modal>
</form>