@php
    use App\bills;
    use App\customers;
@endphp
@extends('receipts.base')
@section('action-content')
<div>
    <!-- Main content -->
    <section class="content">
      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">قائمة الايصالات</h3>
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('receipts.create') }}">إضافة ايصال</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('receipts.search') }}">
         {{ csrf_field() }}
         @component('layouts.search', ['title' => 'بحث'])
          @component('layouts.two-cols-date-search-row', ['items' => ['تاريخ الايصال'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['receipts_date'] : '']])
          @endcomponent
          </br>
          @component('layouts.two-cols-search-row', ['items' => ['رقم الايصال','رقم المانيفست'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['receiptNo'] : '', isset($searchingVals) ? $searchingVals['bill_id'] : '']])
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
    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap pg-table">
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
                <th width="10%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">أنشئ من قبل</th>
                <th width="10%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">تاريخ الانشاء</th>
                <th width="10%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">اخر تعديل من قبل</th>
                <th width="10%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">تاريخ اخر تعديل</th>

                <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2">Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($receipts as $receipt)
                @php
                 $sender = customers::where('id', '=', $receipt->sender)->first();
                 $receiver = customers::where('id', '=', $receipt->receiver)->first();
                 $bill = bills::where('id', '=', $receipt->bill_id)->first();
                @endphp
                <tr role="row" class="odd">
                  <td>{{ $receipt->bill_id }}</td>
                  <td>{{ $receipt->receiptNo }}</td>
                  <td>{{ $sender->customer_name }}</td>
                  <td>{{ $receiver->customer_name }}</td>
                  <td>{{ $receipt->source_city }}</td>
                  <td>{{ $receipt->destination_city }}</td>
                  <td>{{ $receipt->receipts_date }}</td>
                  <td>{{ $receipt->contents }}</td>
                  <td>{{ $receipt->user_create }}</td>
                  <td>{{ $receipt->created_at }}</td>
                  <td>{{ $receipt->user_last_update }}</td>
                  <td>{{ $receipt->updated_at }}</td>

                  <td>

                    <form class="row" method="POST" action="{{ route('receipts.destroy',  $receipt->id) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="{{ route('receipts.view', $receipt->id) }}" class="btn btn-success col-sm-6 col-xs-5 btn-margin">
                        المحتويات
                        </a>
                        <?php if($bill->has_done=="غير مقفلة"|| \Illuminate\Support\Facades\Auth::user()->role=="admin") { ?>
                        <a href="{{ route('receipts.edit', $receipt->id) }}" class="btn btn-warning col-sm-6 col-xs-5 btn-margin">
                            تعديل
                        </a>
                         <button type="submit" class="btn btn-danger col-sm-6 col-xs-5 btn-margin">
                          حذف
                        </button>

                        <?php } ?>

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
                <th width="10%" rowspan="1" colspan="1">أنشئ من قبل</th>
                <th width="10%" rowspan="1" colspan="1">تاريخ الانشاء</th>
                <th width="10%" rowspan="1" colspan="1">اخر تعديل من قبل</th>
                <th width="10%" rowspan="1" colspan="1">تاريخ اخر تعديل</th>

                <th rowspan="1" colspan="2">Action</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
        <div>
            <a href="#" class="paginate btn btn-default" id="previous">السابق</a> |
            <a href="#" class="paginate btn btn-default" id="next">التالي</a>
        </div>
    </div>
  </div>
  <!-- /.box-body -->
</div>
    </section>
    <!-- /.content -->
  </div>
@endsection
