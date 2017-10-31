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


	<?php $row = 0; $ym=''; $wts = search_work_time($staff->staff_id_no, $conditions);?>
	  @if(count($wts['timecard']) > 0)
	   @foreach($wts['worktimes'] as $date => $wt)
   	<?php $ym = date('Y-m', strtotime($date)); ?>
   	@if($ym != date('Y-m', strtotime($date)) || $row == 0)
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
   	@endif

    <tr {!! ($row % 2 != 0) ? 'class="old"' : '' !!}>
      <td class="col-date">{{DateDayJp($date)}}</td>
      <td>{{formatshortTime(@$wt['tt_gotime'], ':')}}</td>
      <td>{{formatshortTime(@$wt['tt_backtime'], ':')}}</td>
      <td>{{@hour_minute(touchtime($staff, $date)->door_in)}}</td>
      <td>{{@hour_minute(touchtime($staff, $date)->door_out)}}</td>
      <td>{{@hour_minute(actiontime($staff, $date)->action_in)}}</td>
      <td>{{@hour_minute(actiontime($staff, $date)->action_out)}}</td>
      <?php 
      	$tt_gotime = isset($wt['tt_gotime']) ? $wt['tt_gotime'] : '00:00:00';
      	$tt_backtime = isset($wt['tt_backtime']) ? $wt['tt_backtime'] : '00:00:00';
        $time_start = compare_min(touchtime($staff, $date)->door_in, actiontime($staff, $date)->action_in); 
        $time_end = compare_max(touchtime($staff, $date)->door_out, actiontime($staff, $date)->action_out);

        $over_in = over_in(time2second($tt_gotime), time2second(date('H:i:s',strtotime($time_start))));
        $over_out = over_out(time2second($tt_backtime), time2second(date('H:i:s',strtotime($time_end))));
        ?>
      <td {{@style_overtime($over_in, $over_out)}}>{{ @time_over($over_in, $over_out) }}</td>
      	<td></td>
		<td></td>
    </tr>
    <?php $row ++; ?>
    	@if($ym != date('Y-m', strtotime($date))  || $row == 0)
		</table>
    	@endif

    @endforeach
  @endif

</div>

</body>
</html>