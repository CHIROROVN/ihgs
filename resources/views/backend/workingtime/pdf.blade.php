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
			<td class="bottom-line header">2017年4月</td>
			<td class="bottom-line header">2017年5月</td>
			<td class="bottom-line header">2017年6月</td>
			<td class="bottom-line header">2017年7月</td>
			<td class="bottom-line header">2017年8月</td>
			<td class="bottom-line header">2017年9月</td>
			<td class="bottom-line header">2017年10月</td>
			<td class="bottom-line header">2017年11月</td>
			<td class="bottom-line header">2017年12月</td>
			<td class="bottom-line header">2018年1月</td>
			<td class="bottom-line header">2018年2月</td>
			<td class="bottom-line header">2018年3月</td>
			<td class="bottom-line header">合計 </td>
			<td class="bottom-line header">基準超</td>
			<td class="bottom-line header remark">備考</td>
	</tr>
	<?php $row = 0; ?>
	@if(count($overwork) > 0)
	@foreach($overwork as $ow)
    <tr {!! ($row % 2 != 0) ? 'class="old"' : '' !!}>
		<td>杉元 俊彦 </td>
		<td>0h</td>
		<td>30h</td>
		<td class="bg-yellow">60h</td>
		<td>45h</td>
		<td>0h</td>
		<td>30h</td>
		<td class="bg-yellow">60h</td>
		<td>45h</td>
		<td>0h</td>
		<td>30h</td>
		<td class="bg-yellow">60h</td>
		<td>45h</td>
		<td>405h</td>
		<td>3回</td>
		<td></td>
    </tr>
    <?php $row ++; ?>
    @endforeach
  @endif

  </table>
</div>
</body>
</html>