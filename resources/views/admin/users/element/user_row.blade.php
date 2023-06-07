@foreach($all_users as $key=>$list)
    <tr>
        <td>{{$key + $all_users->firstItem()}}</td>
        <td>{{$list->name}}</td>
        <td>{{$list->phone}}</td>
        <td>{{$list->address}}</td>
    </tr>
@endforeach
