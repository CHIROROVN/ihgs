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
  <div class="flash-messages">
            @if($message = Session::get('danger'))
              <div id="error" class="message">
                <a id="close" title="Message"  href="#" onClick="document.getElementById('error').setAttribute('style','display: none;');">&times;</a>
                <span>{{$message}}</span>
              </div>
            @elseif($message = Session::get('success'))
              <div id="success" class="message">
                <a id="close" title="Message"  href="javascript::void(0);" onClick="document.getElementById('success').setAttribute('style','display: none;');">&times;</a>
                  <span>{{$message}}</span>
              </div>
            @endif  
          </div> 
    <p class="intro">取り込む「入退出」のデータのフォーマットを指定します。</p>
    <!--/forms-->          
      <div class="forms-main_agileits">
        <header class="panel-heading">フォーマットの指定</header>
        <div class="graph-form agile_info_shadow">
          <div class="form-body">
          {!! Form::open(array('url' => 'door/edit/'.$door->md_id,'id'=>'frmEdit', 'method' => 'post')) !!} 
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
                        <option value="{{ $i }}" @if($i==$door->md_card_no_row) selected="" @endif>{{ $i }} 列目</option>
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
                        <option value="{{ $i }}" @if($i==$door->md_door_row) selected="" @endif>{{ $i }} 列目</option>
                      @endfor
                  </select>
                </td>
                <td class="col-md-6">
                  <div class="fl-left text-td text-center mar-left15">値が</div>
                    <div class="col-md-6"><input name="md_door_format" id="md_door_format" type="text" class="form-control" value="{{$door->md_door_format}}"></div>
                    <div class="fl-left text-td">と一致するもの</div>
                   <span class="help-block" id="error-door_format">@if ($errors->first('md_door_format')) ※{!! $errors->first('md_door_format') !!} @endif</span>
                </td>
              </tr>
              <tr>
                <td class="col-title col-md-3"><label for="">タッチした日時</label></td>
                <td class="col-md-2">
                  <select name="md_touchtime_row" id="md_touchtime_row"  class="form-control">
                    <?php $last=40; $now=1; ?>
                      @for ($i = $now; $i <= $last; $i++)
                        <option value="{{ $i }}" @if($i==$door->md_touchtime_row) selected="" @endif>{{ $i }} 列目</option>
                      @endfor
                  </select>
                </td>
                <td class="col-md-6">
                <div class="col-md-6">
                  <select name="md_touchtime_format" id="md_touchtime_format" class="form-control">
                    @foreach($date_formats as $key=>$date_format)                           
                      <option value="{{ $key }}"@if($i==$door->md_touchtime_format) selected="" @endif >{{ $date_format }}</option>
                    @endforeach
                  </select>
                </div></td>
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
  var flag = true;
  if (!$("#md_door_format").val().replace(/ /g, "")) {  
    $("#error-door_format").html('<?php echo $error['error_door_format_required'];?>');             
    $("#error-door_format").css('display','block');   
    $('#md_door_format').focus();
    flag = false;    
  } 
  if(flag) $( "#frmEdit" ).submit(); 
});
</script> 
@endsection