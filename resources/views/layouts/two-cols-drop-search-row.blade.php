<div class="row">
  @php
    $index = 0;
  @endphp
  @foreach ($items as $item)
    <div class="col-md-6">
      <div class="form-group">
          @php
            $stringFormat =  strtolower(str_replace(' ', '', $item));
          @endphp
          <label for="input<?=$stringFormat?>" class="col-sm-3 control-label">{{$item}}</label>
          <div class="col-sm-9">
              <select class="form-control" name="<?=$stringFormat?>" id="input<?=$stringFormat?>">
                  <option value="">اختر الصلاحية</option>
                  @if(isset($oldVals))
                      @if($oldVals[$index]=='admin')
                          <option value="admin" selected="selected">مدير</option>
                          <option value="user">مستخدم</option>
                      @else
                          <option value="admin">مدير</option>
                          <option value="user" selected="selected">مستخدم</option>
                      @endif
                  @else
                      <option value="admin">مدير</option>
                      <option value="user">مستخدم</option>
                  @endif
              </select>
          </div>
      </div>
    </div>
  @php
    $index++;
  @endphp
  @endforeach
</div>