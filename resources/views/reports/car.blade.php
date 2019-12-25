@extends('reports.base')

@section('action-content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">تقرير عدد الرحلات التي قامت بها مركبة بين تاريخين</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('reports.carRp') }}">
                            {{ csrf_field() }}

                            <div class="form-group">

                                <div class="col-md-2"></div>
                                <div class="col-md-6">
                                    <select id="v_number" class="form-control selecter" name="v_number" required>
                                        <option value="" selected></option>
                                        @foreach($cars as $car)
                                            <option value="{{ $car->vehicle_number }}">{{ $car->vehicle_type.' : '.$car->vehicle_number }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <label for="customer_name" class="col-md-2 control-label">المركبة</label>
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
