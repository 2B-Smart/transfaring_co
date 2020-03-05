@extends('receipts.base')
@section('action-content')
<div>
    <!-- Main content -->
    <section class="content">
      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">إيصالات ضد الدفع</h3>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('receipts.searchunpaid') }}">
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
                <th width="10%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">ضد الدفع</th>

                <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2">Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($receipts as $receipt)
                <tr role="row" class="odd">
                  <td>{{ $receipt->bill_id }}</td>
                  <td>{{ $receipt->receiptNo }}</td>
                  <td>{{ $receipt->customer_sender->customer_name }}</td>
                  <td>{{ $receipt->customer_receiver->customer_name }}</td>
                  <td>{{ $receipt->source_city }}</td>
                  <td>{{ $receipt->destination_city }}</td>
                  <td>{{ $receipt->receipts_date }}</td>
                  <td>{{ $receipt->contents }}</td>
                  <td>{{ $receipt->remittances }}</td>

                  <td>
                      @if($receipt->remittances_paid=='غير مدفوع')
                          <button type="button" class="btn btn-success addrec" data-toggle="modal" data-target="#Bcourses_{{ $receipt->id }}">تم الاستلام</button>
                      @else
                          <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#Bcourses2_{{ $receipt->id }}">تم التسليم</button>
                      @endif
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
                <th width="10%" rowspan="1" colspan="1"> ضد الدفع</th>

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
      <div class="row">
          <div class="col-sm-12">
              @foreach($receipts as $receipt)
                  @if($receipt->remittances_paid=='غير مدفوع')
                      <div class="modal fade" id="Bcourses_{{ $receipt->id }}" role="dialog">
                          <div class="modal-dialog">

                              <!-- Modal content-->
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      <h4 class="modal-title">معلومات الحوالة</h4>
                                  </div>
                                  <div class="modal-body">
                                      <form class="form-horizontal">
                                          <div class="form-group">
                                              <label for="name" class="col-sm-2 control-label">رقم الحوالة</label>
                                              <div class="col-sm-10">
                                                  <input id="voucher_no_{{ $receipt->id }}" type="text">
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label for="name" class="col-sm-2 control-label">تاريخ الحوالة</label>
                                              <div class="col-sm-10">
                                                  <input id="paid_date_{{ $receipt->id }}"class="from" type="text" value="<?=date('Y-m-d')?>">
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <div class="col-sm-12">
                                                  <button type="button" class="btn btn-success addcrs" id="1_{{ $receipt->id }}">تم الاستلام</button>
                                              </div>
                                          </div>
                                      </form>
                                  </div>
                                  <div class="modal-footer">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  </div>
                              </div>

                          </div>
                      </div>
                  @else
                      <div class="modal fade" id="Bcourses2_{{ $receipt->id }}" role="dialog">
                          <div class="modal-dialog">

                              <!-- Modal content-->
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      <h4 class="modal-title">معلومات المستلم</h4>
                                  </div>
                                  <div class="modal-body">
                                      <form class="form-horizontal">
                                          <div class="form-group">
                                              <label for="name" class="col-sm-2 control-label">الاسم</label>
                                              <div class="col-sm-10">
                                                  <input id="full_name_{{ $receipt->id }}" type="text" value="{{ $receipt->customer_receiver->customer_name }}">
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label for="شadd" class="col-sm-2 control-label">العنوان</label>
                                              <div class="col-sm-10">
                                                  <input id="address_{{ $receipt->id }}" type="text" value="{{ $receipt->customer_receiver->customer_address }}">
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label for="moNo" class="col-sm-2 control-label">رقم الجوال</label>
                                              <div class="col-sm-10">
                                                  <input id="mobileNo_{{ $receipt->id }}" type="number" value="{{ $receipt->customer_receiver->customer_mobile }}">
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label for="name" class="col-sm-2 control-label">تاريخ الحوالة</label>
                                              <div class="col-sm-10">
                                                  <input id="received_date_{{ $receipt->id }}"class="from" type="text" value="<?=date('Y-m-d')?>">
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <div class="col-sm-12">
                                                  <button type="button" class="btn btn-success addcrs2" id="2_{{ $receipt->id }}">تم التسليم</button>
                                              </div>
                                          </div>
                                      </form>
                                  </div>
                                  <div class="modal-footer">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  </div>
                              </div>

                          </div>
                      </div>
                  @endif
              @endforeach
          </div>
      </div>
  </div>
  <!-- /.box-body -->
</div>
    </section>
    <!-- /.content -->
  </div>

<script src="{{ asset ("/bower_components/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js") }}"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(function () {
        $(document).on('click','.addcrs',function() {
            var ID = $(this).attr("id");
            var shortText = jQuery.trim(ID).substring(2);
            var voucher_no=$("#voucher_no_"+shortText).val();
            var paid_date=$("#paid_date_"+shortText).val();
            $.ajax({

                type:'POST',

                url:"{{ route('receipts.haspaid') }}",

                data:{"_token": "{{ csrf_token() }}",ID:shortText,voucher_no:voucher_no,paid_date:paid_date}

            }).done(function(result){ location.reload();});
        });
    });
    $(function () {
        $(document).on('click','.addcrs2',function() {
            var ID = $(this).attr("id");
            var shortText = jQuery.trim(ID).substring(2);
            var full_name=$("#full_name_"+shortText).val();
            var address=$("#address_"+shortText).val();
            var mobileNo=$("#mobileNo_"+shortText).val();
            var received_date=$("#received_date_"+shortText).val();
            $.ajax({

                type:'POST',

                url:"{{ route('receipts.hasreceivedbycrs') }}",

                data:{"_token": "{{ csrf_token() }}",ID:shortText,full_name:full_name,address:mobileNo,mobileNo:address,received_date:received_date}

            }).done(function(result){ location.reload();});
        });
    });

</script>
@endsection
