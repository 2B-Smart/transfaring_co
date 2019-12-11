@extends('customers.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">إضافة زبون</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('customers.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('customer_name') ? ' has-error' : '' }}">

                            <div class="col-md-2"></div>
                            <div class="col-md-6">
                                <input id="customer_name" type="text" class="form-control" name="customer_name" value="{{ old('customer_name') }}" required autofocus>

                                @if ($errors->has('customer_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('customer_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <label for="customer_name" class="col-md-2 control-label">إسم الزبون</label>
                        </div>

                        <div class="form-group{{ $errors->has('customer_address') ? ' has-error' : '' }}">

                            <div class="col-md-2"></div>
                            <div class="col-md-6">
                                <input id="customer_address" type="text" class="form-control" name="customer_address" value="{{ old('customer_address') }}" required>

                                @if ($errors->has('customer_address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('customer_address') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <label for="customer_address" class="col-md-2 control-label">عنوان الزبون</label>
                        </div>

                        <div class="form-group{{ $errors->has('customer_mobile') ? ' has-error' : '' }}">

                            <div class="col-md-2"></div>
                            <div class="col-md-6">
                                <input id="customer_mobile" type="text" class="form-control" name="customer_mobile" value="{{ old('customer_mobile') }}" required>

                                @if ($errors->has('customer_mobile'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('customer_mobile') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <label for="customer_mobile" class="col-md-2 control-label">رقم جوال الزبون</label>
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
