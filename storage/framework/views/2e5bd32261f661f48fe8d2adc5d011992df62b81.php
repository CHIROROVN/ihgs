<html lang='ja'>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<TITLE>個人ごと月次集計</TITLE>
<link href="<?php echo e(asset('')); ?>public/backend/css/pdf.css" rel="stylesheet" /> 
<link href="https://fonts.googleapis.com/earlyaccess/mplus1p.css" rel="stylesheet" />
</head>
<body>
<div class="container">
	<div class="name-section">
		<div class="company-line"><?php echo e(COMPANY_NAME); ?> / <?php echo division($staff_belong); ?></div>
	</div>
  <table cellpadding=0 cellspacing=0>
	<tr>
			<td class="bottom-line header col-name">氏名</td>
			<td class="bottom-line header col-normal"><?php echo e($cb_year); ?> 年<br>4月</td>
			<td class="bottom-line header col-normal"><?php echo e($cb_year); ?> 年<br>5月</td>
			<td class="bottom-line header col-normal"><?php echo e($cb_year); ?> 年<br>6月</td>
			<td class="bottom-line header col-normal"><?php echo e($cb_year); ?> 年<br>7月</td>
			<td class="bottom-line header col-normal"><?php echo e($cb_year); ?> 年<br>8月</td>
			<td class="bottom-line header col-normal"><?php echo e($cb_year); ?> 年<br>9月</td>
			<td class="bottom-line header col-normal"><?php echo e($cb_year); ?> 年<br>10月</td>
			<td class="bottom-line header col-normal"><?php echo e($cb_year); ?> 年<br>11月</td>
			<td class="bottom-line header col-normal"><?php echo e($cb_year); ?> 年<br>12月</td>
			<td class="bottom-line header col-normal"><?php echo e($cb_year +1); ?> 年<br>1月</td>
			<td class="bottom-line header col-normal"><?php echo e($cb_year +1); ?> 年<br>2月</td>
			<td class="bottom-line header col-normal"><?php echo e($cb_year +1); ?> 年<br>3月</td>
			<td class="bottom-line header col-total">合計</td>
			<td class="bottom-line header col-normal">基準超</td>
			<td class="bottom-line header remark">備考</td>
	</tr>
	<?php $row = 0; ?>
	<?php if(count($worktimes) > 0): ?>
	<?php $__currentLoopData = $worktimes['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $worktime): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
    <tr <?php echo ($row % 2 != 0) ? 'class="old"' : ''; ?>>
    	<td><?php echo e($worktime->staff_name); ?></td>
     	<td <?php echo e(@style_overwork($overtimes[$worktime->staff_id][4])); ?>><?php if(isset($overtimes[$worktime->staff_id][4])): ?> <?php echo e($overtimes[$worktime->staff_id][4]); ?>  <?php else: ?> 0h <?php endif; ?></td>
    <td <?php echo e(@style_overwork($overtimes[$worktime->staff_id][5])); ?>><?php if(isset($overtimes[$worktime->staff_id][5])): ?> <?php echo e($overtimes[$worktime->staff_id][5]); ?>  <?php else: ?> 0h <?php endif; ?></td>
    <td <?php echo e(@style_overwork($overtimes[$worktime->staff_id][6])); ?>><?php if(isset($overtimes[$worktime->staff_id][6])): ?> <?php echo e($overtimes[$worktime->staff_id][6]); ?>  <?php else: ?> 0h <?php endif; ?></td>
                    <td <?php echo e(@style_overwork($overtimes[$worktime->staff_id][7])); ?>><?php if(isset($overtimes[$worktime->staff_id][7])): ?> <?php echo e($overtimes[$worktime->staff_id][7]); ?>  <?php else: ?> 0h <?php endif; ?></td>
                    <td <?php echo e(@style_overwork($overtimes[$worktime->staff_id][8])); ?>><?php if(isset($overtimes[$worktime->staff_id][8])): ?> <?php echo e($overtimes[$worktime->staff_id][8]); ?>  <?php else: ?> 0h <?php endif; ?></td>
                    <td <?php echo e(@style_overwork($overtimes[$worktime->staff_id][9])); ?>><?php if(isset($overtimes[$worktime->staff_id][9])): ?> <?php echo e($overtimes[$worktime->staff_id][9]); ?>  <?php else: ?> 0h <?php endif; ?></td>
                     <td <?php echo e(@style_overwork($overtimes[$worktime->staff_id][10])); ?>><?php if(isset($overtimes[$worktime->staff_id][10])): ?> <?php echo e($overtimes[$worktime->staff_id][10]); ?>  <?php else: ?> 0h <?php endif; ?></td>
                    <td <?php echo e(@style_overwork($overtimes[$worktime->staff_id][11])); ?>><?php if(isset($overtimes[$worktime->staff_id][11])): ?> <?php echo e($overtimes[$worktime->staff_id][11]); ?>  <?php else: ?> 0h <?php endif; ?></td>
                    <td <?php echo e(@style_overwork($overtimes[$worktime->staff_id][12])); ?>><?php if(isset($overtimes[$worktime->staff_id][12])): ?> <?php echo e($overtimes[$worktime->staff_id][12]); ?>  <?php else: ?> 0h <?php endif; ?></td>
                    <td <?php echo e(@style_overwork($overtimes[$worktime->staff_id][1])); ?>><?php if(isset($overtimes[$worktime->staff_id][1])): ?> <?php echo e($overtimes[$worktime->staff_id][1]); ?>  <?php else: ?> 0h <?php endif; ?></td>
                    <td <?php echo e(@style_overwork($overtimes[$worktime->staff_id][2])); ?>><?php if(isset($overtimes[$worktime->staff_id][2])): ?> <?php echo e($overtimes[$worktime->staff_id][2]); ?>  <?php else: ?> 0h <?php endif; ?></td>
                     <td <?php echo e(@style_overwork($overtimes[$worktime->staff_id][3])); ?>><?php if(isset($overtimes[$worktime->staff_id][3])): ?> <?php echo e($overtimes[$worktime->staff_id][3]); ?>  <?php else: ?> 0h <?php endif; ?></td>
                     <td><?php if(isset($overtimes[$worktime->staff_id]['total']) && $overtimes[$worktime->staff_id]['total'] >0): ?> <?php echo e($overtimes[$worktime->staff_id]['total']); ?> h <?php endif; ?> </td>
                    <td><?php if(isset($overtimes[$worktime->staff_id]['time']) && $overtimes[$worktime->staff_id]['time'] >0): ?> <?php echo e($overtimes[$worktime->staff_id]['time']); ?><?php endif; ?></td>
      <td></td>               		
    </tr>
    <?php $row ++; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <?php endif; ?>

  </table>
</div>
</body>
</html>