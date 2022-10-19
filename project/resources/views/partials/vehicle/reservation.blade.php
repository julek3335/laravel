<x-adminlte-button label="Zarezerwuj pojazd" icon="fas fa-light fa-plus" data-toggle="modal" data-target="#modalReservationVehicle" id="modalReservationVehicleButton"/>

<form action="/reservation" method="POST">
    @csrf
    <x-adminlte-modal id="modalReservationVehicle" title="Rezerwacja pojazdu" theme="light" icon="fas fa-bolt">
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
                <option value="{{ $vehicle->id }}" data-icon="fa fa-fw fa-car">{{ $vehicle->name }}</option>
                @endforeach
            @else
                <option value="{{ $vehicle->id }}" data-icon="fa fa-fw fa-car" selected>{{ $vehicle->name }}</option>
            @endif
        </x-adminlte-select-bs>
        @php
        $config = ['format' => 'YYYY.MM.DD'];
        @endphp
        
        <x-adminlte-input-date name="start_date" :config="$config" label="Data rozpoczęcia">
            <x-slot name="start_date">
                <x-adminlte-button icon="fas fa-calendar-day" title="Data rozpoczęcia"/>
            </x-slot>
        </x-adminlte-input-date>
        
        <x-adminlte-input-date name="end_date" :config="$config" label="Data zakończenia">
            <x-slot name="end_date">
                <x-adminlte-button icon="fas fa-calendar-day" title="Data zakończenia"/>
            </x-slot>
        </x-adminlte-input-date>
        
        <x-slot name="footerSlot">
            <x-adminlte-button type="submit" label="Zarezerwuj pojazd" theme="success" class="mr-auto" icon="fas fa-arrow-alt-circle-right"/>
            <x-adminlte-button theme="danger" label="Zamknij" data-dismiss="modal"/>
        </x-slot>
    </x-adminlte-modal>
</form>
@section('js')
    <script>
        //Set datetime of start date when Button Pickup Vehicle clicked
        $("#modalPickupVehicleButton").click(function(){
            $('#startDate').datetimepicker("defaultDate", new Date());
        });
    </script>
@stop