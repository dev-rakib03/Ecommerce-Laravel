<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->session()->has('ADMIN_LOGIN')){
            return redirect('admin/dashboard');
        }else{
            return view('admin.login');
        }
        return view('admin.login');
    }

    public function auth(Request $request)
    {
        $email=$request->post('email');
        $password=$request->post('password');

        // $result=Admin::where(['email'=>$email,'password'=>$password])->get();
        $result=Admin::where(['email'=>$email])->first();
        if($result){
            if(Hash::check($request->post('password'),$result->password)){
                $request->session()->put('ADMIN_LOGIN',true);
                $request->session()->put('ADMIN_ID',$result->id);
                return redirect('admin/dashboard');
            }else{
                $request->session()->flash('error','Please enter correct password');
                return redirect('admin');
            }
        }else{
            $request->session()->flash('error','Please enter valid login details');
            return redirect('admin');
        }
    }

    public function dashboard()
    {
        $result['total_income']= Order::where('status','!=','canceled')->sum('total_amount');
        $result['today_income']= Order::where('status','!=','canceled')->whereDate('created_at', Carbon::today())->sum('total_amount');
        $result['total_pending'] = Order::where('status','=','pending')->get();
        $result['today_pending'] = Order::where('status','=','pending')->whereDate('created_at', Carbon::today())->get();

        return view('admin.dashboard',$result);
    }

    public function account_controller()
    {
        return view('admin.admin.index');
    }
    public function change_password(Request $request)
    {
        $admin = Admin::find($request->session()->get('ADMIN_ID'));
        $admin->email=$request->email;
        if($request->password){
            $admin->password=Hash::make($request->password);
            $admin->update();
        }
        $request->session()->flash('message','Account has been updated successfully!');
        return redirect('/admin/dashboard');
    }

}
