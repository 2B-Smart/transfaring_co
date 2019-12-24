  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" dir="rtl">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset("/bower_components/AdminLTE/dist/img/user2-160x160.jpg") }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name}}</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <!-- Optionally, you can add icons to the links -->
        <li class="active"><a href="/"><i class="fa fa-link"></i> <span>Dashboard</span></a></li>
        <li><a href="{{ route('user-management.index') }}"><i class="fa fa-link"></i> <span>User management</span></a></li>
        <li><a href="{{ route('drivers.index') }}"><i class="fa fa-link"></i> <span>السائقين</span></a></li>
        <li><a href="{{ route('cars.index') }}"><i class="fa fa-link"></i> <span>المركبات</span></a></li>
        <li><a href="{{ route('cities.index') }}"><i class="fa fa-link"></i> <span>المدن</span></a></li>
        <li><a href="{{ route('customers.index') }}"><i class="fa fa-link"></i> <span>الزبائن</span></a></li>
        <li><a href="{{ route('bills.index') }}"><i class="fa fa-link"></i> <span>الرحلات</span></a></li>
        <li><a href="{{ route('receipts.index') }}"><i class="fa fa-link"></i> <span>الايصالات</span></a></li>
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>التقارير</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('reports/destination') }}">الوجهة</a></li>
            <li><a href="{{ url('reports/driver') }}">السائق</a></li>
            <li><a href="{{ url('reports/country') }}">المرسل</a></li>
            <li><a href="{{ url('reports/state') }}">المرسل اليه</a></li>
            <li><a href="{{ url('reports/city') }}">رقم لوحة المركبة</a></li>
          </ul>
        </li>

      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
