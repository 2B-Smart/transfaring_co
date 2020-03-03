@extends('reports.base')

@section('action-content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">تقرير تفصيل ايصال</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('reports.receipt_paidFRp') }}">
                            {{ csrf_field() }}

                            <div class="form-group">

                                <div class="col-md-2"></div>
                                <div class="col-md-6">
                                    <input type="number" class="form-control" name="receiptNo" required>
                                </div>
                                <label for="receiptNo" class="col-md-2 control-label">رقم الايصال</label>
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
