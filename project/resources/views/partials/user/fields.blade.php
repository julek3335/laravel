
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
    <x-adminlte-select-bs name="driving_licence_category" label="Prawo jazdy" data-title="Wybierz prawo jazdy ..." data-live-search data-live-search-placeholder="Wybierz prawo jazdy ..." data-show-tick>
        <x-slot name="prependSlot">
            <div class="input-group-text bg-gradient-info">
                <i class="fas fa-user-check"></i>
            </div>
        </x-slot>
        <option value="B">B</option>
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
        <option value="0" {{ isset($auth_level) ? ($auth_level == '0' ? 'selected' : '') : ''}}>Administrator</option>
        <option value="1" {{ isset($auth_level) ? ($auth_level == '1' ? 'selected' : '') : ''}}>Edytor</option>
        <option value="2" {{ isset($auth_level) ? ($auth_level == '2' ? 'selected' : '') : ''}}>Użytkownik</option>
    </x-adminlte-select-bs>
    @if(!isset($user))
        <x-adminlte-input name="password" type="password" label="Hasło" placeholder="Hasło"/>
    @endif
    <x-adminlte-button label="Zapisz" type="submit" theme="success" class="float-right" icon="fas fa-save" />
</x-adminlte-card>

@section('js')
<script>
    $(document).ready(function(){
        $("#user_form").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3,
                    maxlength: 10
                },
                last_name: {
                    required: true,
                    minlength: 3,
                    maxlength: 10
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
                photo: "required",
            },
        });
        })
</script>
@parent
@stop