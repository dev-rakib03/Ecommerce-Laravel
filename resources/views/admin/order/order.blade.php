@extends('admin/layout')
@section('page_title','Order')
@section('order_select','active')
@section('container')

    <!-- Include Date Range Picker -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />

    <h1 class="mb10">Order</h1>
    <div class="row">
        <div class="col-md-2">
            <label for="status_box">Status</label><br>
            <div class="input-group mb-2">
                @php
                    if(Request::get('status')){
                        $order_details = Request::get('status');
                    }
                    else{
                        $order_details = '';
                    }
                @endphp

                <select class="form-control float-left" id="status_box" name="status">
                    <option value="" >-select-</option>
                    <option value="pending" {{$order_details=='pending'?'selected':''}}>Pending</option>
                    <option value="pending payment" {{$order_details=='pending payment'?'selected':''}}>Pending Payment</option>
                    <option value="confirm" {{$order_details=='confirm'?'selected':''}}>Confirm</option>
                    <option value="processing" {{$order_details=='processing'?'selected':''}}>Processing</option>
                    <option value="oncourier" {{$order_details=='oncourier'?'selected':''}}>Oncourier</option>
                    <option value="delivered" {{$order_details=='delivered'?'selected':''}}>Delivered</option>
                    <option value="canceled" {{$order_details=='canceled'?'selected':''}}>Canceled</option>
                </select>
            </div>
        </div>

        <div class="col-md-4">
            <label for="date">Date</label><br>
            <div class="input-group mb-2">

                <input type="text"  class="form-control" name="daterange" value=""/>
                <div class="input-group-append">
                    <button class="btn btn-danger" onclick="remove_date_filter();" >Clear</button>
                </div>

            </div>
        </div>
        <div class="col-md-6">
                <label for="search_box">Search</label><br>
                <form id="search_product">
                <div class="input-group mb-3">
                    <input type="text" id="search_box" class="form-control" placeholder="Customer Name or Phone or Order Id" aria-label="Customer Name or Phone or Order Id" aria-describedby="basic-addon2" value="{{ Request::get('search')? Request::get('search') : '' }}">
                    <div class="input-group-append">
                        <input type="submit" class="btn btn-warning" value="Search">
                    </div>
                </div>
                </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- DATA TABLE-->
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3" style="min-width: 900px;">
                    <tbody  id="data-wrapper">

                    </tbody>
                </table>

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
            <!-- END DATA TABLE-->
        </div>
    </div>

    <style>
        .status-form-back{
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

    {{-- Status form --}}
    <div class="status-form-back">
        @include('admin.order.element.status')
    </div>

@endsection

@section('script')
<script>
    //Load orders
    var ENDPOINT = "{{ url('/') }}";
    var page = 1;
    var c = null;



    if("{{ Request::get('status') }}" || "{{ Request::get('search') }}" || "{{ Request::get('from_date') }}" || "{{ Request::get('to_date') }}"){
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
                    $('.auto-load').html("No More Order Available");
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
    //console.log(urlParams[1]);

    //status filter
    $('#status_box').on('change', function(e) {
        e.preventDefault();
      var data = $('#status_box').val();
      if(data){
        if(urlParams[1]){
            if("{{ Request::get('status') }}"){
                url = document.URL;
                new_url = replaceUrlParam(url, 'status' , data);
            }
            else{
                new_url = document.URL+"&status="+data;
            }
        }
        else{
           new_url = "?status="+data;
        }
      }
      else{
        new_url = removeParam("status", document.URL);
      }
      window.location.href = new_url;

   });

   //search
    $('#search_product').on('submit', function(e) {
        e.preventDefault();
       var data = $('#search_box').val();
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
   });



   //date filter
    function search_order_with_date(fron_date,to_date){
       var data_from = fron_date;
       var data_to = to_date;

       if(data_from){

            if(data_to){
                if(urlParams[1]){
                    if("{{ Request::get('to_date') }}"){
                        url = document.URL;
                        new_url = replaceUrlParam(url, 'to_date' , data_to);
                        new_url = replaceUrlParam(new_url, 'from_date' , data_from);
                    }
                    else{
                        new_url = document.URL+"&from_date="+data_from+"&to_date="+data_to;
                    }
                }
                else{
                   new_url = "?from_date="+data_from+"&to_date="+data_to;
                }
              }
              window.location.href = new_url;
       }
       else{
           alert('Select Form Date!')
           $('#to_date_box').val('');
       }
   }

   function remove_date_filter() {
    var new_url = removeParam("from_date", document.URL);
    new_url = removeParam("to_date", new_url);
    window.location.href = new_url;
   }

    //show status update form
    function update_status(order_id,order_status,order_note){
        $('.status-form-back').show();
        $('#order_id').val(order_id);
        $('#order_status').val(order_status);
        $('#order_note').val(order_note);
    }

    //Update status info
    function update_order_status_info(){
        var url = "{{asset('/')}}admin/update-order-status";
        $.ajax({
            url: url,
            method: 'POST',
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                o_id : $('#order_id').val(),
                o_status : $('#order_status').val(),
                o_note: $('#order_note').val(),
            },
            dataType: 'JSON',
            success:function(response)
            {
                if(response.status=='ok'){
                    location.reload();
                }
            },
            error: function(response) {
            }
        });
   }


</script>
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<script type="text/javascript">
    $(function() {
    $('input[name="daterange"]').daterangepicker({
        }, function(start, end, label) {
            search_order_with_date(start.format('YYYY-MM-DD'),end.format('YYYY-MM-DD'));
            //console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
    });
</script>
@endsection
