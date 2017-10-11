@extends('backend.layouts.app')
@section('content')
<!-- breadcrumbs -->
  <div class="w3l_agileits_breadcrumbs">
    <div class="w3l_agileits_breadcrumbs_inner">
      <ul>
        <li>データ管理<span>＞</span></li>
        <li>「入退出」の管理<span>＞</span></li>
        <li>フォーマットの指定</li>
      </ul>
    </div>
  </div>
  <!-- //breadcrumbs -->
  <div class="inner_content_w3_agile_info two_in">
    <p class="intro">取り込む「入退出」のデータのフォーマットを指定します。</p>
    <!--/forms-->          
      <div class="forms-main_agileits">
        <header class="panel-heading">フォーマットの指定</header>
        <div class="graph-form agile_info_shadow">
          <div class="form-body">
          {!! Form::open(array('url' => 'door/regist','id'=>'frmRegist', 'method' => 'post')) !!} 
          <table class="table table-bordered table-list-regist mar-bottom15">
            <thead>
              <tr>
                  <th>取り込む項目名</th>
                  <th>元データの列</th>
                  <th>元データの形式</th>
                  </tr>
              </thead>
              <tr>
                <td class="col-title col-md-3"><label for="">カード番号</label></td>
                <td class="col-md-2">
                  <select name="md_card_no_row" id="md_card_no_row" class="form-control">
                    <?php $last=40; $now=1; ?>
                      @for ($i = $now; $i <= $last; $i++)
                        <option value="{{ $i }}" @if($i==1) selected="" @endif>{{ $i }} 列目</option>
                      @endfor
                  </select>
                </td>
                <td class="col-md-6"></td>
              </tr>
              <tr>
                <td class="col-title col-md-3"><label for="">扉番号</label></td>
                <td class="col-md-2">
                  <select name="md_door_row" id="md_door_row"  class="form-control">
                     <?php $last=40; $now=1; ?>
                      @for ($i = $now; $i <= $last; $i++)
                        <option value="{{ $i }}" @if($i==1) selected="" @endif>{{ $i }} 列目</option>
                      @endfor
                  </select>
                </td>
                <td class="col-md-6">
                  <div class="fl-left text-td text-center mar-left15">値が</div>
                    <div class="col-md-6"><input name="md_door_format" id="md_door_format" type="text" class="form-control"></div>
                    <div class="fl-left text-td">と一致するもの</div>
                </td>
              </tr>
              <tr>
                <td class="col-title col-md-3"><label for="">タッチした日時</label></td>
                <td class="col-md-2">
                  <select name="md_touchtime_row" id="md_touchtime_row"  class="form-control">
                    <?php $last=40; $now=1; ?>
                      @for ($i = $now; $i <= $last; $i++)
                        <option value="{{ $i }}" @if($i==1) selected="" @endif>{{ $i }} 列目</option>
                      @endfor
                  </select>
                </td>
                <td class="col-md-6">
                <div class="col-md-6">
                  <select name="md_touchtime_format" id="md_touchtime_format" class="form-control">
                          <option selected="">YYYY/MM/DD 13:45:02</option>
                          <option>YYYY/MM/DD 01:45:02 PM</option>
                          <option>YYYY/MM/DD 13:45</option>
                          <option>YYYY/MM/DD 1:45 PM</option>
                          <option>YYYY年MM月DD日 13時45分</option>
                        </select>
                      </div>
                    </tr>
                  </table>
                  <div class="row">
                    <div class="col-md-12 text-center">
                      <input name="btnSubmit" id="btnSubmit" value="保存する" type="button" class="btn btn-primary btn-sm">
                      <input name="reset" value="元に戻す" type="reset" class="btn btn-primary btn-sm mar-left15">
                    </div>
                  </div>
                   {!! Form::close() !!} 
                </div>
              </div>
            </div>
          </div>    
<script type="text/javascript">
$("#btnSubmit").on("click",function() {  
   $( "#frmRegist" ).submit(); 
});
</script> 
@endsection