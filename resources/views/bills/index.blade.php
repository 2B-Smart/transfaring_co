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
          @component('layouts.two-cols-search-row', ['items' => ['تاريخ الرحلة', 'اسم السائق'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['bill_date'] : '', isset($searchingVals) ? $searchingVals['driver_id'] : '']])
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
    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
      <div class="row">
        <div class="col-sm-12">
          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
                <th width="3%" class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">رقم الرحلة</th>
                <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="ntnlno: activate to sort column ascending">تاريخ الرحلة</th>
                <th width="3%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="ntnlno: activate to sort column ascending">المصدر</th>
                <th width="3%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="ntnlno: activate to sort column ascending">الوجهة</th>
                <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="ntnlno: activate to sort column ascending">السائق</th>
                <th width="10%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Mobile: activate to sort column ascending">رقم المركبة</th>
                <th width="10%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Createdu: activate to sort column ascending">أنشئ من قبل</th>
                <th width="10%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Createdd: activate to sort column ascending">تاريخ الانشاء</th>
                <th width="10%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Updatedu: activate to sort column ascending">اخر تعديل من قبل</th>
                <th width="10%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Updatedd: activate to sort column ascending">تاريخ اخر تعديل</th>

                <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($bills as $bill)
                <tr role="row" class="odd">
                  <td class="sorting_1">{{ $bill->id }}</td>
                  <td class="sorting_1">{{ $bill->bill_date }}</td>
                  <td class="hidden-xs">{{ $bill->source_city }}</td>
                  <td class="hidden-xs">{{ $bill->destination_city }}</td>
                  <td class="hidden-xs">{{ $bill->driver->full_name }}</td>
                  <td class="hidden-xs">{{ $bill->v_number }}</td>
                  <td class="hidden-xs">{{ $bill->user_create }}</td>
                  <td class="hidden-xs">{{ $bill->created_at }}</td>
                  <td class="hidden-xs">{{ $bill->user_last_update }}</td>
                  <td class="hidden-xs">{{ $bill->updated_at }}</td>

                  <td>
                      <?php if($bill->has_done=="غير مقفلة") { ?>
                      <form class="row" method="POST" action="{{ route('bills.billlock', ['id' => $bill->id] ) }}" onsubmit = "return confirm('Are you sure?')">
                          <input type="hidden" name="_method" value="POST">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <button type="submit" class="btn btn-primary col-sm-6 col-xs-5 btn-margin">
                              اقفال
                          </button>
                      </form>
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
                <th class="hidden-xs" width="10%" rowspan="1" colspan="1">تاريخ الرحلة</th>
                <th class="hidden-xs" width="3%" rowspan="1" colspan="1">المصدر</th>
                <th class="hidden-xs" width="3%" rowspan="1" colspan="1">الوجهة</th>
                <th class="hidden-xs" width="10%" rowspan="1" colspan="1">السائق</th>
                <th class="hidden-xs" width="10%" rowspan="1" colspan="1">رقم المركبة</th>
                <th class="hidden-xs" width="10%" rowspan="1" colspan="1">أنشئ من قبل</th>
                <th class="hidden-xs" width="10%" rowspan="1" colspan="1">تاريخ الانشاء</th>
                <th class="hidden-xs" width="10%" rowspan="1" colspan="1">اخر تعديل من قبل</th>
                <th class="hidden-xs" width="10%" rowspan="1" colspan="1">تاريخ اخر تعديل</th>

                <th rowspan="1" colspan="2">Action</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">إظهار 1 to {{count($bills)}} of {{count($bills)}} سجلات</div>
        </div>
        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
            {{ $bills->links() }}
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