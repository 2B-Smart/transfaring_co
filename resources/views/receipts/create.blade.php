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
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">إنشاء ايصال</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('receipts.store') }}">
                        {{ csrf_field() }}

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
                                                        <select id="bill_id" class="form-control selecter" name="bill_id" required>
                                                            <option value="" selected></option>
                                                            @foreach($bills_list as $bill)
                                                                <option value="{{ $bill->id }}">{{ 'الرحلة رقم '.$bill->id.' من '.$bill->source_city.' الى ' .$bill->destination_city}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <th colspan="2">رقم المانيفست</th>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <div class="form-group{{ $errors->has('source_city') ? ' has-error' : '' }}">

                                                            <div class="col-md-12">

                                                                <select id="source_city" class="form-control" name="source_city" required autofocus>
                                                                    <option value="" selected></option>
                                                                    @foreach($cities_list as $city)
                                                                        <option value="{{ $city->city_name }}">{{ $city->city_name }}</option>
                                                                    @endforeach
                                                                </select>

                                                                @if ($errors->has('source_city'))
                                                                    <span class="help-block">
                                        <strong>{{ $errors->first('source_city') }}</strong>
                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <th colspan="2">المصدر</th>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="input-group date">
                                                            <input type="text" name="receipts_date" class="form-control" id="from" required placeholder="تاريخ الايصال" value="<?=date('Y-m-d')?>">
                                                        </div>
                                                    </td>
                                                    <th>تاريخ الايصال</th>
                                                    <td>
                                                        <input type="number" name="receiptNo" id="receiptNo" class="form-control" required>
                                                    </td>
                                                    <th>رقم الايصال</th>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-sm-2">
                                                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#Bcourses2">+</button>
                                                            </div>
                                                            <div class="col-sm-10">
                                                                <select id="receiver" class="form-control" name="receiver" required>
                                                                    <option value="" selected></option>
                                                                    @foreach($customers_list as $customer)
                                                                        <option value="{{ $customer->id }}">{{ $customer->customer_name.' , '.$customer->customer_address.' , '.$customer->customer_mobile }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>


                                                    </td>
                                                    <th>المستقبل</th>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-sm-2">
                                                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#Bcourses">+</button>
                                                            </div>
                                                            <div class="col-sm-10">
                                                                <select id="sender" class="form-control" name="sender" required>
                                                                    <option value="" selected></option>
                                                                    @foreach($customers_list as $customer)
                                                                        <option value="{{ $customer->id }}">{{ $customer->customer_name.' , '.$customer->customer_address.' , '.$customer->customer_mobile }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <th>المرسل</th>

                                                </tr>
                                                <tr>
                                                    <th>عدد الطرود</th>
                                                    <th>نوع الطرد</th>
                                                    <th>المحتويات</th>
                                                    <th>العلامات</th>
                                                </tr>
                                                <tr>
                                                    <td><input class="form-control" name="number_of_packages" type="number" id="number_of_packages" required placeholder="عدد الطرود" ></td>
                                                    <td><input class="form-control" name="package_type" type="text" id="package_type" required placeholder="نوع الطرد"></td>
                                                    <td><input class="form-control" name="contents" type="text" id="contents" required placeholder="المحتويات"></td>
                                                    <td><input class="form-control" name="marks" type="text" id="marks" placeholder="العلامات"></td>
                                                </tr>
                                                <tr>
                                                    <th colspan="2">الوزن</th>
                                                    <th colspan="2">الحجم</th>
                                                </tr>
                                                <tr>
                                                    <td colspan="2"><input class="form-control" name="weight" type="number" step="any" id="weight" placeholder="الوزن"></td>
                                                    <td colspan="2"><input class="form-control" name="size" type="text" id="size" placeholder="الحجم"></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3"><input class="form-control" name="notes" type="text" id="notes" placeholder="ملاحظات"></td>
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
                                                    <td><input class="form-control" name="collect_from_receiver" type="number" step="any" id="collect_from_receiver" placeholder="تحصيل"></td>
                                                    <td><input class="form-control" name="prepaid" type="number" step="any" id="prepaid" placeholder="مدفوع مسبقا"></td>
                                                    <th colspan="2">اجور الشحن</th>
                                                </tr>
                                                <tr>
                                                    <td><input class="form-control" name="trans_miscellaneous" type="number" step="any" id="trans_miscellaneous" placeholder="محول"></td>
                                                    <td><input class="form-control" name="prepaid_miscellaneous" type="number" step="any" id="prepaid_miscellaneous" placeholder="توصيل"></td>
                                                    <th colspan="2">متفرقات</th>
                                                </tr>
                                                <tr>
                                                    <td><input class="form-control" name="remittances" type="number" step="any" id="remittances" placeholder="ضد الشحن"></td>
                                                    <td></td>
                                                    <th colspan="2">ضد الشحن</th>
                                                </tr>

                                                <tr>
                                                    <td colspan="3"></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="col-md-6 col-md-offset-4">
                                                                <button type="submit" class="btn btn-primary">
                                                                    إنشاء
                                                                </button>
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




                    </form>
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
            </div>
        </div>
    </div>
</div>
    <script src="{{ asset ("/bower_components/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js") }}"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
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
