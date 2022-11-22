<x-adminlte-button id="openReservationButton" label="Zarezerwuj pojazd" icon="fas fa-light fa-plus" data-toggle="modal" data-target="#modalReservationVehicle" id="modalReservationVehicleButton" />

<form id="formReservation" action="/reservation-create" method="POST" enctype="multipart/form-data">
    @csrf
    @method('POST')
    <x-adminlte-modal id="modalReservationVehicle" title="Rezerwacja pojazdu" theme="light" icon="fas fa-bolt">
        @php
        $config = ['format' => 'YYYY.MM.DD'];
        @endphp

        <div id="firstSection">
            <x-adminlte-input-date id="startDate" name="start_date" :config="$config" label="Data rozpoczęcia">
                <x-slot name="start_date">
                    <x-adminlte-button icon="fas fa-calendar-day" title="Data rozpoczęcia" />
                </x-slot>
            </x-adminlte-input-date>
            <x-adminlte-input-date id="endDate" name="end_date" :config="$config" label="Data zakończenia">
                <x-slot name="end_date">
                    <x-adminlte-button icon="fas fa-calendar-day" title="Data zakończenia" />
                </x-slot>
            </x-adminlte-input-date>
            <x-adminlte-button id="submitDate" label="Zatwierdź daty" theme="success" class="mr-auto" />
        </div>

        <div id="secondSection" style="display: none;">
            <div style="margin-bottom: 20px;">
                <p><strong>Wybierz pojazd</strong></p>
                <select name="vehicle_id" id="selectList" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                </select>
            </div>
            <!-- pokaz możliwość wyboru pracownika tylko dla Administratora albo edytora -->
            @if($entitlements == 0 || $entitlements == 1)
            <div style="margin-bottom: 20px;">
                <p><strong>Wybierz pracownika</strong></p>
                <select name="user_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                    @if (isset($avaibleUsers))
                    @foreach ($avaibleUsers as $user)
                    <option value="{{ $user->id }}" data-icon="fa fa-fw fa-car">{{ $user->name }} {{$user->last_name}}</option>
                    @endforeach
                    <option data-icon="fa fa-fw fa-car">Żaden pracownik nie jest dostępny</option>
                    @endif
                </select>
            </div>
            @endif

            <x-adminlte-button id="submitButton" type="submit" label="Zarezerwuj pojazd" theme="success" class="mr-auto" icon="fas fa-arrow-alt-circle-right" />
            <x-adminlte-button id="return" label="Cofnij" class="mr-auto" />
            <x-slot name="footerSlot">
            </x-slot>
        </div>
    </x-adminlte-modal>
</form>
@section('js')
<script>
    //Set datetime of start date when Button Pickup Vehicle clicked
    $("#modalPickupVehicleButton").click(function() {
        $('#startDate').datetimepicker("defaultDate", new Date());
    });

    $("#return").click(function() {
        $('#firstSection').css('display', 'block')
        $('#secondSection').css('display', 'none')
    })

    $(document).ready(function() {
        $('#submitDate').click(function() {

            var date_start = $('start_date').val()
            var date_end = $('start_date').val()

            if (!$('#startDate').val() || !$('#endDate').val()) {
                alert('Prosimy uzupełnić obydwie daty')
                return
            }

            $.ajax({
                url: '/reservation/available-cars',
                method: 'GET',
                data: {
                    start_date: date_start,
                    end_date: date_end
                },
                success: function(data) {
                    $('#firstSection').css('display', 'none')
                    $('#secondSection').css('display', 'block')
                    data.forEach(element => {
                        $('#selectList').append('<option value="' + element.id + '"> ' + element.license_plate + '</option>');
                    });
                }
            })
        })

    })
</script>
@parent
@stop
