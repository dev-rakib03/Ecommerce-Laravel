<style>
.mb-3{
    margin-bottom:3px;
}
</style>
<!-- Shipping Address -->
<div class="panel panel-default">
    <div class="panel-body">
        <form method="POST" action="{{asset('checkout')}}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <input type="text" readonly hidden value="{{ Request::get('place') ?? 'website' }}" name="order_place" required>

                <div class="col-md-12 mb-3">
                    <div class="aa-checkout-single-bill">
                        <div style="display: inline-flex; width:100%;">
                            <input type="text" readonly class="form-control" value="+88" style="width:40px;padding-right:0px;border-top-right-radius:0px;border-bottom-right-radius:0px;">
                            <input type="tel" class="form-control" oninput="getcustomer(); this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" placeholder="আপনার ফোন নম্বর" name="mobile" id="mobile" required style="width:calc(100% - 40px);padding-right:0px;border-top-left-radius:0px;border-bottom-left-radius:0px;">
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-3">
                    <div class="aa-checkout-single-bill">
                        <input type="text" class="form-control" placeholder="আপনার নাম" name="name" id="name" required>
                    </div>
                </div>

                <div class="col-md-12 mb-3">
                    <div class="aa-checkout-single-bill">
                        <input type="text" class="form-control" placeholder="আপনার পুরো ঠিকানা দিন" name="address" id="address" required>
                    </div>
                </div>

                <div class="col-md-12 mb-3">
                    <div class="aa-checkout-single-bill">
                        <select name="location" class="form-control" onchange="changelocation()" id="location" required>
                            <option  value="" hidden >আপনার এলাকা সিলেক্ট করুন</option>
                            <option  value="{{env('IN_DHAKA')}}" >ঢাকার ভিতরে</option>
                            <option  value="{{env('OUT_DHAKA')}}">ঢাকার বাহিরে {{env('OUT_DHAKA')}}/-  অগ্রিম প্রদান করত হবে</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-12 mb-3">
                    <div class="aa-checkout-single-bill">
                        <span id="com" style="color:#FF0000;"> </span>
                    </div>
                </div>

                <div class="col-md-12 mb-3">
                    <div class="aa-checkout-single-bill" style="font-size: 15px; color: green;">
                        <span>Price : </span><span id="total_price">{{$total_cart_price}}</span> TK<br>
                        <span>Delivery Charge: </span><span id="total_delivery">0</span> Tk<br>
                        <hr>
                        <span>Total: </span><span id="total_amnt">{{$total_cart_price}}</span> TK<br>
                    </div>
                </div>

                <div class="col-md-12 mb-3">
                    <div class="">
                    <input type="submit" value="অর্ডার কনফার্ম করুন" class="btn custom-btn">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>



