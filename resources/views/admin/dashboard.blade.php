@extends('admin/layout')
@section('page_title','Dashboard')
@section('dashboard_select','active')
@section('container')
<section>
    <div class="row">
        <div class="col-md-3">
            <div class="bg-white" style="width:100%; padding: 20px; border-radius:10px; margin-bottom: 10px;">
                <h3>Total Income</h3>
                <h5>৳ {{$total_income}}</h5>
            </div>
        </div>
        <div class="col-md-3">
            <div class="bg-white" style="width:100%; padding: 20px; border-radius:10px; margin-bottom: 10px;">
                <h3>Today Income</h3>
                <h5>৳ {{$today_income}}</h5>
            </div>
        </div>
        <div class="col-md-3">
            <div class="bg-white" style="width:100%; padding: 20px; border-radius:10px; margin-bottom: 10px;">
                <h3>Total Pending</h3>
                <h5>{{count($total_pending)}}</h5>
            </div>
        </div>
        <div class="col-md-3">
            <div class="bg-white" style="width:100%; padding: 20px; border-radius:10px; margin-bottom: 10px;">
                <h3>Today Pending</h3>
                <h5>{{count($today_pending)}}</h5>
            </div>
        </div>
    </div>
</section>

@endsection
