@section('plugins.Jquery-validation', true)
<x-adminlte-button label="Zakończ trasę" icon="fas fa-forward-step" data-toggle="modal" data-target="#modalEndJobId{{$job->id}}" id="modalEndJobButtonId{{$job->id}}"/>
<form id="job_end_form" action="/jobs/{{$job->id}}/end" method="POST">
    @csrf
    <x-adminlte-modal id="modalEndJobId{{$job->id}}" title="Zakończenie trasy" theme="light" icon="fas fa-bolt">
        @php
        $config = ['format' => 'DD.MM.YYYY HH:mm'];
        @endphp
        <x-adminlte-input-date name="end_time" :config="$config" label="Data zakończenia" required>
            <x-slot name="appendSlot">
                <x-adminlte-button icon="fas fa-calendar-day"
                    title="Data zakończenia"/>
            </x-slot>
        </x-adminlte-input-date>
        <x-adminlte-input name="end_localization" type="text" label="Lokalizacja końcowa" placeholder="Lokalizacja końcowa" value="{{ isset($job->end_point) ? $job->end_point : '' }}"
            disable-feedback required/>
        <x-adminlte-input name="end_odometer" type="number" label="Stan licznika" disable-feedback required/>
        <x-adminlte-textarea name="description" label="Opis" placeholder="Opis" disable-feedback />
        <x-slot name="footerSlot">
            <x-adminlte-button label="Zakończ" type="submit" theme="success" class="mr-auto" icon="fas fa-arrow-alt-circle-right"/>
            <x-adminlte-button theme="danger" label="Zamknij" data-dismiss="modal"/>
        </x-slot>
    </x-adminlte-modal>
</form>
@section('js')
    <script>
        //Set datetime of start date when Button Pickup Vehicle clicked
        $("#modalEndJobButtonId{{$job->id}}").click(function(){
            $('#end_time').datetimepicker("defaultDate", new Date());
        });

        //Validate fields
        $("#job_end_form").validate({
            rules: {
                end_time: {
                    required: true,
                },
                description: {
                    required: true,
                },
                end_odometer: {
                    required: true,
                    digits: true
                }
            } 
        });
        
    </script>
    @parent
@stop