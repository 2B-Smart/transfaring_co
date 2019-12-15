@extends('bills.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">إنشاء رحلة</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('bills.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('source_city') ? ' has-error' : '' }}">

                            <div class="col-md-2"></div>
                            <div class="col-md-6">

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
                            <label for="source_city" class="col-md-2 control-label">المصدر</label>
                        </div>

                        <div class="form-group{{ $errors->has('destination_city') ? ' has-error' : '' }}">

                            <div class="col-md-2"></div>
                            <div class="col-md-6">
                                <select id="destination_city" class="form-control" name="destination_city" required>
                                    <option value="" selected></option>
                                    @foreach($cities_list as $city)
                                        <option value="{{ $city->city_name }}">{{ $city->city_name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('destination_city'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('destination_city') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <label for="destination_city" class="col-md-2 control-label">الوجهة</label>
                        </div>

                        <div class="form-group{{ $errors->has('driver_id') ? ' has-error' : '' }}">

                            <div class="col-md-2"></div>
                            <div class="col-md-6">

                                <select id="driver_id" class="form-control" name="driver_id" required>
                                    <option value="" selected></option>
                                    @foreach($drivers_list as $driver)
                                        <option value="{{ $driver->id }}">{{ $driver->full_name }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('driver_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('driver_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <label for="driver_id" class="col-md-2 control-label">السائق</label>
                        </div>

                        <div class="form-group{{ $errors->has('v_number') ? ' has-error' : '' }}">

                            <div class="col-md-2"></div>
                            <div class="col-md-6">
                                <select id="v_number" class="form-control" name="v_number" required>
                                    <option value="" selected></option>
                                    @foreach($cars_list as $car)
                                        <option value="{{ $car->vehicle_number }}">{{ $car->vehicle_type.' : '.$car->vehicle_number }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('v_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('v_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <label for="v_number" class="col-md-2 control-label">رقم المركبة</label>
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
