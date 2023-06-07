<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use App\Models\Admin\Product;
use App\Models\Models\AllOrder;
use App\Models\Customer;
use App\Models\Order;
use Session;

class FrontController extends Controller
{
    public function index(Request $request)
    {
        $result['home_categories']=DB::table('categories')
                ->where(['status'=>1])
                ->where(['is_home'=>1])
                ->get();


        foreach($result['home_categories'] as $list){
            $result['home_categorie_product'][$list->id]=
                DB::table('products')
                ->where(['status'=>1])
                ->where(['category_id'=>$list->id])
                ->orderBy('created_at', 'DESC')
                ->get();

            foreach($result['home_categorie_product'][$list->id] as $list1){
                $result['home_product_attr']=
                    DB::table('products_attr')
                    ->leftJoin('sizes','sizes.id','=','products_attr.size_id')
                    ->leftJoin('colors','colors.id','=','products_attr.color_id')
                    ->where(['products_attr.products_id'=>$list1->id])
                    //->orderBy('created_at', 'DESC')
                    ->get();

            }
        }


        $result['all_product_attr']=
                    DB::table('products_attr')
                    ->get();


        $result['home_all_product']=
                DB::table('products')
                ->where(['products.status'=>1])
                ->orderBy('products.created_at', 'DESC')
                ->paginate(12);



        $result['home_brand']=DB::table('brands')
                ->where(['status'=>1])
                ->where(['is_home'=>1])
                ->get();


        $result['home_featured_product'][$list->id]=
                DB::table('products')
                ->where(['status'=>1])
                ->where(['is_featured'=>1])
                ->get();

        foreach($result['home_featured_product'][$list->id] as $list1){
            $result['home_featured_product_attr'][$list1->id]=
                DB::table('products_attr')
                ->leftJoin('sizes','sizes.id','=','products_attr.size_id')
                ->leftJoin('colors','colors.id','=','products_attr.color_id')
                ->where(['products_attr.products_id'=>$list1->id])
                ->get();

        }

        $result['home_tranding_product'][$list->id]=
            DB::table('products')
            ->where(['status'=>1])
            ->where(['is_tranding'=>1])
            ->get();

        foreach($result['home_tranding_product'][$list->id] as $list1){
            $result['home_tranding_product_attr'][$list1->id]=
                DB::table('products_attr')
                ->leftJoin('sizes','sizes.id','=','products_attr.size_id')
                ->leftJoin('colors','colors.id','=','products_attr.color_id')
                ->where(['products_attr.products_id'=>$list1->id])
                ->get();

        }

        $result['home_discounted_product'][$list->id]=
            DB::table('products')
            ->where(['status'=>1])
            ->where(['is_discounted'=>1])
            ->get();

        foreach($result['home_discounted_product'][$list->id] as $list1){
            $result['home_discounted_product_attr'][$list1->id]=
                DB::table('products_attr')
                ->leftJoin('sizes','sizes.id','=','products_attr.size_id')
                ->leftJoin('colors','colors.id','=','products_attr.color_id')
                ->where(['products_attr.products_id'=>$list1->id])
                ->get();

        }

        $result['home_banner']=DB::table('home_banners')
            ->where(['status'=>1])
            ->get();



        //onscroll load
        $products_all_active=$result['home_all_product'];
        $all_product_attr_load=$result['all_product_attr'];
        if ($request->ajax()) {
            $view = view('front.product.element.thumb_product',compact('products_all_active','all_product_attr_load'))->render();
            return response()->json($view);
        }

        return view('front.index',$result);
    }

    public function category(Request $request,$slug)
    {
        $result['all_product_attr_load']=DB::table('products_attr')->get();

        //onscroll load
        $result['products_all_active']=Product::leftJoin('categories','categories.id','=','products.category_id')
        ->where(['products.status'=>1])
        ->where(['categories.category_slug'=>$slug])
        ->orderBy('products.id','desc')
        ->select('products.*')
        ->paginate(24);
        //dd($products_all_active);


        if ($request->ajax()) {
            $view = view('front.product.element.thumb_product',$result)->render();
            return response()->json($view);
        }


        return view('front.category',$result);
    }
    public function product(Request $request,$slug)
    {
        $result['product']=
            DB::table('products')
            ->where(['status'=>1])
            ->where(['slug'=>$slug])
            ->get();

        foreach($result['product'] as $list1){
            $result['product_attr'][$list1->id]=
                DB::table('products_attr')
                ->leftJoin('sizes','sizes.id','=','products_attr.size_id')
                ->leftJoin('colors','colors.id','=','products_attr.color_id')
                ->where(['products_attr.products_id'=>$list1->id])
                ->get();
        }
        $result['all_product_attr']=DB::table('products_attr')->get();

        foreach($result['product'] as $list1){
            $result['product_images'][$list1->id]=
                DB::table('product_images')
                ->where(['product_images.products_id'=>$list1->id])
                ->get();
        }
        $result['related_product']=
            DB::table('products')
            ->where(['status'=>1])
            ->where('slug','!=',$slug)
            ->where(['category_id'=>$result['product'][0]->category_id])
            ->get();
        foreach($result['related_product'] as $list1){
            $result['related_product_attr'][$list1->id]=
                DB::table('products_attr')
                ->leftJoin('sizes','sizes.id','=','products_attr.size_id')
                ->leftJoin('colors','colors.id','=','products_attr.color_id')
                ->where(['products_attr.products_id'=>$list1->id])
                ->get();
        }


        return view('front.product',$result);
    }

    // add to cart------------------------------------------------------------------------------
    public function add_to_cart(Request $request)
    {
        $atrr = DB::table('products_attr')->where('id',$request-> P_attr)->first();
        if($atrr->color_id==0){
            $color ='N/A';
        }else{
            $db_color = DB::table('colors')->where('id',$atrr->color_id)->first();
            $color = $db_color->color;
        }
        if($atrr->size_id==0){
            $size ='N/A';
        }else{
            $db_size = DB::table('sizes')->where('id',$atrr->size_id)->first();
            $size = $db_size->size;
        }

        $product = [
                [
                    "P_id" => $request-> P_id,
                    "P_attr" => $request-> P_attr,
                    "P_img" => $request-> P_img,
                    "P_name" => $request-> P_name,
                    "P_price" => $request-> P_price,
                    "P_mrp" => $request-> P_mrp,
                    "p_color" => $color,
                    "p_size" => $size,
                    "p_qty" => $request-> p_qty,
                ]
            ];

        $flag = 1;

        if(Session::has('cart_product')){
            $session_product =Session::get('cart_product');
            foreach($session_product as $k =>$cart_product){
                if($cart_product['P_id'] == $request-> P_id && $cart_product['P_attr'] == $request-> P_attr){
                    //update QTY
                    $session_product[$k]['p_qty']= $cart_product['p_qty']+$request-> p_qty;
                    //stop loop
                    $flag = 0;
                    break;
                }
            }
            $product_json =$session_product;

            if($flag==1){
                $product_json =array_merge($session_product,$product);
            }
            Session::put('cart_product', $product_json);
        }
        else{
            $product_json = $product;
            Session::put('cart_product', $product_json);
        }
        return response()->json($product_json);
    }

    // cart qty change-----------------------------------------------------------------
    public function cart_qty_change(Request $request)
    {
        if(Session::has('cart_product')){
            $session_product =Session::get('cart_product');
            foreach($session_product as $k =>$cart_product){
                if($cart_product['P_id'] == $request-> P_id){
                    //update QTY
                    $session_product[$k]['p_qty']= $cart_product['p_qty']+$request-> p_qty;
                    //stop loop
                    break;
                }
            }
            $product_json =$session_product;
            Session::put('cart_product', $product_json);
        }
        return response()->json($product_json);
    }

    // cart remove cart product-----------------------------------------------------------------
    public function cart_remove_product(Request $request)
    {
        if(Session::has('cart_product')){
            $session_product =Session::get('cart_product');

            foreach($session_product as $k =>$cart_product){
                if($cart_product['P_id'] == $request-> P_id){
                    //remove product
                    unset($session_product[$k]);
                    //stop loop
                    break;
                }
            }
            $product_json = array_values($session_product); // 'reindex' array
            Session::put('cart_product', $product_json);
        }
        return response()->json($product_json);
    }

    // cart clear product-----------------------------------------------------------------
    public function cart_clear(Request $request)
    {
        if(Session::has('cart_product')){
            Session::forget('cart_product');
        }
        $product_json = array();
        return response()->json($product_json);
    }

    // checkout product-----------------------------------------------------------------
    public function checkout(Request $request)
    {
        //form validation
        $validated = $request->validate([
            'name' => 'required',
            'mobile' => 'required|min:11|max:11',
            'address' => 'required',
            'location' => 'required',
        ]);

        //process cart Session to input database
        if(Session::has('cart_product')){
            $total_price=0;
            foreach(Session::get('cart_product') as $product){
                $total_price=$total_price+($product['P_price']*$product['p_qty']);
            }

            $products = json_encode(Session::get('cart_product'));
            //dd($products);

            //insert or update user data
            $Customer = Customer::where('phone',$request->mobile)->first();
            if($Customer){
                $Customer->name = $request->name;
                $Customer->address = $request->address;
                $Customer->update();
            }
            else{
                $Customer = new Customer();
                $Customer->name = $request->name;
                $Customer->phone = $request->mobile;
                $Customer->address = $request->address;
                $Customer->created_at = time();
                $Customer->save();
            }

            //insert order data
            $Order = new Order();
            $Order->customers = $Customer->id;
            $Order->product_details = $products;
            $Order->total_amount = $total_price;
            $Order->delivery_charge = $request->location;
            $Order->order_place = $request->order_place;
            $Order->created_at = time();
            $Order->save();

            Session::forget('cart_product');

            //after order placed
            session()->flash('ORDER_ID',$Order->id);
            return redirect('order-placed');
        }
        else{
            return redirect('/');
        }

    }

    // cart page-----------------------------------------------------------------
    public function cart(Request $request)
    {
        $result['all_product_attr']=DB::table('products_attr')->get();
        $result['colors']=DB::table('colors')->get();
        $result['sizes']=DB::table('sizes')->get();

        $result['total_cart_price']=0;
        if(Session::has('cart_product')){
            foreach(Session::get('cart_product') as $product){
                $result['total_cart_price']=$result['total_cart_price']+($product['P_price']*$product['p_qty']);
            }
        }
        return view('front.cart.index',$result);
    }

    // load customer-----------------------------------------------------------------
    public function getcustomer(Request $request){
        $Customer = Customer::where('phone',$request->phone)->first();
        return $Customer;
    }

    // get attribute by color,size,product id -----------------------------------------------------------------
    public function get_attribute_id(Request $request)
    {
        $atrr = DB::table('products_attr')
        ->where('color_id',$request-> color)
        ->where('size_id',$request-> size)
        ->where('products_id',$request-> product_id)
        ->first();
        return $atrr;
    }

    // order tracking -----------------------------------------------------------------
    public function order_tracking()
    {
        return view('front.order.tracking');
    }

    // get attribute by color,size,product id -----------------------------------------------------------------
    public function order_tracking_find(Request $request)
    {
        $order_details = Order::where('id',$request-> order_id)->first();
        return $order_details;
    }

    //Nav Search-----------------------------------------------------------------------------------------
    public function search(Request $request,$str)
    {
        $result['product']=
            $query=DB::table('products');
            $query=$query->leftJoin('categories','categories.id','=','products.category_id');
            $query=$query->leftJoin('products_attr','products.id','=','products_attr.products_id');
            $query=$query->where(['products.status'=>1]);
            $query=$query->where('name','like',"%$str%");
            $query=$query->orwhere('model','like',"%$str%");
            $query=$query->orwhere('short_desc','like',"%$str%");
            $query=$query->orwhere('desc','like',"%$str%");
            $query=$query->orwhere('keywords','like',"%$str%");
            $query=$query->orwhere('technical_specification','like',"%$str%") ;
            $query=$query->distinct()->select('products.*');
            $query=$query->paginate(24);
            $result['product']=$query;

            foreach($result['product'] as $list1){

                $query1=DB::table('products_attr');
                $query1=$query1->leftJoin('sizes','sizes.id','=','products_attr.size_id');
                $query1=$query1->leftJoin('colors','colors.id','=','products_attr.color_id');
                $query1=$query1->where(['products_attr.products_id'=>$list1->id]);
                $query1=$query1->get();
                $result['product_attr'][$list1->id]=$query1;
            }
            $result['all_product_attr']=DB::table('products_attr')->get();


            $products_all_active=$result['product'];
            $all_product_attr_load=$result['all_product_attr'];
            if ($request->ajax()) {
                $view = view('front.product.element.thumb_product',compact('products_all_active','all_product_attr_load'))->render();
                return response()->json($view);
            }


        return view('front.search',$result);
    }

    //Order success page
    public function order_placed(Request $request)
    {
        if($request->session()->has('ORDER_ID')){
            return view('front.order_placed');
        }else{
            return redirect('/');
        }
    }

    //Order Failed page
    public function order_fail(Request $request)
    {
        if($request->session()->has('ORDER_ID')){
            return view('front.order_fail');
        }else{
            return redirect('/');
        }
    }

    //Share order
    public function share_order($slag)
    {
        $product_f_s = Product::where('slug',$slag)->first();

        $atrr = DB::table('products_attr')->where('products_id',$product_f_s->id)->first();

        //get color
        if($atrr->color_id==0){
            $color ='N/A';
        }else{
            $db_color = DB::table('colors')->where('id',$atrr->color_id)->first();
            $color = $db_color->color;
        }

        //get size
        if($atrr->size_id==0){
            $size ='N/A';
        }else{
            $db_size = DB::table('sizes')->where('id',$atrr->size_id)->first();
            $size = $db_size->size;
        }

        $product = [
                [
                    "P_id" => $product_f_s->id,
                    "P_attr" => $atrr-> id,
                    "P_img" => $atrr->attr_image,
                    "P_name" => $product_f_s->name,
                    "P_price" => $atrr->price,
                    "P_mrp" => $atrr->mrp,
                    "p_color" => $color,
                    "p_size" => $size,
                    "p_qty" => 1,
                ]
            ];
        $product_json = $product;
        Session::put('cart_product', $product_json);

        $result['all_product_attr']=DB::table('products_attr')->get();
        $result['colors']=DB::table('colors')->get();
        $result['sizes']=DB::table('sizes')->get();

        $result['total_cart_price']=0;
        if(Session::has('cart_product')){
            foreach(Session::get('cart_product') as $product){
                $result['total_cart_price']=$result['total_cart_price']+($product['P_price']*$product['p_qty']);
            }
        }
        $result['product_f_s']=$product_f_s;
        return view('front.share.index',$result);
    }

}
