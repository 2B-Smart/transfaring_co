@extends('receipts.base')
@section('action-content')

<div class="row">

        <div class="col-sm-2"></div>
        <div class="row">
            <div class="col-sm-4 text-right"><h3>إلى المنفست رقم </h3></div>
        <div class="col-sm-4 text-right"><h3>وثيقة شحن</h3></div>
      </div>
      <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-2"></div>
        <div class="col-sm-2"><input class="form-control text-right" type="text" placeholder="أدخل اسم المرسل إليه"></div>
        <div class="col-sm-2">المرسل إليه</div>
        <div class="col-sm-2">
          <select name="customer_name" id="customer_name" class="form-control input-lg dynamic">
                @foreach ($coustomer_list as $customer)
                    <option value="{{ $customer->customer_name }}">{{ $customer->customer_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-2">المرسل</div>
      </div>
      <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-2"></div>
        <div class="col-sm-2"><input class="form-control text-right" type="text" placeholder="أدخل عنوان المرسل إليه"></div>
        <div class="col-sm-2">العنوان</div>
          <select name="customer_address" id="customer_address" class="form-control input-lg dynamic" data-dependent ="customer_mobile">
              <option value="">إختر العنوان</option>
        <div class="col-sm-2">العنوان</div>
      </div>
      <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-2"></div>
        <div class="col-sm-2"><input class="form-control text-right" type="text" placeholder="أدخل رقم هاتف المرسل إليه"></div>
        <div class="col-sm-2">الهاتف</div>
        <div class="col-sm-2"><input class="form-control text-right" type="text" placeholder="أدخل رقم هاتف المرسل"></div>
        <div class="col-sm-2">الهاتف</div>
      </div>
      <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-2"></div>
        <div class="col-sm-2"><input class="form-control text-right" type="text" placeholder="أدخل مكان التسليم"></div>
        <div class="col-sm-2">مكان التسليم</div>
        <div class="col-sm-2"><input class="form-control text-right" type="text" placeholder="أدخل مكان الإستلام"></div>
        <div class="col-sm-2">مكان الإستلام</div>
      </div>
      <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-2"></div>
        <div class="col-sm-2"><input class="form-control text-right" type="text" placeholder="أدخل المحتويات"></div>
        <div class="col-sm-2">المحتويات</div>
        <div class="col-sm-2"><input class="form-control text-right" type="text" placeholder="أدخل عدد الطرود"></div>
        <div class="col-sm-2">عدد الطرود</div>
      </div>
      <div class="row text-center">
            <div class="col-sm-3 text-center"></div>
            <div class="col-sm-3 text-center"><h3>للتحصيل من المرسل إليه</h3></div>
            <div class="col-sm-3 text-center"><h3>المدفوع مسبقا</h3></div>
            <div class="col-sm-3"><h3>الأجور</h3></div>
      </div>
      <br>
      <div class="row text-center">
            <div class="col-sm-3 text-center"></div>
            <div class="col-sm-3"><input class="form-control text-right" type="text" placeholder=""></div>
            <div class="col-sm-3"><input class="form-control text-right" type="text" placeholder=""></div>
            <div class="col-sm-3"><h4>أجور الشحن</h4></div>
      </div>
      <div class="row text-center">
            <div class="col-sm-3 text-center"></div>
            <div class="col-sm-3"><input class="form-control text-right" type="text" placeholder=""></div>
            <div class="col-sm-3"><input class="form-control text-right" type="text" placeholder=""></div>
            <div class="col-sm-3"><h4>متفرقات</h4></div>
      </div>
      <div class="row text-center">
            <div class="col-sm-3 text-center"></div>
            <div class="col-sm-3"><input class="form-control text-right" type="text" placeholder=""></div>
            <div class="col-sm-3"><input class="form-control text-right" type="text" placeholder=""></div>
            <div class="col-sm-3"><h4>ضد الشحن</h4></div>
          </div>
          <br>
          <div class="card-footer text-center">
                <button type="submit" class="btn btn-default float-right">إلغاء</button>
                <button type="submit" class="btn btn-info" style="margin-left:10px">إرسال</button>
              </div>
            </div>
@endsection

