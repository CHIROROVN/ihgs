<html lang='ja'>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<TITLE>個人ごと月次集計</TITLE>
<link href="{{ asset('') }}public/backend/css/pdf.css" rel="stylesheet" /> 
<link href="https://fonts.googleapis.com/earlyaccess/mplus1p.css" rel="stylesheet" />
</head>
<body>
<div class="container">
	<div class="name-section">
		<div class="company-line">{{ COMPANY_NAME }} / {!! division($staff_belong) !!}</div>
	</div>
  <table cellpadding=0 cellspacing=0>
	<tr>
			<td class="bottom-line header col-name">氏名</td>
			<td class="bottom-line header col-normal">{{$cb_year}} 年<br>4月</td>
			<td class="bottom-line header col-normal">{{$cb_year}} 年<br>5月</td>
			<td class="bottom-line header col-normal">{{$cb_year}} 年<br>6月</td>
			<td class="bottom-line header col-normal">{{$cb_year}} 年<br>7月</td>
			<td class="bottom-line header col-normal">{{$cb_year}} 年<br>8月</td>
			<td class="bottom-line header col-normal">{{$cb_year}} 年<br>9月</td>
			<td class="bottom-line header col-normal">{{$cb_year}} 年<br>10月</td>
			<td class="bottom-line header col-normal">{{$cb_year}} 年<br>11月</td>
			<td class="bottom-line header col-normal">{{$cb_year}} 年<br>12月</td>
			<td class="bottom-line header col-normal">{{$cb_year +1}} 年<br>1月</td>
			<td class="bottom-line header col-normal">{{$cb_year +1}} 年<br>2月</td>
			<td class="bottom-line header col-normal">{{$cb_year +1}} 年<br>3月</td>
			<td class="bottom-line header col-total">合計</td>
			<td class="bottom-line header col-normal">基準超</td>
			<td class="bottom-line header remark">備考</td>
	</tr>
	<?php $row = 0; ?>
	@if(count($worktimes) > 0)
	@foreach($worktimes['data'] as $worktime) 
    <tr {!! ($row % 2 != 0) ? 'class="old"' : '' !!}>
    	<td>{{$worktime->staff_name}}</td>
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
        <td>{{@display_overwork_staff($overtimes[$worktime->staff_id])}}</td>
        <td>{{@count_overwork_staff($overtimes[$worktime->staff_id])}}</td> 
      <td></td>               		
    </tr>
    <?php $row ++; ?>
    @endforeach
  @endif

  </table>
</div>
</body>
</html>