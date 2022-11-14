@section('plugins.Jquery-validation', true)
<x-adminlte-button label="Podejmij pojazd" icon="fas fa-light fa-plus" data-toggle="modal" data-target="#modalPickupVehicle" id="modalPickupVehicleButton"/>
<form action="/rent" method="POST" id="pickup_vehicle_form">
    @csrf
    <x-adminlte-modal id="modalPickupVehicle" title="Podjęcie pojazdu" theme="light" icon="fas fa-bolt">
        <x-adminlte-select-bs name="vehicle_id" label="Wybierz pojazd" 
            data-title="Wybierz pojazd ..." data-live-search
            data-live-search-placeholder="Wybierz pojazd ..." data-show-tick required>
            <x-slot name="prependSlot">
                <div class="input-group-text bg-gradient-info">
                    <i class="fas fa-car-side"></i>
                </div>
            </x-slot>
            @if (isset($availableVehicles))
                @foreach ($availableVehicles as $vehicle)
                <option data-icon="fa fa-fw fa-car" value="{{$vehicle->id }}">{{ $vehicle->name }}</option>
                @endforeach
            @else
                <option data-icon="fa fa-fw fa-car" selected>{{ $vehicle->name }}</option>
            @endif
        </x-adminlte-select-bs>
        @php
        $config = ['format' => 'DD.MM.YYYY HH:mm'];
        @endphp
        <x-adminlte-input-date name="start_time" :config="$config" label="Data rozpoczęcia" required>
            <x-slot name="appendSlot">
                <x-adminlte-button icon="fas fa-calendar-day"
                    title="Data rozpoczęcia"/>
            </x-slot>
        </x-adminlte-input-date>
        <x-adminlte-input name="start_localization" type="text" label="Lokalizacja początkowa" placeholder="Poznań"
            disable-feedback required/>
        <x-adminlte-input name="end_localization" type="text" label="Lokalizacja końcowa" placeholder="Warszawa"
            disable-feedback required/>
        <x-adminlte-input name="start_odometer" type="number" label="Stan licznika" disable-feedback required/>
        <x-slot name="footerSlot">
            <x-adminlte-button label="Podejmij pojazd" type="submit" theme="success" class="mr-auto" icon="fas fa-arrow-alt-circle-right"/>
            <x-adminlte-button theme="danger" label="Zamknij" data-dismiss="modal"/>
        </x-slot>
    </x-adminlte-modal>
</form>
@section('js')
<script>
    $(document).ready(function(){
        //Set datetime of start date when Button Pickup Vehicle clicked
        $("#modalPickupVehicleButton").click(function(){
            $('#start_time').datetimepicker("defaultDate", new Date());
        });
        
        //Validate fields
        $("#pickup_vehicle_form").validate({
            rules: {
                vehicle_id: {
                    required: true,
                },
                start_time: {
                    required: true,
                },
                user_id: {
                    required: true
                },
                start_localization: {
                    required: true,
                },
                end_localization: {
                    required: true,
                },
                start_odometer: {
                    required: true,
                    digits: true
                }
            } 
        });
    })
</script>
@parent
@stop