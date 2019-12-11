@extends('cities.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">إضافة مدينة</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('cities.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('city_name') ? ' has-error' : '' }}">

                            <div class="col-md-2"></div>
                            <div class="col-md-6">
                                <input id="city_name" type="text" class="form-control" name="city_name" value="{{ old('city_name') }}" required autofocus>

                                @if ($errors->has('city_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('city_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <label for="city_name" class="col-md-2 control-label">اسم المدينة</label>
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
