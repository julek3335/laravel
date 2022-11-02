@php
$return_code = session('return_code');
$return_message = session('return_message');

switch($return_code){
    case 200:
        $event_title = 'Sukces';
        $event_type_color = 'bg-green';
        break;
    case 400:
        $event_title = 'Błąd';
        $event_type_color = 'bg-red';
        break;
    default:
        $event_title = 'Komunikat';
        $event_type_color = '';
        break;
}
@endphp

@isset($return_code)
<script>
    /*
    ** Toasts
    */
    const backend_message = {
        'code': {{$return_code}}, 
        'message': '{{$return_message}}',
        'title': '{{$event_title}}',
        'event_type_color' : '{{$event_type_color}}',
    }

    if(backend_message.code){
        $(document).Toasts('create', {
            title: backend_message.title,
            body: backend_message.message,
            autohide: true,
            delay: 5000,
            class: 'm-2 ' + backend_message.event_type_color
        });
    }
</script>
@endisset