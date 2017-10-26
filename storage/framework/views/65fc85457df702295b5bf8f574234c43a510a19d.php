<?php $__env->startSection('content'); ?>
<!-- breadcrumbs -->
<div class="w3l_agileits_breadcrumbs">
    <div class="w3l_agileits_breadcrumbs_inner">
        <ul><li>部課ごと残業集計</li></ul>
    </div>
</div>
<!-- //breadcrumbs -->
<div class="inner_content_w3_agile_info two_in">
    <div class="graph-form agile_info_shadow">
        <div class="form-body">
          <span class="help-block" id="error-staff-belong"></span>
          <span class="help-block" id="error-cb-year"></span>  
        <?php echo Form::open(array('url' => 'overwork','id'=>'frmSearch', 'method' => 'post')); ?> 
        <table id="table">
            <thead>
            <tr>
                <th>部課名</th>
                <th>年度</th>
                <th></th>
            </tr>
            </thead>
        <tbody>
        <tr>
            <td><?php echo divisions('staff_belong', $staff_belong,true); ?>

              </td>
            <td><div class="fl-left">
                    <select name="cb_year" id="cb_year" class="form-control form-control-date">
                        <option value=""><?php echo e(ALL_YEAR); ?></option>                        
                        <?php for($i = START_YEAR; $i <= END_YEAR; $i++): ?>
                            <option value="<?php echo e($i); ?>" <?php if($i==$cb_year): ?> selected="" <?php endif; ?>><?php echo e($i); ?> 年度</option>
                        <?php endfor; ?>
                    </select>
                </div>              
            </td>
            <td><input name="btnSubmit" value="抽出する" id="btnSubmit" type="button" class="btn btn-primary btn-sm"></td>
            </tr>
        </tbody>    
        </table>
        <?php echo Form::close(); ?>  
   </div>
</div>
<!-- tables -->
<div class="agile-tables">
  <?php if(empty($worktimes['data']) || count($worktimes['data']) < 1): ?>
    <div class="agile_info_shadow" style="text-align: center;">
      <strong style="color: #777;">該当するデータがありません。</strong>
    </div>
  <?php else: ?>
    <div class="w3l-table-info agile_info_shadow">
      <div class="row mar-bottom15"></div>
        <table id="table" class="mar-bottom15">
          <thead>
          <tr>
            <th>氏名</th>
            <th><?php echo e($cb_year); ?> 年<br />4月</th>
            <th><?php echo e($cb_year); ?> 年<br />5月</th>
            <th><?php echo e($cb_year); ?> 年<br />6月</th>
            <th><?php echo e($cb_year); ?> 年<br />7月</th>
            <th><?php echo e($cb_year); ?> 年<br />8月</th>
            <th><?php echo e($cb_year); ?> 年<br />9月</th>
            <th><?php echo e($cb_year); ?> 年<br />10月</th>
            <th><?php echo e($cb_year); ?> 年<br />11月</th>
            <th><?php echo e($cb_year); ?> 年<br />12月</th>
            <th><?php echo e($cb_year +1); ?> 年<br />1月</th>
            <th><?php echo e($cb_year +1); ?> 年<br />2月</th>
            <th><?php echo e($cb_year +1); ?> 年<br />3月</th>
            <th>合計</th>
            <th>基準超</th>
          </tr>
                </thead>
                <tbody> 
                <?php $__currentLoopData = $worktimes['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $worktime): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  
                  <tr>
                    <td><a href="<?php echo e(asset('overtime/detail/'.$worktime->staff_id.'?year='.$cb_year)); ?>"><?php echo e($worktime->staff_name); ?></a></td>
                    <td <?php echo e(@style_overwork($overtimes[$worktime->staff_id][4])); ?>><?php if(isset($overtimes[$worktime->staff_id][4])): ?> <?php echo e($overtimes[$worktime->staff_id][4]); ?> h <?php else: ?> 0h <?php endif; ?></td>
                    <td <?php echo e(@style_overwork($overtimes[$worktime->staff_id][5])); ?>><?php if(isset($overtimes[$worktime->staff_id][5])): ?> <?php echo e($overtimes[$worktime->staff_id][5]); ?> h <?php else: ?> 0h <?php endif; ?></td>
                     <td <?php echo e(@style_overwork($overtimes[$worktime->staff_id][6])); ?>><?php if(isset($overtimes[$worktime->staff_id][6])): ?> <?php echo e($overtimes[$worktime->staff_id][6]); ?> h <?php else: ?> 0h <?php endif; ?></td>
                    <td <?php echo e(@style_overwork($overtimes[$worktime->staff_id][7])); ?>><?php if(isset($overtimes[$worktime->staff_id][7])): ?> <?php echo e($overtimes[$worktime->staff_id][7]); ?> h <?php else: ?> 0h <?php endif; ?></td>
                    <td <?php echo e(@style_overwork($overtimes[$worktime->staff_id][8])); ?>><?php if(isset($overtimes[$worktime->staff_id][8])): ?> <?php echo e($overtimes[$worktime->staff_id][8]); ?> h <?php else: ?> 0h <?php endif; ?></td>
                    <td <?php echo e(@style_overwork($overtimes[$worktime->staff_id][9])); ?>><?php if(isset($overtimes[$worktime->staff_id][9])): ?> <?php echo e($overtimes[$worktime->staff_id][9]); ?> h <?php else: ?> 0h <?php endif; ?></td>
                     <td <?php echo e(@style_overwork($overtimes[$worktime->staff_id][10])); ?>><?php if(isset($overtimes[$worktime->staff_id][10])): ?> <?php echo e($overtimes[$worktime->staff_id][10]); ?> h <?php else: ?> 0h <?php endif; ?></td>
                    <td <?php echo e(@style_overwork($overtimes[$worktime->staff_id][11])); ?>><?php if(isset($overtimes[$worktime->staff_id][11])): ?> <?php echo e($overtimes[$worktime->staff_id][11]); ?> h <?php else: ?> 0h <?php endif; ?></td>
                    <td <?php echo e(@style_overwork($overtimes[$worktime->staff_id][12])); ?>><?php if(isset($overtimes[$worktime->staff_id][12])): ?> <?php echo e($overtimes[$worktime->staff_id][12]); ?> h <?php else: ?> 0h <?php endif; ?></td>
                    <td <?php echo e(@style_overwork($overtimes[$worktime->staff_id][1])); ?>><?php if(isset($overtimes[$worktime->staff_id][1])): ?> <?php echo e($overtimes[$worktime->staff_id][1]); ?> h <?php else: ?> 0h <?php endif; ?></td>
                    <td <?php echo e(@style_overwork($overtimes[$worktime->staff_id][2])); ?>><?php if(isset($overtimes[$worktime->staff_id][2])): ?> <?php echo e($overtimes[$worktime->staff_id][2]); ?> h <?php else: ?> 0h <?php endif; ?></td>
                     <td <?php echo e(@style_overwork($overtimes[$worktime->staff_id][3])); ?>><?php if(isset($overtimes[$worktime->staff_id][3])): ?> <?php echo e($overtimes[$worktime->staff_id][3]); ?> h <?php else: ?> 0h <?php endif; ?></td>
                     <td><?php if(isset($overtimes[$worktime->staff_id]['total']) && $overtimes[$worktime->staff_id]['total'] >0): ?> <?php echo e($overtimes[$worktime->staff_id]['total']); ?> h <?php endif; ?> </td>
                    <td><?php if(isset($overtimes[$worktime->staff_id]['time']) && $overtimes[$worktime->staff_id]['time'] >0): ?> <?php echo e($overtimes[$worktime->staff_id]['time']); ?><?php endif; ?></td>
                    <td></td>
                  </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
              </table>
              <div class="row">
                <div class="col-md-12 text-center">
                  <input name="export_pdf" value="PDFで出力する" type="button" onclick="location.href='<?php echo e(route('backend.workingtime.pdf', ['staff_belong'=>$staff_belong, 'cb_year'=>$cb_year])); ?>'" class="btn btn-primary btn-sm">
                </div>
              </div>
              </div>
              <?php endif; ?>

          </div>
        </div>
 </div>
</div>
<script type="text/javascript">
$("#btnSubmit").on("click",function() { 
   var flag = true; 
  if (!$("[name=staff_belong]").val().replace(/ /g, "")) {  
    $("#error-staff-belong").html('<?php echo $error['error_belong_required'];?>');             
    $("#error-staff-belong").css('display','block');   
    $('[name=staff_belong]').focus();
    flag = false;    
  }

 if (!$("#cb_year").val().replace(/ /g, "")) {  
    $("#error-cb-year").html('<?php echo $error['error_year_required'];?>');             
    $("#error-cb-year").css('display','block');   
    $('#cb_year').focus();
    flag = false; 
  }  
  if(flag) $( "#frmSearch" ).submit();
});
</script>   
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>