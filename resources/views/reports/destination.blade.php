@extends('reports.base')

@section('action-content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">عدد الرحلات الى وجهة معينة بين تاريخين</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('reports.destinationRp') }}">
                            {{ csrf_field() }}

                            <div class="form-group">

                                <div class="col-md-2"></div>
                                <div class="col-md-6">
                                    <select class="form-control" name="destination_city" required>
                                        <option value="" selected="selected">اختر اسم المدينة</option>
                                        @foreach($cities as $city)
                                            <option value="{{ $city->city_name }}">{{ $city->city_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <label for="city_name" class="col-md-2 control-label">اسم المدينة الوجهة</label>
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
