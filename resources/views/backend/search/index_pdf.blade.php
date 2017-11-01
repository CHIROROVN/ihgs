<html lang='ja'>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<TITLE>個人ごと月次集計</TITLE>
<link href="{{ asset('') }}public/backend/css/pdf-style.css" rel="stylesheet" /> 
<link href="https://fonts.googleapis.com/earlyaccess/mplus1p.css" rel="stylesheet" />
</head>
<body>
<div class="container">
	<div class="name-section">
		<div class="company-line">{{ COMPANY_NAME }}</div>
		<div class="staff-line">{!! division($staff->staff_belong) !!} ／ {{$staff->staff_id_no}} ／ {{$staff->staff_name}}</div>
	</div>
  <?php  $wts = search_work_time_pdf($staff, $conditions);       
        $intMonth = 0;        
  ?>
     @foreach($wts as $kd => $wt) 
       @if($intMonth==0 || ($intMonth !=0 && $intMonth!=$kd)) 
          @if($intMonth !=0) <pagebreak>  @endif        
      <table cellpadding=0 cellspacing=0 >
      <tr>
          <td rowspan="2" class="bottom-line col-first header">年月日</td>
          <td colspan="2" class="header">本⼈申告</td>
          <td colspan="2" class="header">⼊退出</td>
          <td colspan="2" class="header"> PC（テレワーク）</td>
          <td rowspan="2" class="bottom-line width-normal header">分析</td>
          <td rowspan="2" class="bottom-line col-reason header">乖離理由</td>
          <td rowspan="2" class="bottom-line remark header">印</td>
      </tr>
      <tr>
          <td class="bottom-line width-normal header">出社</td>
          <td class="bottom-line width-normal header">退社</td>
          <td class="bottom-line width-normal header">最初</td>
          <td class="bottom-line width-normal header">最後</td>
          <td class="bottom-line top-line width-normal header">最初</td>
          <td class="bottom-line width-normal header">最後</td>
      </tr>
      @endif
      <?php $row = 0;?>
      @foreach($wt as $key => $val)
       <?php            
             $time_start = isset($val['touchtime_in'])?compare_min($val['touchtime_in'], @$val['pc_in']):(isset($val['pc_in'])?$val['pc_in']:''); 
             $time_end   = isset($val['touchtime_out'])?compare_max($val['touchtime_out'], @$val['pc_out']):(isset($val['pc_out'])?$val['pc_out']:'');
             $over_in    = isset($val['gotime'])?over_in( time2second($val['gotime']), time2second($time_start)):'';
             $over_out   = isset($val['backtime'])?over_out(time2second($val['backtime']), time2second($time_end)):'';
       ?>      
      <tr {!! ($row % 2 != 0) ? 'class="old"' : '' !!}>
          <td class="col-date">{{DateDayJp($key)}}</td>
          <td>@if(isset($val['gotime'])){{formatshortTime($val['gotime'])}} @else  データ無し @endif</td>
          <td>@if(isset($val['backtime'])){{formatshortTime($val['backtime'])}} @else  データ無し @endif</td>
          <td>@if(isset($val['touchtime_in'])){{formatshortTime($val['touchtime_in'])}} @else  データ無し @endif</td>
          <td>@if(isset($val['touchtime_out'])){{formatshortTime($val['touchtime_out'])}} @else  データ無し @endif</td>
          <td>@if(isset($val['pc_in'])){{formatshortTime($val['pc_in'])}} @else  データ無し @endif</td>
          <td>@if(isset($val['pc_out'])){{formatshortTime($val['pc_out'])}} @else  データ無し @endif</td>
          <td {{style_overtime($over_in, $over_out)}}>{{ time_over($over_in, $over_out) }}</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
      </tr>
      <?php $row++;?>
      @endforeach  
    <?php $intMonth =$kd;?>
    </table>
    @endforeach
</div>
</body>
</html>