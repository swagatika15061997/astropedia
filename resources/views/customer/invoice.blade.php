<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invoice</title>
    <meta http-equiv="Content-Type" content="text/html;"/>
    <meta charset="UTF-8">
    <style media="all">
        * {
            margin: 0;
            padding: 0;
            line-height: 1.3;
            font-family: sans-serif;
            color: #333542;
        }

        /* IE 6 */
        * html .footer {
            position: absolute;
            top: expression((0-(footer.offsetHeight)+(document.documentElement.clientHeight ? document.documentElement.clientHeight : document.body.clientHeight)+(ignoreMe = document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop))+'px');
        }

        body {
            font-size: .75rem;
        }

        img {
            max-width: 100%;
        }

        .customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }
        table {
            width: 100%;
        }

        table thead th {
            padding: 8px;
            font-size: 11px;
            text-align: left;
        }

        table tbody th,
        table tbody td {
            padding: 8px;
            font-size: 11px;
        }

        table.fz-12 thead th {
            font-size: 12px;
        }

        table.fz-12 tbody th,
        table.fz-12 tbody td {
            font-size: 12px;
        }

        table.customers thead th {
            background-color: #0177CD;
            color: #fff;
        }

        table.customers tbody th,
        table.customers tbody td {
            background-color: #FAFCFF;
        }

        table.calc-table th {
            text-align: left;
        }

        table.calc-table td {
            text-align: right;
        }
        table.calc-table td.text-left {
            text-align: left;
        }

        .table-total {
            font-family: Arial, Helvetica, sans-serif;
        }


        .text-left {
            text-align: left !important;
        }

        .pb-2 {
            padding-bottom: 8px !important;
        }

        .pb-3 {
            padding-bottom: 16px !important;
        }

        .text-right {
            text-align: right !important;
        }

        table th.text-right {
            text-align: right !important;
        }

        @media print {
            table th.text-right {
                text-align: right !important;
            }
        }

        .content-position {
            padding: 15px 40px;
        }

        .content-position-y {
            padding: 0px 40px;
        }

        .text-white {
            color: white !important;
        }

        .bs-0 {
            border-spacing: 0;
        }
        .text-center {
            text-align: center;
        }
        .mb-1 {
            margin-bottom: 4px !important;
        }
        .mb-2 {
            margin-bottom: 8px !important;
        }
        .mb-4 {
            margin-bottom: 24px !important;
        }
        .mb-30 {
            margin-bottom: 30px !important;
        }
        .px-10 {
            padding-left: 10px;
            padding-right: 10px;
        }
        .fz-14 {
            font-size: 14px;
        }
        .fz-12 {
            font-size: 12px;
        }
        .fz-10 {
            font-size: 10px;
        }
        .font-normal {
            font-weight: 400;
        }
        .font-weight-normal {
            font-weight: normal;
        }
        .border-dashed-top {
            border-top: 1px dashed #ddd;
        }
        .font-weight-bold {
            font-weight: 700;
        }
        .bg-light {
            background-color: #F7F7F7;
        }
        .py-30 {
            padding-top: 30px;
            padding-bottom: 30px;
        }
        .py-4 {
            padding-top: 24px;
            padding-bottom: 24px;
        }
        .d-flex {
            display: flex;
        }
        .gap-2 {
            gap: 8px;
        }
        .flex-wrap {
            flex-wrap: wrap;
        }
        .align-items-center {
            align-items: center;
        }
        .justify-content-center {
            justify-content: center;
        }
        a {
            color: rgba(0, 128, 245, 1);
        }
        .p-1 {
            padding: 4px !important;
        }
        .h2 {
            font-size: 1.5em;
            margin-block-start: 0.83em;
            margin-block-end: 0.83em;
            margin-inline-start: 0px;
            margin-inline-end: 0px;
            font-weight: bold;
        }

        .h4 {
            margin-block-start: 1.33em;
            margin-block-end: 1.33em;
            margin-inline-start: 0px;
            margin-inline-end: 0px;
            font-weight: bold;
        }

    </style>
</head>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<body>
@php
    use App\Models\Setting;
    $company =Setting::first();
    
@endphp

<div class="first">
    <table class="content-position mb-30">
        <tr>
            <th>
                <img height="50" src="{{asset('images/setting/'.$company->header_logo) }}" onerror="this.src='{{asset('backend/assets/images/demo/def.jpg')}}'" alt="">
            </th>
        </tr>
    </table>

    <table class="bs-0 mb-30 px-10">
        <tr>
            <th class="content-position-y text-left">
                <h4 class="text-uppercase mb-1 fz-14">
                    Invoice #{{ $order->id }}
                </h4>
                
            </th>
            <th class="content-position-y text-right">
                <h4 class="fz-14">Date : {{date('d-m-Y h:i:s a',strtotime($order['created_at']))}}</h4>
            </th>
        </tr>
    </table>
</div>
    <div class="">
        <section>
            <table class="content-position-y fz-12">
                <tr>
                    <td class="font-weight-bold p-1">
                        <table>
                            <tr>
                                <td>
                                   <?php $shipping= json_decode($order->shipping_address_data); ?>

                                    @if ($shipping)
                                        <span class="h2" style="margin: 0px;">Shipping to </span>
                                        <div class="h4 montserrat-normal-600">
                                            <p class="font-weight-normal" style=" margin-top: 6px; margin-bottom:0px;">{{$order->customer !=null? $order->customer['name'] : 'Name not found'}}</p>
                                            <p class="font-weight-normal" style=" margin-top: 6px; margin-bottom:0px;">{{$order->customer !=null? $order->customer['email']: 'Email not found'}}</p>
                                            <p class="font-weight-normal" style=" margin-top: 6px; margin-bottom:0px;">{{$order->customer !=null? $order->customer['phone']: 'hone not found'}}</p>
                                            <p class="font-weight-normal" style=" margin-top: 6px; margin-bottom:0px;">{{$shipping ? $shipping->address : ""}}</p>
                                            <p class="font-weight-normal" style=" margin-top: 6px; margin-bottom:0px;">{{$shipping ?  $shipping->city : ""}} {{$shipping ? $shipping->zip : ""}}</p>
                                        </div>
                                    @else
                                        <span class="h2" style="margin: 0px;">Customer info</span>
                                        <div class="h4 montserrat-normal-600">
                                            <p class="font-weight-normal" style=" margin-top: 6px; margin-bottom:0px;">{{$order->customer !=null? $order->customer['name']:'Name not found'}}</p>
                                            @if (isset($order->customer) && $order->customer['id']!=0)
                                                <p style=" margin-top: 6px; margin-bottom:0px;">{{$order->customer !=null? $order->customer['email']:'Email not found'}}</p>
                                                <p style=" margin-top: 6px; margin-bottom:0px;">{{$order->customer !=null? $order->customer['phone']:'Phone not found'}}</p>
                                            @endif
                                        </div>
                                        </p>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </td>

                    <td>
                        <table>
                            <tr>
                                <td class="text-right">
                                   @if ($order->billing_address_data)
                                        <?php $billing= json_decode($order->billing_address_data);?>
                                        <span class="h2" style="margin: 0px;">Billing address </span>
                                        <div class="h4 montserrat-normal-600">
                                            <p class="font-weight-normal" style=" margin-top: 6px; margin-bottom:0px;">{{$order->customer !=null? $order->customer['name'] : 'Name not found'}}</p>
                                            <p class="font-weight-normal" style=" margin-top: 6px; margin-bottom:0px;">{{$order->customer !=null? $order->customer['email']: 'Email not found'}}</p>
                                            <p class="font-weight-normal" style=" margin-top: 6px; margin-bottom:0px;">{{$order->customer !=null? $order->customer['phone']: 'Phone not found'}}</p>
                                            <p class="font-weight-normal" style=" margin-top: 6px; margin-bottom:0px;">{{$order->billing_address_data ? $billing->address : ""}}</p>
                                            <p class="font-weight-normal" style=" margin-top: 6px; margin-bottom:0px;">{{$order->billing_address_data ?  $billing->city : ""}} {{$order->billing_address_data ? $billing->zip: ""}}</p>
                                        </div>
                                    @endif
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </section>
    </div>


<br>

<div>
    <div class="content-position-y">
        <table class="customers bs-0">
            <thead>
            <tr>
                <th>No.</th>
                <th>Item description</th>
                <th>
                    Unit price
                </th>
                <th>
                    Qty
                </th>
                <th>
                    Total
                </th>
            </tr>
            </thead>
            @php
                $subtotal=0;
                $total=0;
                $sub_total=0;
                $total_tax=0;
                $total_shipping_cost=0;
                $total_discount_on_product=0;
                $extra_discount=0;
            @endphp
            <tbody>
            @foreach($order->details as $key=>$details)
                @php $subtotal=($details['price'])*$details->qty @endphp
                <tr>
                    <td>{{$key+1}}</td>
                    <td>
                        {{$details['product']?$details['product']->name:''}}
                        
                    </td>
                    <td>{{$details['price']}}</td>
                    <td>{{$details->qty}}</td>
                    <td>{{$subtotal}}</td>
                </tr>

                @php
                    $sub_total+=$details['price']*$details['qty'];
                    $total_discount_on_product+=$details['discount'];
                    $total+=$subtotal;
                @endphp
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="row">
    <section>
        <table>
            <tr>
                <th class="content-position-y bg-light py-4">
                    <div class="d-flex justify-content-center gap-2">
                        <div class="mb-2">
                            <i class="fa fa-phone"></i>
                            Phone
                            : {{$company->phone}}
                        </div>
                        <div class="mb-2">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                            Email
                            : {{$company->email}}
                        </div>
                    </div>
                    <div class="mb-2">
                        <i class="fa fa-globe" aria-hidden="true"></i>
                        Website
                        : {{url('/')}}
                    </div>
                    <div>
                        {{'All_copy_right_reserved_©'.'_'.date('Y').'_'.$company->company_name}}
                    </div>
                </th>
            </tr>
        </table>
    </section>
</div>

</body>
</html>
