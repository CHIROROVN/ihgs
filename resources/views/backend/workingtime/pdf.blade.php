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
		<div class="company-line">{{ ALL }} / {!! division($staff_belong) !!}</div>
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
      @if(isset($overtimes[$worktime->staff_id][4])) {{@style_overwork($overtimes[$worktime->staff_id][4])}}  @else  <td>0h</td>@endif
      @if(isset($overtimes[$worktime->staff_id][5])) {{@style_overwork($overtimes[$worktime->staff_id][5])}}  @else  <td>0h</td>@endif
      @if(isset($overtimes[$worktime->staff_id][6])) {{@style_overwork($overtimes[$worktime->staff_id][6])}}  @else  <td>0h</td>@endif
      @if(isset($overtimes[$worktime->staff_id][7])) {{@style_overwork($overtimes[$worktime->staff_id][7])}}  @else  <td>0h</td>@endif
      @if(isset($overtimes[$worktime->staff_id][8])) {{@style_overwork($overtimes[$worktime->staff_id][8])}}  @else  <td>0h</td>@endif
      @if(isset($overtimes[$worktime->staff_id][9])) {{@style_overwork($overtimes[$worktime->staff_id][9])}}  @else  <td>0h</td>@endif
      @if(isset($overtimes[$worktime->staff_id][10])) {{@style_overwork($overtimes[$worktime->staff_id][10])}}  @else  <td>0h</td>@endif
      @if(isset($overtimes[$worktime->staff_id][11])) {{@style_overwork($overtimes[$worktime->staff_id][11])}}  @else  <td>0h</td>@endif
      @if(isset($overtimes[$worktime->staff_id][12])) {{@style_overwork($overtimes[$worktime->staff_id][12])}}  @else  <td>0h</td>@endif
      @if(isset($overtimes[$worktime->staff_id][1])) {{@style_overwork($overtimes[$worktime->staff_id][1])}}  @else  <td>0h</td>@endif
      @if(isset($overtimes[$worktime->staff_id][2])) {{@style_overwork($overtimes[$worktime->staff_id][2])}}  @else  <td>0h</td>@endif
      @if(isset($overtimes[$worktime->staff_id][3])) {{@style_overwork($overtimes[$worktime->staff_id][3])}}  @else  <td>0h</td>@endif                                                          
      <td>@if(isset($overtimes[$worktime->staff_id]['total']) && $overtimes[$worktime->staff_id]['total'] >0) {{$overtimes[$worktime->staff_id]['total']}}h @endif</td>
      <td>@if(isset($overtimes[$worktime->staff_id]['time']) && $overtimes[$worktime->staff_id]['time'] >0) {{$overtimes[$worktime->staff_id]['time']}}@endif</td>
      <td></td>               		
    </tr>
    <?php $row ++; ?>
    @endforeach
  @endif

  </table>
</div>
</body>
</html>