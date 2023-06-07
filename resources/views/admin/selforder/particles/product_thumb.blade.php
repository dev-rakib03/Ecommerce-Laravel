@foreach($products_all_active as $productArr)
<div class="col-sm-3 col-md-3 card m-0 p-2" >
    <a class="card-img-top" href="{{url('product/'.$productArr->slug)}}">
        <img class="product-img" src="{{asset('storage/media/'.$productArr->image)}}" alt="{{$productArr->name}}">
    </a>
    <div class="card-body p-0">
        <h5 class="card-title p-0 m-0"><a href="{{url('product/'.$productArr->slug)}}">{{$productArr->name}}</a></h5>
    </div>
    @foreach($all_product_attr_load as $pArr)
        @if ($pArr->products_id==$productArr->id)
        <div class="product-btn-back">
            <span class="product-price" style="color: green;">৳  {{$pArr->price}} </span><span class="product-price" style="color: red;"> <del>৳  {{$pArr->mrp}}</del></span>
            <div class="text-center" style="width:100%;">
                <button class="btn btn-warning" onclick="add_to_cart('{{$productArr->id}}','{{$pArr->id}}','{{$productArr->image}}','{{$productArr->name}}','{{$pArr->price}}','{{$pArr->mrp}}',1)"><span class="fa fa-shopping-cart"></span> Click To Add</button>
            </div>
        </div>
        @break
        @endif
    @endforeach
</div>
@endforeach

