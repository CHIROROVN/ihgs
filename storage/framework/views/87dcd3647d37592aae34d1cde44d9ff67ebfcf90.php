<html lang='ja'>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<TITLE>個人ごと月次集計</TITLE>
<link href="<?php echo e(asset('')); ?>public/backend/css/pdf-style.css" rel="stylesheet" /> 
<link href="https://fonts.googleapis.com/earlyaccess/mplus1p.css" rel="stylesheet" />
</head>
<body>
<div class="container">
	<div class="name-section">
		<div class="company-line"><?php echo e(COMPANY_NAME); ?></div>
		<div class="staff-line"><?php echo division($staff->staff_belong); ?> ／ <?php echo e($staff->staff_id_no); ?> ／ <?php echo e($staff->staff_name); ?></div>
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
	  <?php if(count(search_work_time($staff->staff_id_no, $conditions)) > 0): ?>
	   <?php $__currentLoopData = search_work_time($staff->staff_id_no, $conditions); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
   	<?php $date = format_date($wt->tt_date, '-');

   ?>
    <tr <?php echo ($row % 2 != 0) ? 'class="old"' : ''; ?>>
      <td class="col-date"><?php echo e(DateDayJp($wt->tt_date)); ?></td>
      <td><?php echo e(formatshortTime($wt->tt_gotime, ':')); ?></td>
      <td><?php echo e(formatshortTime($wt->tt_backtime, ':')); ?></td>
      <td><?php echo e(@hour_minute(touchtime($staff, $date)[0]->door_in)); ?></td>
      <td><?php echo e(@hour_minute(touchtime($staff, $date)[0]->door_out)); ?></td>
      <td><?php echo e(@hour_minute(actiontime($staff, $date)[0]->action_in)); ?></td>
      <td><?php echo e(@hour_minute(actiontime($staff, $date)[0]->action_out)); ?></td>
      <?php 
        $time_start = compare_min(touchtime($staff, $date)[0]->door_in, actiontime($staff, $date)[0]->action_in); 
        $time_end = compare_max(touchtime($staff, $date)[0]->door_out, actiontime($staff, $date)[0]->action_out);

        $over_in = over_in(time2second($wt->tt_gotime), time2second(date('H:i:s',strtotime($time_start))));
        $over_out = over_out(time2second($wt->tt_backtime), time2second(date('H:i:s',strtotime($time_end))));
        ?>
      <td <?php echo e(@style_overtime($over_in, $over_out)); ?>><?php echo e(@time_over($over_in, $over_out)); ?></td>
      	<td></td>
		<td></td>
    </tr>
    <?php $row ++; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <?php endif; ?>

  </table>
</div>
</body>
</html>