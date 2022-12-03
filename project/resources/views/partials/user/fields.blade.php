@section('plugins.Jquery-validation', true)
<x-adminlte-card title="Dane użytkownika" theme="lightblue" theme-mode="outline" collapsible maximizable>
    <x-adminlte-input name="name" type="text" label="Imię" placeholder="Imię" value="{{ isset($user->name) ? $user->name : '' }}" disable-feedback required/>
    <x-adminlte-input name="last_name" type="text" label="Nazwisko" placeholder="Nazwisko" value="{{ isset($user->last_name) ? $user->last_name : '' }}" disable-feedback required/>
    <x-adminlte-input name="email" type="email" label="Email" placeholder="Email" value="{{ isset($user->email) ? $user->email : '' }}" disable-feedback required/>
    <x-adminlte-select-bs name="status" label="Status" data-title="Wybierz status ..." data-live-search data-live-search-placeholder="Wybierz status ..." data-show-tick>
        <x-slot name="prependSlot">
            <div class="input-group-text bg-gradient-info">
                <i class="fas fa-user-check"></i>
            </div>
        </x-slot>
        @foreach(App\Enums\UserStatusEnum::cases() as $status_option)
        <option value="{{ $status_option->value }}" {{ isset($user) ? $status_option->value === $user->status->value ? "selected" : "" : ""}}>{{ __('status.'.$status_option->name) }}</option>
        @endforeach>
    </x-adminlte-select-bs>
    <x-adminlte-select-bs name="driving_licence_category[]" label="Prawo jazdy" id="driving_licence_category"
        data-title="Wybierz prawo jazdy ..." multiple required>
        <x-slot name="prependSlot">
            <div class="input-group-text bg-gradient-info">
                <i class="fas fa-address-card"></i>
            </div>
        </x-slot>
        <x-slot name="appendSlot">
            <x-adminlte-button theme="outline-dark" label="Wyczyść" icon="fas fa-lg fa-ban text-danger"/>
        </x-slot>
        @foreach($qualifications as $qualification)
            <option data-icon="fa address-card" value="{{$qualification->id }}"
            @isset($selectedQualifications)
                @if($selectedQualifications->where('qualification_id', $qualification->id)->first())
                    selected
                @endif
            @endisset
            >{{ $qualification->code }}</option>
        @endforeach
    </x-adminlte-select-bs>
    <x-adminlte-input-file name="photo" label="Zdjęcie profilowe" legend="Wybierz" placeholder="Wybierz lub upuść zdjęcie" value="{{isset($user) ? asset('storage/users_photos/'. $user->photo) : ''}}">
        <x-slot name="prependSlot">
            <div class="input-group-text bg-lightblue">
                <i class="fas fa-upload"></i>
            </div>
        </x-slot>
    </x-adminlte-input-file>
    <x-adminlte-select-bs name="auth_level" label="Uprawnienia" data-title="Wybierz uprawnienia ..." data-live-search data-live-search-placeholder="Wybierz prawo jazdy ..." data-show-tick>
        <x-slot name="prependSlot">
            <div class="input-group-text bg-gradient-info">
                <i class="fas fa-user-check"></i>
            </div>
        </x-slot>
        <option value="0" {{ isset($user->auth_level) ? ($user->auth_level == '0' ? 'selected' : '') : ''}}>Administrator</option>
        <option value="1" {{ isset($user->auth_level) ? ($user->auth_level == '1' ? 'selected' : '') : ''}}>Edytor</option>
        <option value="2" {{ isset($user->auth_level) ? ($user->auth_level == '2' ? 'selected' : '') : ''}}>Użytkownik</option>
    </x-adminlte-select-bs>
    @if(!isset($user))
        <x-adminlte-input name="password" type="password" label="Hasło" placeholder="Hasło"/>
    @endif
    <x-adminlte-button label="Zapisz" type="submit" theme="success" class="float-right" icon="fas fa-save" />
    @isset($user)
    <a href="/user/{{ isset($user) ? $user->id : ''}}">
        <x-adminlte-button label="Strona użytkownika" icon="fas fa-arrow-left" class="float-right mr-2"/>
    </a>
    @endisset
</x-adminlte-card>

@section('js')
<script>
    $(document).ready(function(){
        $("#user_form").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 1
                },
                last_name: {
                    required: true,
                    minlength: 1
                },
                email: {
                    required: true,
                    email: true
                },
                status: "required",
                driving_licence_category: "required",
                password: {
                    required: true,
                    minlength: 8,
                },
                auth_level: {
                    required: true
                }
            },
        });
        })
</script>
@parent
@stop
