<x-adminlte-card title="Dane ubezpieczenia" theme="lightblue" theme-mode="outline" collapsible maximizable>
    <div class="row">
        <div class="col-sm-12">
            <x-adminlte-input name="policy_number" type="text" label="Number polisy" placeholder="Number polisy"
                value="{{ $insurance->policy_number }}" disable-feedback/>
            <!-- <x-adminlte-input name="brand" type="text" label="Marka" placeholder="Marka"
                value="{{ $insurance->expiration_date }}" disable-feedback/> -->
            <x-adminlte-input name="insurer_name" type="text" label="Nazwa ubezpieczyciela" placeholder="Nazwa ubezpieczyciela"
                value="{{ $insurance->insurer_name }}" disable-feedback/>
                 <x-adminlte-input name="cost" type="number" label="Koszt" placeholder="Koszt"
                value="{{ $insurance->cost }}" disable-feedback/>
            <x-adminlte-input name="phone_number" type="number" label="Numer kontaktowy" placeholder="Numer kontaktowy"
                value="{{ $insurance->phone_number }}" disable-feedback/>
            <x-adminlte-input name="description" type="text"  label="Opis" placeholder="Opis"
                value="{{ $insurance->description	}}" disable-feedback/>   
            <x-adminlte-select-bs name="type" label="Typ" 
                data-title="Wybierz typ ..." data-live-search
                data-live-search-placeholder="Wybierz typ ..." data-show-tick>
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-info">
                        <i class="fas fa-car-side"></i>
                    </div>
                </x-slot>
                <option data-icon="fa fa-fw fa-car">OC</option>
                <option data-icon="fa fa-fw fa-truck" selected>AC</option>
                <option data-icon="fa fa-fw fa-truck-moving">Assistance</option>
                <option data-icon="fa fa-fw fa-motorcycle">nnw</option>
            </x-adminlte-select-bs>
            <x-adminlte-input name="status" type="number" label="Status" placeholder="Status"
                value="{{ $insurance->status->name}}" disable-feedback/>
            <x-adminlte-input-file name="photos[]" label="Zdjęcia" legend="Wybierz" placeholder="Wybierz lub upuść zdjęcia" multiple>
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-lightblue">
                        <i class="fas fa-upload"></i>
                    </div>
                </x-slot>
            </x-adminlte-input-file>
            <x-adminlte-button label="Zapisz" type="submit" theme="success" class="float-right" icon="fas fa-save"/>
            <!-- <a href="/insurance/{{$insurance->id}}">
                <x-adminlte-button label="Karta pojazdu" icon="fas fa-arrow-left" class="float-right mr-2"/>
            </a> -->
        </div>
    </div>
</x-adminlte-card>