@extends('backend.layouts.app')
@section('content')
<!-- breadcrumbs -->
          <div class="w3l_agileits_breadcrumbs">
            <div class="w3l_agileits_breadcrumbs_inner">
              <ul>
                <li>データ管理<span>＞</span></li>
                <li>「タイムカード」の管理<span>＞</span></li>
                <li>データの取り込み</li>
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
          <p class="intro">「タイムカード」のデータを取り込みます。ファイルを指定し、「取り込み開始」をクリックしてください。<br />
            ※過去のデータを削除する場合は、一覧表内の「削除」ボタンをクリックしてください。<br />
            ※ユニークキーがないため、データは重複されて取り込まれます。データ変更（差し替え）の場合は、必ず、削除して登録してください。</p>
          <p class="note">
            ●取り込むデータの形式●<br />
            社員番号：00列目<br />
            日付：00列目<br />
            出社時刻：00列目<br />
            退社時刻：00列目
          </p>
          <div class="graph-form agile_info_shadow">
            <div class="form-body">
              {!! Form::open(array('route' => 'backend.timecard.import','id'=>'frmUpload', 'enctype'=>'multipart/form-data', 'accept-charset'=>'utf-8')) !!} 
                <table class="table table-bordered">
                  <tr>
                    <td class="col-title col-md-3"><label for="">データ名称</label></td>
                    <td class="col-md-9">
                      <div class="col-md-6">
                        <input type="text" class="form-control" id="tt_dataname" name="tt_dataname">
                        <span class="help-block" id="error_dataname"></span>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td class="col-title col-md-3"><label for="">取り込むデータ</label></td>
                    <td class="col-md-9">
                      <div class="bt-browser mar-left15">
                        <button type="button" class="bfs btn btn-primary" data-style="fileStyle-l" id="file_path"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> ファイルを選ぶ</button>
                        <span class="help-block" id="error_file_path"></span>
                      </div>
                      <div class="fl-left">
                        <input name="btnSend" id="btnSend" value="取り込み開始" type="button" class="btn btn-primary">
                      </div>
                    </td>
                  </tr>
                 </table>
                {!! Form::close() !!} 
              </div>
           </div>
          <!-- tables -->
          <div class="agile-tables">
            <div class="w3l-table-info agile_info_shadow">
              <table id="table">
                <thead>
                  <tr>
                    <th>削除</th>
                    <th>データ名称</th>
                    <th>取り込み日時</th>
                  </tr>
                </thead>
                <tbody>
                @if(empty($timecards) || count($timecards) < 1)
                <tr>
                <td colspan="3">
                  <h3 align="center">該当するデータがありません。</h3>
                </td>
              </tr>
                @else  
                @foreach($timecards as $timecard)
                  <tr>
                    <td align="center" style="width: 150px;"><input name="button2" value="削除" type="button" class="btn btn-primary btn-xs"></td>
                    <td>2017年8月期</td>
                    <td>2017/08/11 12:34:56</td>
                  </tr> 
                 @endforeach
                 @endif                      
                </tbody>
              </table>
            </div>
          </div>

<script type="text/javascript">
$("#btnSend").on("click",function() {
  var flag = true;
  if (!$("#tt_dataname").val().replace(/ /g, "")) {  
    $("#error_dataname").html('<?php echo $error['error_tt_dataname_required']?>');             
    $("#error_dataname").css('display','block');  
    flag = false;  
  }  
  if (!$("#file_path").val().replace(/ /g, "")) {  
    $("#error_file_path").html('<?php echo $error['error_file_path_required']?>');             
    $("#error_file_path").css('display','block');    
    flag = false; 
  }
  if(flag)   $( "#frmUpload" ).submit(); 
});
/*
$(document).ready(function(){
  $('input[type="file"]').change(function(e){
    var fileName = e.target.files[0].name;    
    $("#tt_dataname").val(fileName);    
  });
});*/
</script>
@endsection
@section('js')
<script src="{{ asset('') }}public/backend/js/bootstrap-button-to-input-file.js"></script>
<script>
  var filestyler = new buttontoinputFile();
</script>
@endsection