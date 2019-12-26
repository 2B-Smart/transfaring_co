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
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <!-- Optionally, you can add icons to the links
        <li class="active"><a href="/"><i class="fa fa-link"></i> <span>Dashboard</span></a></li>-->
        <?php if(\Illuminate\Support\Facades\Auth::user()->role=='admin'){ ?>
        <li><a href="{{ route('user-management.index') }}"><i class="fa fa-users"></i> <span>ادارة المستخدمين</span></a></li>
        <?php }?>
        <li><a href="{{ route('drivers.index') }}"><i class="fa fa-user"></i> <span>السائقين</span></a></li>
        <li><a href="{{ route('cars.index') }}"><i class="fa fa-car"></i> <span>المركبات</span></a></li>
        <li><a href="{{ route('cities.index') }}"><i class="fa fa-building-o"></i> <span>المدن</span></a></li>
        <li><a href="{{ route('customers.index') }}"><i class="fa fa-users"></i> <span>الزبائن</span></a></li>
        <li><a href="{{ route('bills.index') }}"><i class="fa fa-truck"></i> <span>الرحلات</span></a></li>
        <li><a href="{{ route('receipts.index') }}"><i class="fa fa-book"></i> <span>الايصالات</span></a></li>
        <li><a href="{{ route('receipts.unpaid') }}"><i class="fa fa-book"></i> <span>الايصالات ضد الدفع لم يتم دفعها</span></a></li>
        <li class="treeview">
          <a href="#"><i class="fa fa-files-o"></i> <span>التقارير</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('reports/destination') }}">الوجهة</a></li>
            <li><a href="{{ url('reports/driver') }}">السائق</a></li>
            <li><a href="{{ url('reports/sender') }}">المرسل</a></li>
            <li><a href="{{ url('reports/receiver') }}">المرسل اليه</a></li>
            <li><a href="{{ url('reports/car') }}">رقم لوحة المركبة</a></li>
          </ul>
        </li>

      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
