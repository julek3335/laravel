<x-adminlte-button label="Podejmij pojazd" icon="fas fa-light fa-plus" data-toggle="modal" data-target="#modalPickupVehicle" id="modalPickupVehicleButton"/>
<x-adminlte-modal id="modalPickupVehicle" title="Podjęcie pojazdu" theme="light"
    icon="fas fa-bolt">
    <x-adminlte-select-bs name="carsList" label="Wybierz pojazd" 
        data-title="Wybierz pojazd ..." data-live-search
        data-live-search-placeholder="Wybierz pojazd ..." data-show-tick>
        <x-slot name="prependSlot">
            <div class="input-group-text bg-gradient-info">
                <i class="fas fa-car-side"></i>
            </div>
        </x-slot>
        @if (isset($availableVehicles))
            @foreach ($availableVehicles as $vehicle)
            <option data-icon="fa fa-fw fa-car">{{ $vehicle->name }}</option>
            @endforeach
        @else
            <option data-icon="fa fa-fw fa-car" selected>{{ $vehicle->name }}</option>
        @endif
    </x-adminlte-select-bs>
    @php
    $config = ['format' => 'DD.MM.YYYY HH:mm'];
    @endphp
    <x-adminlte-input-date name="startDate" :config="$config" label="Data rozpoczęcia">
        <x-slot name="appendSlot">
            <x-adminlte-button icon="fas fa-calendar-day"
                title="Data rozpoczęcia"/>
        </x-slot>
    </x-adminlte-input-date>
    <x-adminlte-input name="startLocalization" type="text" label="Lokalizacja początkowa" placeholder="Poznań"
        disable-feedback/>
    <x-adminlte-input name="endLocalization" type="text" label="Lokalizacja końcowa" placeholder="Warszawa"
        disable-feedback/>
    <x-adminlte-input name="" type="number" label="Stan licznika" disable-feedback/>
    <x-adminlte-button label="Podejmij pojazd" theme="success" class="float-right" icon="fas fa-arrow-alt-circle-right"/>
</x-adminlte-modal>
@section('js')
    <script>
        //Set datetime of start date when Button Pickup Vehicle clicked
        $("#modalPickupVehicleButton").click(function(){
            $('#startDate').datetimepicker("defaultDate", new Date());
        });
    </script>
@stop