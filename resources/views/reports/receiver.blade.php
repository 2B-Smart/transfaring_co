@extends('reports.base')

@section('action-content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">تقرير الخدمات التي استفاد منها المرسل اليه بين تاريخين</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('reports.receiverRp') }}">
                            {{ csrf_field() }}

                            <div class="form-group">

                                <div class="col-md-2"></div>
                                <div class="col-md-6">
                                    <select class="form-control" id="receiver" name="receiver" required>
                                        <option value="" selected="selected">اختر اسم المرسل اليه</option>
                                        @foreach($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->customer_name.' , '.$customer->customer_address.' , '.$customer->customer_mobile }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <label for="customer_name" class="col-md-2 control-label">اسم المرسل اليه</label>
                            </div>
                            <div class="form-group">

                                <div class="col-md-2"></div>
                                <div class="col-md-6">
                                    <input class="form-control" name="start_date" id="from" required>
                                </div>
                                <label for="city_name" class="col-md-2 control-label">تاريخ البداية</label>
                            </div>
                            <div class="form-group">

                                <div class="col-md-2"></div>
                                <div class="col-md-6">
                                    <input class="form-control" name="end_date" id="to" required>
                                </div>
                                <label for="city_name" class="col-md-2 control-label">تاريخ النهاية</label>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        إنشاء
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
