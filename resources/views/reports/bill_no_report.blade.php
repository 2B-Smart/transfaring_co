<!DOCTYPE html>
<!--
  This is a starter template page. Use this page to start your new project from
  scratch. This page gets rid of all links and provides the needed markup only.
  -->
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>شركة عودة للشحن</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link href="{{ asset("/bower_components/AdminLTE/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link href="{{ asset("/bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.css")}}" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{ asset("/bower_components/AdminLTE/dist/css/AdminLTE.min.css")}}" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
      page. However, you can choose any other skin. Make sure you
      apply the skin class to the body tag so the changes take effect.
      -->
    <link href="{{ asset("/bower_components/AdminLTE/dist/css/skins/_all-skins.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/app-template.css') }}" rel="stylesheet">
    <link href="{{ asset('print/print.min.css') }}" rel="stylesheet">
    <style>
        body{
            font-size: 11px;
            margin-top: 96px;
            margin-bottom: 96px;
            margin-left: 120px;
            margin-right: 120px;
            background-color: grey;
        }
        .wrapper{
            margin: 10px;
            width: 21.0cm;
            /*height: 29.7cm;*/
            background-color: white;
        }
        .row {
            margin-right: 0px;
             margin-left: 0px;
        }
        table,
        thead,
        tr,
        tbody,
        th,
        td {
            text-align: center;
        }
    </style>
</head>
<body class="hold-transition">
<button type="button" onclick="printJS({ printable: 'printJS-div', type: 'html', css: ['/bower_components/AdminLTE/bootstrap/css/bootstrap.min.css','/css/app-template.css','/bower_components/AdminLTE/dist/css/skins/_all-skins.min.css'],style:'table,thead,tr,tbody,th,td {text-align: center;}'})">
    Print Form
</button>
<div class="wrapper" id="printJS-div">
    <!-- Main Header -->
    <div class="row">
        <div class="col cl-sm-12">
            <table class="table">
                <tr>
                    <td></td>
                    <td>
                        <img src="{{ asset("/logo.png") }}" width="100" height="100">
                    </td>
                    <th>
                        <span>العودة</span><br>
                        <span>للنقل</span>
                    </th>
                    <th>
                        <span>
                            مانيفست الامانات
                        </span>
                    </th>
                    <td>
                        <span id="billnumber">
                            {{ $bills->id }}
                        </span>
                    </td>
                    <th>
                        <span id="headernotes">
                            كل شطب او تعديل<br>
                            بدون توقيع غير معترف به
                        </span>
                    </th>
                </tr>
                <tr>

                    <td></td>
                    <td></td>
                    <td>
                       {{ $bills->driver->full_name }}
                    </td>
                    <th>:اسم السائق</th>
                    <td>{{ $bills->destination_city }}</td>
                    <th>: الخط دمشق</th>
                </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col cl-sm-12">
            <table class="table table-border table-hover">
                <tr>
                    <td></td>
                    <th>المحول</th>
                    <th>التحصيل من المرسل اليه</th>
                    <th>الخصم</th>
                    <th>المدفوع مسبقا</th>
                    <th>متفرقات مدفوعة</th>
                    <th>ضد الدفع</th>
                    <th>المرسل اليه</th>
                    <th>اسم المرسل</th>
                    <th>عدد الطرود</th>
                    <th>نوع الطرد</th>
                    <th>المصدر</th>
                    <th>رقم الايصال</th>
                    <th> {{ "#" }} </th>
                </tr>
                <?php
                    $x=1;
                    $trans_miscellaneous=0;
                    $collect_from_receiver=0;
                    $prepaid=0;
                    $prepaid_miscellaneous=0;
                    $remittances=0;
                    $discount=0;
                ?>
                @foreach($bills->receipts as $receipt)
                    <tr>
                        <td></td>
                        <td>{{ $receipt->trans_miscellaneous }}</td>
                        <td>{{ $receipt->collect_from_receiver }}</td>
                        <td>{{ $receipt->discount }}</td>
                        <td>{{ $receipt->prepaid }}</td>
                        <td>{{ $receipt->prepaid_miscellaneous }}</td>
                        <td>{{ $receipt->remittances }}</td>
                        <td>{{ $receipt->customer_receiver->customer_name }}</td>
                        <td>{{ $receipt->customer_sender->customer_name }}</td>
                        <td>{{ $receipt->number_of_packages }}</td>
                        <td>{{ $receipt->package_type }}</td>
                        <td>{{ $receipt->source_city }}</td>
                        <td>{{ $receipt->receiptNo }}</td>
                        <td>{{ $x }}</td>
                    </tr>
                    <?php
                        $trans_miscellaneous+= $receipt->trans_miscellaneous;
                        $collect_from_receiver+= $receipt->collect_from_receiver;
                        $prepaid+= $receipt->prepaid;
                        $prepaid_miscellaneous+= $receipt->prepaid_miscellaneous;
                        $remittances+= $receipt->remittances;
                        $discount+=$receipt->discount;
                    ?>
                    <?php $x++; ?>
                @endforeach
            </table>
            <table class="table">
                <tr>
                    <td></td>
                    <td>{{$prepaid+$collect_from_receiver}}</td>
                    <th>المجموع العام</th>
                    <td>{{ $bills->driver->mobile_number }}</td>
                    <th>جوال السائق</th>
                    <td>{{ $bills->driver->full_name }}</td>
                    <th>اسم السائق</th>
                </tr>
                <tr>
                    <td></td>
                    <td>{{$prepaid}}</td>
                    <th>المسبق</th>
                    <td>{{ $bills->bill_date }}</td>
                    <th>التاريخ</th>
                    <td>{{ $bills->driver->national_id_number }}</td>
                    <th>الرقم الوطني</th>
                </tr>
                <tr>
                    <td></td>
                    <td>{{$trans_miscellaneous}}</td>
                    <th>المحول</th>
                    <td>{{ $bills->car->vehicle_type }}</td>
                    <th>نوع السيارة</th>
                    <td>{{ $bills->v_number }}</td>
                    <th>رقم السيارة</th>
                </tr>
                <tr>
                    <td></td>
                    <td>{{$discount}}</td>
                    <th>مجموع الخصم</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>{{($prepaid+$collect_from_receiver)-$discount}}</td>
                    <th>المجموع العام بعد ازالة الخصم</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>{{$prepaid_miscellaneous}}</td>
                    <th>متفرقات مدفوعة</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>{{$remittances}}</td>
                    <th>ضد الشحن</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
        </div>
    </div>
    <!-- ./wrapper -->
    <!-- REQUIRED JS SCRIPTS -->
    <!-- jQuery 2.1.3 -->
    <script src="{{ asset ("/bower_components/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js") }}"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="{{ asset ("/bower_components/AdminLTE/bootstrap/js/bootstrap.min.js") }}" type="text/javascript"></script>
    <script  src="{{ asset ("/bower_components/AdminLTE/plugins/datatables/jquery.dataTables.min.js") }}" type="text/javascript" ></script>
    <script  src="{{ asset ("/bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js") }}" type="text/javascript" ></script>


    <!-- Optionally, you can add Slimscroll and FastClick plugins.
      Both of these plugins are recommended to enhance the
      user experience. Slimscroll is required when using the
      fixed layout. -->

    <script src="{{ asset('js/site.js') }}"></script>
    <script src="{{ asset('print/print.min.js') }}"></script>
</body>
</html>
