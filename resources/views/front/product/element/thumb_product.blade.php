 @foreach($products_all_active as $productArr)
<div class="product-back" >
    <div class="product-image-back">
        <a href="{{url('product/'.$productArr->slug)}}"><img class="product-img" src="{{asset('storage/media/'.$productArr->image)}}" alt="{{$productArr->name}}"></a>
        <h4><a class="product-title" href="{{url('product/'.$productArr->slug)}}">{{$productArr->name}}</a></h4>
    </div>
    @foreach($all_product_attr_load as $pArr)
        @if ($pArr->products_id==$productArr->id)
        <div class="product-btn-back">
            <span class="product-price" style="color: green;">৳  {{$pArr->price}} </span><span class="product-price" style="color: red;"> <del>৳  {{$pArr->mrp}}</del></span>
            <br>
            <div style="display: inline-flex;width: 100%;">
                <button class="btn custom-btn buy-btn" onclick="buy_now('{{$productArr->id}}','{{$pArr->id}}','{{$productArr->image}}','{{$productArr->name}}','{{$pArr->price}}','{{$pArr->mrp}}',1)" style="cursor: pointer!important;border-top-right-radius:0px;border-bottom-right-radius:0px;"><span class="fa fa-shopping-bag"></span> Order Now</button>
                <button class="btn custom-btn cart-btn" onclick="add_to_cart('{{$productArr->id}}','{{$pArr->id}}','{{$productArr->image}}','{{$productArr->name}}','{{$pArr->price}}','{{$pArr->mrp}}',1)" style="cursor: pointer!important;border-top-left-radius:0px;border-bottom-left-radius:0px;">{{-- <span class="fa fa-shopping-cart"></span> --}}Add to Cart</button>
            </div>
        </div>
        @break
        @endif
    @endforeach
</div>
@endforeach

