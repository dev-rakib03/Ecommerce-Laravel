<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\share;

class shareController extends Controller
{
    public function index(){
        $shares = share::all();
        return view('admin.share.index',compact('shares'));
    }
    
    public function store(Request $request){
        $share = new share();
        $share->share_place = $request->order_place;
        $share->save();
        
        $request->session()->flash('message','Order place has been added successfully');
        return redirect()->back();
    }
    
    public function delete($id,Request $request){
        
        $share = share::find($id);
        
        if($share){
           $share->delete(); 
        }
        $request->session()->flash('message','Order place has been deleted successfully');
        return redirect()->back();
    }
}
