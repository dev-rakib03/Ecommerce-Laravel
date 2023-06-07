@extends('front/layout')
@section('page_title','Home Page')
@section('container')

<style>
    .seq{
        max-height: 300px!important;
    }
    .title_back{
        background-color: #20bcaf;
        color: #fff;
        padding: 5px;
        font-size: 24px;
    }
    @media only screen and (max-width:991px){
        .seq{
            max-height: 200px!important;
        }
    }
</style>
<section id="aa-slider" style="margin-top: 10px;">
<div class="container" style="padding-right: 0px;padding-left: 0px;">
    <div class="aa-slider-area">
      <div id="sequence" class="seq">
        <div class="seq-screen">
          <ul class="seq-canvas">
            <!-- single slide item -->
            @foreach($home_banner as $list)
            <li>
              <div class="seq-model">
                <a data-seq target="_blank" href="{{$list->btn_link!=''?$list->btn_link : '#'}}">
                    <img data-seq src="{{asset('storage/media/banner/'.$list->image)}}" style="object-fit: cover;"/>
                </a>
              </div>
              {{--@if($list->btn_txt!='')
              <div class="seq-title">
                <a data-seq target="_blank" href="{{$list->btn_link}}" class="aa-shop-now-btn aa-secondary-btn">{{$list->btn_txt}}</a>
              </div>
              @endif--}}
            </li>
            @endforeach
          </ul>
        </div>
        <!-- slider navigation btn -->
        <fieldset class="seq-nav" aria-controls="sequence" aria-label="Slider buttons">
          <a type="button" class="seq-prev" aria-label="Previous"><span class="fa fa-angle-left"></span></a>
          <a type="button" class="seq-next" aria-label="Next"><span class="fa fa-angle-right"></span></a>
        </fieldset>
      </div>
    </div>
</div>
</section>
<!-- / slider -->

<!-- popular section -->


  <section>
    <div class="container">
    </div>
  </section>
<br>

@include('front.product.element.featured')
@include('front.product.element.discount')
@include('front.product.element.tranding')


  <!-- Products section -->
  <section id="aa-product">
    <div class="container title_back">
        <span>All Products</span>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">


            <div class="row">
                  <!-- Tab panes -->
                    <div class="product-background" id="data-wrapper">
                        <!--load product-->
                    </div>
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
    </div>
  </section>
  <!-- / Products section -->


<!-- Client Brand -->
@if(count($home_brand)>0)
    <center>
        <section id="aa-client-brand">
            <div class="container">
            <div class="row">
                <div class="col-md-12">
                <div class="aa-client-brand-area">
                    <ul class="aa-client-brand-slider">
                    @foreach($home_brand as $list)
                    <li><a href="#"><img src="{{asset('storage/media/brand/'.$list->image)}}" alt="{{$list->name}}"></a></li>
                    @endforeach
                    </ul>
                </div>
                </div>
            </div>
            </div>
        </section>
    </center>
  <!-- / Client Brand -->
@endif


<script src="{{asset('front_assets/js/sequence.js')}}"></script>
<script src="{{asset('front_assets/js/sequence-theme.modern-slide-in.js')}}"></script>
@endsection
@section('script')
<script>
    var ENDPOINT = "{{ url('/') }}";
    var page = 1;
    $( document ).ready(function() {
        //console.log( "ready!" );
        infinteLoadMore(page);
    });

    $(window).scroll(function () {
        if ($(window).scrollTop() + $(window).height()+300 >= $(document).height()) {
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
                url: ENDPOINT + "/?page=" + page,
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
</script>
@endsection
