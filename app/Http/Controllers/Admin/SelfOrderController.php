<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\share;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Admin\Product;
use DB;
use Session;

class SelfOrderController extends Controller
{
    public function index(Request $request)
    {
        $result['order_places']=share::all();
        $result['all_product_attr']=DB::table('products_attr')->get();

        $Products=Product::orderBy('created_at', 'desc');
        if($request->search){
            $Products->where('name','like', '%' . $request->search . '%');
        }
        $Products->where(['status'=>1]);
        //onscroll load
        $products_all_active=$Products->paginate(15);

        $all_product_attr_load=$result['all_product_attr'];
        if ($request->ajax()) {
            $view = view('admin.selforder.particles.product_thumb',compact('products_all_active','all_product_attr_load'))->render();
            return response()->json($view);
        }
        return view('admin.selforder.index',$result);

    }

    public function update_cart_html(Request $request)
    {
        if ($request->ajax()) {

            $total_cart_price=0;
            if(Session::has('cart_product')){
                foreach(Session::get('cart_product') as $product){
                    $total_cart_price=$total_cart_price+($product['P_price']*$product['p_qty']);
                }
            }

            $view = view('admin.selforder.particles.cartproduct')->render();
            return response()->json(['product'=>$view,'total'=>$total_cart_price]);
        }
    }

    // checkout product-----------------------------------------------------------------
    public function checkout(Request $request)
    {
        //form validation
        $validated = $request->validate([
            'name' => 'required',
            'mobile' => 'required|min:11|max:11',
            'address' => 'required',
            'delivery_charge' => 'required',
            'order_place' => 'required',
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
            $Order->advance_amount = $request->advance;
            $Order->delivery_charge = $request->delivery_charge;
            $Order->note = $request->note;
            $Order->order_place = $request->order_place;
            $Order->order_process_by = "Admin";
            $Order->created_at = time();
            $Order->save();

            Session::forget('cart_product');

            //after order placed
            session()->flash('ORDER_ID',$Order->id);
            return redirect()->back();
        }
        else{
            return redirect()->back();
        }

    }
}
