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
                <tr><td colspan="6"></td></tr>
                <tr>
                    <td></td>
                    <td>
                        <img src="{{ asset("/logo.png") }}" width="50" height="50">
                    </td>
                    <th>
                        <span>العودة</span><br>
                        <span>للنقل</span>
                    </th>
                    <th style="text-align: right;">
                        {{$receipts->count()}}
                    </th>
                    <th>
                        <span id="billnumber">
                            :عدد المرات التي استفاد المرسل اليه  {{ $receiver }} من خدماتنا
                        </span>
                    </th>
                    <th>
                        <span id="headernotes">
                            كل شطب او تعديل<br>
                            بدون توقيع غير معترف به
                        </span>
                    </th>
                </tr>
                {{--<div class="row">--}}
                {{--<div class="col cl-sm-12">--}}
                {{--<table class="table">--}}

            </table>
        </div>
    </div>
    <div class="row">
        <div class="col cl-sm-12">
            <table align="center" id="example2" class="table table-bordered table-hover">
                <thead>
                    <tr>

                        <th>مجموع التحصيل</th>
                        <th>مجموع المدفوع و التوصيل</th>
                        <th>ضد الشحن</th>
                        <th>محول</th>
                        <th>متفرقات</th>
                        <th>اجور الشحن(التحصيل)</th>
                        <th>اجور الشحن(مسبق)</th>
                        <th>تاريخ الايصال</th>
                        <th>عدد الطرود</th>
                        <th>المرسل</th>
                        <th>المصدر</th>
                        <th>رقم الايصال</th>
                        <th>رقم الرحلة</th>
                        <th> {{ "#" }} </th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $x=1;
                    $PreSUM=0;
                    $CollectSUM=0;
                ?>
            @foreach($receipts as $receipt)
                <tr>

                    <td>{{ $receipt->collect_from_receiver+$receipt->trans_miscellaneous+$receipt->remittances-$receipt->discount }}</td>
                    <td>{{ $receipt->prepaid+$receipt->prepaid_miscellaneous }}</td>
                    <td>{{ $receipt->remittances }}</td>
                    <td>{{ $receipt->trans_miscellaneous }}</td>
                    <td>{{ $receipt->prepaid_miscellaneous }}</td>
                    <td>{{ $receipt->collect_from_receiver }}</td>
                    <td>{{ $receipt->prepaid }}</td>
                    <td>{{ $receipt->receipts_date }}</td>
                    <td>{{ $receipt->number_of_packages }}</td>
                    <td>{{ $receipt->customer_sender->customer_name }}</td>
                    <td>{{ $receipt->source_city }}</td>
                    <td>{{ $receipt->receiptNo }}</td>
                    <td>{{ $receipt->bill->id }}</td>
                    <td>{{ $x }}</td>
                </tr>
                <?php
                    $x++;
                    $PreSUM+=$receipt->prepaid+$receipt->prepaid_miscellaneous;
                    $CollectSUM+=$receipt->collect_from_receiver+$receipt->trans_miscellaneous+$receipt->remittances-$receipt->discount;
                ?>
            @endforeach
                </tbody>
                <tr><td colspan="15"><hr/></td></tr>
                <tr>

                    <td>{{ $CollectSUM }}</td>
                    <th colspan="2">المجموع العام للتحصيل</th>
                    <td>{{ $PreSUM }}</td>
                    <th colspan="2">المجموع العام للمدفوع و التوصيل</th>
                    <td colspan="8"></td>
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