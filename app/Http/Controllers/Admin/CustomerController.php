<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function all_order_users(Request $request)
    {
        $result['all_users'] = Customer::orderBy('created_at', 'desc')->paginate(50);
        if ($request->ajax()) {
            $view = view('admin.users.element.user_row',$result)->render();
            return response()->json($view);
        }

        return view('admin.users.index',$result);
    }
}
