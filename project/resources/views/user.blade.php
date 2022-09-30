<h1>User test</h1>
@foreach($users as $user)
<tr>
    <td> {{$user->id}} </td>
    <td> {{$user->name}} </td>
    <td> {{$user->email}} </td>
    <td>{{$user->driving_licence_category}}</td>
    <td> {{$user->status}} </td>
</tr>
@endforeach