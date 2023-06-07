@extends('admin/layout')
@section('page_title','Users')
@section('customer_select','active')
@section('container')
    <h1 class="mb10">All-Users</h1>

    <div class="row m-t-30">
        <div class="col-md-12">
            <!-- DATA TABLE-->
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Address</th>
                        </tr>
                    </thead>
                    <tbody id="data-wrapper">

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
                    $('.auto-load').html("No More User Available");
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

