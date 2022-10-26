@php
    $config_next_time_filed = ['format' => 'YYYY-MM-DD'];
@endphp
<x-adminlte-input name="name" type="text" label="Nazwa" placeholder="Nazwa" value="{{ isset($service->name) ? $service->name : '' }}" disable-feedback required/>
<x-adminlte-textarea name="description" type="textarea" label="Opis" placeholder="Opis" disable-feedback>
    {{ isset($service->description) ? $service->description : '' }}
</x-adminlte-textarea>
<x-adminlte-input-date name="next_time" :config="$config_next_time_filed" label="Data nastepnego wykonania" value="{{ isset($service->next_time) ? $service->next_time : '' }}" required>
    <x-slot name="appendSlot">
        <x-adminlte-button icon="fas fa-calendar-day"
            title="Data następnego wykonania"/>
    </x-slot>
</x-adminlte-input-date>
<x-adminlte-input name="interval" type="number" label="Interwał (dni)" placeholder="30" value="{{ isset($service->interval) ? $service->interval : '' }}" disable-feedback required/>
<x-adminlte-select-bs name="vehicles[]" label="Wybierz pojazdy" 
    data-title="Wybierz pojazdy ..." multiple required>
    <x-slot name="prependSlot">
        <div class="input-group-text bg-gradient-info">
            <i class="fas fa-car-side"></i>
        </div>
    </x-slot>
    <x-slot name="appendSlot">
        <x-adminlte-button theme="outline-dark" label="Wyczyść" icon="fas fa-lg fa-ban text-danger"/>
    </x-slot>
    @foreach ($availableVehicles as $vehicle)
    <option data-icon="fa fa-fw fa-car" value="{{$vehicle->id }}" 
        @isset($selectedVehicles) 
            @if($selectedVehicles->where('vehicle_id', $vehicle->id)->first())
                selected
            @endif
        @endisset
        >{{ $vehicle->name }}</option>
    @endforeach
</x-adminlte-select-bs>
<x-adminlte-button label="Zapisz" type="submit" theme="success" class="float-right" icon="fas fa-save" />