<h1>incident test</h1>
{{-- @foreach($incidents as $incident) --}}
<tr>
    <td> {{$id}} </td>
    <td> {{$date}} </td>
    <td> {{$description}} </td>
    <td> {{$status}} </td>
    <td><img src="{{asset('storage/incidents_photos/'. $photo)}}"></td>
</tr>
{{-- @endforeach --}}