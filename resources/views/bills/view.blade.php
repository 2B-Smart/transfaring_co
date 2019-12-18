@extends('bills.base')
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
                    <h3 class="box-title">معلومات الرحلة رقم: {{ $bills->id }}</h3>

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
                                <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                    <tr>
                                        <td>{{ $bills->bill_date }}</td>
                                        <th>تاريخ الرحلة</th>
                                        <td>{{ $bills->id }}</td>
                                        <th>رقم الرحلة</th>
                                    </tr>
                                    <tr>
                                        <th colspan="4"></th>
                                    </tr>
                                    <tr>
                                        <td>{{ $bills->destination_city }}</td>
                                        <th>الوجهة</th>
                                        <td>{{ $bills->source_city }}</td>
                                        <th>المصدر</th>
                                    </tr>
                                    <tr>
                                        <th colspan="4"></th>
                                    </tr>
                                    <tr>
                                        <td>{{ $bills->driver->mobile_number }}
                                        <th>رقم جوال السائق</th>
                                        <td>{{ $bills->driver->full_name }}</td>
                                        <th>اسم السائق</th>
                                    </tr>
                                    <tr>
                                        <th colspan="2"></th>
                                        <td>{{ $bills->driver->national_id_number }}</td>
                                        <th>رقم السائق الوطني</th>
                                    </tr>
                                    <tr>
                                        <th colspan="4"></th>
                                    </tr>
                                    <tr>

                                        <td>{{ $bills->car->vehicle_type }}</td>
                                        <th>نوع المركبة</th>
                                        <td>{{ $bills->v_number }}</td>
                                        <th>رقم المركبة</th>
                                    </tr>
                                    <tr>
                                        <th colspan="4"></th>
                                    </tr>
                                    <tr>
                                        <td>{{ $bills->user_create }}</td>
                                        <th>تم انشاء الرحلة من قبل</th>
                                        <td>{{ $bills->created_at }}</td>
                                        <th>تاريخ الانشاء</th>
                                    </tr>
                                    <tr>
                                        <td>{{ $bills->user_last_update }}</td>
                                        <th>صاحب اخر تعديل</th>
                                        <td>{{ $bills->updated_at }}</td>
                                        <th>تاريخ اخر تعديل</th>
                                    </tr>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <div class="row">
                <div class="col col-md-6">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">إضافة ايصال</h3>

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
                            <div id="example2_wrapper">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table id="example2" class="table table-bordered table-hover">
                                            <tr>
                                                <td>
                                                    <select id="sender" class="form-control" name="sender" required autofocus>
                                                        <option value="" selected></option>
                                                        @foreach($customers_list as $customer)
                                                            <option value="{{ $customer->id }}">{{ $customer->customer_name.' , '.$customer->customer_address.' , '.$customer->customer_mobile }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <th>المرسل</th>
                                                <td>
                                                    <select id="receiver" class="form-control" name="receiver" required>
                                                        <option value="" selected></option>
                                                        @foreach($customers_list as $customer)
                                                            <option value="{{ $customer->id }}">{{ $customer->customer_name.' , '.$customer->customer_address.' , '.$customer->customer_mobile }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <th>المستقبل</th>
                                            </tr>
                                                <tr>
                                                    <th>عدد الطرود</th>
                                                    <th>نوع الطرد</th>
                                                    <th>المحتويات</th>
                                                    <th>العلامات</th>
                                                </tr>
                                                <tr>
                                                    <td><input class="form-control" type="number" id="number_of_packages" placeholder="عدد الطرود"></td>
                                                    <td><input class="form-control" type="text" id="package_type" placeholder="نوع الطرد"></td>
                                                    <td><input class="form-control" type="text" id="contents" placeholder="المحتويات"></td>
                                                    <td><input class="form-control" type="text" id="marks" placeholder="العلامات"></td>
                                                </tr>
                                                <tr>
                                                    <th colspan="2">الوزن</th>
                                                    <th colspan="2">الحجم</th>
                                                </tr>
                                                <tr>
                                                    <td colspan="2"><input class="form-control" type="number" step="any" id="weight" placeholder="الوزن"></td>
                                                    <td colspan="2"><input class="form-control" type="text" id="size" placeholder="الحجم"></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3"><input class="form-control" type="text" id="notes" placeholder="ملاحظات"></td>
                                                    <th>ملاحظات</th>
                                                </tr>
                                                <tr>
                                                    <th>للتحصيل من المرسل اليه</th>
                                                    <th>المدفوع مسبقاً</th>
                                                    <th colspan="2">الاجور</th>
                                                </tr>
                                                <tr>
                                                    <td><input class="form-control" type="number" step="any" id="collect_from_receiver" placeholder="تحصيل"></td>
                                                    <td><input class="form-control" type="number" step="any" id="prepaid" placeholder="مدفوع مسبقا"></td>
                                                    <th colspan="2">اجور الشحن</th>
                                                </tr>
                                                <tr>
                                                    <td><input class="form-control" type="number" step="any" id="trans_miscellaneous" placeholder="محول"></td>
                                                    <td><input class="form-control" type="number" step="any" id="prepaid_miscellaneous" placeholder="توصيل"></td>
                                                    <th colspan="2">متفرقات</th>
                                                </tr>
                                                <tr>
                                                    <td><input class="form-control" type="number" step="any" id="remittances" placeholder="ضد الشحن"></td>
                                                    <td></td>
                                                    <th colspan="2">ضد الشحن</th>
                                                </tr>
                                                <tr>
                                                    <td colspan="3"></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="col-sm-12">
                                                                <button type="button" class="btn btn-success addrec">إضافة</button>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
                {{--قائمة الايصالات--}}
                <div class="col col-sm-6">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">قائمة الايصالات</h3>

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
                                            @foreach($bills->receipts as $receipt)
                                                <tr>
                                                    <td colspan="3"></td>
                                                    <td>
                                                        <button class='ion-android-delete delrec' id="{{ $receipt->id }}"></button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>{{ $receipt->receipts_date }}</td>
                                                    <th>تاريخ الايصال</th>
                                                    <td>{{ $receipt->id }}</td>
                                                    <th>رقم الايصال</th>
                                                </tr>
                                                <tr>
                                                    <td>{{ $receipt->customer_receiver->customer_name }}</td>
                                                    <th>المستقبل</th>
                                                    <td>{{ $receipt->customer_sender->customer_name }}</td>
                                                    <th>المرسل</th>
                                                </tr>
                                                <tr>
                                                    <th>عدد الطرود</th>
                                                    <th>نوع الطرد</th>
                                                    <th>المحتويات</th>
                                                    <th>العلامات</th>
                                                </tr>
                                                <tr>
                                                    <td>{{ $receipt->number_of_packages }}</td>
                                                    <td>{{ $receipt->package_type }}</td>
                                                    <td>{{ $receipt->contents }}</td>
                                                    <td>{{ $receipt->marks }}</td>
                                                </tr>
                                                <tr>
                                                    <th colspan="2">الوزن</th>
                                                    <th colspan="2">الحجم</th>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">{{ $receipt->weight }}</td>
                                                    <td colspan="2">{{ $receipt->size }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3">{{ $receipt->notes }}</td>
                                                    <th>ملاحظات</th>
                                                </tr>
                                                <tr>
                                                    <th>للتحصيل من المرسل اليه</th>
                                                    <th>المدفوع مسبقاً</th>
                                                    <th colspan="2">الاجور</th>
                                                </tr>
                                                <tr>
                                                    <td>{{ $receipt->collect_from_receiver }}</td>
                                                    <td>{{ $receipt->prepaid }}</td>
                                                    <th colspan="2">اجور الشحن</th>
                                                </tr>
                                                <tr>
                                                    <td>{{ $receipt->trans_miscellaneous }}</td>
                                                    <td>{{ $receipt->prepaid_miscellaneous }}</td>
                                                    <th colspan="2">متفرقات</th>
                                                </tr>
                                                <tr>
                                                    <td>{{ $receipt->remittances }}</td>
                                                    <td>{{ $receipt->remittances_paid }}</td>
                                                    <th colspan="2">ضد الشحن</th>
                                                </tr>
                                                <tr>
                                                    <td>{{ $receipt->collect_from_receiver+$receipt->trans_miscellaneous+$receipt->remittances }}</td>
                                                    <td>{{ $receipt->prepaid+$receipt->prepaid_miscellaneous }}</td>
                                                    <th colspan="2">المجموع</th>
                                                </tr>
                                                <tr><td colspan="4" class="alert-success"></td></tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <script src="{{ asset ("/bower_components/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js") }}"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(function () {
            $(document).on('click','.addrec',function() {
                alert("d");
                var remittances = $("#remittances").val();
                var prepaid_miscellaneous = $("#prepaid_miscellaneous").val();
                var trans_miscellaneous = $("#trans_miscellaneous").val();
                var collect_from_receiver = $("#collect_from_receiver").val();
                var prepaid = $("#prepaid").val();
                var sender = $("#sender").val();
                var receiver = $("#receiver").val();
                var number_of_packages = $("#number_of_packages").val();
                var package_type = $("#package_type").val();
                var contents = $("#contents").val();
                var marks = $("#marks").val();
                var weight = $("#weight").val();
                var size = $("#size").val();
                var notes = $("#notes").val();

                var Bid = <?php echo $bills->id; ?>;
//                $.ajax({url:'bills/addrec&id='+ID+'&name='+coursName+'&center='+centerName,type : 'POST'}).done(function(result){ location.reload();});
                $.ajax({

                    type:'POST',

                    url:"{{ route('bills.addrec') }}",

                    data:{"_token": "{{ csrf_token() }}",sender:sender, receiver:receiver, number_of_packages:number_of_packages, package_type:package_type, contents:contents, marks:marks, weight:weight, size:size, notes:notes, remittances:remittances, prepaid_miscellaneous:prepaid_miscellaneous, trans_miscellaneous:trans_miscellaneous, collect_from_receiver:collect_from_receiver, prepaid:prepaid, bill_id:Bid}

                }).done(function(result){ location.reload();});
            });
        });
        $(function () {
            $(document).on('click','.delrec',function() {
                if(confirm("هل تريد الحذف!!")){
                    var ID = $(this).attr("id");
                    $.ajax({

                        type:'POST',

                        url:"/bills/delrec/"+ID+"",

                        data:{"_token": "{{ csrf_token() }}"}

                    }).done(function(result){ location.reload();});
                }
            });
        });

    </script>
@endsection


