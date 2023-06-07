@foreach($home_categories as $list)
  @if(isset($home_featured_product[$list->id][0]))
    <section>
      <div class="container title_back">
        <span>Featured Products</span>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="row">
              <!-- Tab panes -->
              <div class="aa-related-item-slider">
                @foreach($home_featured_product[$list->id] as $productArr)
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
                      <div style="display: inline-flex; width: 100%;">
                        <button class="btn custom-btn buy-btn" onclick="buy_now('{{$productArr->id}}','{{$pArr->id}}','{{$productArr->image}}','{{$productArr->name}}','{{$pArr->price}}','{{$pArr->mrp}}',1)" style="cursor: pointer!important;border-top-right-radius:0px;border-bottom-right-radius:0px;"><span class="fa fa-shopping-bag"></span> Order Now</button>
                        <button class="btn custom-btn cart-btn" onclick="add_to_cart('{{$productArr->id}}','{{$pArr->id}}','{{$productArr->image}}','{{$productArr->name}}','{{$pArr->price}}','{{$pArr->mrp}}',1)" style="cursor: pointer!important;border-top-left-radius:0px;border-bottom-left-radius:0px;">{{-- <spanclass="fafa-shopping-cart"></span> --}}Add to Cart</button>
                      </div>
                    </div>
                    @break
                    @endif
                  @endforeach
                </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  @endif
@endforeach
