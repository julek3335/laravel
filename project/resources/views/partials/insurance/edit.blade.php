@section('plugins.Jquery-validation', true)
<form id="insurance-edit" action="{{ url('insurance/edit/'. $insurance->id) }}" method="POST" enctype="multipart/form-data">
    <x-adminlte-card title="Dane pojazdu" theme="lightblue" theme-mode="outline" collapsible maximizable>
        <div class="row">
            <div class="col-sm-12">
                @csrf
                <x-adminlte-input name="policy_number" type="number" label="Numer polisy" placeholder="Number polisy" value="{{ $insurance->policy_number }}" disable-feedback required/>
                @php
                $config = ['format' => 'DD.MM.YYYY'];
                @endphp
                <x-adminlte-input-date name="expiration_date" :config="$config" label="Data wygaśnięcia" value="{{ $insurance->expiration_date }}" disable-feedback required>
                    <x-slot name="appendSlot">
                        <x-adminlte-button icon="fas fa-calendar-day"
                            title="Data"/>
                    </x-slot>
                </x-adminlte-input-date>
                <x-adminlte-input name="insurer_name" type="text" label="Ubezpieczyciel" placeholder="Ubezpieczyciel" value="{{ $insurance->insurer_name }}" disable-feedback required/>
                <x-adminlte-input name="cost" type="number" label="Koszt" placeholder="Koszt" value="{{ $insurance->cost }}" disable-feedback />
                <x-adminlte-input name="phone_number" type="tel" label="Numer kontaktowy" placeholder="Numer kontaktowy" value="{{ $insurance->phone_number }}" disable-feedback />
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
    $(document).ready(function(){
        $("#insurance-edit").validate({
            rules: {
                policy_number: {
                    required: true,
                    number: true,
                },
                cost: {
                    required: true,
                    number: true
                },
                phone_number: {
                    required: true,
                    phonePL: true
                },
                insurer_name: {
                    required: true
                },
                selBsVehicle: {
                    required: true,
                }
            }
        });
    });
</script>
@parent
@stop