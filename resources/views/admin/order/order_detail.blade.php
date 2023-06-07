@extends('admin/layout')
@section('page_title','Order Details')
@section('order_select','active')
@section('container')
<div class=" whitebg">
    <center>
        <h3>Order Id: {{$order_details->id}}</h3>
        <label>{{date("d M Y (h:i a)", strtotime($order_details->created_at))}}</label>
    </center>
    <div class="row">
    <div class="text-left" style="width: 50%;">
        <div class="order_detail">
                <span class="font-weight-bold">Name: </span> {{$order_details->name}}<br>
                <span class="font-weight-bold">Phone: </span> {{$order_details->phone}}<br>
                <span class="font-weight-bold">Address: </span> {{$order_details->address}}<br>
                @if ($order_details->booking_number)
                <span class="font-weight-bold">Booking Number: </span> {{$order_details->booking_number}}<br>
                @endif
                @if ($order_details->courier_name)
                <span class="font-weight-bold">Courier Name: </span> {{$order_details->courier_name}}<br>
                @endif
                <span class="font-weight-bold" style="color: #158d1b">Note: {{$order_details->note}}</span><br>
          </div>
      </div>
      <div class="text-right" style="width: 50%;">

            <div class="order_detail">
                <a class="btn btn-info" href="{{asset('/')}}order-pdfview/{{$order_details->id}}" target="_blank" style="margin-bottom:10px; ">Invoice</a><br>
                @if ($order_details->status=='pending')
                    <span class="text-uppercase" style="background-color:orange;color:#fff; padding:5px;border-radius:5px;">{{$order_details->status}}</span>
                @elseif ($order_details->status=='pending payment')
                    <span class="text-uppercase" style="background-color:#9d581e;color:#fff; padding:5px;border-radius:5px;">{{$order_details->status}}</span>
                @elseif ($order_details->status=='confirm')
                    <span order_details="text-uppercase" style="background-color:rgb(216, 213, 9);color:#fff; padding:5px;border-radius:5px;">{{$order_details->status}}</span>
                @elseif ($order_details->status=='processing')
                    <span class="text-uppercase" style="background-color:rgb(17, 218, 27);color:#fff; padding:5px;border-radius:5px;">{{$order_details->status}}</span>
                @elseif ($order_details->status=='oncourier')
                    <span class="text-uppercase" style="background-color:#959d1e;color:#fff; padding:5px;border-radius:5px;">{{$order_details->status}}</span>
                @elseif ($order_details->status=='delivered')
                    <span class="text-uppercase" style="background-color:rgb(19, 139, 45);color:#fff; padding:5px;border-radius:5px;">{{$order_details->status}}</span>
                @elseif ($order_details->status=='canceled')
                    <span class="text-uppercase" style="background-color:rgb(100, 97, 97);color:#fff; padding:5px;border-radius:5px;">{{$order_details->status}}</span>
                @else
                    <span class="text-uppercase" style="background-color:rgb(0, 132, 255);color:#fff; padding:5px;border-radius:5px;">{{$order_details->status}}</span>
                @endif
            </div>
        </div>


       <div class="col-md-12">
         <div class="cart-view-area">
           <div class="cart-view-table">


               <div class="table-responsive">
                  <table class="table table-bordered order_detail">
                    <thead class="thead-dark">
                      <tr>
                        <th>Product</th>
                        <th>Image</th>
                        <th>Size</th>
                        <th>Color</th>
                        <th>Price ( For 1 product )</th>
                        <th>Qty</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php
                            $total_product_price = 0;
                        @endphp
                        @foreach (json_decode($order_details->product_details) as $key=>$product)
                        <tr>
                            <td>{{$product->P_name}}</td>
                            <td><img src="{{asset('/')}}storage/media/{{$product->P_img}}" onerror="this.onerror=null;this.src='/storage/media/img/no-image-placeholder.png';" style="height: 100px;object-fit:contain;"></td>
                            <td>{{$product->p_size}}</td>
                            <td>{{$product->p_color}}</td>
                            <td>৳ {{$product->P_price}}</td>
                            <td>{{$product->p_qty}}</td>
                            <td>৳ {{$product->p_qty*$product->P_price}}</td>
                        </tr>
                        @php
                            $total_product_price = $total_product_price+$product->p_qty*$product->P_price;
                        @endphp
                        @endforeach

                        <tr class="table-borderless">
                            <td colspan="4">&nbsp;</td>
                            <td colspan="2">Delivery Charge</td>
                            <td>৳ {{$order_details->delivery_charge ?? 0}}</td>
                        </tr>
                        <tr class="table-borderless">
                            <td colspan="4">&nbsp;</td>
                            <td colspan="2">Advance</td>
                            <td>৳ {{$order_details->advance_amount ?? 0}}</td>
                        </tr>
                        <tr class="table-borderless">
                            <td colspan="4">&nbsp;</td>
                            <td colspan="2">Discount</td>
                            <td>৳ {{$order_details->discount_amount ?? 0}}</td>
                        </tr>
                        <tr class="table-borderless">
                            <td colspan="4">&nbsp;</td>
                            <td colspan="2"><b>Total</b></td>
                            <td><b>৳ {{(($total_product_price+$order_details->delivery_charge)-$order_details->advance_amount)-$order_details->discount_amount}}</b></td>
                        </tr>

                    </tbody>
                  </table>
                </div>

             <!-- Cart Total view -->

		   </div>
         </div>
       </div>

    </div>
</div>
@endsection
