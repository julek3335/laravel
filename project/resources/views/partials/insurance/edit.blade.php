<form id="eeer" action="{{ url('insurance/edit/'. $insurance->id) }}" method="POST" enctype="multipart/form-data">
@section('plugins.Jquery-validation', true)

    <x-adminlte-card title="Dane pojazdu" theme="lightblue" theme-mode="outline" collapsible maximizable>
        <div class="row">
            <div class="col-sm-12">
                @csrf
                <x-adminlte-input name="policy_number" type="text" label="Number polisy" placeholder="Number polisy" value="{{ $insurance->policy_number }}" disable-feedback />
                <x-adminlte-input name="expiration_date" type="text" label="Data ważności" placeholder="Data ważności" value="{{ $insurance->expiration_date }}" disable-feedback />
                <x-adminlte-input name="insurer_name" type="text" label="Ubezpieczyciel" placeholder="Ubezpieczyciel" value="{{ $insurance->insurer_name }}" disable-feedback />
                <x-adminlte-input name="cost" type="number" label="Koszt" placeholder="Koszt" value="{{ $insurance->cost }}" disable-feedback />
                <x-adminlte-input name="phone_number" type="number" label="Numer kontaktowy" placeholder="Numer kontaktowy" value="{{ $insurance->phone_number }}" disable-feedback />
                <x-adminlte-textarea name="description" type="text" label="Opis" placeholder="Opis" value="{{ $insurance->description	}}" disable-feedback />
                <x-adminlte-select-bs name="type" label="Typ" data-title="Wybierz typ ..." data-live-search data-live-search-placeholder="Wybierz typ ..." data-show-tick>
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-gradient-info">
                            <i class="fas fa-car-side"></i>
                        </div>
                    </x-slot>
                    <optio>OC</option>
                    <option selected>AC</option>
                    <option>Assistance</option>
                    <option>nnw</option>
                </x-adminlte-select-bs>
                <x-adminlte-input-file name="photos[]" label="Zdjęcia" legend="Wybierz" placeholder="Wybierz lub upuść zdjęcia" multiple>
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-lightblue">
                            <i class="fas fa-upload"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input-file>
                <x-adminlte-select-bs name="selBsVehicle" label="Numer rejestracyjny pojazdu" data-title="Numer rejestracyjny ..." data-live-search data-live-search-placeholder="Wybierz typ ..." data-show-tick>
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-gradient-info">
                            <i class="fas fa-car-side"></i>
                        </div>
                    </x-slot>
                    <option selected>{{$currentVehicle->license_plate}}</option>
                    @foreach($vehicles as $vehicle)
                    <option>{{$vehicle->license_plate}}</option>
                    @endforeach
                </x-adminlte-select-bs>
                <x-adminlte-button label="Zapisz" type="submit" theme="success" class="float-right" icon="fas fa-save" />
            </div>
        </div>
    </x-adminlte-card>
</form>

@section('js')
<script>
    $("#eeer").validate({
        rules: {
            policy_number: {
                required: true,
                decimal: true,
            },
            expiration_date: {
                required: true,
            },
            cost: {
                required: true,
                number: true
            },
            phone_number: {
                required: true,
                decimal: true,
                maxlength: 9,
                minlength: 9
            },
            insurer_name: {
                require: true
            },
            description: {
                required: true,
            },
            selBsVehicle: {
                required: true,
            },
            photo: {
                required: true,
            },
            license_plate: {
                required: true,
            },
        },
        highlight: function(element) {
            $(element).parent().css('color', 'red')
        },
    });
</script>
@parent
@stop