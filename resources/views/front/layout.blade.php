<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{env('SITE_NAME')}}-@yield('page_title')</title>

    <link rel="icon" type="image/x-icon" href="{{asset('/')}}front_assets/favicon.png">

    <link href="{{asset('/front_assets/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('/front_assets/css/jquery.smartmenus.bootstrap.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('/front_assets/css/jquery.simpleLens.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/front_assets/css/slick.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/front_assets/css/nouislider.css')}}">
    <link id="switcher" href="{{asset('/front_assets/css/theme-color/default-theme.css')}}" rel="stylesheet">
    <link href="{{asset('/front_assets/css/sequence-theme.modern-slide-in.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('/front_assets/css/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Google Font -->
    <link href='//fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script>
    var PRODUCT_IMAGE="{{asset('storage/media/')}}";
    </script>
    <style>
        .custom-btn{
            width: 100%;
            background: #20bcaf;
            padding-bottom: 5px;
            padding-right: 2px;
            border:none;
            border-radius: 5px;
            font-size: 16px;
            color: #fff;
        }
        .custom-btn:hover{
            color: #fff;
        }

        /*product layout css*/
        .product-background{
            width: 100%;
            display: inline-flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }
        .product-image-back{
            height: 200px;
            overflow: hidden;
        }
        .product-btn-back{
            /*height: 50px;*/
        }
        .product-back{
            margin: 5px;
            padding: 10px;
            width: 215px;
            border: 1px solid rgb(0,0,0,.2);
            border-radius: 10px;
        }
        .product-img{
            height: 170px;
            width: 100%;
            object-fit: cover;
        }

        @media only screen and (max-width:767px){
            .pc-logo-display-none{
                display:none!important;
            }
        }

        @media only screen and (min-width:767px){
            .mobile-logo-display-none{
                display:none!important;
            }
        }

        @media only screen and (max-width:767px){
            .mobile-menu-opt-border{
                border: 1px solid #ffff;
            }
        }
        .cart-btn{
            padding: 0 5px 0px 5px;
            background: rgb(247 147 35)!important;
            font-size: 15px;
        }
        .buy-btn{
            font-size: 15px;
        }
        .cart-btn:focus {
          color:#fff;
          outline: none;
        }
        .cart-label{
          background: red;
          height: 20px;
          width: 20px;
          text-align: center;
          color: #fff;
          border-radius: 50%;
          position: relative;
          left: -10px;
          top: -11px;
          cursor: pointer;
        }

        @media only screen and (max-width:449px){
            .product-back{
                width: 177px;
            }
            .cart-btn{
                font-size: 12px;
            }
            .buy-btn{
                font-size: 12px;
            }
        }
    </style>

    @if(Route::is('order.cart') )
        <style>

            @media only screen and (max-width:991px){
                .aa-search-box{
                    display: none;
                }
            }
        </style>
    @endif
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Meta Pixel Code -->
    @php
        require_once(public_path('/front_assets/fb_pixel.php'));
    @endphp
    <!-- End Meta Pixel Code -->
    {{-- Custom CSS --}}
    <link href="{{asset('front_assets/css/admin_custom.css')}}" rel="stylesheet" media="all">
  </head>
  <body class="productPage">
   <!-- wpf loader Two -->
    {{-- <div id="wpf-loader-two">
      <div class="wpf-loader-two-inner">
        <span>Loading</span>
      </div>
    </div>  --}}
    <!-- / wpf loader Two -->
  <!-- SCROLL TOP BUTTON -->
    <a class="scrollToTop" href="#"><i class="fa fa-chevron-up"></i></a>
  <!-- END SCROLL TOP BUTTON -->


  <!-- Start header section -->
  <header id="aa-header" style="border-bottom: 1px solid rgb(0,0,0,.2)">
    <!-- start header top  -->
    <div class="aa-header-top hidden-xs">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="aa-header-top-area">
              <!-- start header top left -->
              <div class="aa-header-top-left">

                <!-- start cellphone -->
                <div class="cellphone hidden-xs">
                  <p><span class="fa fa-phone"></span> <a href="tel:{{env('SITE_PHONE')}}"><b>{{env('SITE_PHONE')}}</b></a></p>
                </div>


                <div class="cellphone hidden-xs">
                  <p><span class="fa fa-envelope"></span> <a href="mailto:{{env('SITE_EMAIL')}}" style="color:black;">{{env('SITE_EMAIL')}}</a></p>

                </div>


                <!-- / cellphone -->
              </div>
              <!-- / header top left -->
              <div class="aa-header-top-right">
                <ul class="aa-head-top-nav-right">

                  <li class="hidden-xs">
                    <a href="{{url('/cart')}}" style="position: relative;top: 7px;padding:0px!important;border:none!important;">
                      <i class="fa-solid fa-cart-shopping"></i>
                      <label class="cart-label">{{Session::has('cart_product')?count(Session::get('cart_product')):'0'}}</label>
                    </a>
                  </li>

                  <li class="hidden-xs">
                    <a href="{{url('/order-tracking')}}" style="position: relative; border-right:none!important; border-left: 1px solid #ddd;">
                      <i class="fas fa-shipping-fast"></i>
                    </a>
                  </li>

                  {{--@if(session()->has('FRONT_USER_LOGIN')!=null)
                  <li><a href="{{url('/order')}}">My Order</a></li>
                  <li><a href="{{url('/logout')}}">Logout</a></li>
                  @else
                    <li><a href="" data-toggle="modal" data-target="#login-modal">Login</a></li>
                  @endif--}}


                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- / header top  -->

    <!-- start header bottom  -->
    <div class="aa-header-bottom  pc-logo-display-none">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="aa-header-bottom-area">
              <!-- logo  -->
              <div class="aa-logo pc-logo-display-none" >
                <!-- Text based logo -->
                {{--<a href="{{url('/')}}">
                  <span class="fa fa-shopping-cart"></span>
                  <p>Demo<strong>Shop</strong> <span>Your Shopping Partner</span></p>
                </a>--}}
                <!-- img based logo -->
                 <a href="{{url('/')}}"><img src="{{asset('/')}}front_assets/logo.png" alt="logo img" style="height:60px;"></a>
              </div>
              <!-- / logo  -->
               <!-- cart box -->
              {{-- @php
              $getAddToCartTotalItem=getAddToCartTotalItem();
              $totalCartItem=count($getAddToCartTotalItem);
              $totalPrice=0;
              @endphp --}}
              {{-- <div class="aa-cartbox">
                <a class="aa-cart-link" href="#" id="cartBox">
                  <span class="fa fa-shopping-basket"></span>
                  <span class="aa-cart-title">SHOPPING CART</span>
                  <span class="aa-cart-notify">{{$totalCartItem}}</span>
                </a>
                <div class="aa-cartbox-summary">
               @if($totalCartItem>0)

                  <ul>
                    @foreach($getAddToCartTotalItem as $cartItem)

                    @php
                    $totalPrice=$totalPrice+($cartItem->qty*$cartItem->price)
                    @endphp
                    <li>
                      <a class="aa-cartbox-img" href="#"><img src="{{asset('storage/media/'.$cartItem->image)}}" alt="img"></a>
                      <div class="aa-cartbox-info">
                        <h4><a href="#">{{$cartItem->name}}</a></h4>
                        <p>{{$cartItem->qty}} * Rs {{$cartItem->price}}</p>
                      </div>
                    </li>
                    @endforeach
                    <li>
                      <span class="aa-cartbox-total-title">
                        Total
                      </span>
                      <span class="aa-cartbox-total-price">
                        Rs {{$totalPrice}}
                      </span>
                    </li>
                  </ul>
                  <a class="aa-cartbox-checkout aa-primary-btn" href="{{url('/cart')}}">Cart</a>

                @endif
                </div>
              </div> --}}
              <!-- / cart box -->
              <!-- search box -->
              <div class="aa-search-box">
                  <input type="text" id="search_str" placeholder="Search here ex. 'man' ">
                  <button type="button" onclick="document.getElementById('search_str').value?window.location.href='/search/'+document.getElementById('search_str').value:'';"><span class="fa fa-search"></span></button>
              </div>

              <!-- / search box -->
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- / header bottom  -->
  </header>
  <!-- / header section -->

{{--@if(!Route::is('order.cart') )--}}

    <style>
        #menu .menu-area .navbar-default .navbar-nav .open a {
            background-color: rgb(0,0,0,0)!important;
            color:#fff!important;
            padding: 10px!important;
        }

        #menu .menu-area .navbar-default .navbar-nav a {
            background-color: rgb(0,0,0,0)!important;
            color: #fff!important;
            padding: 10px!important;
        }

        .sub-menu-opt{
            background-color:#09524c;
            padding: 5px;
            width:100%;
            color:#fff;
            font-size:20px;
            margin-top: 5px;
            border: 1px solid #fff;
            cursor:pointer;
        }
    </style>
  <!-- menu -->
  <section id="menu" style="padding: 5px 0px;">
    <div class="container">
      <div class="menu-area">
        <!-- Navbar -->
        <div class="navbar navbar-default" role="navigation">
          <div class="navbar-header">



            <!-- mobile nav button -->
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse" style="float: left!important;">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>


            <div style="float: right!important; display:inline-flex;">
                <!--Search mobile button-->
                <button type="button" onclick="mobileSearchbar();" style=" background: rgb(0,0,0,0); border:none; font-size:20px; color:#fff; margin-top: 10px;" class="mobile-logo-display-none"><span class="fa fa-search ss"></span></button>
                <a class="visible-xs-block" style="margin-left: 3px; margin-right: 10px; margin-top: 15px;color:#fff;" href="{{url('/order-tracking')}}"><i class="fas fa-shipping-fast"></i></a>
                <a class="visible-xs-block" style="margin-left: 3px; margin-right: -13px; margin-top: 15px;color:#fff;" href="{{url('/cart')}}"><i class="fa-solid fa-cart-shopping"></i><label class="cart-label">{{Session::has('cart_product')?count(Session::get('cart_product')):'0'}}</label></a>

              </div>

            <center>
                <!-- img mobile based logo -->
                <a class="mobile-logo-display-none mobile-logo" href="{{url('/')}}" style="margin-left: 4%;"><img src="{{asset('/')}}front_assets/logo.png" alt="logo img" style="height:50px;"></a>
                <!-- mobile search -->
                <div class="mobile-search-box mobile-logo-display-none " style=" margin-top: 10px; display:none;">
                  <input type="text" id="mobile_search_str" placeholder="Search here ex. 'man' " style="width:50%; border-radius:15px; border: 0px solid; padding:5px;">
                  <button type="button" onclick="document.getElementById('mobile_search_str').value?window.location.href='/search/'+document.getElementById('mobile_search_str').value:'';"  style="/*width:60%; */ margin-left:-20px; border-top-right-radius:15px;border-bottom-right-radius:15px; border: 0px solid; padding:5px;"><span class="fa fa-search"></span></button>
              </div>
            </center>



          </div>
            @php
                $category = DB::table('categories')->where(['status'=>1])->where('parent_category_id',0)->get();
                $subcategory = DB::table('categories')->where(['status'=>1])->where('parent_category_id','>',0)->get();
                //dd($category);
            @endphp

            <div class="navbar-collapse collapse">
            <!-- Left nav -->

            <ul class="navbar-nav">
                @php
                    $havesubmenu = 0;
                @endphp
                @foreach($category as $nav)
                    @if($nav->parent_category_id==0)

                        @foreach($subcategory as $csubnav)
                            @if($csubnav->parent_category_id==$nav->id)
                                @php
                                    $havesubmenu = 1;
                                @endphp
                            @break
                            @endif
                        @endforeach

                    <li class="nav-item dropdown mobile-menu-opt-border" style="padding:5px;">
                      <a class="nav-link dropdown-toggle"  style="font-size:20px;" href="{{$havesubmenu==0?asset('/').'category/'.$nav->category_slug:'#'}}" <?php if($havesubmenu!=0){ ?> id="navbardrop" data-toggle="dropdown" <?php } ?>    style="padding: 0px 15px 0px 0px!important;">
                        {{$nav->category_name}}
                        @if($havesubmenu==1)
                        <i class="fa fa-caret-down"></i>
                        @endif
                      </a>


                      @if($havesubmenu==1)
                        <div class="dropdown-menu">
                          @foreach($subcategory as $subnav)
                            @if($subnav->parent_category_id==$nav->id)
                               {{-- <a class="dropdown-item"  style="font-size:20px;" href="{{ asset('/')}}category/{{$subnav->category_slug}}">--}}
                                    <div class="sub-menu-opt" onclick="location.href=`{{ asset('/')}}category/{{$subnav->category_slug}}`;">{{$subnav->category_name}}</div>
                               {{-- </a> --}}
                            @endif
                          @endforeach
                        </div>
                      @endif


                    </li>
                    @php
                        $havesubmenu = 0;
                    @endphp
                    @endif
                @endforeach


            </ul>
          </div>


        </div>
      </div>
    </div>
  </section>
  <!-- / menu -->
{{--@endif--}}

<!--main content-->
<div style="min-height: 900px;">
    @yield('container')
</div>


  <!-- footer -->
  <footer id="aa-footer">
    <!-- footer bottom -->
    <div style="padding: 15px 0px 10px 0px!important; color:#fff; text-align:center;">
     <div class="container">

            <div class="row">
              <div class="col-md-3 col-sm-6">
                    <p><span class="fa fa-home"></span> {{env('SITE_ADDRESS')}}</p>
              </div>
              <div class="col-md-3 col-sm-6">
                    <p><span class="fa fa-phone"></span> <a href="tel:{{env('SITE_PHONE')}}" style="color:#fff;">{{env('SITE_PHONE')}}</a></p>
              </div>
              <div class="col-md-3 col-sm-6">
                    <p><span class="fa fa-envelope"></span> <a href="mailto:{{env('SITE_EMAIL')}}" style="color:#fff;">{{env('SITE_EMAIL')}}</a></p>
              </div>
              <div class="col-md-3 col-sm-6">
                    <div class="row">
                        @if(env('SITE_FACEBOOK'))
                            <a style="color: #fff;padding: 0 5px;" href="{{env('SITE_FACEBOOK')}}"><i class="fa-brands fa-facebook"></i></a>
                        @endif
                        @if(env('SITE_TWITTER'))
                            <a style="color: #fff;padding: 0 5px;" href="{{env('SITE_TWITTER')}}"><i class="fa-brands fa-twitter"></i></a>
                        @endif
                        @if(env('SITE_INSTAGRAM'))
                            <a style="color: #fff;padding: 0 5px;" href="{{env('SITE_INSTAGRAM')}}"><i class="fa-brands fa-instagram"></i></a>
                        @endif
                        @if(env('SITE_YOUTUBE'))
                            <a style="color: #fff;padding: 0 5px;" href="{{env('SITE_YOUTUBE')}}"><i class="fa-brands fa-youtube"></i></a>
                        @endif
                    </div>
              </div>

      </div>
     </div>
    </div>
  </footer>
  <!-- / footer -->


  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="{{asset('/front_assets/js/bootstrap.js')}}"></script>
  <script type="text/javascript" src="{{asset('/front_assets/js/jquery.smartmenus.js')}}"></script>
  <script type="text/javascript" src="{{asset('/front_assets/js/jquery.smartmenus.bootstrap.js')}}"></script>
  {{-- <script src="{{asset('front_assets/js/sequence.js')}}"></script> --}}
  {{-- <script src="{{asset('front_assets/js/sequence-theme.modern-slide-in.js')}}"></script> --}}
  <script type="text/javascript" src="{{asset('/front_assets/js/jquery.simpleGallery.js')}}"></script>
  <script type="text/javascript" src="{{asset('/front_assets/js/jquery.simpleLens.js')}}"></script>
  <script type="text/javascript" src="{{asset('/front_assets/js/slick.js')}}"></script>
  <script type="text/javascript" src="{{asset('/front_assets/js/nouislider.js')}}"></script>
  <script src="{{asset('/front_assets/js/custom.js')}}"></script>
  @yield('script')
  <script>
    //mobile nav search
    function mobileSearchbar(){
        if(!$('.mobile-logo').is(':visible'))
        {
            $('.mobile-logo').show();
            $('.mobile-search-box').hide();
            $(".ss").addClass("fa-search");
            $(".ss").removeClass("fa-times");
        }
        else{
            $('.mobile-logo').hide();
            $('.mobile-search-box').show();
            $(".ss").removeClass("fa-search");
            $(".ss").addClass("fa-times");
        }
    }

     //Buy Now
     function buy_now(product_id,attribute_id,product_image,product_name,product_price,product_mrp,product_qty){
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
                $('.cart-label').html(response.length);
                window.location="{{ asset('/cart')}}";
            },
            error: function(response) {
            }
        });
    }

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
                $('.cart-label').html(response.length);
                //console.log(response)
            },
            error: function(response) {
            }
        });
    }

  </script>
    <script src="{{ asset('/') }}front_assets/js/admin_custom.js"></script>
  </body>
</html>
