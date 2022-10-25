<x-adminlte-button label="Dodaj nowe ubezpieczenie" icon="fas fa-light fa-plus" data-toggle="modal" data-target="#modalInsuranceVehicle" id="modalInsuranceVehicleButton" />

<x-adminlte-modal id="modalInsuranceVehicle" title="Dodaj nowe ubezpieczenie" theme="light" icon="fas fa-bolt">
  <form action="{{ url('insurance/create-new/'.$vehicle->id) }}" method="POST">
    @csrf
    <x-adminlte-input name="policy_number" type="text" label="Numer ubezpieczenia" placeholder="Numer ubezpieczenia" value="" disable-feedback required/>
    <x-adminlte-input name="expiration_date" type="text" label="Data wygaśnięcia" placeholder="Data wygaśnięcia" value="" disable-feedback required/>
    <x-adminlte-input name="cost" type="number" label="Koszt" placeholder="Koszt" value="" disable-feedback />
    <x-adminlte-input name="phone_number" type="number" label="Numer kontaktowy" placeholder="Numer kontaktowy" value="" disable-feedback required/>
    <x-adminlte-input name="vehicle_id" type="number" label="id pojazdu" placeholder="id pojazdu" value="{{$vehicle->id}}" disable-feedback disabled />
    <x-adminlte-input name="insurer_name" type="text" label="Ubezpieczyciel" placeholder="Ubezpieczyciel" value="" disable-feedback />
    <x-adminlte-input name="description" type="text" label="Opis" placeholder="Opis" value="" disable-feedback required/>
    <x-adminlte-input-file name="photo" label="Zdjęcie" legend="Wybierz" placeholder="Wybierz lub upuść zdjęcie" required>
      <x-slot name="prependSlot">
        <div class="input-group-text bg-lightblue">
          <i class="fas fa-upload"></i>
        </div>
      </x-slot>
    </x-adminlte-input-file>
    <x-adminlte-select-bs name="type" label="Typ" data-title="Wybierz typ ..." data-live-search data-live-search-placeholder="Wybierz typ ..." data-show-tick required>
      <x-slot name="prependSlot">
        <div class="input-group-text bg-gradient-info">
          <i class="fas fa-car-side"></i>
        </div>
      </x-slot>
      <option data-icon="fa fa-fw fa-car">AC</option>
      <option data-icon="fa fa-fw fa-truck" selected>OC</option>
      <option data-icon="fa fa-fw fa-truck-moving">AC+OC</option>
      <option data-icon="fa fa-fw fa-motorcycle">Assistance</option>
    </x-adminlte-select-bs>
    <x-adminlte-button label="Zapisz" theme="success" type="submit" class="float-right" icon="fas fa-save" />
  </form>

</x-adminlte-modal>