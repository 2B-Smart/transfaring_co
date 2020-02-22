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
                    <th>
                        {{$bills->count()}}
                    </th>
                    <th>
                        <span id="billnumber">
                            :عدد الرحلات الى {{ $destination }}
                        </span>
                    </th>
                    <th>
                        <span id="headernotes">
                            كل شطب او تعديل<br>
                            بدون توقيع غير معترف به
                        </span>
                    </th>
                </tr>

            </table>
        </div>
    </div>
    <div class="row">
        <div class="col cl-sm-12">
            <table class="table table-border table-hover">
                <thead>
                <tr>
                    <td></td>
                    <th>ضد الشحن</th>
                    <th>متفرقات مدفوعة</th>
                    <th>المجموع العام بعد ازالة الخصم</th>
                    <th>مجموع الخصم</th>
                    <th>المحول</th>
                    <th>المسبق</th>
                    <th>المجموع العام</th>
                    <th>تاريخ الرحلة</th>
                    <th>اسم السائق</th>
                    <th>رقم المركبة</th>
                    <th>رقم الرحلة</th>
                    <th> {{ "#" }} </th>
                </tr>
                </thead>
                <tbody>
                <?php
                $x=1;
                $A_trans_miscellaneous=0;
                $A_collect_from_receiver=0;
                $A_prepaid=0;
                $A_prepaid_miscellaneous=0;
                $A_remittances=0;
                $A_discount=0;
                ?>
                @foreach($bills as $bill)
                    <?php
                    $x=1;
                    $trans_miscellaneous=0;
                    $collect_from_receiver=0;
                    $prepaid=0;
                    $prepaid_miscellaneous=0;
                    $remittances=0;
                    $discount=0;
                    ?>
                    @foreach($bill->receipts as $receipt)
                        <?php
                        $trans_miscellaneous+= $receipt->trans_miscellaneous;
                        $collect_from_receiver+= $receipt->collect_from_receiver;
                        $prepaid+= $receipt->prepaid;
                        $prepaid_miscellaneous+= $receipt->prepaid_miscellaneous;
                        $remittances+= $receipt->remittances;
                        $discount+=$receipt->discount;
                        ///////////////////////////
                        $A_trans_miscellaneous+= $receipt->trans_miscellaneous;
                        $A_collect_from_receiver+= $receipt->collect_from_receiver;
                        $A_prepaid+= $receipt->prepaid;
                        $A_prepaid_miscellaneous+= $receipt->prepaid_miscellaneous;
                        $A_remittances+= $receipt->remittances;
                        $A_discount+=$receipt->discount;
                        ?>
                        <?php $x++; ?>
                    @endforeach
                    <tr>
                        <td></td>
                        <td>{{$remittances}}</td>
                        <td>{{$prepaid_miscellaneous}}</td>
                        <td>{{($prepaid+$collect_from_receiver)-$discount}}</td>
                        <td>{{$discount}}</td>
                        <td>{{$trans_miscellaneous}}</td>
                        <td>{{$prepaid}}</td>
                        <td>{{$prepaid+$collect_from_receiver}}</td>
                        <td>{{ $bill->bill_date }}</td>
                        <td>{{ $bill->driver->full_name }}</td>
                        <td>{{ $bill->v_number }}</td>
                        <td>{{ $bill->id }}</td>
                        <td>{{ $x }}</td>
                    </tr>

                    <?php $x++; ?>
                @endforeach
                </tbody>
                <tr><td colspan="13"><hr/></td></tr>
                <tr>
                    <td></td>
                    <td>{{($A_prepaid+$A_collect_from_receiver)-$A_discount}}</td>
                    <th>المجموع العام بعد ازالة الخصم</th>
                    <td>{{$A_prepaid+$A_collect_from_receiver}}</td>
                    <th>المجموع العام</th>
                    <td colspan="8"></td>

                </tr>
                <tr>
                    <td></td>
                    <td>{{$A_prepaid_miscellaneous}}</td>
                    <th>متفرقات مدفوعة</th>
                    <td>{{$A_prepaid}}</td>
                    <th>المسبق</th>
                    <td colspan="8"></td>
                </tr>
                <tr>
                    <td></td>
                    <td>{{$A_remittances}}</td>
                    <th>ضد الشحن</th>
                    <td>{{$A_trans_miscellaneous}}</td>
                    <th>المحول</th>
                    <td colspan="8"></td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td>{{$A_discount}}</td>
                    <th>مجموع الخصم</th>
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