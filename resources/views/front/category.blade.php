@extends('front/layout')
@section('page_title','Category')
@section('container')

  <!-- product category -->
<section id="aa-product-category">
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
                  <path fill="#41bffa"
                      d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
                      <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s"
                          from="0 50 50" to="360 50 50" repeatCount="indefinite" />
                  </path>
              </svg>
          </div>
          <center>
              <button class="btn btn-warning" id="load_more_btn" onclick="load_more_products();">Load More</button>
          </center>
          <br>

         </div>

      </div>
   </div>
</section>
<!-- / product category -->

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
                url: "?page=" + page,
                datatype: "html",
                type: "get",
                beforeSend: function () {
                    $('.auto-load').show();
                    $('#load_more_btn').hide();
                }
            })
            .done(function (response) {
                if (response.length == 0) {
                    $('.auto-load').html("No More product Available");
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
