@foreach($orders as $key=>$order)
    <tr style="background: #fff; padding:5px; margin-bottom:5px; border-bottom: 10px solid #e5e5e5;">
        <td class="font-weight-bold" style="width:300px;">
            <div style="background: #E7E9EB; box-shadow: 0 2px 5px 1px rgba(64,60,67,1); padding:5px;">
                <span style="color: #df7721;">Order:</span> {{$order->id}}<br>
                <span style="color: #212edf;">Date:</span> {{date("d M Y (h:i a)", strtotime($order->created_at))}}<br>
                @foreach ($customers as $key=>$customer)
                @if ($customer->id==$order->customers)
                <span class="font-weight-bold">Name:</span> {{$customer->name}}<br/>
                <span class="font-weight-bold">Phone:</span> {{$customer->phone}}<br/>
                <span class="font-weight-bold">Address:</span> {{$customer->address}}<br/>
                @break
                @endif
                @endforeach
                <span style="color: #212edf;">Booking Number: {{ $order->booking_number }}</span> <br>
                <span style="color: #212edf;">Courier Name: {{ $order->courier_name }}</span> <br>
                <span style="color: #21df31;">Courier Charge: {{ $order->delivery_charge }}&nbsp;৳</span><br>
                <span >Advance: {{ $order->advance_amount }}&nbsp;৳</span><br>
                <span style="color: #212edf;">Discount: {{ $order->discount_amount }}&nbsp;৳</span><br>
                <span >Condition:</span> <span style="color: #834512">{{ (($order->total_amount-$order->discount_amount)+$order->delivery_charge)-$order->advance_amount }}&nbsp;৳</span><br>
                <span >Note: </span><span style="color: #21df31">{{ $order->note }}</span><br>
                <span >Status: </span><span style="color: #834512">{{ $order->status }}</span><br>
            </div>
        </td>
        <td style="display: inline-flex; flex-wrap: wrap; justify-content: space-around; border: none;">
            @foreach (json_decode($order->product_details) as $key=>$product)
            <div style="width:100px; background: #E7E9EB; box-shadow: 0 2px 5px 1px rgba(64,60,67,1); padding:5px; margin:2.5px; text-align:center;">
                <img src="{{asset('/')}}storage/media/{{$product->P_img}}" onerror="this.onerror=null;this.src='/storage/media/img/no-image-placeholder.png';" style="height: 70px;"><br>
                <span class="font-weight-bold" style="color: #087c12">Code: {{$product->P_id}}</span><br/>
                <span class="font-weight-bold" style="color: #ff0202">৳&nbsp;{{$product->P_price}}</span><br/>
                <span class="font-weight-bold" style="color: #087c12">Qty: {{$product->p_qty}}</span><br/>
                @if ($product->p_size!='N/A')
                    <span class="font-weight-bold">Size: {{$product->p_size}}</span><br/>
                @endif
                @if ($product->p_color!='N/A')
                    <span class="font-weight-bold">Color: {{$product->p_color}}</span><br/>
                @endif
            </div>
            @endforeach
        </td>
        <td  style="width:300px;">
            <div class="text-uppercase text-center" style="background-color:#3ec033;color:#fff; padding:5px;border-radius:5px; margin-bottom:5px;">{{$order->order_place}}</div>
            @if ($order->order_process_by!=null)
            <div class="text-uppercase text-center" style="background-color:#0b6cad;color:#fff; padding:5px;border-radius:5px; margin-bottom:5px;">{{$order->order_process_by}}</div>
            @endif
            @if ($order->status=='pending')
                <div class="text-uppercase text-center" style="background-color:orange;color:#fff; padding:5px;border-radius:5px; margin-bottom:5px;">{{$order->status}}</div>
            @elseif ($order->status=='pending payment')
                <div class="text-uppercase text-center" style="background-color:#9d581e;color:#fff; padding:5px;border-radius:5px; margin-bottom:5px;">{{$order->status}}</div>
            @elseif ($order->status=='confirm')
                <span order_details="text-uppercase" style="background-color:rgb(216, 213, 9);color:#fff; padding:5px;border-radius:5px; margin-bottom:5px;">{{$order->status}}</div>
            @elseif ($order->status=='processing')
                <div class="text-uppercase text-center" style="background-color:rgb(17, 218, 27);color:#fff; padding:5px;border-radius:5px; margin-bottom:5px;">{{$order->status}}</div>
            @elseif ($order->status=='oncourier')
                <div class="text-uppercase text-center" style="background-color:#959d1e;color:#fff; padding:5px;border-radius:5px; margin-bottom:5px;">{{$order->status}}</div>
            @elseif ($order->status=='delivered')
                <div class="text-uppercase text-center" style="background-color:rgb(19, 139, 45);color:#fff; padding:5px;border-radius:5px; margin-bottom:5px;">{{$order->status}}</div>
            @elseif ($order->status=='canceled')
                <div class="text-uppercase text-center" style="background-color:rgb(100, 97, 97);color:#fff; padding:5px;border-radius:5px; margin-bottom:5px;">{{$order->status}}</div>
            @else
                <div class="text-uppercase text-center" style="background-color:rgb(0, 132, 255);color:#fff; padding:5px;border-radius:5px; margin-bottom:5px;">{{$order->status}}</div>
            @endif
            <a class="btn btn-success" href="{{url('/order-pdfview')}}/{{$order->id}}" target="_blank" style=margin:2px;>Print</a>
            <a class="btn btn-info" href="{{url('/admin/order-detail')}}/{{$order->id}}" style=margin:2px;>View</a>
            <a class="btn btn-warning" href="{{url('/admin/order/edit')}}/{{$order->id}}" style=margin:2px;>Edit</a>
            <button class="btn btn-primary" onclick="update_status('{{ $order->id }}','{{ $order->status }}','{{ $order->note }}');" style=margin:2px;>Status</button>
            <a class="btn btn-danger" href="{{url('/admin/order/delete/')}}/{{$order->id}}" style=margin:2px;>Delete</a>
        </td>
    </tr>
@endforeach
