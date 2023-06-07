@extends('front/layout')
@section('page_title',$product[0]->name)
@section('container')


  <!-- product category -->
  <section id="aa-product-details">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-product-details-area">
            <div class="aa-product-details-content">
              <div class="row">
                <!-- Modal view slider -->
                <div class="col-md-5 col-sm-5 col-xs-12">
                  <div class="aa-product-view-slider">
                    <div id="demo-1" class="simpleLens-gallery-container">
                      <div class="simpleLens-container">
                        <div class="simpleLens-big-image-container"><a data-lens-image="{{asset('storage/media/'.$product[0]->image)}}" class="simpleLens-lens-image"><img src="{{asset('storage/media/'.$product[0]->image)}}" class="simpleLens-big-image"></a></div>
                      </div>
                      <div class="simpleLens-thumbnails-container">
                          <a data-big-image="{{asset('storage/media/'.$product[0]->image)}}" data-lens-image="{{asset('storage/media/'.$product[0]->image)}}" class="simpleLens-thumbnail-wrapper" href="#"><img src="{{asset('storage/media/'.$product[0]->image)}}" width="70px">
                          </a>

                          @if(isset($product_images[$product[0]->id][0]))

                            @foreach($product_images[$product[0]->id] as $list)

                            <a data-big-image="{{asset('storage/media/'.$list->images)}}" data-lens-image="{{asset('storage/media/'.$list->images)}}" class="simpleLens-thumbnail-wrapper" href="#"><img src="{{asset('storage/media/'.$list->images)}}" width="70px">
                            </a>

                            @endforeach

                          @endif

                      </div>
                    </div>
                  </div>
                </div>
                <style>
                    .mobile-order-button{
                        display:none;
                    }
                    @media only screen and (max-width:991px){
                        .mobile-order-button{
                            display:block;
                        }
                    }
                    .desktop-order-button{
                        display:block;
                    }
                    @media only screen and (max-width:991px){
                        .desktop-order-button{
                            display:none;
                        }
                    }
                </style>
                <!-- Modal view content -->
                <div class="col-md-7 col-sm-7 col-xs-12">
                  <div class="aa-product-view-content">

                    <!--Mobile order button-->
                    <div class="aa-prod-view-bottom mobile-order-button">
                      {{-- <a class="aa-add-to-cart-btn" href="javascript:void(0)" onclick="add_to_cart('{{$product[0]->id}}','{{$product_attr[$product[0]->id][0]->size_id}}','{{$product_attr[$product[0]->id][0]->color_id}}')">Add To Cart</a> --}}
                        {{-- <a class="btn custom-btn buy-btn" href="#" onclick="placeorder_btn('cart','{{$product_attr[$product[0]->id][0]->color_id}}','{{$product_attr[$product[0]->id][0]->size_id}}');" style="cursor: pointer!important;"><span class="fa fa-shopping-bag"></span> অর্ডার করুন</a> --}}
                        <div style="display: inline-flex;width: 100%;">
                            <button class="btn custom-btn buy-btn" onclick="placeorder_btn('buy','{{$product_attr[$product[0]->id][0]->color_id}}','{{$product_attr[$product[0]->id][0]->size_id}}','{{ $product[0]->id }}');" style="cursor: pointer!important;border-top-right-radius:0px;border-bottom-right-radius:0px;"><span class="fa fa-shopping-bag"></span> অর্ডার করুন</button>
                            <button class="btn custom-btn cart-btn" onclick="placeorder_btn('cart','{{$product_attr[$product[0]->id][0]->color_id}}','{{$product_attr[$product[0]->id][0]->size_id}}','{{ $product[0]->id }}');" style="cursor: pointer!important;border-top-left-radius:0px;border-bottom-left-radius:0px;"><span class="fa fa-shopping-cart"></span></button>
                        </div>
                    </div>




                    <h3 id="product-name">{{$product[0]->name}}</h3>
                    <div class="aa-price-block">
                      <span class="aa-product-view-price" id="off_price" style="color: green; font-size:20px;">৳ {{$product_attr[$product[0]->id][0]->price}}&nbsp;&nbsp;</span>
                      <del><span class="aa-product-view-price" id="mrp_price" style="color: red; font-size:20px;">৳ {{$product_attr[$product[0]->id][0]->mrp}}</span></del>
                      <p class="aa-product-avilability">Avilability: <span>In stock</span></p>

                       @if($product[0]->lead_time!='')
                       <p class="lead_time">
                       {{$product[0]->lead_time}}
                       </p>
                       @endif

                    </div>
                    <p>
                    {!!$product[0]->short_desc!!}
                    </p>
                    <p style="color: rgb(13, 135, 175);">
                        Model: {{$product[0]->model}}
                    </p>


                    @if($product_attr[$product[0]->id][0]->size_id>0)
                    <div style="display: inline-flex; width:100%;">
                    <h4>Size:&nbsp;&nbsp;</h4>
                        <div class="aa-prod-view-size">
                            @php
                                $arrSize=[];
                            @endphp
                            @foreach($product_attr[$product[0]->id] as $attr)
                                @if (!in_array($attr->size, $arrSize))
                                    @if($attr!='')
                                        <a href="javascript:void(0)" onclick="showColor('{{$attr->size}}');setsizeatrr('{{$attr->size_id}}');" id="size_{{$attr->size}}" class="size_link">{{$attr->size}}</a>
                                    @endif
                                @endif
                                @php
                                    $arrSize[]=$attr->size;
                                    $arrSize=array_unique($arrSize);
                                @endphp
                            @endforeach
                        </div>
                    </div>
                    @endif


                    @if($product_attr[$product[0]->id][0]->color_id>0)
                    <div style="display: inline-flex; width:100%;">
                        <h4>Color:&nbsp;&nbsp;</h4>
                        <div class="aa-color-tag">
                        @foreach($product_attr[$product[0]->id] as $attr)

                            {{-- @php
                                dd($attr);
                            @endphp --}}
                        @if($attr->color!='')

                        <a href="javascript:void(0)" class="aa-color-{{strtolower($attr->color)}} product_color size_{{$attr->size}}"  onclick="setatrr('{{$attr->color_id}}','{{$attr->price}}','{{$attr->mrp}}');change_product_color_image('{{asset('storage/media/'.$attr->attr_image)}}','{{$attr->color}}')"></a>
                        @endif

                        @endforeach
                        </div>
                    </div>
                    @endif

                    <div style="display: inline-flex; width:100%;">
                        <h4>Quantity:&nbsp;&nbsp;</h4>
                        <div class="p-5" style="display: inline-flex; flex-wrap: nowrap;">
                            <input type="button" class="form-control" class="btn btn-danger" value="-" style="border-top-right-radius:0px;border-bottom-right-radius:0px;" onclick="parseInt($(`#cart-qty`).val())>1?$(`#cart-qty`).val(parseInt($(`#cart-qty`).val())-1) : '';">
                            <input type="text" readonly class="form-control" id="cart-qty" value="1" style="width:50px!important; text-align:center; border-radius:0px;">
                            <input type="button" class="form-control" class="btn btn-success" value="+" style="border-top-left-radius:0px;border-bottom-left-radius:0px;" onclick="$(`#cart-qty`).val(parseInt($(`#cart-qty`).val())+1);">
                        </div>
                    </div>

                    <div>
                        <h4 style="color: green; font-weight: bold; font-size:20px;">ফোনে অর্ডার করতে কল করুন- <span style="font-family:Arial, Helvetica, sans-serif;">{{ env('SITE_PHONE') }}</span></h4>
                    </div>

                    <div class="aa-prod-view-bottom desktop-order-button">
                      {{-- <a class="aa-add-to-cart-btn" href="javascript:void(0)" onclick="add_to_cart('{{$product[0]->id}}','{{$product_attr[$product[0]->id][0]->size_id}}','{{$product_attr[$product[0]->id][0]->color_id}}')">Add To Cart</a> --}}
                        {{-- <a class="btn custom-btn buy-btn" href="#" onclick="placeorder_btn('cart','{{$product_attr[$product[0]->id][0]->color_id}}','{{$product_attr[$product[0]->id][0]->size_id}}');" style="cursor: pointer!important;"><span class="fa fa-shopping-bag"></span> অর্ডার করুন</a> --}}
                        <div style="display: inline-flex;width: 100%;">
                            <button class="btn custom-btn buy-btn" onclick="placeorder_btn('buy','{{$product_attr[$product[0]->id][0]->color_id}}','{{$product_attr[$product[0]->id][0]->size_id}}','{{ $product[0]->id }}');" style="cursor: pointer!important;border-top-right-radius:0px;border-bottom-right-radius:0px;"><span class="fa fa-shopping-bag"></span> অর্ডার করুন</button>
                            <button class="btn custom-btn cart-btn" onclick="placeorder_btn('cart','{{$product_attr[$product[0]->id][0]->color_id}}','{{$product_attr[$product[0]->id][0]->size_id}}','{{ $product[0]->id }}');" style="cursor: pointer!important;border-top-left-radius:0px;border-bottom-left-radius:0px;"><span class="fa fa-shopping-cart"></span></button>
                        </div>
                    </div>

                    <div id="add_to_cart_msg"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="aa-product-details-bottom">
              <ul class="nav nav-tabs" id="myTab2">
                <li><a href="#description" data-toggle="tab">Description</a></li>
                <li><a href="#technical_specification" data-toggle="tab">Technical Specification</a></li>
                <li><a href="#uses" data-toggle="tab">Uses</a></li>
                <li><a href="#warranty" data-toggle="tab">Warranty</a></li>
                {{-- <li><a href="#review" data-toggle="tab">Reviews</a></li> --}}
              </ul>

              <!-- Tab panes -->
              <div class="tab-content">
                <div class="tab-pane fade in active" id="description">
                  {!!$product[0]->desc!!}
                </div>
                <div class="tab-pane fade" id="technical_specification">
                  {!!$product[0]->technical_specification!!}
                </div>
                <div class="tab-pane fade" id="uses">
                  {!!$product[0]->uses!!}
                </div>
                <div class="tab-pane fade" id="warranty">
                  {!!$product[0]->warranty!!}
                </div>
              </div>
            </div>
            <!-- Related product -->
            <div class="aa-product-related-item">
              <h3>Related Products</h3>
              <div class="aa-related-item-slider">

              @if(isset($related_product[0]))
                    @foreach($related_product as $productArr)
                    <div class="product-back" >
                        <div class="product-image-back">
                            <a href="{{url('product/'.$productArr->slug)}}"><img class="product-img" src="{{asset('storage/media/'.$productArr->image)}}" alt="{{$productArr->name}}"></a>
                            <h4><a class="product-title" href="{{url('product/'.$productArr->slug)}}">{{$productArr->name}}</a></h4>
                        </div>

                        @foreach($all_product_attr as $pArr)
                        @if ($pArr->products_id==$productArr->id)
                        <div class="product-btn-back">
                            <span class="product-price" style="color: green;">৳  {{$pArr->price}} </span><span class="product-price" style="color: red;"> <del>৳  {{$pArr->mrp}}</del></span>
                            <br>
                            <div style="display: inline-flex;width: 100%;">
                                <button class="btn custom-btn buy-btn" onclick="buy_now('{{$productArr->id}}','{{$pArr->id}}','{{$productArr->image}}','{{$productArr->name}}','{{$pArr->price}}','{{$pArr->mrp}}',1)" style="cursor: pointer!important;border-top-right-radius:0px;border-bottom-right-radius:0px;"><span class="fa fa-shopping-bag"></span> অর্ডার করুন</button>
                                <button class="btn custom-btn cart-btn" onclick="add_to_cart('{{$productArr->id}}','{{$pArr->id}}','{{$productArr->image}}','{{$productArr->name}}','{{$pArr->price}}','{{$pArr->mrp}}',1)" style="cursor: pointer!important;border-top-left-radius:0px;border-bottom-left-radius:0px;"><span class="fa fa-shopping-cart"></span></button>
                            </div>
                        </div>
                        @break
                        @endif
                    @endforeach

                    </div>
                    @endforeach
                @else
                <div>
                    <figure>
                    No data found
                    <figure>
                <div>
                @endif


                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
@section('script')
<script>
    var select_size = 0;
    var select_color = 0;
    var c_id = 0;
    var s_id = 0;

    //set size
    function setsizeatrr(size_id){
        select_size=1;
        s_id=size_id;
        //alert('size:'+ size_id);
    }

    //set color
    function setatrr(color_id,off_price,mrp_price){
        c_id=color_id;
        select_color=1;
        document.getElementById("off_price").innerHTML = '৳ '+off_price+' ';
        document.getElementById("mrp_price").innerHTML = '৳ '+mrp_price;
        //alert('color:' +color_id);
    }

    //place order
    function placeorder_btn(type,color,size,product_id){
        if(color==0 && size==0){
            //window.location.href = l+'/product?c='+c_id+'&s='+s_id+'&q='+qty;
            submit_order(type,c_id,s_id,product_id);
        }
        else if(color>0 && size==0){
            if(select_color==0){
                alert("Please Select Color!");
            }
            else{
                //window.location.href = l+'/product?c='+c_id+'&s='+s_id+'&q='+qty;
                submit_order(type,c_id,s_id,product_id);
            }
        }
        else if( size>0 && color==0){
            if(select_size==0){
                alert("Please Select Size!");
            }
            else{
                //window.location.href = l+'/product?c='+c_id+'&s='+s_id+'&q='+qty;
                submit_order(type,c_id,s_id,product_id);
            }
        }
        else{
            if(select_size==0){
                alert("Please Select Size!");
            }
            else if(select_color==0){
                alert("Please Select Color!");
            }
            else{
                //window.location.href = l+'/product?c='+c_id+'&s='+s_id+'&q='+qty;
                submit_order(type,c_id,s_id,product_id);
            }
        }
    }

    //submit order
    function submit_order(type,color,size,product_id){
        var url = "{{asset('/')}}get-attribute-id";
        $.ajax({
            url: url,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                color : color,
                size : size,
                product_id: product_id,
            },
            dataType: 'JSON',
            success:function(response)
            {
                if(type=='cart'){
                    add_to_cart(response.products_id,response.id,response.attr_image,$('#product-name').text(),response.price,response.mrp,$('#cart-qty').val());
                    alert("This product has been added on cart.");
                }
                if(type=='buy'){
                    buy_now(response.products_id,response.id,response.attr_image,$('#product-name').text(),response.price,response.mrp,$('#cart-qty').val());
                }
                //console.log(response)
            },
            error: function(response) {
            }
        });
    }
</script>
@endsection
