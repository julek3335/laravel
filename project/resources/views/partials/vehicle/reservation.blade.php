<x-adminlte-button id="openReservationButton" label="Zarezerwuj pojazd" icon="fas fa-light fa-plus" data-toggle="modal" data-target="#modalReservationVehicle" id="modalReservationVehicleButton" />

<form action="/reservation-create" method="POST" enctype="multipart/form-data" id="formReservation" >
    @csrf
    @method('POST')
    <x-adminlte-modal id="modalReservationVehicle" title="Rezerwacja pojazdu" theme="light" icon="fas fa-bolt">
        @php
        $config = ['format' => 'YYYY.MM.DD HH:mm'];
        @endphp

        <div id="firstSection">
            <x-adminlte-input-date id="startDate" name="start_date" :config="$config" label="Data rozpoczęcia" required>
                <x-slot name="start_date_slot">
                    <x-adminlte-button icon="fas fa-calendar-day" title="Data rozpoczęcia" />
                </x-slot>
            </x-adminlte-input-date>
            <x-adminlte-input-date id="endDate" name="end_date" :config="$config" label="Data zakończenia" required>
                <x-slot name="end_date_slot">
                    <x-adminlte-button icon="fas fa-calendar-day" title="Data zakończenia" />
                </x-slot>
            </x-adminlte-input-date>
        </div>

        <div id="secondSection" style="display: none;">
            <div style="margin-bottom: 20px;">
                <p><strong>Wybierz pojazd</strong></p>
                    <select name="vehicle_id" id="selectList" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                    @if(isset($vehicle))   
                    <option value="{{$vehicle->id}}">{{$vehicle->license_plate}}</option>  
                    @endif 
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

            <x-slot name="footerSlot">
                <x-adminlte-button name="submitDate" type="submit" label="Zatwierdź daty" theme="success" id="submitDate" class="mr-auto" />
                <x-adminlte-button name="return" label="Cofnij" theme="info" id="return" style="display:none" />
                <x-adminlte-button name="submitButton" type="submit" label="Zarezerwuj pojazd" theme="success" id="submitButton" class="mr-auto" style="display:none" />
            </x-slot>
        </div>
    </x-adminlte-modal>
</form>
@section('js')
<script>
    $(document).ready(function() {
        //Hide return to previous step button if not needed
        $("#return").click(function() {
            $('#firstSection, #submitDate').css('display', 'block')
            $('#secondSection, #submitButton, #return').css('display', 'none')
        });

        //Store validation object on this variable
        let reserve_form_validation;

        //Define reservation validation function
        function validateReservationForm(){
            reserve_form_validation = $("#formReservation").validate({
                rules: {
                    start_date: "required",
                    end_date: {
                        required: true,
                        dateGreaterStart: "#startDate"
                    }
                } 
            });
        }

        //Validate start i end date filed on every input changes or form try send
        $('#startDate, #endDate').on('input, click', function(){

            validateReservationForm();
        });
        

        //Send AJAX request
        $('#submitDate').click(function(event) {
            event.preventDefault();

            if(reserve_form_validation == undefined){
                validateReservationForm()
            }

            let start_date_val = $('#startDate').val();
            let end_date_val = $('#endDate').val();

            if($('#formReservation').valid()){
                
                $.ajax({
                    url: '/reservation/available-cars',
                    method: 'GET',
                    data: {
                        start_date: start_date_val,
                        end_date: end_date_val
                    },
                    success: function(data) {
                        $('#firstSection, #submitDate').css('display', 'none');
                        $('#secondSection, #submitButton, #return').css('display', 'block');
                        data.forEach(element => {
                            $('#selectList').append('<option value="' + element.id + '"> ' + element.license_plate + '</option>');
                        });
                    }
                })
                
            }

        })

    });
</script>
@parent
@stop
