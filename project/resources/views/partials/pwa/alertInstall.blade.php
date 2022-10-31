<div id="install_pwa_alert" class="install-pwa-alert" style="display:none">
    <x-adminlte-alert theme="light" title="iPojazd" class="text-center" dismissable>
        <p class="text-center mb-3 mt-3">Dodaj aplikację iPojazd do ekranu głównego.</p>
        <x-adminlte-button label="Dodaj do ekranu głównego" theme="info" id="install_pwa" class="m-auto" icon="fas fa-mobile-screeen" />
    </x-adminlte-alert>
</div>

@section('css')
<style>
.install-pwa-alert{
    position: fixed;
    bottom:0;
    left:0;
    width:100%;
}
.install-pwa-alert .alert{
    margin:0;
}
</style>
@parent
@stop