@extends('drivers.base')
@section('action-content')
        <div>
    <!-- Main content -->
    <section class="content">
      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">قائمة السائقين</h3>
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('drivers.create') }}">إضافة سائق</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('drivers.search') }}">
         {{ csrf_field() }}
         @component('layouts.search', ['title' => 'بحث'])
          @component('layouts.two-cols-search-row', ['items' => ['الاسم', 'الرقم الوطني'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['full_name'] : '', isset($searchingVals) ? $searchingVals['national_id_number'] : '']])
          @endcomponent
          </br>
          @component('layouts.two-cols-search-row', ['items' => ['رقم الجوال'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['mobile_number'] : '']])
          @endcomponent
        @endcomponent
      </form>
    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap pg-table">
      <div class="row">
        <div class="col-sm-12">
          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
                <th width="10%" rowspan="1" colspan="1">الاسم</th>
                <th width="10%" rowspan="1" colspan="1">الرقم الوطني</th>
                <th width="10%" rowspan="1" colspan="1">رقم الجوال</th>
                <th width="10%" rowspan="1" colspan="1">أنشئ من قبل</th>
                <th width="10%" rowspan="1" colspan="1">تاريخ الانشاء</th>
                <th width="10%" rowspan="1" colspan="1">اخر تعديل من قبل</th>
                <th width="10%" rowspan="1" colspan="1">تاريخ اخر تعديل</th>

                <th rowspan="1" colspan="2">Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($drivers as $driver)
                <tr role="row" class="odd">
                  <td>{{ $driver->full_name }}</td>
                  <td>{{ $driver->national_id_number }}</td>
                  <td>{{ $driver->mobile_number }}</td>
                  <td>{{ $driver->user_create }}</td>
                  <td>{{ $driver->created_at }}</td>
                  <td>{{ $driver->user_last_update }}</td>
                  <td>{{ $driver->updated_at }}</td>

                  <td>
                    <form class="row" method="POST" action="{{ route('drivers.destroy',  $driver->id) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="{{ route('drivers.edit', $driver->id) }}" class="btn btn-warning col-sm-3 col-xs-5 btn-margin">
                        تعديل
                        </a>

                         <button type="submit" class="btn btn-danger col-sm-3 col-xs-5 btn-margin">
                          حذف
                        </button>

                    </form>
                  </td>
              </tr>
            @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th width="10%" rowspan="1" colspan="1">الاسم</th>
                <th width="10%" rowspan="1" colspan="1">الرقم الوطني</th>
                <th width="10%" rowspan="1" colspan="1">رقم الجوال</th>
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
