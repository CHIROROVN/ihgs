@extends('backend.layouts.app')
@section('content')
<!-- breadcrumbs -->
<div class="w3l_agileits_breadcrumbs">
    <div class="w3l_agileits_breadcrumbs_inner">
        <ul><li>部課ごと残業集計</li></ul>
    </div>
</div>
<!-- //breadcrumbs -->
<div class="inner_content_w3_agile_info two_in">
    <div class="graph-form agile_info_shadow">
        <div class="form-body">
          <span class="help-block" id="error-staff-belong"></span>
          <span class="help-block" id="error-cb-year"></span>  
        {!! Form::open(array('url' => 'overwork','id'=>'frmSearch', 'method' => 'post')) !!} 
        <table id="table">
            <thead>
            <tr>
                <th>部課名</th>
                <th>年度</th>
                <th></th>
            </tr>
            </thead>
        <tbody>
        <tr>
            <td>{!! divisions('staff_belong', $staff_belong,true) !!}
              </td>
            <td><div class="fl-left">
                    <select name="cb_year" id="cb_year" class="form-control form-control-date">
                        <option value="">{{ALL_YEAR}}</option>                        
                        @for ($i = START_YEAR; $i <= END_YEAR; $i++)
                            <option value="{{ $i }}" @if($i==$cb_year) selected="" @endif>{{ $i }} 年度</option>
                        @endfor
                    </select>
                </div>              
            </td>
            <td><input name="btnSubmit" value="抽出する" id="btnSubmit" type="button" class="btn btn-primary btn-sm"></td>
            </tr>
        </tbody>    
        </table>
        {!! Form::close() !!}  
   </div>
</div>
<!-- tables -->
<div class="agile-tables">
  @if(empty($worktimes['data']) || count($worktimes['data']) < 1)
    <div class="agile_info_shadow" style="text-align: center;">
      <strong style="color: #777;">該当するデータがありません。</strong>
    </div>
  @else
    <div class="w3l-table-info agile_info_shadow">
      <div class="row mar-bottom15"></div>
        <table id="table" class="mar-bottom15 table-bordered">
          <thead>
          <tr>
            <th>氏名</th>
            <th>{{$cb_year}} 年<br />4月</th>
            <th>{{$cb_year}} 年<br />5月</th>
            <th>{{$cb_year}} 年<br />6月</th>
            <th>{{$cb_year}} 年<br />7月</th>
            <th>{{$cb_year}} 年<br />8月</th>
            <th>{{$cb_year}} 年<br />9月</th>
            <th>{{$cb_year}} 年<br />10月</th>
            <th>{{$cb_year}} 年<br />11月</th>
            <th>{{$cb_year}} 年<br />12月</th>
            <th>{{$cb_year +1}} 年<br />1月</th>
            <th>{{$cb_year +1}} 年<br />2月</th>
            <th>{{$cb_year +1}} 年<br />3月</th>
            <th>合計</th>
            <th>基準超</th>
          </tr>
                </thead>
                <tbody> 
                @foreach($worktimes['data'] as $worktime)                   
                  <tr>
                    <td><a href="{{ asset('overtime/detail/'.$worktime->staff_id.'?year='.$cb_year) }}">{{$worktime->staff_name}}</a></td>
                    <td {{@style_overwork($overtimes[$worktime->staff_id][4])}}>{{@display_overwork($overtimes[$worktime->staff_id][4])}}</td>
                    <td {{@style_overwork($overtimes[$worktime->staff_id][5])}}>{{@display_overwork($overtimes[$worktime->staff_id][5])}}</td>
                     <td {{@style_overwork($overtimes[$worktime->staff_id][6])}}>{{@display_overwork($overtimes[$worktime->staff_id][6])}}</td>
                    <td {{@style_overwork($overtimes[$worktime->staff_id][7])}}>{{@display_overwork($overtimes[$worktime->staff_id][7])}}</td>
                    <td {{@style_overwork($overtimes[$worktime->staff_id][8])}}>{{@display_overwork($overtimes[$worktime->staff_id][8])}}</td>
                    <td {{@style_overwork($overtimes[$worktime->staff_id][9])}}>{{@display_overwork($overtimes[$worktime->staff_id][9])}}</td>
                     <td {{@style_overwork($overtimes[$worktime->staff_id][10])}}>{{@display_overwork($overtimes[$worktime->staff_id][10])}}</td>
                    <td {{@style_overwork($overtimes[$worktime->staff_id][11])}}>{{@display_overwork($overtimes[$worktime->staff_id][11])}}</td>
                    <td {{@style_overwork($overtimes[$worktime->staff_id][12])}}>{{@display_overwork($overtimes[$worktime->staff_id][12])}}</td>
                    <td {{@style_overwork($overtimes[$worktime->staff_id][1])}}>{{@display_overwork($overtimes[$worktime->staff_id][1])}}</td>
                    <td {{@style_overwork($overtimes[$worktime->staff_id][2])}}>{{@display_overwork($overtimes[$worktime->staff_id][2])}}</td>
                     <td {{@style_overwork($overtimes[$worktime->staff_id][3])}}>{{@display_overwork($overtimes[$worktime->staff_id][3])}}</td>
                     <td {{@style_overwork($overtimes[$worktime->staff_id],'true')}}>{{@display_overwork_staff($overtimes[$worktime->staff_id])}}</td>
                    <td >{{@count_overwork_staff($overtimes[$worktime->staff_id])}}</td>                    
                  </tr>
                @endforeach
                </tbody>
              </table>
              <div class="row">
                <div class="col-md-12 text-center">
                  <input name="export_pdf" value="PDFで出力する" type="button" onclick="location.href='{{route('backend.workingtime.pdf', ['staff_belong'=>$staff_belong, 'cb_year'=>$cb_year])}}'" class="btn btn-primary btn-sm">
                </div>
              </div>
              </div>
              @endif

          </div>
        </div>
 </div>
</div>
<script type="text/javascript">
$("#btnSubmit").on("click",function() { 
   var flag = true; 
  if (!$("[name=staff_belong]").val().replace(/ /g, "")) {  
    $("#error-staff-belong").html('<?php echo $error['error_belong_required'];?>');             
    $("#error-staff-belong").css('display','block');   
    $('[name=staff_belong]').focus();
    flag = false;    
  }

 if (!$("#cb_year").val().replace(/ /g, "")) {  
    $("#error-cb-year").html('<?php echo $error['error_year_required'];?>');             
    $("#error-cb-year").css('display','block');   
    $('#cb_year').focus();
    flag = false; 
  }  
  if(flag) $( "#frmSearch" ).submit();
});
</script>   
@endsection