@extends('admin/layout')
@section('page_title','Order Details')
@section('order_select','active')
@section('container')
<form method="POST" action="{{asset('/')}}admin/order/update-save" enctype="multipart/form-data">
    @csrf
<div class=" whitebg">
    <center>
        <h3>Order Id: {{$order_details->id}}</h3>
        <label>{{date("d M Y (h:i a)", strtotime($order_details->created_at))}}</label>
    </center>
    <div class="row">

        <div class="text-left col-md-4" >
            <div class="order_detail">
                <input required type="hidden" readonly name="order_id" value="{{$order_details->id}}" >
                <input required type="hidden" readonly name="customer_id" value="{{$order_details->customers}}" >
                <span class="font-weight-bold">Name: </span> <input required type="text" class="form-control" name="name" value="{{$order_details->name}}">
                <span class="font-weight-bold">Phone: </span> <input required type="text" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" name="phone" value="{{$order_details->phone}}"  maxlength="11">
                <span class="font-weight-bold">Address: </span> <input required type="text" class="form-control" name="address" value="{{$order_details->address}}">
            </div>
        </div>
        <div class="text-left col-md-4">
            <div class="order_detail">
                <span class="font-weight-bold">Booking Number: </span> <input type="text" class="form-control" name="booking_number" value="{{$order_details->booking_number}}">
                <span class="font-weight-bold">Courier Name: </span> <input type="text" class="form-control" name="courier_name" value="{{$order_details->courier_name}}">
                <span class="font-weight-bold">Note: </span> <textarea class="form-control" name="note">{{$order_details->note}}</textarea><br>
            </div>
        </div>
      <div class="text-left col-md-4">
            <span class="font-weight-bold">Status: </span>
            <select class="form-control float-right" name="status">
                <option value="pending" {{$order_details->status=='pending'?'selected':''}}>Pending</option>
                <option value="pending payment" {{$order_details->status=='pending payment'?'selected':''}}>Pending Payment</option>
                <option value="confirm" {{$order_details->status=='confirm'?'selected':''}}>Confirm</option>
                <option value="processing" {{$order_details->status=='processing'?'selected':''}}>Processing</option>
                <option value="oncourier" {{$order_details->status=='oncourier'?'selected':''}}>Oncourier</option>
                <option value="delivered" {{$order_details->status=='delivered'?'selected':''}}>Delivered</option>
                <option value="canceled" {{$order_details->status=='canceled'?'selected':''}}>Canceled</option>
            </select>
      </div>
    </div>
    <div class="row">
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
                            <td><img src="{{asset('/')}}storage/media/{{$product->P_img}}" onerror="this.onerror=null;this.src='/storage/media/img/no-image-placeholder.png';" style="height: 50px;object-fit:contain;"></td>
                            <td>{{$product->p_size}}</td>
                            <td>{{$product->p_color}}</td>
                            <td style="min-width: 185px;">

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">৳</span>
                                        </div>
                                        <input required type="text" id="order-product-price-{{$product->P_id}}" class="form-control" value="{{$product->P_price}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                        <div class="input-group-append">
                                          <span class="btn btn-success" onclick="change_order_product_price('{{$order_details->id}}',$('#order-product-price-{{$product->P_id}}').val(),'{{$product->P_id}}')"><i class="fa fa-check" aria-hidden="true"></i></span>
                                        </div>
                                    </div>

                            </td>
                            <td style="min-width: 120px;">
                                <div class="input-group mb-3">
                                    <input required type="text" id="order-product-qty-{{$product->P_id}}" class="form-control" value="{{$product->p_qty}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                    <div class="input-group-append">
                                      <span class="btn btn-success" onclick="change_order_product_qty('{{$order_details->id}}',$('#order-product-qty-{{$product->P_id}}').val(),'{{$product->P_id}}')"><i class="fa fa-check" aria-hidden="true"></i></span>
                                    </div>
                                </div>
                            </td>
                            <td >৳ {{$product->p_qty*$product->P_price;}}</td>
                        </tr>
                        @php
                            $total_product_price = $total_product_price+$product->p_qty*$product->P_price;
                        @endphp
                        @endforeach

                        <tr class="table-borderless">
                            <td colspan="4">&nbsp;</td>
                            <td colspan="2">Delivery Charge</td>
                            <td>
                                <div style="display: inline-flex;flex-wrap:nowrap;width: 100%;">
                                    ৳&nbsp;&nbsp;
                                    <input required type="text" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" name="delivery_charge" value="{{$order_details->delivery_charge}}">
                                </div>
                            </td>
                        </tr>
                        <tr class="table-borderless">
                            <td colspan="4">&nbsp;</td>
                            <td colspan="2">Advance</td>
                            <td>
                                <div style="display: inline-flex;flex-wrap:nowrap;width: 100%;">
                                    ৳&nbsp;&nbsp;
                                        <input required type="text" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" name="advance" value="{{$order_details->advance_amount??0}}">
                                </div>
                            </td>
                        </tr>
                        <tr class="table-borderless">
                            <td colspan="4">&nbsp;</td>
                            <td colspan="2">Discount</td>
                            <td>
                                <div style="display: inline-flex;flex-wrap:nowrap;width: 100%;">
                                    ৳&nbsp;&nbsp;
                                        <input required type="text" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" name="discount" value="{{$order_details->discount_amount??0}}">
                                </div>
                            </td>
                        </tr>
                        <tr class="table-borderless">
                            <td colspan="4">&nbsp;</td>
                            <td colspan="2"><b>Total</b></td>
                            <td><b>৳ {{(($total_product_price+$order_details->delivery_charge)-$order_details->advance_amount)-$order_details->discount_amount}}</b></td>
                        </tr>
                    </tbody>
                  </table>
                  <div class="float-right">
                        <input required type="submit" class="btn btn-success" value="Update"/>
                  </div>
                </div>

             <!-- Cart Total view -->

		   </div>
         </div>
       </div>

    </div>
</div>
</form>
@endsection
@section('script')
<script>
    //Update QTY
    function change_order_product_qty(order_id,p_qty,product_id){
        var url = "{{asset('/')}}admin/order-qty-update";
        $.ajax({
            url: url,
            method: 'POST',
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
            order_id : order_id,
            P_id : product_id,
            p_qty : p_qty
            },
            dataType: 'JSON',
            success:function(response)
            {
                //$('.cart-label').html(response.length);
                //console.log(response)
                if(response.status=="ok"){
                   location.reload();
                }
            },
            error: function(response) {
            }
        }
        );
    }

    //Update Price
    function change_order_product_price(order_id,p_price,product_id){
        var url = "{{asset('/')}}admin/order-price-update";
        $.ajax({
            url: url,
            method: 'POST',
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
            order_id : order_id,
            P_id : product_id,
            P_price : p_price
            },
            dataType: 'JSON',
            success:function(response)
            {
                //$('.cart-label').html(response.length);
                //console.log(response)
                if(response.status=="ok"){
                    location.reload();
                }
            },
            error: function(response) {
            }
        }
        );
    }
</script>
@endsection
