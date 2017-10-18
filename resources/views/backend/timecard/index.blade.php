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
              {!! Form::open(array('route' => 'backend.timecard.import','id'=>'frmUpload', 'enctype'=>'multipart/form-data', 'accept-charset'=>'Shift-JIS')) !!} 
                <table class="table table-bordered">
                  <tr>
                    <td class="col-title col-md-3"><label for="">データ名称</label></td>
                    <td class="col-md-9">
                      <div class="col-md-6">
                        <input type="text" class="form-control" id="tt_dataname" name="tt_dataname">
                        <span class="help-block" id="error_dataname">@if ($errors->has('tt_dataname'))<strong>{{ $errors->first('tt_dataname') }}</strong>@endif</span>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td class="col-title col-md-3"><label for="">取り込むデータ</label></td>
                    <td class="col-md-9">
                      <div class="bt-browser mar-left15">
                        <button type="button" class="bfs btn btn-primary" data-style="fileStyle-l" id="file_path"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> ファイルを選ぶ</button>
                        <span class="help-block" id="error_file_path">@if ($errors->has('file_csv'))<strong>{{ $errors->first('file_csv') }}</strong>@endif</span>
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
                  <tr data-id='{{$timecard->tt_dataname}}'>
                    <td align="center" style="width: 150px;"><input value="削除" type="button" class="btn btn-primary btn-xs" name="btnDelete" id="btnDelete" value="削除" type="button" class="btn btn-primary btn-xs" onclick="btnDelete('{{$timecard->tt_dataname}}');"></td>
                    <td>{{$timecard->tt_dataname}}</td>
                    <td>{{$timecard->last_date}}</td>
                  </tr> 
                 @endforeach
                 @endif                      
                </tbody>
              </table>
            </div>
          </div>
 </div> 
<!-- start: Delete Coupon Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"
                    aria-hidden="true">&times;</button>
                <h3 class="modal-title" id="myModalLabel">Warning!</h3>
            </div>
            <div class="modal-body">
                <h4>Are you sure you want to DELETE?</h4>

            </div>
            <!--/modal-body-collapse -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="btnDelteYes" href="#">Yes</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            </div>
            <!--/modal-footer-collapse -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script type="text/javascript">
  $('#btnDelete').on('click', function (e) {
    e.preventDefault();
    var id = $(this).closest('tr').data('id');
    $('#myModal').data('id', id).modal('show');
});
function btnDelete($id)
 {
      var id = $id;
    $('#myModal').data('id', id).modal('show');
 }   
$('#btnDelteYes').click(function () {
    var id = $('#myModal').data('id');
    location.href='{{ asset('timecard/delete/') }}'+'/'+ id ;    
});
</script>                 
<script type="text/javascript">
$("#btnSend").on("click",function() {
  var flag = true;
  if (!$("#tt_dataname").val().replace(/ /g, "")) {  
    $("#error_dataname").html('<strong><?php echo $error['error_tt_dataname_required']?></strong>');             
    $("#error_dataname").css('display','block');  
    flag = false;  
  }  
  if (!$("#file_path").val().replace(/ /g, "")) {  
    $("#error_file_path").html('<strong><?php echo $error['error_file_path_required']?></strong>');             
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