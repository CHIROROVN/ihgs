@extends('backend.layouts.app')
@section('content')
<!-- breadcrumbs -->
  <div class="w3l_agileits_breadcrumbs">
    <div class="w3l_agileits_breadcrumbs_inner">
      <ul>
        <li>データ管理<span>＞</span></li>
        <li>「入退室」の管理<span>＞</span></li>
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
      <div id="result"></div>         
    </div>  
    <p class="intro">「入退室」のデータを取り込みます。ファイルを指定し、「取り込み開始」をクリックしてください。<br />
          ※取り込むファイルはEXCELファイルまたはCSVファイルのみとなります。<br />          
          ※過去のデータを削除する場合は、一覧表内の「削除」ボタンをクリックしてください。<br />
          ※ユニークキーがないため、データは重複されて取り込まれます。データ変更（差し替え）の場合は、必ず、削除して登録してください。</p>
          <p class="note">
            ●取り込むデータの形式●<br />
            カード番号 ： @if (isset($door->md_card_no_row)){{$door->md_card_no_row}} @endif 列目<br />
            扉番号   ： @if (isset($door->md_door_row)){{$door->md_door_row}} @endif 列目<br />
            タッチした時刻： @if(isset($door->md_touchdate_row)) @if($door->md_touchdate_row >0) {{$door->md_touchdate_row}} @else {{$door->md_touchday_row}} - {{$door->md_touchtime_row}} @endif @endif 列目
    </p>
    <div class="graph-form agile_info_shadow">
      <div class="form-body">
        {!! Form::open(array('route' => 'backend.door.upload','id'=>'frmUpload', 'enctype'=>'multipart/form-data')) !!} 
          <table class="table table-bordered">
            <tr>
              <td class="col-title col-md-3"><label for="">データ名称<span class="required">必須</span></label></td>
              <td class="col-md-9">
                <div class="col-md-6"><input type="text" class="form-control" id="td_dataname" name="td_dataname" value="@if(old('td_dataname')){{old('td_dataname')}}@endif">
                <span class="help-block" id="error_dataname">@if ($errors->has('td_dataname'))<strong>{{ $errors->first('td_dataname') }}</strong>@endif</span></div>
              </td>
            </tr>
            <tr>
              <td class="col-title col-md-3"><label for="">取り込むデータ<span class="required">必須</span></label></td>
              <td class="col-md-9">
                <div class="bt-browser mar-left15">
                  <button type="button" class="bfs btn btn-primary" data-style="fileStyle-l" id="file_path"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> ファイルを選ぶ</button>
                  <span class="help-block" id="error_file_path">@if ($errors->has('file_csv'))<strong>{{ $errors->first('file_csv') }}</strong>@endif</span>
                  <span class="help-block" id="error_set_up"></span>
                </div>
                <div class="fl-left">
                  <input name="btnSend" id="btnSend" value="取り込み開始" type="button" class="btn btn-primary">                  
                  <input type="hidden" name="md_card_no_row" value="@if (isset($door->md_card_no_row)) {{$door->md_card_no_row}} @endif" id="md_card_no_row">
                  <input type="hidden" name="md_door_row" value="@if (isset($door->md_door_row)){{$door->md_door_row}}@endif" id="md_door_row">
                  <input type="hidden" name="md_touchday_row" value="@if (isset($door->md_touchday_row)){{$door->md_touchday_row}}@endif" id="md_touchday_row">
                  <input type="hidden" name="md_touchtime_row" value="@if (isset($door->md_touchtime_row)){{$door->md_touchtime_row}}@endif" id="md_touchtime_row">
                  <input type="hidden" name="md_touchdate_row" value="@if (isset($door->md_touchdate_row)){{$door->md_touchdate_row}}@endif" id="md_touchdate_row">
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
        <table id="table" class="table-bordered">
          <thead>
            <tr>
              <th>削除</th>
              <th>データ名称</th>
              <th>取り込み日時</th>
              <th></th>
            </tr>
          </thead>
          <tbody>          
          @if(empty($doorcards) || count($doorcards) < 1)
          <tr>
            <td colspan="3">
              <h3 align="center">該当するデータがありません。</h3>
            </td>
          </tr>
          @else  
            @foreach($doorcards as $doorcard)
              <tr data-id='{{$doorcard->mf_dataname}}'>
                <td align="center" style="width: 120px;"><input value="削除" type="button" class="btn btn-primary btn-xs" name="btnDelete" id="btnDelete" value="削除" type="button" class="btn btn-primary btn-xs" onclick="btnDelete('{{$doorcard->mf_dataname}}');"></td>
                <td>{{$doorcard->mf_dataname}}</td>
                <td>{{date_time($doorcard->last_date)}}</td>
                <td align="center" style="width: 120px;">@if($doorcard->mf_status_import ==0) <script type="text/javascript"> 
                                                                                                $.ajax({
                                                                                                    url : "{{route('backend.door.import')}}",
                                                                                                    type : "GET",
                                                                                                   // dataType:"text",
                                                                                                    cache: false,
                                                                                                    data : {
                                                                                                      "dataname" : '{{$doorcard->mf_dataname}}',
                                                                                                      "md_card_no_row" :$("#md_card_no_row").val(),
                                                                                                      "md_door_row" :$("#md_door_row").val(),
                                                                                                      "md_touchday_row" :$("#md_touchday_row").val(),  
                                                                                                      "md_touchtime_row" :$("#md_touchtime_row").val(),
                                                                                                      "md_touchdate_row" :$("#md_touchdate_row").val()
                                                                                                    },
                                                                                                     success: function (data, status)
                                                                                                      {
                                                                                                          
                                                                                                      },
                                                                                                      error: function (xhr, desc, err)
                                                                                                      {
                                                                                                          console.log("error");

                                                                                                      }
                                                                                                  }) ;</script> @endif </td>
              </tr>
            @endforeach
          @endif       
          </tbody>
        </table>
      </div>
  </div>
 </div>  
<!-- start: Delete Coupon Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog"  aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title" id="myModalLabel">確認を削除!</h3>
            </div>
            <div class="modal-body">
                <h4>本当に削除してもいいですか。</h4>

            </div>
            <!--/modal-body-collapse -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="btnDelteYes" href="#">削除</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">キャンセル</button>
            </div>
            <!--/modal-footer-collapse -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal --> 

<script type="text/javascript">
$("#btnSend").on("click",function() {
  var flag = true;
  if (!$("#td_dataname").val().replace(/ /g, "")) {  
    $("#error_dataname").html('<strong><?php echo $error['error_td_dataname_required']?></strong>');             
    $("#error_dataname").css('display','block');  
    flag = false;  
  }  
  if (!$("#file_path").val().replace(/ /g, "")) {  
    $("#error_file_path").html('<strong><?php echo $error['error_file_path_required']?></strong>');             
    $("#error_file_path").css('display','block');    
    flag = false; 
  }else{
     if(!validate($("#file_path").val())){
        $("#error_file_path").html('<strong><?php echo $error['error_timecard_file_csv']?></strong>');             
        $("#error_file_path").css('display','block');  
        flag = false; 
     }
  }
  if (!$("#md_card_no_row").val().replace(/ /g, "")) {  
    $("#error_set_up").html('<strong><?php echo $error['msg_import_setting_danger']?></strong>');             
    $("#error_set_up").css('display','block');    
    flag = false; 
  }
  if (!$("#md_door_row").val().replace(/ /g, "")) {  
    $("#error_set_up").html('<strong><?php echo $error['msg_import_setting_danger']?></strong>');             
    $("#error_set_up").css('display','block');    
    flag = false; 
  }
 if(flag)   $( "#frmUpload" ).submit(); 

});
$('#btnDelete').on('click', function (e) {    
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
    location.href='{{ asset('door/delete/') }}'+'/'+ id ;    
});
function validate(fileupload){  
  var reg = /(.*?)\.(xlsx|xls|csv|CSV)$/;
  if(!fileupload.match(reg))       return false;
  else return true;
}
function btnImport(filename1)
{
 
   $.ajax({
            url : "{{route('backend.door.import')}}",
            type : "GET",
           // dataType:"text",
            cache: false,
            data : {
              "dataname" : filename1,
              "md_card_no_row" :$("#md_card_no_row").val(),
              "md_door_row" :$("#md_door_row").val(),
              "md_touchday_row" :$("#md_touchday_row").val(),  
              "md_touchtime_row" :$("#md_touchtime_row").val(),
              "md_touchdate_row" :$("#md_touchdate_row").val()
            },
             success: function (data, status)
              {
                  $("#result").html(data);
              },
              error: function (xhr, desc, err)
              {
                  console.log("error");

              }
          }) ;
  

}
</script>
@endsection
@section('js')
<script src="{{ asset('') }}public/backend/js/bootstrap-button-to-input-file.js"></script>
<script>
  var filestyler = new buttontoinputFile();
</script>
@endsection