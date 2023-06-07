<html  charset="UTF-8" >
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>INVOICE</title>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>
<body class=" container" >
	<div id="DivIdToPrint" style="padding: 0px 50px;">
        <div  style="padding: 0px 50px;">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
            <style media="all">
                /* @page {
                margin: 0;
                padding:0;
            }
            body{
                    font-family:  Arial, sans-serif;

                font-size: 14px;
                font-weight: normal;
                direction: left;
                text-align: left;
                padding:0;
                margin:0;
            } */

            @media print {
                @page { margin: 0; }
                /* body { margin: 1.6cm; } */

            }
            @media print {
                body {-webkit-print-color-adjust: exact;}
            }
            .gry-color *,
            .gry-color{
                color:#000;
            }
            table{
                width: 100%;
            }
            table th{
                font-weight: normal;
            }
            table.padding th{
                padding: .25rem .7rem;
            }
            table.padding td{
                padding: .25rem .7rem;
            }
            table.sm-padding td{
                padding: .12px .7rem;
            }
            .border-bottom td,
            .border-bottom th{
                border-bottom:1px solid #eceff4;
            }
            .text-left{
                text-align:left;
            }
            .text-right{
                text-align:right;
            }

            .cash table, .cash table td, .cash table th {
                border: 2px solid;
            }

            .cash table {
                width: 100%;
                border-collapse: collapse;
            }
        </style>
            <div style="padding: 12px;">

                <table>
                    <tr>
                        <td style="font-size: 12px;" class="strong">
                            <!-- logo -->
                            <img src="{{asset('/')}}front_assets/logo.jpg" style="height:60px;">
                        </td>
                        <td class="text-right">
                            <span style="font-size: 20px;font-weight: bold;">{{env('SITE_NAME')}}</span><br>
                            <span>{{env('SITE_ADDRESS')}}</span><br>
                            <span>Mobile: {{env('SITE_PHONE')}}</span>
                        </td>
                    </tr>
                </table>
            </div>

            <div style="padding: 0px;padding-bottom: 0" class="cash">
                <table>
                    <tr>
                        <td class="text-center"  colspan="2" rowspan="2" style="background-color: rgba(211, 211, 211, 0.5);"><b>Cash Memo</b></td>
                        <td class="text-center" style="background: rgba(211, 211, 211, 0.5); width:100px;"><b>DATE</b></td>
                        <td class="text-center" style=" width:130px;"><b>{{date("d M Y", strtotime($order_details->created_at))}}</b></td>

                    </tr>
                    <tr>
                        <td class="text-center" style="background: rgba(211, 211, 211, 0.5); width:100px;"><b>Memo NO:</b></td>
                        <td class="text-center"  style=" width:100px;"><b style="color:red;">{{$order_details->id}}</b></td>
                    </tr>
                    <tr>
                        <td class="text-left" style="background: rgba(211, 211, 211, 0.5); width:100px;"><b>Name</b></td>
                        <td class="text-left">{{$order_details->name}}</td>
                        <td class="text-center" style="background: rgba(211, 211, 211, 0.5); width:100px;"><b>Phone NO: </b></td>
                        <td class="text-center" style=" width:100px;"><b>{{$order_details->phone}}</b></td>
                    </tr>
                    <tr>
                        <td class="text-left" style="background: rgba(211, 211, 211, 0.5); width:100px;"><b>Address</b></td>
                        <td class="text-left" colspan="3">{{$order_details->address}}</td>
                    </tr>
                </table>
            </div>
            <br>
            <div class="cash">
                <table class="text-left">
                    <thead>
                        <tr class="gry-color" style="background: #eceff4;">
                            <th width="40%" class="text-center"><b>Product Name</b></th>
                            <th width="15%" class="text-center"><b>Price</b></th>
                            <th width="10%" class="text-center"><b>Qty</b></th>
                            <th width="15%" class="text-center"><b>Amount</b></th>
                        </tr>
                    </thead>
                    <tbody class="strong">
                        @php
                            $total_product_price = 0;
                        @endphp
                        @foreach (json_decode($order_details->product_details) as $key=>$product)
                        <tr>
                            <td>
                                {{$product->P_name}}
                                @if ($product->p_size!='N/A' || $product->p_color!='N/A')
                                    <br>
                                    @if ($product->p_size!='N/A')
                                        <span style="color: gray;font-size:12px;">Size: {{$product->p_size}} </span>
                                    @endif
                                    @if ($product->p_color!='N/A')
                                        <span style="color: gray;font-size:12px;">Color: {{$product->p_color}}</span>
                                    @endif
                                @endif
                            </td>
                            <td class="text-center"><span style="font-size:20px; ">৳</span> {{$product->P_price}}</td>
                            <td class="text-center">{{$product->p_qty}}</td>
                            <td class="text-center"><span style="font-size:20px; ">৳</span> {{$product->p_qty*$product->P_price}}</td>
                        </tr>
                        @php
                            $total_product_price = $total_product_price+$product->p_qty*$product->P_price;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div>
                <table class="text-right sm-padding small strong">
                    <thead>
                        <tr>
                            <th width="60%"></th>
                            <th width="40%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                            </td>
                            <td class="cash text-right" style="padding: 0;">
                                <table class="text-right">
                                    <tbody>
                                        <tr>
                                            <th class="text-left" style="background-color: rgba(211, 211, 211, 0.5);"><b>Amount</b></th>
                                            <td class="text-right"><span style="font-size:20px; ">৳</span> {{$order_details->qty*$order_details->price}}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-left" style="background-color: rgba(211, 211, 211, 0.5);"><b>Courier</b></th>
                                            <td class="text-right"><span style="font-size:20px; ">৳</span> {{$order_details->delivery_charge ?? 0}}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-left" style="background-color: rgba(211, 211, 211, 0.5);"><b>Advance</b></th>
                                            <td class="text-right"><span style="font-size:20px; ">৳</span> {{$order_details->advance_amount ?? 0}}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-left" style="background-color: rgba(211, 211, 211, 0.5);"><b>Discount</b></th>
                                            <td class="text-right"><span style="font-size:20px; ">৳</span> {{$order_details->discount_amount ?? 0}}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-left" style="background-color: rgba(239, 159, 159, 0.712);"><b>TOTAL DUE</b></th>
                                            <td class="text-right"><b><span style="font-size:20px; ">৳</span> {{(($total_product_price+$order_details->delivery_charge)-$order_details->advance_amount)-$order_details->discount_amount}}</b></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <div class="row">
                    <div class="co-md-12 " style="text-align: center;">
                        <div style="width: 100%; background-color:rgba(211, 211, 211, 0.5);">
                            <span><b>যে কোনো সমস্যায় ফোন করুন: {{env('SITE_PHONE')}}</b></span>
                        </div>

                        <span><b>পণ্য গ্রহনের ৭ দিন পর, কোনো অভিযোগ গ্রহণ যোগ্য নয়</b></span>
                    </div>
                </div>
            </div>
        </div>

	</div>

    <center> <button class="btn btn-success" onclick='printDiv();' >Print</button> <button class="btn btn-danger"  onclick='window.close();'>Close</button></center>


        <script>
            function printDiv()
            {

            var divToPrint=document.getElementById('DivIdToPrint');

            var newWin=window.open('','Print-Window');

            newWin.document.open();

            newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

            newWin.document.close();

            setTimeout(function(){newWin.close();},10);

            }
        </script>
</body>
</html>
