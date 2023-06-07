@extends('front/layout')
@section('page_title','Cart Page')
@section('container')

<section id="cart-view" style="margin-top:5px;">
    <div class="container">
    @if($errors->any())
      <div class="alert alert-danger alert-dismissible">
          <strong>
              {!! implode('<br/>', $errors->all('<span>:message</span>')) !!}
          </strong>
      </div>
    @endif
      @if(Session::has('cart_product'))
      <div class="row">
        <div class="col-sm-6 col-md-6">
          @include('front.cart.checkout')
        </div>
        <div class="col-sm-6 col-md-6">
          @include('front.cart.cart')
        </div>
      </div>
      @else
      <div class="row text-center">
        <h3><i class="fa fa-shopping-cart" aria-hidden="true"></i>Your cart is empty</h3>
        <a href="/" style="color:blue;">click here to continue shopping</a>
      </div>
      @endif
    </div>
</section>
@endsection

@section('script')
<script>
    //change location
      function changelocation(){
          var val = document.getElementById('location').value;
          var indhaka="{{env('IN_DHAKA')}}";
          if(val=="{{env('IN_DHAKA')}}"){
              document.getElementById("com").innerHTML = " ";
          }
          else{
              document.getElementById("com").innerHTML = "<b>ঢাকার বাহিরে ডেলিভারি চার্জ  {{env('OUT_DHAKA')}} টাকা অগ্রিম প্রদান করতে হবে।</b>";
          }
          document.getElementById("total_delivery").innerHTML = val+" TK";

          cart_total_price();
      }
    //cart total price
      function cart_total_price(){
          document.getElementById("total_amnt").innerHTML = parseFloat($('#total_delivery').text())+parseFloat($('#total_price').text());
      }
  </script>
  <script>
  //Update QTY
  function getcustomer(){
    var url = "{{asset('/')}}get-customer-by-phone";
    $.ajax({
        url: url,
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
          phone : $('#mobile').val(),
        },
        dataType: 'JSON',
        success:function(response)
        {
          //$('.cart-label').html(response.length);
          if(response){
            //console.log(response);
            $('#name').val(response.name);
            $('#address').val(response.address);
          }

        },
        error: function(response) {
        }
      }
    );
  }
  //Update QTY
  function change_cart_qty(p_qty,product_id){
    var url = "{{asset('/')}}cart-qty-update";
    $.ajax({
        url: url,
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
          P_id : product_id,
          p_qty : p_qty
        },
        dataType: 'JSON',
        success:function(response)
        {
          $('.cart-label').html(response.length);
            //console.log(response)
        },
        error: function(response) {
        }
      }
    );
  }
  //Remove Product
  function cart_remove_product(product_id,p_div_id){
    var url = "{{asset('/')}}cart-remove-product";
    $.ajax({
        url: url,
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
          P_id : product_id,
        },
        dataType: 'JSON',
        success:function(response)
        {
          $('.cart-label').html(response.length);
            $(p_div_id).remove();
          if(response.length==0){
            cart_clear();
          }
            //console.log(response)
        },
        error: function(response) {
        }
      }
    );
  }

  //Clear cart
  function cart_clear(){
    var url = "{{asset('/')}}cart-clear";
    $.ajax({
        url: url,
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {},
        dataType: 'JSON',
        success:function(response)
        {
          $('.cart-label').html(response.length);
            location.reload();
            //console.log(response);
        },
        error: function(response) {
        }
      }
    );
  }
  //update total price
  function changetotalprice(p_price,p_qty){
    var p_price = p_price*p_qty;
    $('#total_price').text(parseFloat($('#total_price').text())+p_price)
    cart_total_price();
  }
  </script>
@endsection
