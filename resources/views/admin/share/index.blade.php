@extends('admin/layout')
@section('page_title','Order')
@section('share_select','active')
@section('container')
    <h1 class="mb10">Order Place</h1>
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{asset('/')}}admin/order-place/save" enctype='multipart/form-data'>
            @csrf
                <label>Order Place Name</label>
                <div class="row">
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="order_place" placeholder="Input order place Name" required>
                    </div>
                    <div class="col-md-2">
                        <input type="submit" class="btn btn-success" value="Add">
                    </div>
                    </div>
            </form> 
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <!-- DATA TABLE-->
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Order Place</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($shares as $key=> $place)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$place->share_place}}</td>
                                <td>
                                    <a href="{{asset('/')}}admin/order-place/delete/{{$place->id}}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <br>
            </div>
            <!-- END DATA TABLE-->
        </div>
    </div>

@endsection

@section('script')

@endsection
