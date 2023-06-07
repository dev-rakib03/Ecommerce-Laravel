@extends('front/layout')
@section('page_title','Order Placed')
@section('container')

  <!-- product category -->
<section id="aa-product-category">
   <div class="container">
      <div class="row" style="text-align:center;">
        <br/><br/><br/>
            <h2>আপনার অর্ডারটি সফল হয়েছে।</h2>
            <h3>Order Id:- {{session()->get('ORDER_ID')}}</h3>
            <h3>আপনার অর্ডারের সর্বশেষ আপডেট জানতে Track Order -এ ক্লিক করুন</h3>
            <a class="btn btn-info" href="{{ asset('/order-tracking') }}">Track Order</a> </h3>
            <h3>কিছুক্ষনের মধ্যে আমাদের কাস্টমার প্রতিনিধিগণ আপনার সাথে যোগাযোগ করবে। </h3>
            <h3>যে কোন প্রয়োজনে যোগাযোগ করুন- <a style="font-family: Arial, Helvetica, sans-serif;" href="tel:{{env('SITE_PHONE')}}">{{env('SITE_PHONE')}}</a></h3>
        <br/><br/><br/>
      </div>
   </div>
</section>
@endsection
