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
            padding: 5px;
            width: 21.0cm;
            /*height: 29.7cm;*/
            background-color: white;
        }
        .row {
            margin-right: 0px;
             margin-left: 0px;
        }
    </style>
</head>
<body class="hold-transition">
<div class="wrapper">
    <!-- Main Header -->
    <div class="row">
        <div class="col col-sm-2">
            <span id="headernotes">
                كل شطب او تعديل<br>
                بدون توقيع غير معترف به
            </span>
        </div>
        <div class="col col-sm-2">
            <span id="billnumber">
                {{ $bills->id }}
            </span>
        </div>
        <div class="col col-sm-2">
            <span>
                مانيفست الامانات
            </span>
        </div>
        <div class="col col-sm-3">
            <span>العودة</span><br>
            <span>للنقل</span>
        </div>
        <div class="col col-sm-3">
            <img src="{{ asset("/logo.jpg") }}" width="100" height="100">
        </div>
    </div>
    <div class="row">
        <div class="col col-sm-6"></div>
        <div class="col col-sm-3">
        الخط دمشق: {{ $bills->destination_city }} اسم السائق: {{ $bills->id }}
        </div>
        <div class="col col-sm-3"></div>
    </div>
    <div class="row">
        <div class="col cl-sm-12">
            <table class="table table-border table-hover">
                <tr>
                    <th>المحول</th>
                    <th>التحصيل من المرسل اليه</th>
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
                ?>
                @foreach($bills->receipts as $receipt)
                    <tr>
                        <td>{{ $receipt->trans_miscellaneous }}</td>
                        <td>{{ $receipt->collect_from_receiver }}</td>
                        <td>{{ $receipt->prepaid }}</td>
                        <td>{{ $receipt->prepaid_miscellaneous }}</td>
                        <td>{{ $receipt->remittances }}</td>
                        <td>{{ $receipt->customer_receiver->customer_name }}</td>
                        <td>{{ $receipt->customer_sender->customer_name }}</td>
                        <td>{{ $receipt->number_of_packages }}</td>
                        <td>{{ $receipt->package_type }}</td>
                        <td>{{ $receipt->source_city }}</td>
                        <td>{{ $receipt->id }}</td>
                        <td>{{ $x }}</td>
                    </tr>
                    <?php $x++; ?>
                @endforeach
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
</body>
</html>