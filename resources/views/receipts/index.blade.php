@extends('receipts.base')
@section('action-content')

<div class="row">
        {{-- <div class="col-sm-8 text-center">
            <h3></h3>
        </div> --}}
        <div class="row">
                <div class="col-md-6">
                  <div class="form-group text-right">
                    <label>إلى المنفست رقم</label>
                    <select class="form-control select2bs4" style="width: 100%;">
                      <option selected="selected">123456</option>
                      <option>123545</option>
                      <option>515154</option>
                      <option>123545</option>
                      <option>123545</option>
                      <option>123545</option>
                      <option>123545</option>
                    </select>
                  </div>
              </div>
        <div class="col-sm-4 text-right"><h3>وثيقة شحن</h3></div>
      </div>
      <div class="row">
        <div class="col-sm-6"><input class="form-control text-center" type="text" placeholder="المرسل إليه"></div>
        <div class="col-sm-6"><input class="form-control text-center" type="text" placeholder="المرسل"></div>
      </div>
      <div class="row">
        <div class="col-sm-6"><input class="form-control text-center" type="text" placeholder="العنوان"></div>
        <div class="col-sm-6"><input class="form-control text-center" type="text" placeholder="العنوان"></div>
      </div>
      <div class="row">
        <div class="col-sm-6"><input class="form-control text-center" type="text" placeholder="الهاتف"></div>
        <div class="col-sm-6"><input class="form-control text-center" type="text" placeholder="الهاتف"></div>
      </div>
      <div class="row">
        <div class="col-sm-6"><input class="form-control text-center" type="text" placeholder="مكان التسليم"></div>
        <div class="col-sm-6"><input class="form-control text-center" type="text" placeholder="مكان الإستلام"></div>
      </div>
      <div class="row">
        <div class="col-sm-6"><input class="form-control text-center" type="text" placeholder="المحتويات"></div>
        <div class="col-sm-6"><input class="form-control text-center" type="text" placeholder="عدد الطرود"></div>
      </div>
      <div class="row text-center">
            <div class="col-sm-4 text-center"><h3>للتحصيل من المرسل إليه</h3></div>
            <div class="col-sm-4 text-center"><h3>المدفوع مسبقا</h3></div>
            <div class="col-sm-4"><h3>الأجور</h3></div>
      </div>
      <br>
      <div class="row text-center">
            <div class="col-sm-4"><input class="form-control" type="text" placeholder=""></div>
            <div class="col-sm-4"><input class="form-control" type="text" placeholder=""></div>
            <div class="col-sm-4"><h4>أجور الشحن</h4></div>
      </div>
      <div class="row text-center">
            <div class="col-sm-4"><input class="form-control" type="text" placeholder=""></div>
            <div class="col-sm-4"><input class="form-control" type="text" placeholder=""></div>
            <div class="col-sm-4"><h4>متفرقات</h4></div>
      </div>
      <div class="row text-center">
            <div class="col-sm-4"><input class="form-control" type="text" placeholder=""></div>
            <div class="col-sm-4"><input class="form-control" type="text" placeholder=""></div>
            <div class="col-sm-4"><h4>ضد الشحن</h4></div>
          </div>
          <div class="card-footer text-center">
                <button type="submit" class="btn btn-info">إرسال</button>
                <button type="submit" class="btn btn-default float-right">إلغاء</button>
              </div>
@endsection

