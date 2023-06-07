@extends('admin/layout')
@section('page_title','Self Order')
@section('selforder_select','active')
@section('container')
<style>
@media (min-width: 991px){
    .page-wrapper{
        padding-bottom: 0px;
    }
}
.main-content {
    padding-top: 80px!important;
    padding-bottom: 20px!important;
}
@media (max-width: 991px){
    .btn{
        font-size: 11px!important;
    }
    .main-content {
        padding-top: 0!important;
        padding-bottom: 20px!important;
    }
}
.section__content--p30{
    padding: 5px!important;
}

</style>

    <div class="row">
        <div class="col-sm-8 col-md-8 p-0">
            <!-- Products section -->
                <div class = "card m-0">
                    <div class="card-header">
                        <div class="input-group">
                            <div class="input-group-prepend mr-5">
                                <h3>ALL Product</h3>
                            </div>
                            <input type="text" class="form-control" id="find-product" placeholder="Product name or Id" aria-label="Product name or Id" aria-describedby="basic-addon2" value="{{ Request::get('search') ?? '' }}">
                            <div class="input-group-append">
                              <button class="btn btn-info" onclick="find_product_selforder()">Find</button>
                            </div>
                          </div>
                    </div>
                    <div class = "card-body pt-1" id="product_self" style="overflow:scroll;">
                        <!-- Tab panes -->
                        <div class="row" id="data-wrapper">
                            <!--load product-->
                        </div>
                        <br>
                        <!-- Data Loader -->
                        <div class="auto-load text-center">
                            <svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                x="0px" y="0px" height="100" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
                                <path fill="#20bcaf"
                                    d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
                                    <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s"
                                        from="0 50 50" to="360 50 50" repeatCount="indefinite" />
                                </path>
                            </svg>
                        </div>
                        <center>
                            <button class="btn btn-warning" id="load_more_btn" onclick="load_more_products();">আরও পন্য দেখুন</button>
                        </center>
                        <br>
                    </div>
                 </div>
            <!-- / Products section -->
        </div>

        <div class="col-sm-4 col-md-4 p-0">
            <div class = "card m-0" >
                <div class="card-header text-center">
                    SELECTED PRODUCT
                </div>
                <div class = "card-body pt-1" id="cart_self" style="overflow:scroll; ">
                    <!-- Tab panes -->
                    <div id="self-cart-wrapper">
                        <!--load cart product-->
                    </div>
                </div>
                <div class="card-footer">
                    <div style="display: inline-flex;flex-warp:no-warp;">
                        <h3>Total: <span id="total_price">0</span> Tk</h3>
                    </div>
                </div>
                <div class="card-footer">
                    <div style="width:100%; display: inline-flex; flex-warp:nowarp; justify-content: space-between;">
                        <button class="btn btn-danger" onclick="cart_clear();">Clear Cart</button>
                        <button class="btn btn-success"  onclick=" $('#total_price').text()>0? $('.customer-form-back').show() : alert('Please add product on cart!'); cart_total_price();">Place Order</button>
                    </div>
                </div>
             </div>
        </div>
    </div>
    <style>
        .customer-form-back{
            width: 100%;
            height: 100%;
            background: rgb(0, 0, 0,.5);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 4;
            display: none;
        }
    </style>

    {{-- Customer Info form --}}
    <div class="customer-form-back">
        @include('admin.selforder.particles.checkout')
    </div>




@endsection

@section('script')
<script>

    $(window).on('load', function() {
        var win = $(this); //this = window
        if (win.width() <= 991) {
            var windowHeight = $(window).height();
            $('#product_self').height(windowHeight-200);
            $('#cart_self').height(windowHeight-311);
        }
        if (win.width() <= 647) {
            var windowHeight = $(window).height();
            $('#product_self').height(windowHeight-200);
            $('#cart_self').height(windowHeight-311);
        }
        if (win.width() > 991) {
            var windowHeight = $(window).height();
            $('#product_self').height(windowHeight-200);
            $('#cart_self').height(windowHeight-318);
        }

    });

    $(window).on('resize', function(){
        var win = $(this); //this = window
        if (win.width() <= 991) {
            var windowHeight = $(window).height();
            $('#product_self').height(windowHeight-200);
            $('#cart_self').height(windowHeight-311);
        }
        if (win.width() <= 647) {
            var windowHeight = $(window).height();
            $('#product_self').height(windowHeight-200);
            $('#cart_self').height(windowHeight-311);
        }
        if (win.width() > 991) {
            var windowHeight = $(window).height();
            $('#product_self').height(windowHeight-200);
            $('#cart_self').height(windowHeight-318);
        }
    });

    //Replace url value
    function replaceUrlParam(url, paramName, paramValue)
    {
        if (paramValue == null) {
            paramValue = '';
        }
        var pattern = new RegExp('\\b('+paramName+'=).*?(&|#|$)');
        if (url.search(pattern)>=0) {
            return url.replace(pattern,'$1' + paramValue + '$2');
        }
        url = url.replace(/[?#]$/,'');
        return url + (url.indexOf('?')>0 ? '&' : '?') + paramName + '=' + paramValue;
    }



    //load product on load and on scroll
    var ENDPOINT = "{{ url('/') }}";
    var page = 1;


    var c = null;



    if("{{ Request::get('search') }}"){
        c = 1;
    }

    if(c==null){
        var load_url="?page=";
    }
    else{
        var load_url=document.URL+"&page=";
    }

    $( document ).ready(function() {
        //console.log( "ready!" );
        infinteLoadMore(page);
        update_cart_html();
    });

    $('#product_self').scroll(function () {
        if ($('#product_self').scrollTop() + $('#product_self').height()+300 >= $(document).height()) {
            page++;
            infinteLoadMore(page);
        }
    });

    function load_more_products(){
        page++;
        infinteLoadMore(page);
    }
    function infinteLoadMore(page) {
        $.ajax({
                url: load_url+page,
                datatype: "html",
                type: "get",
                beforeSend: function () {
                    $('.auto-load').show();
                    $('#load_more_btn').hide();
                }
            })
            .done(function (response) {
                if (response.length == 0) {
                    $('.auto-load').html("<b>আর কোন পণ্য অবশিষ্ট নেই</b>");
                    $('#load_more_btn').hide();
                    return;
                }
                $('.auto-load').hide();
                $('#load_more_btn').show();
                $("#data-wrapper").append(response);
            })
            .fail(function (jqXHR, ajaxOptions, thrownError) {
                console.log('Server error occured');
            });
    }


    //remove variable from link
    function removeParam(key, sourceURL) {
        var rtn = sourceURL.split("?")[0],
            param,
            params_arr = [],
            queryString = (sourceURL.indexOf("?") !== -1) ? sourceURL.split("?")[1] : "";
        if (queryString !== "") {
            params_arr = queryString.split("&");
            for (var i = params_arr.length - 1; i >= 0; i -= 1) {
                param = params_arr[i].split("=")[0];
                if (param === key) {
                    params_arr.splice(i, 1);
                }
            }
            if (params_arr.length) rtn = rtn + "?" + params_arr.join("&");
        }
        return rtn;
    }

    var urlParams = $(location).attr('href').split("?");
    var new_url='';

    //find product
    function find_product_selforder(){
        var data = $('#find-product').val();
       if(data){
        if(urlParams[1]){
            if("{{ Request::get('search') }}"){
                url = document.URL;
                new_url = replaceUrlParam(url, 'search' , data);
            }
            else{
                new_url = document.URL+"&search="+data;
            }
        }
        else{
           new_url = "?search="+data;
        }
      }
      else{
        new_url = removeParam("search", document.URL);
      }
      window.location.href = new_url;
    }

</script>


<script>
    //Get customer data
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
        });
    }

    //change location
      function changelocation(){
          var val = document.getElementById('location').value;
          $('#delivery_charge').val(val);
          $('#total_delivery').html(val);
          cart_total_price();
      }
    //cart total price
      function cart_total_price(){
            var total = $('#total_price').text();
            var delivary =0;
            var advance =0;
            $('#delivery_charge').val()? delivary = $('#delivery_charge').val() : delivary = 0;
            $('#advance').val()? advance = $('#advance').val() : advance = 0;

          document.getElementById("total_amnt").innerHTML = parseFloat(delivary)+parseFloat(total)-parseFloat(advance);
      }
  </script>
  <script>
    //add to cart
    function add_to_cart(product_id,attribute_id,product_image,product_name,product_price,product_mrp,product_qty){
        var url = "{{asset('/')}}add-to-cart";
        $.ajax({
            url: url,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                P_id : product_id,
                P_attr : attribute_id,
                P_img : product_image,
                P_name : product_name,
                P_price : product_price,
                P_mrp : product_mrp,
                p_qty : product_qty
            },
            dataType: 'JSON',
            success:function(response)
            {
                //$('.cart-label').html(response.length);
                update_cart_html();
                //console.log(response)
            },
            error: function(response) {
            }
        });
    }

    //Update cart data
    function update_cart_html() {
        $.ajax({
            url: ENDPOINT + "/admin/self-order/update-cart-html",
            datatype: "html",
            type: "get",
        })
        .done(function (response) {
            if (response.product.length == 0) {
                $('#self-cart-wrapper').html("<center><h3>Your cart is empty</h3></center>");
                return;
            }
            //console.log(response);
            $("#self-cart-wrapper").html(response.product);
            $('#total_price').text(response.total)
        })
        .fail(function (jqXHR, ajaxOptions, thrownError) {
            console.log('Server error occured');
        });
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
          //$('.cart-label').html(response.length);
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
          //$('.cart-label').html(response.length);
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
          //$('.cart-label').html(response.length);
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
  }
  </script>
@endsection

