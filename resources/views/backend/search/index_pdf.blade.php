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
  <table cellpadding=0 cellspacing=0>
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
	<?php $row = 0; $wts = search_work_time($staff, $conditions);
  $first = reset($wts['worktimes']); $ym = date('Ym', strtotime($first['tt_date']));
  ?>

	   @foreach($wts['worktimes'] as $kd => $wt)

     <?php  $tt_date =  date('Y-m-d', strtotime(@$wt['tt_date'])); 
        $door_in = formatshortTime(hour_minute(touchtime($staff, $tt_date)->door_in));
        $door_out = formatshortTime(hour_minute(touchtime($staff, $tt_date)->door_out));
        $tt_gotime = formatshortTime(@$wt['tt_gotime'], ':');
        $tt_backtime = formatshortTime(@$wt['tt_backtime'], ':');
        $time_start = compare_min($door_in, formatshortTime(@$wt['tp_logintime'])); 
        $time_end = compare_max($door_out, formatshortTime(@$wt['tp_logouttime']));
        $over_in = over_in( time2second($tt_gotime), time2second($time_start));
        $over_out = over_out(time2second($tt_backtime), time2second($time_end));
    ?>

    <tr {!! ($row % 2 != 0) ? 'class="old"' : '' !!}>
      <td class="col-date">{{DateDayJp($kd)}}</td>
      <td>@if(!empty($tt_gotime)){{$tt_gotime}} @else &nbsp; @endif </td>
      <td>@if(!empty($tt_backtime)){{$tt_backtime}} @else &nbsp; @endif</td>
      <td>@if(isset($door_in)){{$door_in}} @else &nbsp; @endif </td>
      <td>@if(isset($door_out)){{$door_out}} @else &nbsp; @endif</td>
      <td>@if(isset($wt['tp_logintime'])){{formatshortTime($wt['tp_logintime'])}} @else &nbsp; @endif</td>
      <td>@if(isset($wt['tp_logouttime'])){{formatshortTime($wt['tp_logouttime'])}} @else &nbsp; @endif</td>
      <td {{style_overtime($over_in, $over_out)}}>{{ time_over($over_in, $over_out) }}</td>
      <td></td>
      <td></td>
    </tr>
    <?php $row ++; ?>  

    @endforeach
</table>
</div>

</body>
</html>