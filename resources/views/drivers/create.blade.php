@extends('drivers.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add new user</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('drivers.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('full_name') ? ' has-error' : '' }}">

                            <div class="col-md-2"></div>
                            <div class="col-md-6">
                                <input id="full_name" type="text" class="form-control" name="full_name" value="{{ old('full_name') }}" required autofocus>

                                @if ($errors->has('full_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('full_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <label for="full_name" class="col-md-2 control-label">الاسم الكامل</label>
                        </div>

                        <div class="form-group{{ $errors->has('national_id_number') ? ' has-error' : '' }}">

                            <div class="col-md-2"></div>
                            <div class="col-md-6">
                                <input id="national_id_number" type="text" class="form-control" name="national_id_number" value="{{ old('national_id_number') }}" required>

                                @if ($errors->has('national_id_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('national_id_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <label for="national_id_number" class="col-md-2 control-label">الرقم الوطني</label>
                        </div>
                        <div class="form-group{{ $errors->has('mobile_number') ? ' has-error' : '' }}">

                            <div class="col-md-2"></div>
                            <div class="col-md-6">
                                <input id="mobile_number" type="text" class="form-control" name="mobile_number" value="{{ old('mobile_number') }}" required>

                                @if ($errors->has('mobile_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mobile_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <label for="mobile_number" class="col-md-2 control-label">رقم الجوال</label>
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
