@extends('cars.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">إضافة مركبة</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('cars.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('vehicle_number') ? ' has-error' : '' }}">

                            <div class="col-md-2"></div>
                            <div class="col-md-6">
                                <input id="vehicle_number" type="text" class="form-control" name="vehicle_number" value="{{ old('vehicle_number') }}" required autofocus>

                                @if ($errors->has('vehicle_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('vehicle_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <label for="vehicle_number" class="col-md-2 control-label">رقم المركبة</label>
                        </div>

                        <div class="form-group{{ $errors->has('vehicle_type') ? ' has-error' : '' }}">

                            <div class="col-md-2"></div>
                            <div class="col-md-6">
                                <input id="vehicle_type" type="text" class="form-control" name="vehicle_type" value="{{ old('vehicle_type') }}" required>

                                @if ($errors->has('vehicle_type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('vehicle_type') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <label for="vehicle_type" class="col-md-2 control-label">نوع المركبة</label>
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
