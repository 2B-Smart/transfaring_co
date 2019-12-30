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
                        <a href="{{ route('reports.bill_no_report', $bills->id) }}" class="btn btn-success col-sm-6btn-margin">
                            طباعة المانيفست
                        </a>
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
                                                <td colspan="2">
                                                    <select id="source_city" class="form-control" name="source_city" required autofocus>
                                                        <option value="" selected></option>
                                                        @foreach($cities_list as $city)
                                                            <option value="{{ $city->city_name }}">{{ $city->city_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <th colspan="2">المصدر</th>
                                            </tr>
                                            <tr>
                                               <td>
                                                   <input type="text" name="receipts_date" class="form-control from" id="receipts_date" required placeholder="تاريخ الايصال" value="<?=date('Y-m-d')?>">
                                               </td>
                                                <th>تاريخ الايصال</th>
                                                <td>
                                                    <input type="number" name="receiptNo" id="receiptNo" class="form-control" required>
                                                </td>
                                                <th>رقم الايصال</th>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <select id="receiver" class="form-control" name="receiver" required>
                                                        <option value="" selected></option>
                                                        @foreach($customers_list as $customer)
                                                            <option value="{{ $customer->id }}">{{ $customer->customer_name.' , '.$customer->customer_address.' , '.$customer->customer_mobile }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <th>
                                                    المستقبل<br>
                                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#Bcourses2">+</button>
                                                </th>
                                                <td>
                                                    <select id="sender" class="form-control" name="sender" required autofocus>
                                                        <option value="" selected></option>
                                                        @foreach($customers_list as $customer)
                                                            <option value="{{ $customer->id }}">{{ $customer->customer_name.' , '.$customer->customer_address.' , '.$customer->customer_mobile }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <th>
                                                    المرسل<br>
                                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#Bcourses">+</button>

                                                </th>

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
                                                    <td colspan="2"><input class="form-control" name="discount" type="text" step="any" id="discount" placeholder="خصم"></td>
                                                    <th colspan="2">خصم</th>
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
                <div class="modal fade" id="Bcourses" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">إضافة زبون</h4>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal">
                                    <div class="form-group">
                                        <label for="name" class="col-sm-2 control-label">اسم الزبون</label>
                                        <div class="col-sm-10">
                                            <input id="full_name" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="شadd" class="col-sm-2 control-label">العنوان</label>
                                        <div class="col-sm-10">
                                            <input id="address" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="moNo" class="col-sm-2 control-label">رقم الجوال</label>
                                        <div class="col-sm-10">
                                            <input id="mobileNo" type="number">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button type="button" class="btn btn-success addcrs">إضافة</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal fade" id="Bcourses2" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">إضافة زبون</h4>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal">
                                    <div class="form-group">
                                        <label for="name" class="col-sm-2 control-label">اسم الزبون</label>
                                        <div class="col-sm-10">
                                            <input id="full_name2" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="شadd" class="col-sm-2 control-label">العنوان</label>
                                        <div class="col-sm-10">
                                            <input id="address2" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="moNo" class="col-sm-2 control-label">رقم الجوال</label>
                                        <div class="col-sm-10">
                                            <input id="mobileNo2" type="number">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button type="button" class="btn btn-success addcrs2">إضافة</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>

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
                                                        <a href="{{ route('receipts.edit', $receipt->id) }}" class="btn btn-warning">
                                                            تعديل
                                                        </a>
                                                        <button class='btn ion-android-delete delrec' id="{{ $receipt->id }}"></button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">{{ $receipt->source_city }}</td>
                                                    <th colspan="2">المصدر</th>
                                                </tr>
                                                <tr>
                                                    <td>{{ $receipt->receipts_date }}</td>
                                                    <th>تاريخ الايصال</th>
                                                    <td>{{ $receipt->receiptNo }}</td>
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
                                                    <td colspan="2">{{ $receipt->discount }}</td>
                                                    <th colspan="2">خصم</th>
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
                                                    <td>( {{ $receipt->paid_date }} ) {{ $receipt->remittances_paid }}</td>
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
                var discount = $("#discount").val();
                var receipts_date=$("#receipts_date").val();
                var receiptNo=$("#receiptNo").val();
                var source_city=$("#source_city").val();

                var Bid = <?php echo $bills->id; ?>;
//                $.ajax({url:'bills/addrec&id='+ID+'&name='+coursName+'&center='+centerName,type : 'POST'}).done(function(result){ location.reload();});
                $.ajax({

                    type:'POST',

                    url:"{{ route('bills.addrec') }}",

                    data:{"_token": "{{ csrf_token() }}",receiptNo:receiptNo,source_city:source_city,sender:sender, receiver:receiver, number_of_packages:number_of_packages, package_type:package_type, contents:contents, marks:marks, weight:weight, size:size, notes:notes, remittances:remittances, prepaid_miscellaneous:prepaid_miscellaneous, trans_miscellaneous:trans_miscellaneous, collect_from_receiver:collect_from_receiver, prepaid:prepaid,discount:discount,receipts_date:receipts_date ,bill_id:Bid}

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
        $(function () {
            $(document).on('click','.addcrs2',function() {
                var customer_mobile = $("#mobileNo2").val();
                var customer_address = $("#address2").val();
                var customer_name = $("#full_name2").val();
                $.ajax({

                    type:'POST',

                    url:"{{ route('customers.addrec') }}",

                    data:{"_token": "{{ csrf_token() }}",customer_name:customer_name, customer_address:customer_address, customer_mobile:customer_mobile}

                }).done(function(data){
                    $('#receiver').append(
                    `<option value="${data}" selected="selected">${customer_name} , ${customer_address} , ${customer_mobile}</option>`
                    );
                    $('#sender').append(
                    `<option value="${data}">${customer_name} , ${customer_address} , ${customer_mobile}</option>`
                    );
                    $('#Bcourses2').modal('hide');
                    $("#mobileNo2").val("");
                    $("#address2").val("");
                    $("#full_name2").val("");
                    //location.reload();
                });
            });
        });
        $(function () {
            $(document).on('click','.addcrs',function() {
                var customer_mobile = $("#mobileNo").val();
                var customer_address = $("#address").val();
                var customer_name = $("#full_name").val();
                $.ajax({

                    type:'POST',

                    url:"{{ route('customers.addrec') }}",

                    data:{"_token": "{{ csrf_token() }}",customer_name:customer_name, customer_address:customer_address, customer_mobile:customer_mobile}

                }).done(function(data){
                    $('#receiver').append(
                             `<option value="${data}">${customer_name} , ${customer_address} , ${customer_mobile}</option>`
                    );
                    $('#sender').append(
                                `<option value="${data}" selected="selected">${customer_name} , ${customer_address} , ${customer_mobile} </option>`
                    );
                    $('#Bcourses').modal('hide');
                    $('#Bcourses').modal('hide');
                    $("#mobileNo").val("");
                    $("#address").val("");
                    $("#full_name").val("");
                    //location.reload();
                });
            });
        });

    </script>
@endsection


