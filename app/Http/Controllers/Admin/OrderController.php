<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Customer;
use Attribute;
use DateTime;

class OrderController extends Controller
{
    //All Order
    public function index(Request $request)
    {
        $result['customers'] = Customer::all();
        $order = Order::orderBy('created_at', 'desc');

        if($request->status){
            $order->where('status',$request->status);
        }

        if($request->search){
            $customer_id_by_phone = Customer::where('customers.phone', $request->search)->first();
            $customer_id_by_name = Customer::where('customers.name','like', '%' . $request->search . '%')->first();
            if($customer_id_by_phone!=null){
                $customer_id=$customer_id_by_phone->id;
            }
            elseif($customer_id_by_name!=null){
                $customer_id=$customer_id_by_name->id;
            }
            else{
                $customer_id=0;
            }

            if($customer_id!=0){
                $order->where('customers',$customer_id);
            }
            else{
                $order->where('id',$request->search);
            }
        }

        if($request->from_date && $request->to_date){

            $todate = new DateTime($request->to_date);
            $todate->modify('+1 day');
            $order->whereBetween('created_at', [$request->from_date, $todate->format('Y-m-d')]);
        }

        $result['orders']=$order->paginate(15);

        if ($request->ajax()) {
            $view = view('admin.order.element.order_row',$result)->render();
            return response()->json($view);
        }

        return view('admin.order.order',$result);
    }


    //View order
    public function order_detail(Request $request,$id)
    {
        $result['order_details']=Order::where('orders.id',$id)
        ->leftjoin('customers','customers.id','=','orders.customers')
        ->select('orders.*','customers.name','customers.phone','customers.address')
        ->first();
        return view('admin.order.order_detail',$result);
    }

    //Order Pdf
    public function download_pdf(Request $request,$id)
    {
        $result['order_details']=Order::where('orders.id',$id)
        ->leftjoin('customers','customers.id','=','orders.customers')
        ->select('orders.*','customers.name','customers.phone','customers.address')
        ->first();
        return View('admin.order.element.orderpdf',$result);
    }

    //Edit Order
    public function order_edit(Request $request,$id)
    {
        $result['order_details']=Order::where('orders.id',$id)
        ->leftjoin('customers','customers.id','=','orders.customers')
        ->select('orders.*','customers.name','customers.phone','customers.address')
        ->first();
        // dd($result['order_details']);
        return view('admin.order.edit',$result);
    }

    //Edit save Order
    public function order_update_save(Request $request)
    {
        $customer = Customer::find($request->customer_id);
        $customer->name = $request->name;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->update();

        $order = Order::find($request->order_id);
        $order->advance_amount = $request->advance;
        $order->delivery_charge = $request->delivery_charge;
        $order->discount_amount = $request->discount;
        $order->status = $request->status;
        $order->note = $request->note;
        $order->order_process_by = 'Admin';
        $order->booking_number = $request->booking_number;
        $order->courier_name = $request->courier_name;
        $order->update();

        $request->session()->flash('message','Order has been updated successfully');
        return redirect()->back();
    }

    //Order qty update
    public function order_qty_update(Request $request)
    {
        if($request-> p_qty>0){
            $order = Order::find($request->order_id);
            if($order){
                $order_products =json_decode($order->product_details);
                foreach($order_products as $k =>$product){
                    if($product->P_id == $request-> P_id){
                        //update QTY
                        $order_products[$k]->p_qty= $request-> p_qty;
                        //stop loop
                        break;
                    }
                }
                //update total amount
                $total_price=0;
                foreach($order_products as $k =>$product){
                    $total_price = $total_price+$product->P_price;
                }
                $product_json = json_encode($order_products);
                $order->product_details = $product_json;
                $order->total_amount = $total_price;
                $order->update();
            }
            $request->session()->flash('message','Order quantity has been updated successfully');
            return response()->json(['status'=>'ok']);
        }
    }

    //Order price update
    public function order_price_update(Request $request)
    {
        if($request->P_price>0){
            $order = Order::find($request->order_id);
            if($order){
                $order_products =json_decode($order->product_details);
                foreach($order_products as $k =>$product){
                    if($product->P_id == $request-> P_id){
                        //update QTY
                        $order_products[$k]->P_price= $request-> P_price;
                        //stop loop
                        break;
                    }
                }
                //update total amount
                $total_price=0;
                foreach($order_products as $k =>$product){
                    $total_price = $total_price+$product->P_price;
                }
                $product_json = json_encode($order_products);
                $order->product_details = $product_json;
                $order->total_amount = $total_price;
                $order->update();
            }
            $request->session()->flash('message','Order price has been updated successfully');
            return response()->json(['status'=>'ok']);
        }
    }

    //Order Status and note update
    public function update_order_status(Request $request)
    {
        $order = Order::find($request->o_id);
        $order->order_process_by = 'Admin';
        $order->status = $request->o_status;
        $order->note = $request->o_note;
        $order->update();
        $request->session()->flash('message','Order has been updated successfully');
        return response()->json(['status'=>'ok']);
    }

    //Delete order
    public function delete_order(Request $request,$id)
    {
        $model=Order::find($id);
        $model->delete();
        $request->session()->flash('message','Order has been deleted successfully');
        return redirect()->back();
    }



}
