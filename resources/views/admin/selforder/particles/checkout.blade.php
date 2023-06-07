<style>
.mb-3{
    margin-bottom:3px;
}
</style>
<!-- Shipping Address -->
<div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-8 mt-5">
        <div class="card">
            <div class="card-body">
                <div onclick="$('.customer-form-back').hide();" style="float: right; position: relative; top: -9px; height: 28px; width: 28px; background: orange; text-align: center; cursor: pointer; border: 1px solid gray; border-radius: 50%;">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </div>
                <form method="POST" action="{{asset('/admin/selforder')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col-sm-6 col-md-6">

                            <div class="form-group">
                                <label for="mobile">Phone No.*</label>
                                <div style="display: inline-flex; width:100%;">
                                    <input type="text" readonly class="form-control" value="+88" style="width:50px;padding-right:0px;border-top-right-radius:0px;border-bottom-right-radius:0px;">
                                    <input type="tel" class="form-control" oninput="getcustomer(); this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" placeholder="আপনার ফোন নম্বর" name="mobile" id="mobile" required style="width:calc(100% - 40px);padding-right:0px;border-top-left-radius:0px;border-bottom-left-radius:0px;">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name">Name *</label>
                                <input type="text" class="form-control" name="name" id="name" required>
                            </div>

                            <div class="form-group">
                                <label for="address">Address *</label>
                                <input type="text" class="form-control" name="address" id="address" required>
                            </div>

                            <div class="form-group">
                                <label for="note">Note</label>
                                <textarea type="text" class="form-control" name="note" id="note"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">

                            <div class="form-group">
                                <label for="location">Area *</label>
                                <select name="location" class="form-control" onchange="changelocation()" id="location" required>
                                    <option  value="" hidden >এলাকা সিলেক্ট করুন</option>
                                    <option  value="{{env('IN_DHAKA')}}" >ঢাকার ভিতরে</option>
                                    <option  value="{{env('OUT_DHAKA')}}">ঢাকার বাহিরে {{env('OUT_DHAKA')}}/-  অগ্রিম প্রদান করত হবে</option>
                                </select>
                            </div>

                            <div class="row">
                                <div class="form-group col-sm-6 col-md-6">
                                    <label for="delivery_charge">Delivery Charge *</label>
                                    <input type="text" class="form-control" oninput="cart_total_price(); this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" name="delivery_charge" id="delivery_charge" required>
                                </div>

                                <div class="form-group col-sm-6 col-md-6">
                                    <label for="advance">Advance</label>
                                    <input type="text" class="form-control" oninput="cart_total_price(); this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" name="advance" id="advance">
                                </div>
                            </div>
                            <input type="text" readonly hidden value="self order" name="order_place" required>

                            <div class="form-group">
                                <label for="order_place">Order From *</label>
                                <select name="order_place" class="form-control" id="order_place" required>
                                    <option  value="" hidden >Select</option>
                                    @foreach ($order_places as $order_place)
                                        <option  value="{{$order_place->share_place}}">{{$order_place->share_place}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-12">
                                <div class="aa-checkout-single-bill" style="font-size: 15px; color: green;">
                                    <span>Delivery Charge: </span><span id="total_delivery">0</span> Tk<br>
                                    <span>Total: </span><span id="total_amnt">0</span> TK<br>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <input class="btn btn-info" type="submit" value="Confirm" style="width:100%;">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-5">
    </div>
</div>




