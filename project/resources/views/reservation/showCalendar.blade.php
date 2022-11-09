@extends('adminlte::page')

@section('title', 'Kalendarz rezerwacji')

@section('content_header')
<h1>Kalendarz rezerwacji</h1>
@stop

@section('content')
@section('plugins.Fullcalendar', true)

<x-adminlte-card title="Kalendarz rezerwacji" theme="lightblue" theme-mode="outline" collapsible maximizable>
    <div id='calendar'></div>
</x-adminlte-card>
<script>
    var reservations = []
    @foreach ($reservations as $reservation)
        reservations.push({
         title: 'Rezerwacja: {{$reservation->user_name}} {{$reservation->user_last_name}}, Pojazd: {{$reservation->vehicle_name}}', 
         start: "{{$reservation->start_date}}", 
         end: "{{$reservation->end_date}}",
         backgroundColor: '#f39c12', //yellow
         borderColor    : '#f39c12' //yellow
        });
    @endforeach
</script>
@stop

@section('css')

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
            selectable: true,
            events: reservations
        });

        calendar.render();
    });
</script>
@stop
