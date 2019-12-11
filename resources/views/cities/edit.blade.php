@extends('cities.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">تعديل بيانات مدينة</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('cities.update', $cities->city_name) }}">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">


                        <div class="form-group{{ $errors->has('city_name') ? ' has-error' : '' }}">

                            <div class="col-md-2"></div>
                            <div class="col-md-6">
                                <input id="city_name" type="text" class="form-control" name="city_name" value="{{ $cities->city_name }}" required>

                                @if ($errors->has('city_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('city_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <label for="city_name" class="col-md-2 control-label">رقم السيارة</label>
                        </div>

                        <div class="form-group{{ $errors->has('vehicle_type') ? ' has-error' : '' }}">

                            <!-- <div class="col-md-2"></div>
                            <div class="col-md-6">
                                <input id="vehicle_type" type="text" class="form-control" name="vehicle_type" value="{{ $cities->vehicle_type }}" required>

                                @if ($errors->has('vehicle_type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('vehicle_type') }}</strong>
                                    </span>
                                @endif 
                            </div>
                            <label for="vehicle_type" class="col-md-2 control-label">نوع المركبة</label>
                         </div>  -->

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    تعديل
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
