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
                    <div onclick="$('.status-form-back').hide();" style="float: right; position: relative; top: -9px; height: 28px; width: 28px; background: orange; text-align: center; cursor: pointer; border: 1px solid gray; border-radius: 50%;">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </div>

                        <div class="row">

                            <div class="col-sm-12 col-md-12">
                                <input type="text" readonly hidden id="order_id">
                                <div class="form-group">
                                    <label for="order_status">Status*</label><br>
                                    <select class="form-control col-md-12 float-right" id="order_status">
                                        <option value="pending">Pending</option>
                                        <option value="pending payment">Pending Payment</option>
                                        <option value="confirm">Confirm</option>
                                        <option value="processing">Processing</option>
                                        <option value="oncourier">Oncourier</option>
                                        <option value="delivered">Delivered</option>
                                        <option value="canceled">Canceled</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="order_note">Note</label>
                                    <textarea type="text" class="form-control" id="order_note"></textarea>
                                </div>

                                <div class="form-group text-center">
                                    <input type="button" class="btn btn-info" onclick="update_order_status_info();" value="Update">
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




