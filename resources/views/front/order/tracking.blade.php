@extends('front/layout')
@section('page_title','Cart Page')
@section('container')

<section id="cart-view" style="margin-top:5px;">
    <div class="container">
            <h1 class="text-center">Track Your Order</h1>
            <div class="text-center">
                <div style="display: inline-flex; flex-warp:nowarp;width:100%;">
                    <input type="text" class="form-control" id="order_id" placeholder="Order Id" style="width: calc(100% - 50px); border-top-right-radius:0px;border-bottom-right-radius:0px;">
                    <button type="button" onclick="find_order();" style="width: 50px;border-top-left-radius:0px;border-bottom-left-radius:0px;background: #20bcaf; border: none; color: #fff;"><span class="fas fa-search"></span></button>
                </div>
            </div>
            <div id="order-status">
                <div class="text-center">
                    <div style="font-size: 150px;">
                        <i class="fa-regular fa-face-smile"></i>
                    </div>
                    <h3>Happy Shopping</h3>
                </div>
            </div>
    </div>
</section>
@endsection

@section('script')
<script>
  //Update QTY
  function find_order(){
    var url = "{{asset('/')}}order-tracking-find";
    $.ajax({
        url: url,
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
          order_id : $('#order_id').val(),
        },
        dataType: 'JSON',
        success:function(response)
        {
          //$('.cart-label').html(response.length);
          if(response){
            //console.log(response);
            var htm = '<div class="text-center">'
                    +'<h3>Your product status is <span class="btn btn-success">'+response.status+'<span></h3>'
                    +`<h3>যে কোন প্রয়োজনে যোগাযোগ করুন- <a style="font-family: Arial, Helvetica, sans-serif;" href="tel:{{env('SITE_PHONE')}}">{{env('SITE_PHONE')}}</a></h3>`
                    +'</div>';
            $('#order-status').html(htm);
          }
        },
        error: function(response) {
            var htm = '<div class="text-center">'
                    +'<h3>No order found with this Order Id!</h3>'
                    +`<h3>যে কোন প্রয়োজনে যোগাযোগ করুন- <a style="font-family: Arial, Helvetica, sans-serif;" href="tel:{{env('SITE_PHONE')}}">{{env('SITE_PHONE')}}</a></h3>`
                    +'</div>';
            $('#order-status').html(htm);
        }
      }
    );
  }
</script>
@endsection
