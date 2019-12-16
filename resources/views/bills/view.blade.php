@extends('bills.base')
@section('action-content')
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
                                        <th>رقم الرحلة</th>
                                        <td>{{ $bills->id }}</td>
                                        <th>تاريخ الرحلة</th>
                                        <td>{{ $bills->bill_date }}</td>
                                    </tr>
                                    <tr>
                                        <th colspan="4"></th>
                                    </tr>
                                    <tr>
                                        <th>المصدر</th>
                                        <td>{{ $bills->source_city }}</td>
                                        <th>الوجهة</th>
                                        <td>{{ $bills->destination_city }}</td>
                                    </tr>
                                    <tr>
                                        <th colspan="4"></th>
                                    </tr>
                                    <tr>
                                        <th>اسم السائق</th>
                                        <td>{{ $bills->driver->full_name }}</td>
                                        <th>رقم جوال السائق</th>
                                        <td>{{ $bills->driver->mobile_number }}</td>
                                    </tr>
                                    <tr>
                                        <th>رقم السائق الوطني</th>
                                        <td>{{ $bills->driver->national_id_number }}</td>
                                        <th></th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th colspan="4"></th>
                                    </tr>
                                    <tr>
                                        <th>نوع المركبة</th>
                                        <td>{{ $bills->car->vehicle_type }}</td>
                                        <th>رقم المركبة</th>
                                        <td>{{ $bills->v_number }}</td>
                                    </tr>
                                    <tr>
                                        <th colspan="4"></th>
                                    </tr>
                                    <tr>
                                        <th>تم انشاء الرحلة من قبل</th>
                                        <td>{{ $bills->user_create }}</td>
                                        <th>تاريخ الانشاء</th>
                                        <td>{{ $bills->created_at }}</td>
                                    </tr>
                                    <tr>
                                        <th>صاحب اخر تعديل</th>
                                        <td>{{ $bills->user_last_update }}</td>
                                        <th>تاريخ اخر تعديل</th>
                                        <td>{{ $bills->updated_at }}</td>
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