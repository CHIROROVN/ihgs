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
		<div class="company-line">{{ ALL }}</div>
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
	<?php $row = 0; ?>
	  @if(count(search_work_time($staff->staff_id_no, $conditions)) > 0)
	   @foreach(search_work_time($staff->staff_id_no, $conditions) as $wt)
   	<?php $date = format_date($wt->tt_date, '-');

   ?>
    <tr {!! ($row % 2 != 0) ? 'class="old"' : '' !!}>
      <td class="col-date">{{DateDayJp($wt->tt_date)}}</td>
      <td>{{formatshortTime($wt->tt_gotime, ':')}}</td>
      <td>{{formatshortTime($wt->tt_backtime, ':')}}</td>
      <td>{{@hour_minute(touchtime($staff, $date)[0]->door_in)}}</td>
      <td>{{@hour_minute(touchtime($staff, $date)[0]->door_out)}}</td>
      <td>{{@hour_minute(actiontime($staff, $date)[0]->action_in)}}</td>
      <td>{{@hour_minute(actiontime($staff, $date)[0]->action_out)}}</td>
      <?php 
        $time_start = compare_min(touchtime($staff, $date)[0]->door_in, actiontime($staff, $date)[0]->action_in); 
        $time_end = compare_max(touchtime($staff, $date)[0]->door_out, actiontime($staff, $date)[0]->action_out);

        $over_in = over_in(time2second($wt->tt_gotime), time2second(date('H:i:s',strtotime($time_start))));
        $over_out = over_out(time2second($wt->tt_backtime), time2second(date('H:i:s',strtotime($time_end))));
        ?>
      <td {{@style_overtime($over_in, $over_out)}}>{{ @time_over($over_in, $over_out) }}</td>
      	<td></td>
		<td></td>
    </tr>
    <?php $row ++; ?>
    @endforeach
  @endif

<!-- 	<tr class="old col-date">
		<td>2017年10⽉2⽇(⽇)</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class="col-date">2017年10⽉3⽇(⽇)</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr class="old col-date">
		<td>2017年10⽉4⽇(⽇)</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class="col-date">2017年10⽉5⽇(⽇)</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr class="old col-date">
		<td>2017年10⽉6⽇(⽇)</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class="col-date">2017年10⽉7⽇(⽇)</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr class="old col-date">
		<td>2017年10⽉8⽇(⽇)</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class="col-date">2017年10⽉9⽇(⽇)</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr class="old col-date">
		<td>2017年10⽉10⽇(⽇)</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class="col-date">2017年10⽉11⽇(⽇)</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr class="old col-date">
		<td>2017年10⽉12⽇(⽇)</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class="col-date">2017年10⽉13⽇(⽇)</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr class="old col-date">
		<td>2017年10⽉14⽇(⽇)</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class="col-date">2017年10⽉15⽇(⽇)</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr class="old col-date">
		<td>2017年10⽉16⽇(⽇)</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class="col-date">2017年10⽉17⽇(⽇)</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr class="old col-date">
		<td>2017年10⽉18⽇(⽇)</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class="col-date">2017年10⽉19⽇(⽇)</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr class="old col-date">
		<td>2017年10⽉20⽇(⽇)</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class="col-date">2017年10⽉20⽇(⽇)</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr class="old col-date">
		<td>2017年10⽉21⽇(⽇)</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class="col-date">2017年10⽉22⽇(⽇)</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr class="old col-date">
		<td>2017年10⽉23⽇(⽇)</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class="col-date">2017年10⽉24⽇(⽇)</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr class="old col-date">
		<td>2017年10⽉25⽇(⽇)</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr> -->

  </table>
</div>
</body>
</html>