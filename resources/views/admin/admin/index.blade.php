@extends('admin/layout')
@section('page_title','Brand')
@section('brand_select','active')
@section('container')
    <h1 class="mb10">Account</h1>
    <div class="row">
        <div class="col-md-12 bg-white">
            <form method="POST" action="{{asset('/')}}admin/password-change" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" required value="">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Update" >
                </div>
            </form>

        </div>
    </div>

@endsection
