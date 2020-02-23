@extends('receipts.base')

@section('action-content')
    <div class="container">
        <div class="row">
            <div class="col col-sm-6">
                <table class="table">
                    <tr>

                        <th>نقل الى مانيفست</th>

                        <th>المنافيست التي تحوي الخطأ</th>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group">
                                <select id="bill_id2" class="form-control billNumber">
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <select id="bill_id" class="form-control billNumber">
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <div class="form-group">
                                <button type="button" class="btn btn-success pull-right s">بحث</button>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col col-sm-10" id="resaultData">

            </div>
        </div>
    </div>
    <script src="{{ asset ("/bower_components/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js") }}"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function () {
            $(document).on('click','.s',function() {
                var bill_id = $("#bill_id").val();
                $('#resaultData').empty();
                $.ajax({

                    type:'POST',

                    url:"{{ route('receipts.getR') }}",

                    data:{"_token": "{{ csrf_token() }}",bill_id:bill_id}

                }).done(function(data){
                    $('#resaultData').append(
                        data
                    );
                    //location.reload();
                });
            });
        });

        $(function () {
            $(document).on('click','.mvR',function() {
                if(confirm("هل تريد النقل!!")){
                    var ID = $(this).attr("id");
                    var bill_id = $("#bill_id2").val();
                    $.ajax({

                        type:'POST',

                        url:"{{ route('receipts.mvR') }}",

                        data:{"_token": "{{ csrf_token() }}",ID:ID,bill_id:bill_id}

                    }).done(function(result){ $("#"+ID).remove();});
                }
            });
        });
        $(function () {
            $(document).on('click','.mvAR',function() {
                if(confirm("هل تريد النقل الكل!!")){
                    var bill_id = $("#bill_id").val();
                    var bill_id2 = $("#bill_id2").val();
                    $.ajax({

                        type:'POST',

                        url:"{{ route('receipts.mvAR') }}",

                        data:{"_token": "{{ csrf_token() }}",bill_id:bill_id,bill_id2:bill_id2}

                    }).done(function(result){ $('#resaultData').empty(); alert("تم النقل بنجاح")});
                }
            });
        });


    </script>

@endsection