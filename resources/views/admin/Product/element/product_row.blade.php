@foreach($products_all as $key=>$list)
    <tr>
        <td>{{$key + $products_all->firstItem()}}</td>
        <td>{{$list->name}}</td>
        <td>{{$list->id}}</td>
        <td>
            <select class="form-control" onchange="order_place_copy(event)">
                <option value="" disable hidden >select</option>
                @foreach($order_place as $place)
                    <option value="{{asset('/order').'/'.$list->slug}}?place={{$place->share_place}}" >{{$place->share_place}}</option>
                @endforeach
            </select>
        </td>
        <td>
        @if($list->image!='')
            <img width="100px" src="{{asset('storage/media/'.$list->image)}}"/>
        @endif
        </td>
        <td>
            <a href="{{url('admin/product/manage_product/')}}/{{$list->id}}"><button type="button" class="btn btn-success">Edit</button></a>

            @if($list->status==1)
                <a href="{{url('admin/product/status/0')}}/{{$list->id}}"><button type="button" class="btn btn-primary">Visible</button></a>
                @elseif($list->status==0)
                <a href="{{url('admin/product/status/1')}}/{{$list->id}}"><button type="button" class="btn btn-warning">Hidden</button></a>
            @endif

            <a href="{{url('admin/product/delete/')}}/{{$list->id}}"><button type="button" class="btn btn-danger">Delete</button></a>
        </td>
    </tr>
@endforeach
