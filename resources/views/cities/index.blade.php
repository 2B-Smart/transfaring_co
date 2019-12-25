@extends('cities.base')
@section('action-content')
        <div>
    <!-- Main content -->
    <section class="content">
      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">قائمة المدن</h3>
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('cities.create') }}">إضافة مدينة</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('cities.search') }}">
         {{ csrf_field() }}
         @component('layouts.search', ['title' => 'Search'])
          @component('layouts.two-cols-search-row', ['items' => ['اسم المدينة'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['city_name'] : '']])
          @endcomponent
        @endcomponent
      </form>
    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
      <div class="row">
        <div class="col-sm-12">
          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
                <th width="10%"rowspan="1" colspan="1">اسم المدينة</th>
                <!-- <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="ntnlno: activate to sort column ascending">نوع المركبة</th> -->
                <th width="10%" rowspan="1" colspan="1">أنشئ من قبل</th>
                <th width="10%" rowspan="1" colspan="1">تاريخ الانشاء</th>
                <th width="10%" rowspan="1" colspan="1">اخر تعديل من قبل</th>
                <th width="10%" rowspan="1" colspan="1">تاريخ اخر تعديل</th>

                <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($cities as $city)
                <tr role="row" class="odd">
                  <td class="sorting_1">{{ $city->city_name }}</td>
                  <td>{{ $city->user_create }}</td>
                  <td>{{ $city->created_at }}</td>
                  <td>{{ $city->user_last_update }}</td>
                  <td>{{ $city->updated_at }}</td>

                  <td>
                    <form class="row" method="POST" action="{{ route('cities.destroy',  $city->city_name) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="{{ route('cities.edit', $city->city_name) }}" class="btn btn-warning col-sm-3 col-xs-5 btn-margin">
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
                <th width="10%" rowspan="1" colspan="1">اسم المدينة</th>
                <!-- <th width="10%" rowspan="1" colspan="1">نوع المركبة</th> -->
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
      <div class="row">
        <div class="col-sm-5">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">إظهار 1 to {{count($cities)}} of {{count($cities)}} سجلات</div>
        </div>
        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
            {{ $cities->links() }}
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
