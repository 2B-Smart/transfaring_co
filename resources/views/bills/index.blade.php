@extends('bills.base')
@section('action-content')
        <div>
    <!-- Main content -->
    <section class="content">
      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">قائمة الرحلات</h3>
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('bills.create') }}">إضافة رحلة</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('bills.search') }}">
         {{ csrf_field() }}
         @component('layouts.search', ['title' => 'بحث'])
          @component('layouts.two-cols-date-search-row', ['items' => ['تاريخ الرحلة'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['bill_date'] : '']])
          @endcomponent
          </br>
          @component('layouts.two-cols-search-row', ['items' => ['رقم الرحلة', 'اسم السائق'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['id'] : '', isset($searchingVals) ? $searchingVals['driver_id'] : '']])
          @endcomponent
          </br>
          @component('layouts.two-cols-search-row', ['items' => ['المصدر', 'الوجهة'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['source_city'] : '', isset($searchingVals) ? $searchingVals['destination_city'] : '']])
          @endcomponent
		  </br>
          @component('layouts.two-cols-search-row', ['items' => ['رقم المركبة', 'مقفلة'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['v_number'] : '', isset($searchingVals) ? $searchingVals['has_done'] : '']])
          @endcomponent
        @endcomponent
      </form>
    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap pg-table">
      <div class="row">
        <div class="col-sm-12">
          <table id="example2" class="table table-bordered table-hover">
            <thead>
              <tr role="row">
                <th width="3%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">رقم الرحلة</th>
                <th width="10%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">تاريخ الرحلة</th>
                <th width="3%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">المصدر</th>
                <th width="3%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">الوجهة</th>
                <th width="10%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">السائق</th>
                <th width="10%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">رقم المركبة</th>
                <th width="10%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">أنشئ من قبل</th>
                <th width="10%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">تاريخ الانشاء</th>
                <th width="10%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">اخر تعديل من قبل</th>
                <th width="10%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">تاريخ اخر تعديل</th>
                <th width="3%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">مقفلة؟</th>

                <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2">Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($bills as $bill)
                <tr role="row" class="odd">
                  <td>{{ $bill->id }}</td>
                  <td>{{ $bill->bill_date }}</td>
                  <td>{{ $bill->source_city }}</td>
                  <td>{{ $bill->destination_city }}</td>
                  <td>{{ $bill->driver->full_name }}</td>
                  <td>{{ $bill->v_number }}</td>
                  <td>{{ $bill->user_create }}</td>
                  <td>{{ $bill->created_at }}</td>
                  <td>{{ $bill->user_last_update }}</td>
                  <td>{{ $bill->updated_at }}</td>
                  <td>{{ $bill->has_done }}</td>

                  <td>
                      <a href="{{ route('reports.bill_no_report', $bill->id) }}" class="btn btn-success">
                          طباعة المانيفست
                      </a>
                      <?php if($bill->has_done=="غير مقفلة" ) { ?>
                      <form class="row" method="POST" action="{{ route('bills.billlock', ['id' => $bill->id] ) }}" onsubmit = "return confirm('Are you sure?')">
                          <input type="hidden" name="_method" value="POST">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <button type="submit" class="btn btn-primary col-sm-6 col-xs-5 btn-margin">
                              اقفال
                          </button>
                      </form>
                      <?php } ?>
                      <?php if($bill->has_done=="مقفلة" && \Illuminate\Support\Facades\Auth::user()->role=="admin") { ?>
                      <form class="row" method="POST" action="{{ route('bills.billunlock', ['id' => $bill->id] ) }}" onsubmit = "return confirm('Are you sure?')">
                          <input type="hidden" name="_method" value="POST">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <button type="submit" class="btn btn-primary col-sm-6 col-xs-5 btn-margin">
                              الغاء القفل
                          </button>
                      </form>
                      <?php } ?>
                      <?php if($bill->has_done=="غير مقفلة" || \Illuminate\Support\Facades\Auth::user()->role=="admin") { ?>
                    <form class="row" method="POST" action="{{ route('bills.destroy',  $bill->id) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="{{ route('bills.edit', $bill->id) }}" class="btn btn-warning col-sm-6 col-xs-5 btn-margin">
                        تعديل
                        </a>
                        <a href="{{ route('bills.view', $bill->id) }}" class="btn btn-success col-sm-6 col-xs-5 btn-margin">
                        المحتويات
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
                <th width="3%" rowspan="1" colspan="1">رقم الرحلة</th>
                <th width="10%" rowspan="1" colspan="1">تاريخ الرحلة</th>
                <th width="3%" rowspan="1" colspan="1">المصدر</th>
                <th width="3%" rowspan="1" colspan="1">الوجهة</th>
                <th width="10%" rowspan="1" colspan="1">السائق</th>
                <th width="10%" rowspan="1" colspan="1">رقم المركبة</th>
                <th width="10%" rowspan="1" colspan="1">أنشئ من قبل</th>
                <th width="10%" rowspan="1" colspan="1">تاريخ الانشاء</th>
                <th width="10%" rowspan="1" colspan="1">اخر تعديل من قبل</th>
                <th width="10%" rowspan="1" colspan="1">تاريخ اخر تعديل</th>
                <th width="3%" rowspan="1" colspan="1">مقفلة؟</th>
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
