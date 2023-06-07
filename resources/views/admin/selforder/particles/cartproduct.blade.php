
@if(Session::has('cart_product'))
@foreach(Session::get('cart_product') as $product)
<div id="cart-product-{{$product['P_id']}}" style="display: inline-flex; flex-wrap: wrap; justify-content: space-between; width:100%; margin: 5px 0px; border: 1px solid #c1c0c0; padding: 5px;">

    <div>
    <img class="cart-image" src="{{asset('/')}}storage/media/{{$product['P_img']}}" style="max-height: 50px;">
    </div>

    <div style="width: 50%;">
    <h5>{{$product['P_name']}}</h5>
    <span style="font-size: 12px; color:gray;">Color: {{$product['p_color']}} Size:{{$product['p_size']}}</span>
    </div>

    <div>
        <span class="product-price" style="color: red;font-size:12px"> <del>৳  {{$product['P_mrp']}}</del></span>
        <br>
        <span class="product-price" style="color: green;font-size:12px">৳  {{$product['P_price']}} </span>
        <br>
        <label onclick="cart_remove_product({{$product['P_id']}},`#cart-product-{{$product['P_id']}}`); changetotalprice({{$product['P_price']}} , -parseInt($(`#cart-qty-{{$product['P_id']}}`).val()));" style="cursor:pointer;"><i class="fa fa-trash" aria-hidden="true"></i></label>
    </div>

    <div style="">
    <input type="button" class="form-control" class="btn btn-danger" value="-" style=" height:25px; padding: 0; border-top-right-radius:0px;border-bottom-right-radius:0px;" onclick="parseInt($(`#cart-qty-{{$product['P_id']}}`).val())>1?change_cart_qty(-1,{{$product['P_id']}}) : ''; parseInt($(`#cart-qty-{{$product['P_id']}}`).val())>1?changetotalprice({{$product['P_price']}} , -1) :''; parseInt($(`#cart-qty-{{$product['P_id']}}`).val())>1?$(`#cart-qty-{{$product['P_id']}}`).val(parseInt($(`#cart-qty-{{$product['P_id']}}`).val())-1) : '';">
    <input type="text" readonly class="form-control" id="cart-qty-{{$product['P_id']}}" value="{{$product['p_qty']}}" style=" height:25px; width:50px!important; text-align:center; border-radius:0px;">
    <input type="button" class="form-control" class="btn btn-success" value="+" style=" height:25px; padding: 0; border-top-left-radius:0px;border-bottom-left-radius:0px;" onclick="$(`#cart-qty-{{$product['P_id']}}`).val(parseInt($(`#cart-qty-{{$product['P_id']}}`).val())+1); change_cart_qty(+1,{{$product['P_id']}});parseInt($(`#cart-qty-{{$product['P_id']}}`).val())>1?changetotalprice({{$product['P_price']}} , 1) :'';">
    </div>
</div>
@endforeach
@endif




