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
            <td>{!! divisions('staff_belong', $staff_belong,true) !!}</td>
            <td>
                <div class="fl-left">
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
        <table id="table" class="mar-bottom15">
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
                    @if(isset($overtimes[$worktime->staff_id][4]))
                       @if($overtimes[$worktime->staff_id][4] >59)
                          <td class="bg-red">{{$overtimes[$worktime->staff_id][4]}} h</td>
                       @else <td>{{$overtimes[$worktime->staff_id][4]}} h</td>
                       @endif
                    @else  <td>0h</td>
                    @endif
                    @if(isset($overtimes[$worktime->staff_id][5]))
                       @if($overtimes[$worktime->staff_id][5] >59)
                          <td class="bg-red">{{$overtimes[$worktime->staff_id][5]}} h</td>
                       @else <td>{{$overtimes[$worktime->staff_id][5]}} h</td>
                       @endif
                    @else  <td>0h</td>
                    @endif
                    @if(isset($overtimes[$worktime->staff_id][6]))
                       @if($overtimes[$worktime->staff_id][6] >59)
                          <td class="bg-red">{{$overtimes[$worktime->staff_id][6]}} h</td>
                       @else <td>{{$overtimes[$worktime->staff_id][6]}} h</td>
                       @endif
                    @else  <td>0h</td>
                    @endif
                    @if(isset($overtimes[$worktime->staff_id][7]))
                       @if($overtimes[$worktime->staff_id][7] >59)
                          <td class="bg-red">{{$overtimes[$worktime->staff_id][7]}} h</td>
                       @else <td>{{$overtimes[$worktime->staff_id][7]}} h</td>
                       @endif
                    @else  <td>0h</td>
                    @endif
                    @if(isset($overtimes[$worktime->staff_id][8]))
                       @if($overtimes[$worktime->staff_id][8] >59)
                          <td class="bg-red">{{$overtimes[$worktime->staff_id][8]}} h</td>
                       @else <td>{{$overtimes[$worktime->staff_id][8]}} h</td>
                       @endif
                    @else  <td>0h</td>
                    @endif
                    @if(isset($overtimes[$worktime->staff_id][9]))
                       @if($overtimes[$worktime->staff_id][9] >59)
                          <td class="bg-red">{{$overtimes[$worktime->staff_id][9]}} h</td>
                       @else <td>{{$overtimes[$worktime->staff_id][9]}} h</td>
                       @endif
                    @else  <td>0h</td>
                    @endif                    
                    @if(isset($overtimes[$worktime->staff_id][10]))
                       @if($overtimes[$worktime->staff_id][10] >59)
                          <td class="bg-red">{{$overtimes[$worktime->staff_id][10]}} h</td>
                       @else <td>{{$overtimes[$worktime->staff_id][10]}} h</td>
                       @endif
                    @else  <td>0h</td>
                    @endif
                    @if(isset($overtimes[$worktime->staff_id][11]))
                       @if($overtimes[$worktime->staff_id][11] >59)
                          <td class="bg-red">{{$overtimes[$worktime->staff_id][11]}} h</td>
                       @else <td>{{$overtimes[$worktime->staff_id][11]}} h</td>
                       @endif
                    @else  <td>0h</td>
                    @endif 
                    @if(isset($overtimes[$worktime->staff_id][12]))
                       @if($overtimes[$worktime->staff_id][12] >59)
                          <td class="bg-red">{{$overtimes[$worktime->staff_id][12]}} h</td>
                       @else <td>{{$overtimes[$worktime->staff_id][12]}} h</td>
                       @endif
                    @else  <td>0h</td>
                    @endif 
                    @if(isset($overtimes[$worktime->staff_id][1]))
                       @if($overtimes[$worktime->staff_id][1] >59)
                          <td class="bg-red">{{$overtimes[$worktime->staff_id][1]}} h</td>
                       @else <td>{{$overtimes[$worktime->staff_id][1]}} h</td>
                       @endif
                    @else  <td>0h</td>
                    @endif
                    @if(isset($overtimes[$worktime->staff_id][2]))
                       @if($overtimes[$worktime->staff_id][2] >59)
                          <td class="bg-red">{{$overtimes[$worktime->staff_id][2]}} h</td>
                       @else <td>{{$overtimes[$worktime->staff_id][2]}} h</td>
                       @endif
                    @else  <td>0h</td>
                    @endif 
                    @if(isset($overtimes[$worktime->staff_id][3]))
                       @if($overtimes[$worktime->staff_id][3] >59)
                          <td class="bg-red">{{$overtimes[$worktime->staff_id][3]}} h</td>
                       @else <td>{{$overtimes[$worktime->staff_id][3]}} h</td>
                       @endif
                    @else  <td>0h</td>
                    @endif                                                            
                    <td>@if(isset($overtimes[$worktime->staff_id]['total']) && $overtimes[$worktime->staff_id]['total'] >0) {{$overtimes[$worktime->staff_id]['total']}}h @endif</td>
                    <td>@if(isset($overtimes[$worktime->staff_id]['time']) && $overtimes[$worktime->staff_id]['time'] >0) {{$overtimes[$worktime->staff_id]['time']}}@endif</td>
                    <td></td>
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
  $( "#frmSearch" ).submit(); 
});
</script>   
@endsection