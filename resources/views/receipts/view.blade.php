@extends('receipts.base')
@section('action-content')

    <style>
        table,
        thead,
        tr,
        tbody,
        th,
        td {
            text-align: center;
        }
    </style>
    <div>
        <!-- Main content -->
        <section class="content">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">معلومات الايصال رقم: {{ $receipts->receiptNo }}</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-6"></div>
                        <div class="col-sm-6"></div>
                    </div>
                    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="example2" class="table table-bordered table-hover">
                                        <tr>
                                            <td>{{ $receipts->receipts_date }}</td>
                                            <th>تاريخ الايصال</th>
                                            <td>{{ $receipts->receiptNo }}</td>
                                            <th>رقم الايصال</th>
                                        </tr>
                                        <tr>
                                            <td>{{ $receipts->customer_receiver->customer_name }}</td>
                                            <th>المستقبل</th>
                                            <td>{{ $receipts->customer_sender->customer_name }}</td>
                                            <th>المرسل</th>
                                        </tr>
                                        <tr>
                                            <th>عدد الطرود</th>
                                            <th>نوع الطرد</th>
                                            <th>المحتويات</th>
                                            <th>العلامات</th>
                                        </tr>
                                        <tr>
                                            <td>{{ $receipts->number_of_packages }}</td>
                                            <td>{{ $receipts->package_type }}</td>
                                            <td>{{ $receipts->contents }}</td>
                                            <td>{{ $receipts->marks }}</td>
                                        </tr>
                                        <tr>
                                            <th colspan="2">الوزن</th>
                                            <th colspan="2">الحجم</th>
                                        </tr>
                                        <tr>
                                            <td colspan="2">{{ $receipts->weight }}</td>
                                            <td colspan="2">{{ $receipts->size }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">{{ $receipts->notes }}</td>
                                            <th>ملاحظات</th>
                                        </tr>
                                        <tr>
                                            <td colspan="2">{{ $receipts->discount }}</td>
                                            <th colspan="2">خصم</th>
                                        </tr>
                                        <tr>
                                            <th>للتحصيل من المرسل اليه</th>
                                            <th>المدفوع مسبقاً</th>
                                            <th colspan="2">الاجور</th>
                                        </tr>
                                        <tr>
                                            <td>{{ $receipts->collect_from_receiver }}</td>
                                            <td>{{ $receipts->prepaid }}</td>
                                            <th colspan="2">اجور الشحن</th>
                                        </tr>
                                        <tr>
                                            <td>{{ $receipts->trans_miscellaneous }}</td>
                                            <td>{{ $receipts->prepaid_miscellaneous }}</td>
                                            <th colspan="2">متفرقات</th>
                                        </tr>
                                        <tr>
                                            <td>{{ $receipts->remittances }}</td>
                                            <td>( {{ $receipts->paid_date }} ) {{ $receipts->remittances_paid }}</td>
                                            <th colspan="2">ضد الشحن</th>
                                        </tr>
                                        <tr>
                                            <td>{{ $receipts->collect_from_receiver+$receipts->trans_miscellaneous+$receipts->remittances }}</td>
                                            <td>{{ $receipts->prepaid+$receipts->prepaid_miscellaneous }}</td>
                                            <th colspan="2">المجموع</th>
                                        </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection


