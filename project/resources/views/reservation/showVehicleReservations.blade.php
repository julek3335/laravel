@foreach ($reservations as $reservation)
<tr>
    <td>{{ $reservation->id }}</td>
    <td>{{ $reservation->start_date }}</td>
    <td>{{ $reservation->end_date }}</td>
    <td>{{ $reservation->vehicle_id }}</td>
    <td>{{ $reservation->user_id }}</td>
</tr>
<br>
@endforeach