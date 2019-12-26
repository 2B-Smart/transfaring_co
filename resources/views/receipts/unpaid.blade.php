@extends('receipts.base')
@section('action-content')
<div>
    <!-- Main content -->
    <section class="content">
      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title"></h3>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('receipts.searchunpaid') }}">
         {{ csrf_field() }}
         @component('layouts.search', ['title' => 'بحث'])
          @component('layouts.two-cols-date-search-row', ['items' => ['تاريخ الايصال'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['receipts_date'] : '']])
          @endcomponent
          </br>
          @component('layouts.two-cols-search-row', ['items' => ['رقم الايصال','رقم المانيفست'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['id'] : '', isset($searchingVals) ? $searchingVals['bill_id'] : '']])
          @endcomponent
          </br>
          @component('layouts.two-cols-search-row', ['items' => ['المصدر', 'الوجهة'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['source_city'] : '', isset($searchingVals) ? $searchingVals['destination_city'] : '']])
          @endcomponent
		  </br>
          @component('layouts.two-cols-search-row', ['items' => ['المرسل', 'المرسل إليه'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['sender'] : '', isset($searchingVals) ? $searchingVals['receiver'] : '']])
          @endcomponent
        @endcomponent
      </form>
    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
      <div class="row">
        <div class="col-sm-12">
          <table id="example2" class="table table-bordered table-hover">
            <thead>
              <tr role="row">
                <th width="3%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">رقم المانيفست</th>
                <th width="3%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">رقم الايصال</th>
                <th width="3%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">المرسل</th>
                <th width="3%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">المرسل اليه</th>
                <th width="3%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">المصدر</th>
                <th width="3%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">الوجهة</th>
                <th width="10%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">تاريخ الايصال</th>
                <th width="10%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">المحتويات</th>
                <th width="10%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">ضد الدفع</th>

                <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2">Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($receipts as $receipt)
                <tr role="row" class="odd">
                  <td>{{ $receipt->bill_id }}</td>
                  <td>{{ $receipt->id }}</td>
                  <td>{{ $receipt->customer_sender->customer_name }}</td>
                  <td>{{ $receipt->customer_receiver->customer_name }}</td>
                  <td>{{ $receipt->source_city }}</td>
                  <td>{{ $receipt->destination_city }}</td>
                  <td>{{ $receipt->receipts_date }}</td>
                  <td>{{ $receipt->contents }}</td>
                  <td>{{ $receipt->remittances }}</td>

                  <td>
                    <form class="row" method="POST" action="{{ route('receipts.haspaid',  $receipt->id) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                         <button type="submit" class="btn btn-danger col-sm-6 col-xs-5 btn-margin">
                          تم الدفع
                        </button>
                    </form>

                  </td>
              </tr>
            @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th width="3%" rowspan="1" colspan="1">رقم المانيفست</th>
                <th width="3%" rowspan="1" colspan="1">رقم الايصال</th>
                <th width="3%" rowspan="1" colspan="1">المرسل</th>
                <th width="3%" rowspan="1" colspan="1">المرسل اليه</th>
                <th width="3%" rowspan="1" colspan="1">المصدر</th>
                <th width="3%" rowspan="1" colspan="1">الوجهة</th>
                <th width="10%" rowspan="1" colspan="1">تاريخ الايصال</th>
                <th width="10%" rowspan="1" colspan="1">المحتويات</th>
                <th width="10%" rowspan="1" colspan="1"> ضد الدفع</th>

                <th rowspan="1" colspan="2">Action</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">إظهار 1 to {{count($receipts)}} of {{count($receipts)}} سجلات</div>
        </div>
        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
            {{ $receipts->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.box-body -->
</div>
    </section>
    <!-- /.content -->
  </div>
@endsection
