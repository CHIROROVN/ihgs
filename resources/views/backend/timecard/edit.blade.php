@extends('backend.layouts.app')
@section('content')
<!-- breadcrumbs -->
          <div class="w3l_agileits_breadcrumbs">
            <div class="w3l_agileits_breadcrumbs_inner">
              <ul>
                <li>データ管理<span>＞</span></li>
                <li>「タイムカード」の管理<span>＞</span></li>
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
          <p class="intro">取り込む「タイムカード」のデータのフォーマットを指定します。</p>
          <!--/forms-->
          {!! Form::open(array('url' => 'timecard/edit/'.$timecard->mt_id,'id'=>'frmEdit', 'method' => 'post')) !!}
          <div class="forms-main_agileits">
            <header class="panel-heading">
              フォーマットの指定
            </header>
            <div class="graph-form agile_info_shadow">
              <div class="form-body">
                <form> 
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
                        <select name="mt_staff_id_row" id="mt_staff_id_row" class="form-control">
                        <?php $last=40; $now=1; ?>
                        @for ($i = $now; $i <= $last; $i++)
                            <option value="{{ $i }}" @if($i==$timecard->mt_staff_id_row) selected="" @endif>{{ $i }} 列目</option>
                        @endfor
                          
                        </select>
                      </td>
                      <td class="col-md-6"></td>
                    </tr>
                    <tr>
                      <td class="col-title col-md-3"><label for="">日付</label></td>
                      <td class="col-md-2">
                        <select name="mt_date_row" id="mt_date_row"  class="form-control">                          
                          @for ($i = $now; $i <= $last; $i++)
                              <option value="{{ $i }}" @if($i==$timecard->mt_date_row) selected="" @endif>{{ $i }} 列目</option>
                          @endfor
                        </select>
                      </td>
                      <td class="col-md-6">
                        <div class="col-md-6">
                          <select name="mt_date_format" id="mt_date_format" class="form-control">
                           @foreach($date_formats as $key=>$date_format)                           
                            <option value="{{ $key }}" @if($key==$timecard->mt_date_format) selected="" @endif>{{ $date_format }}</option>
                          @endforeach
                            
                          </select>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="col-title col-md-3"><label for="">出社時刻</label></td>
                      <td class="col-md-2">
                        <select name="mt_gotime_row" id="mt_gotime_row"  class="form-control">                          
                          @for ($i = $now; $i <= $last; $i++)
                              <option value="{{ $i }}" @if($i==$timecard->mt_gotime_row) selected="" @endif>{{ $i }} 列目</option>
                          @endfor
                        </select>
                      </td>
                      <td class="col-md-6">
                        <div class="col-md-6">
                          <select name="mt_gotime_format" id="mt_gotime_format" class="form-control">
                            @foreach($time_formats as $key=>$date_format)                           
                            <option value="{{ $key }}" @if($key==$timecard->mt_gotime_format) selected="" @endif>{{ $date_format }}</option>
                          @endforeach
                          </select>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="col-title col-md-3"><label for="">退社時刻</label></td>
                      <td class="col-md-2">
                        <select name="mt_backtime_row" id="mt_backtime_row"  class="form-control">                          
                          @for ($i = $now; $i <= $last; $i++)
                              <option value="{{ $i }}" @if($i==$timecard->mt_backtime_row) selected="" @endif>{{ $i }} 列目</option>
                          @endfor
                        </select>
                      </td>
                      <td class="col-md-6">
                        <div class="col-md-6">
                          <select name="mt_backtime_format" id="mt_backtime_format" class="form-control">
                            @foreach($time_formats as $key=>$date_format)                           
                            <option value="{{ $key }}" @if($key==$timecard->mt_backtime_format) selected="" @endif>{{ $date_format }}</option>
                          @endforeach
                          </select>
                        </div>
                      </td>
                    </tr>
                  </table>
                  <div class="row">
                    <div class="col-md-12 text-center">
                      <input name="btnSubmit" id="btnSubmit" value="保存する" type="button" class="btn btn-primary btn-sm">
                      <input name="reset" value="元に戻す" type="reset" class="btn btn-primary btn-sm mar-left15">
                      <!--<input name="btn" value="フォーマットの指定" type="button" class="btn btn-primary btn-sm mar-left15" onclick="location.href='{{ asset('timecard/regist' ) }}'">-->
                    </div>
                  </div>
                  </form> 
                </div>
              </div>
            </div>
          </div>
          {!! Form::close() !!}            
<script type="text/javascript">
$("#btnSubmit").on("click",function() {  
   $( "#frmEdit" ).submit(); 
});
</script>          
@endsection