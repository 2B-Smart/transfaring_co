@extends('customers.base')
@section('action-content')
        <div>
    <!-- Main content -->
    <section class="content">
      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">قائمة الزبائن</h3>
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('customers.create') }}">إضافة زبون</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('customers.search') }}">
         {{ csrf_field() }}
         @component('layouts.search', ['title' => 'بحث'])
          @component('layouts.two-cols-search-row', ['items' => ['اسم الزبون' , 'عنوان الزبون'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['customer_name'] : '', isset($searchingVals) ? $searchingVals['customer_address'] : '']])
          @endcomponent
         </br>
          @component('layouts.two-cols-search-row', ['items' => ['رقم الزبون'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['customer_mobile'] : '']])
          @endcomponent
        @endcomponent
      </form>
    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap pg-table">
      <div class="row">
        <div class="col-sm-12">
          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
                <th width="10%" rowspan="1" colspan="1">إسم الزبون</th>
                <th width="10%" rowspan="1" colspan="1">عنوان الزبون</th>
                <th width="10%" rowspan="1" colspan="1">رقم الزبون</th>
                <th width="10%" rowspan="1" colspan="1">أنشئ من قبل</th>
                <th width="10%" rowspan="1" colspan="1">تاريخ الانشاء</th>
                <th width="10%" rowspan="1" colspan="1">اخر تعديل من قبل</th>
                <th width="10%" rowspan="1" colspan="1">تاريخ اخر تعديل</th>

                <th tabindex="0" rowspan="1" colspan="2">Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($customers as $customer)
                <tr role="row" class="odd">
                  <td>{{ $customer->customer_name }}</td>
                  <td>{{ $customer->customer_address }}</td>
                  <td>{{ $customer->customer_mobile }}</td>
                  <td>{{ $customer->user_create }}</td>
                  <td>{{ $customer->created_at }}</td>
                  <td>{{ $customer->user_last_update }}</td>
                  <td>{{ $customer->updated_at }}</td>

                  <td>
                    <form class="row" method="POST" action="{{ route('customers.destroy',  $customer->id) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-warning col-sm-3 col-xs-5 btn-margin">
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
                <th width="10%" rowspan="1" colspan="1">إسم الزبون</th>
                <th width="10%" rowspan="1" colspan="1">عنوان الزبون</th>
                <th width="10%" rowspan="1" colspan="1">رقم الزبون</th>
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
