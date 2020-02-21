@extends('reports.base')

@section('action-content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">تقرير عن الايصالات التي تحوي "ضد الدفع" بين تاريخين</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('reports.receipt_paidRp') }}">
                            {{ csrf_field() }}

                            <div class="form-group">

                                <div class="col-md-2"></div>
                                <div class="col-md-6">
                                    <select id="city" class="form-control" name="city" required autofocus>
                                        <option value="" selected></option>
                                        <option value="all">الكل</option>
                                        @foreach($cities_list as $city)
                                            <option value="{{ $city->city_name }}">{{ $city->city_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <label for="city_name" class="col-md-2 control-label">المدينة الوجهة</label>

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
