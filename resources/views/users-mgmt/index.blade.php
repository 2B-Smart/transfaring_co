@extends('users-mgmt.base')
@section('action-content')
        <div>
    <!-- Main content -->
    <section class="content">
      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">قائمة المستخدمين</h3>
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('user-management.create') }}">اضافة مستخدم جديد</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('user-management.search') }}">
         {{ csrf_field() }}
         @component('layouts.search', ['title' => 'بحث'])
          @component('layouts.two-cols-search-row', ['items' => ['اسم المستخدم', 'الاسم الاول'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['name'] : '', isset($searchingVals) ? $searchingVals['firstname'] : '']])
          @endcomponent
          </br>
          @component('layouts.two-cols-search-row', ['items' => ['الكنية'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['lastname'] : '']])
          @endcomponent
          </br>
          @component('layouts.two-cols-drop-search-row', ['items' => ['الصلاحية'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['role'] : '']])
          @endcomponent
        @endcomponent
      </form>
    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
      <div class="row">
        <div class="col-sm-12">
          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
                <th width="10%" rowspan="1" colspan="1">اسم المستخدم</th>
                <th width="20%" rowspan="1" colspan="1">البريد الالكتروني</th>
                <th width="20%" rowspan="1" colspan="1">الاسم الاول</th>
                <th width="20%" rowspan="1" colspan="1">الكنية</th>
                <th width="10%" rowspan="1" colspan="1">الصلاحية</th>
                <th rowspan="1" colspan="2"></th>
              </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr role="row" class="odd">
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->firstname }}</td>
                  <td>{{ $user->lastname }}</td>
                  <td>{{ $user->role }}</td>
                  <td>
                    <form class="row" method="POST" action="{{ route('user-management.destroy',  $user->id) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="{{ route('user-management.edit', $user->id) }}" class="btn btn-warning col-sm-3 col-xs-5 btn-margin">
                        تعديل
                        </a>
                        @if ($user->username == Auth::user()->username)
                         <button type="submit" class="btn btn-danger col-sm-3 col-xs-5 btn-margin">
                          حذف
                        </button>
                        @endif
                    </form>
                  </td>
              </tr>
            @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th width="10%" rowspan="1" colspan="1">اسم المستخدم</th>
                <th width="20%" rowspan="1" colspan="1">البريد الالكتروني</th>
                <th width="20%" rowspan="1" colspan="1">الاسم الاول</th>
                <th width="20%" rowspan="1" colspan="1">الكنية</th>
                <th width="10%" rowspan="1" colspan="1">الصلاحية</th>
                <th rowspan="1" colspan="2"></th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
        <div class="row">
            <div class="col-sm-5">
                <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">إظهار 1 to {{count($users)}} of {{count($users)}} سجلات</div>
            </div>
            <div class="col-sm-7">
                <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                    {{ $users->links() }}
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