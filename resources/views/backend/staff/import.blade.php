@extends('backend.layouts.app')
@section('content')  
  <div class="w3l_agileits_breadcrumbs">
    <div class="w3l_agileits_breadcrumbs_inner">
      <ul>
        <li>社員マスタ管理<span>＞</span></li>
        <li>社員データの取り込み</li>
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
    <p class="intro">
      社員データを取り込みます。ファイルを指定し、「取り込み開始」をクリックしてください。<br />
      ※取り込むファイルはEXCELファイルまたはCSVファイルのみとなります。<br /> 
       ※同一社員番号のデータが取り込まれた場合は、<br/>
        　・「社員名」、「所属課」は上書きされます。<br />
        　・「入退出カード番号」、「PC番号」は追加されます。</p>
    <!--/forms-->
    {!! Form::open(array('route' => 'backend.staff.import','id'=>'frmUpload', 'enctype'=>'multipart/form-data', 'accept-charset'=>'Shift-JIS')) !!} 
    <div class="forms-main_agileits">
      <div class="graph-form agile_info_shadow">
        <div class="form-body">
          <table class="table table-bordered table-list-regist mar-bottom15">
            <thead>
              <tr>
                <th>取り込む項目名</th>
                <th>元データの列</th>
                <th>元データの形式</th>
              </tr>
            </thead>
            <tr>
                <td class="col-title col-md-3"><label for="">社員番号</label></td>
                <td class="col-md-2">
                  <select name="staff_id_no" id="staff_id_no" class="form-control">
                  <?php $last=40; $now=1; ?>
                    @for ($i = $now; $i <= $last; $i++)
                      <option value="{{ $i }}" @if($i==1) selected="" @endif>{{ $i }} 列目</option>
                    @endfor
                  </select>
                </td>
                <td class="col-md-6"></td>
            </tr>
            <tr>
              <td class="col-title col-md-3"><label for="">社員名</label></td>
              <td class="col-md-2">
                <select name="staff_name" id="staff_name" class="form-control">
                  @for ($i = $now; $i <= $last; $i++)
                      <option value="{{ $i }}" @if($i==1) selected="" @endif>{{ $i }} 列目</option>
                    @endfor
                </select>
              </td>
              <td class="col-md-6"></td>
            </tr>
            <tr>
              <td class="col-title col-md-3"><label for="">所属課</label></td>
              <td class="col-md-2">
                <select name="staff_belong" id="staff_belong"  class="form-control">
                  @for ($i = $now; $i <= $last; $i++)
                      <option value="{{ $i }}" @if($i==1) selected="" @endif>{{ $i }} 列目</option>
                    @endfor
                </select>
              </td>
              <td class="col-md-6"></td>
            </tr>
            <tr>
              <td class="col-title col-md-3"><label for="">入退出カード番号</label></td>
              <td class="col-md-2">
                <select name="staff_card" id="staff_card" class="form-control">
                  @for ($i = $now; $i <= $last; $i++)
                      <option value="{{ $i }}" @if($i==1) selected="" @endif>{{ $i }} 列目</option>
                    @endfor
                </select>
              </td>
              <td class="col-md-6"></td>
            </tr>
            <tr>
              <td class="col-title col-md-3"><label for="">PC番号</label></td>
              <td class="col-md-2">
                  <select name="staff_pc" id="staff_pc" class="form-control">
                    @for ($i = $now; $i <= $last; $i++)
                      <option value="{{ $i }}" @if($i==1) selected="" @endif>{{ $i }} 列目</option>
                    @endfor
                  </select>
              </td>
              <td class="col-md-6"></td>
            </tr>
          </table>
        </div>
      </div>
    <div class="graph-form agile_info_shadow">
  <div class="form-body">   
  <table class="table table-bordered">
    <tr>
      <td class="col-title col-md-3"><label for="">取り込むデータ</label></td>
      <td class="col-md-9" colspan="2">
      <div class="bt-browser">
        <button type="button" class="bfs btn btn-primary" data-style="fileStyle-l" id="file_path"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> ファイルを選ぶ</button>
        <span class="help-block" id="error_file_path">@if ($errors->has('file_csv'))<strong>{{ $errors->first('file_csv') }}</strong>@endif</span>
      </div>
      <div class="fl-left">
        <input name="btnSend" id="btnSend" value="取り込み開始" type="button" class="btn btn-primary">
      </div>
      </td>
    </tr>
  </table>
  </div>
  </div>
  </div>
</div>
{!! Form::close() !!}  
<script type="text/javascript">
$("#btnSend").on("click",function() {
  var flag = true;
  if (!$("#file_path").val().replace(/ /g, "")) {  
    $("#error_file_path").html('<strong><?php echo $error['error_file_path_required']?></strong>');             
    $("#error_file_path").css('display','block');    
    flag = false; 
  }
  if(flag)   $( "#frmUpload" ).submit(); 
});

</script>        
@endsection
@section('js')
<script src="{{ asset('') }}public/backend/js/bootstrap-button-to-input-file.js"></script>
<script>
  var filestyler = new buttontoinputFile();
</script>
@endsection