@extends('backend.layouts.app')
@section('content')
<!-- breadcrumbs -->
<div class="w3l_agileits_breadcrumbs">
  <div class="w3l_agileits_breadcrumbs_inner">
    <ul><li>個人ごと月次集計</li></ul>
  </div>
</div>
<!-- //breadcrumbs -->
        <div class="inner_content_w3_agile_info two_in">
          <div class="flash-messages">
            <div id="error" class="message" style="display: none">       
            
            </div>
          </div>  
          <div class="graph-form agile_info_shadow">
            <div class="form-body">
                <table id="table" class="table-bordered">
                  <thead>
                    <tr>
                      <th>部課名</th>
                      <th>日付</th>
                      <th>社員番号/社員名</th>
                      <th></th>
                    </tr>
                  </thead>
                {!! Form::open( ['id' => 'f_search', 'method' => 'get', 'route' => 'backend.search.index', 'enctype'=>'multipart/form-data', 'accept-charset'=>'utf-8']) !!}
                  <tbody>
                  <tr>
                    <td>
                      {!! divisions('belong_id', $belong_selected, true) !!}
                    </td>
                    <td>
                      <div class="fl-left">
                        <select name="year_from" class="form-control form-control-date" id="year_from">
                          @for($yf=($curr_year-3); $yf<=($curr_year); $yf++)
                          <option value="{{$yf}}" @if(isset($year_from) && $year_from == $yf) selected @endif>{{$yf}}年</option>
                          @endfor
                        </select>
                          <select name="month_from" class="form-control form-control-date">
                            @for($mf=1; $mf<=12; $mf++)
                            <option value="{{c2digit($mf)}}" @if(isset($month_from) && $month_from == c2digit($mf)) selected @endif>{{c2digit($mf)}}月</option>
                            @endfor
                          </select>
                          
                          <div class="fl-left mar-left15 line-height30 mar-right15">～</div>
                        </div>
                        <div class="fl-left">
                          <select name="year_to" class="form-control form-control-date" id="year_to">
                            @for($yt=($curr_year-2); $yt<=($curr_year + 1); $yt++)
                            <option value="{{$yt}}" @if(isset($year_to) && $year_to == $yt) selected @endif>{{$yt}}年</option>
                          @endfor
                          </select>
                          <select name="month_to" class="form-control form-control-date">
                            @for($mt=1; $mt<=12; $mt++)
                            <option value="{{c2digit($mt)}}" @if(isset($month_to) && $month_to == c2digit($mt)) selected @endif>{{c2digit($mt)}}月</option>
                            @endfor
                          </select>
                          
                        </div>
                     </td>
                     <td>
                      <input name="kw" type="text" class="form-control" size="20" value="{{@$kw}}">
                     </td>
                     <td>
                        <input value="抽出する" id="btnSubmit" type="button" class="btn btn-primary btn-sm" >
                      </td>
                  </tr>
                </tbody>
                 </table>
                
              </div>
           </div>
          <!-- tables -->
          @if(count($staffs) > 0)
          <div class="agile-tables">
            <div class="w3l-table-info agile_info_shadow">
              @foreach($staffs as $staff)
              <div class="row mar-bottom15">
                <div class="col-md-12 text-left">
                  {!! (!empty($staff->staff_belong)) ? division($staff->staff_belong) : ALL !!}／{{$staff->staff_id_no}}／{{$staff->staff_name}}
                </div>
              </div>

              <table id="table" class="mar-bottom15">
                <thead>
                  <tr>
                    <th rowspan="2">年月日</th>
                    <th colspan="2">本人申告</th>
                    <th colspan="2">入退出</th>
                    <th colspan="2">パソコン(テレワーク)</th>
                    <th colspan="2"  rowspan="2">分析</th>
                  </tr>
                  <tr>
                    <th>出社</th>
                    <th>退社</th>
                    <th>最初</th>
                    <th>最後</th>
                    <th>ログイン</th>
                    <th>ログアウト</th>
                  </tr>
                </thead>
                <tbody>
                <?php $wts = search_work_time($staff, $conditions); ?>                
                 
                @foreach($wts['worktimes'] as $kd => $vald)

                <?php  $tt_date =  date('Y-m-d', strtotime($vald['tt_date'])); 
                       //$arrDoor =  touchtime($staff, $tt_date);                                              
                    $door_in = isset($vald['door_in'])?formatshortTime(hour_minute(@$vald['door_in'])):'';
                    $door_out = isset($vald['door_out'])?formatshortTime(hour_minute(@$vald['door_out'])):'';
                    $tt_gotime = isset($vald['tt_gotime'])?formatshortTime(@$vald['tt_gotime'], ':'):'';
                    $tt_backtime = isset($vald['tt_backtime'])?formatshortTime(@$vald['tt_backtime'], ':'):'';
                    $time_start = compare_min($door_in, formatshortTime(@$vald['tp_logintime'])); 
                    $time_end = compare_max($door_out, formatshortTime(@$vald['tp_logouttime']));
                    $over_in = over_in( time2second($tt_gotime), time2second($time_start));
                    $over_out = over_out(time2second($tt_backtime), time2second($time_end));
                ?>

                <tr>
                  <td>{{DayeJp($kd)}}</td>
                  <td>@if(!empty($tt_gotime)){{$tt_gotime}} @else データ無し @endif </td>
                  <td>@if(!empty($tt_backtime)){{$tt_backtime}} @else データ無し @endif</td>                  
                  <td>@if(!empty($door_in)){{$door_in}} @else データ無し @endif </td>
                  <td>@if(!empty($door_out)){{$door_out}} @else データ無し @endif</td>                  
                  <td>@if(isset($vald['tp_logintime'])){{formatshortTime($vald['tp_logintime'])}} @else データ無し @endif</td>
                  <td>@if(isset($vald['tp_logouttime'])){{formatshortTime($vald['tp_logouttime'])}} @else データ無し @endif</td>
                  <td {{style_overtime($over_in, $over_out)}}>{{ time_over($over_in, $over_out) }}</td>
                </tr>
                @endforeach
                

                </tbody>
              </table>              

              <div class="row">
                <div class="col-md-12 text-center">
                  <input name="export_pdf" value="PDFで出力する" type="button" onclick="location.href='{{route('backend.search.index_pdf',['staff_id'=>$staff->staff_id, 'year_from'=>$conditions['year_from'], 'month_from'=>$conditions['month_from'], 'year_to'=>$conditions['year_to'], 'month_to'=>$conditions['month_to']])}}'" class="btn btn-primary btn-sm">
                </div>
              </div>

              @endforeach

            </div>
          </div>
          @elseif(count($staffs) <= 0 && (isset($belong_id) || isset($kw)) )
          <div class="agile-tables">
            <div class="agile_info_shadow" style="text-align: center;">
              <strong style="color: #777;">該当するデータがありません。</strong>
            </div>
          </div>
          @endif

        </div>
<script type="text/javascript">
$("#btnSubmit").on("click",function() { 
   var flag = true; 
   var $yearFrom = $("#year_from").val();
   var $yearTo = $("#year_to").val();
  if (parseInt($yearFrom) > parseInt($yearTo )) {  
    $("#error").html('年月までは年月からより大きくなければなりません。');             
    $("#error").css('display','block');   
    $("#year_from").focus();
    flag = false;    
  }
  if(flag) $( "#f_search" ).submit();
});
</script>   
@endsection