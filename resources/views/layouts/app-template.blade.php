<!DOCTYPE html>
<!--
  This is a starter template page. Use this page to start your new project from
  scratch. This page gets rid of all links and provides the needed markup only.
  -->
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>شركة عودة للشحن</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link href="{{ asset("/bower_components/AdminLTE/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link href="{{ asset("/bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("/bower_components/AdminLTE/plugins/daterangepicker/daterangepicker.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("/bower_components/AdminLTE/plugins/datepicker/datepicker3.css")}}" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{ asset("/bower_components/AdminLTE/dist/css/AdminLTE.min.css")}}" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
      page. However, you can choose any other skin. Make sure you
      apply the skin class to the body tag so the changes take effect.
      -->
    <link href="{{ asset("/bower_components/AdminLTE/dist/css/skins/_all-skins.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/app-template.css') }}" rel="stylesheet">
    <link href="{{ asset("/select2/css/select2.min.css")}}" rel="stylesheet" type="text/css" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <!--
    BODY TAG OPTIONS:
    =================
    Apply one or more of the following classes to get the
    desired effect
    |---------------------------------------------------------|
    | SKINS         | skin-blue                               |
    |               | skin-black                              |
    |               | skin-purple                             |
    |               | skin-yellow                             |
    |               | skin-red                                |
    |               | skin-green                              |
    |---------------------------------------------------------|
    |LAYOUT OPTIONS | fixed                                   |
    |               | layout-boxed                            |
    |               | layout-top-nav                          |
    |               | sidebar-collapse                        |
    |               | sidebar-mini                            |
    |---------------------------------------------------------|
    -->
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
    <!-- Main Header -->
    @include('layouts.header')
    <!-- Sidebar -->
    @include('layouts.sidebar')
    @yield('content')
    <!-- /.content-wrapper -->
    <!-- Footer -->
    @include('layouts.footer')
    <!-- ./wrapper -->
    <!-- REQUIRED JS SCRIPTS -->
    <!-- jQuery 2.1.3 -->
    <script src="{{ asset ("/bower_components/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js") }}"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="{{ asset ("/bower_components/AdminLTE/bootstrap/js/bootstrap.min.js") }}" type="text/javascript"></script>
    <script  src="{{ asset ("/bower_components/AdminLTE/plugins/datatables/jquery.dataTables.min.js") }}" type="text/javascript" ></script>
    <script  src="{{ asset ("/bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js") }}" type="text/javascript" ></script>
    <script  src="{{ asset ("/bower_components/AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js") }}" type="text/javascript" ></script>
    <script  src="{{ asset ("/bower_components/AdminLTE/plugins/fastclick/fastclick.js") }}" type="text/javascript" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script  src="{{ asset ("/bower_components/AdminLTE/plugins/input-mask/jquery.inputmask.js") }}" type="text/javascript" ></script>
    <script  src="{{ asset ("/bower_components/AdminLTE/plugins/input-mask/jquery.inputmask.date.extensions.js") }}" type="text/javascript" ></script>
    <script  src="{{ asset ("/bower_components/AdminLTE/plugins/input-mask/jquery.inputmask.extensions.js") }}" type="text/javascript" ></script>
    <script  src="{{ asset ("/bower_components/AdminLTE/plugins/daterangepicker/daterangepicker.js") }}" type="text/javascript" ></script>
    <script  src="{{ asset ("/bower_components/AdminLTE/plugins/datepicker/bootstrap-datepicker.js") }}" type="text/javascript" ></script>
    <!-- AdminLTE App -->
    <script src="{{ asset ("/bower_components/AdminLTE/dist/js/app.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset ("/bower_components/AdminLTE/dist/js/demo.js") }}" type="text/javascript"></script>
      <script src="{{ asset ("/select2/js/select2.min.js") }}" type="text/javascript"></script>


    <!-- Optionally, you can add Slimscroll and FastClick plugins.
      Both of these plugins are recommended to enhance the
      user experience. Slimscroll is required when using the
      fixed layout. -->
      <script>
      $(document).ready(function() {
        //Date picker
        $('#birthDate').datepicker({
          autoclose: true,
          format: 'yyyy/mm/dd'
        });
        $('#hiredDate').datepicker({
          autoclose: true,
          format: 'yyyy/mm/dd'
        });
        $('#from').datepicker({
          autoclose: true,
          format: 'yyyy-mm-dd'
        });
        $('.from').datepicker({
          autoclose: true,
          format: 'yyyy-mm-dd'
        });
        $('#to').datepicker({
          autoclose: true,
          format: 'yyyy-mm-dd'
        });
        $("#sender").select2({
            ajax: {
              url: function (params) {
                return "/customers/getCustomers?search="+params.term;
              },
              processResults: function (response) {
                return {
                    results: response
                };
              },
              cache: true
            }
            // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
        });

        $("#receiver").select2({
            ajax: {
              url: function (params) {
                return "/customers/getCustomers?search="+params.term;
              },
              processResults: function (response) {
                return {
                    results: response
                };
              },
              cache: true
            }
            // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
        });
        $(".selecter").select2();
        $(function () {
          // Selectors for future use
          var myTable = ".pg-table";
          var myTableBody = myTable + " tbody";
          var myTableRows = myTableBody + " tr";
          var myTableColumn = myTable + " th";

          // Starting table state
          function initTable() {
            $(myTableBody).attr("data-pageSize", 10);
            $(myTableBody).attr("data-firstRecord", 0);
            $('#previous').hide();
            $('#next').show();

            // Increment the table width for sort icon support


            // Start the pagination
            paginate(parseInt($(myTableBody).attr("data-firstRecord"), 10),
                    parseInt($(myTableBody).attr("data-pageSize"), 10));
          }


          // Table sorting function
          function sortTable(table, column, order) {


          }

          // Heading click
          $(myTableColumn).click(function () {


            // Start the pagination
            paginate(parseInt($(myTableBody).attr("data-firstRecord"), 10),
                    parseInt($(myTableBody).attr("data-pageSize"), 10));
          });

          // Pager click
          $("a.paginate").click(function (e) {
            e.preventDefault();
            var tableRows = $(myTableRows);
            var tmpRec = parseInt($(myTableBody).attr("data-firstRecord"), 10);
            var pageSize = parseInt($(myTableBody).attr("data-pageSize"), 10);

            // Define the new first record
            if ($(this).attr("id") == "next") {
              tmpRec += pageSize;
            } else {
              tmpRec -= pageSize;
            }
            // The first record is < of 0 or > of total rows
            if (tmpRec < 0 || tmpRec > tableRows.length) return

            $(myTableBody).attr("data-firstRecord", tmpRec);
            paginate(tmpRec, pageSize);
          });

          // Paging function
          var paginate = function (start, size) {
            var tableRows = $(myTableRows);
            var end = start + size;
            // Hide all the rows
            tableRows.hide();
            // Show a reduced set of rows using a range of indices.
            tableRows.slice(start, end).show();
            // Show the pager
            $(".paginate").show();
            // If the first row is visible hide prev
            if (tableRows.eq(0).is(":visible")) $('#previous').hide();
            // If the last row is visible hide next
            if (tableRows.eq(tableRows.length - 1).is(":visible")) $('#next').hide();
          }
          // Table starting state
          initTable();


        });
    });
    </script>
<script src="{{ asset('js/site.js') }}"></script>
  </body>
</html>