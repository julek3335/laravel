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
            events: [
                {
                    title          : 'Trasa - Jan Kowalski',
                    start          : '2022-10-12T12:30:00+02:00',
                    end            : '2022-10-19T12:30:00+02:00',
                    backgroundColor: '#00c0ef', //Info (aqua)
                    borderColor    : '#00c0ef', //Info (aqua)
                },
                {
                    title          : 'Rezerwacja - Adam Nowakowski',
                    start          : '2022-10-20T09:00:00+02:00',
                    end            : '2022-10-25T15:30:00+02:00',
                    backgroundColor: '#f39c12', //yellow
                    borderColor    : '#f39c12' //yellow
                }, 
                {
                    title          : 'Serwis',
                    start          : '2022-10-26T12:30:00+02:00',
                    backgroundColor: '#f56954', //red
                    borderColor    : '#f56954', //red
                    allDay         : true
                    },
            ]
        });

        calendar.render();
    });
</script>
@stop
