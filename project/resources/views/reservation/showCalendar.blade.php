@extends('adminlte::page')

@section('title', 'Kalendarz rezerwacji')

@section('content_header')
<h1>Kalendarz rezerwacji</h1>
@stop

@section('content')
@section('plugins.Fullcalendar', true)

<x-adminlte-card title="Kalendarz rezerwacji" theme="lightblue" theme-mode="outline" collapsible maximizable>
    <div id="calendar"></div>
</x-adminlte-card>
<script>
    var reservations = []
    @foreach ($reservations as $reservation)
        reservations.push({
         title: 'Rezerwacja: {{$reservation->user_name}} {{$reservation->user_last_name}}, Pojazd: {{$reservation->vehicle_name}}', 
         start: "{{$reservation->start_date}}", 
         end: "{{$reservation->end_date}}",
         extendedProps: {
            'user_name': "{{$reservation->user_name}}",
            'user_last_name': "{{$reservation->user_last_name}}",
            'user_id': "{{$reservation->user_id}}", 
            'vehicle_name': "{{$reservation->vehicle_name}}", 
            'vehicle_id': "{{$reservation->vehicle_id}}",
            'vehcile_license_plate': "{{$reservation->license_plate}}"
         },
         backgroundColor: '#f39c12', //yellow
         borderColor    : '#f39c12', //yellow
         allDay: false
        });
    @endforeach
</script>

@include('partials.reservation.eventModal')

@stop

@section('js')
<script>
    $(document).ready(function(){
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            locale: 'pl',
            headerToolbar: {
                left  : 'prev,next today',
                center: 'title',
                right : 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            themeSystem: 'bootstrap',
            selectable: false,
            displayEventTime: false,
            events: reservations, 
            eventClick: function(info) {
                $('#modal_event').modal();
                $('#modal_event_user_name')
                    .attr('href', '/user/' + info.event.extendedProps['user_id'])
                    .text(info.event.extendedProps['user_name'] + ' ' + info.event.extendedProps['user_last_name']);
                $('#modal_event_vehicle')
                    .attr('href', '/vehicles/' + info.event.extendedProps['vehicle_id'])
                    .text(info.event.extendedProps['vehicle_name']);
                $('#modal_event_vehcile_license_plate')
                    .attr('href', '/vehicles/' + info.event.extendedProps['vehicle_id'])
                    .text(info.event.extendedProps['vehcile_license_plate']);

                let date_format_options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric'};
                $('#modal_event_start')
                    .text(info.event.start.toLocaleDateString("pl-PL", date_format_options));
                $('#modal_event_end')
                    .text(info.event.end.toLocaleDateString("pl-PL", date_format_options));
            }
        });

        calendar.render();
    });
</script>
@stop

