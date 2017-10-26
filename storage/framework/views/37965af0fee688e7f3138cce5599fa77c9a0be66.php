<?php $__env->startSection('content'); ?>
<!-- breadcrumbs -->
<div class="w3l_agileits_breadcrumbs">
  <div class="w3l_agileits_breadcrumbs_inner">
    <ul>
      <li>データ管理<span>＞</span></li>
      <li>部課の管理<span>＞</span></li>
      <li>登録済み部の一覧</li>
    </ul>
  </div>
</div>
<!-- //breadcrumbs -->
  <div class="inner_content_w3_agile_info two_in">
    <div class="flash-messages">
      <?php if($message = Session::get('danger')): ?>
        <div id="error" class="message">
          <a id="close" title="Message"  href="#" onClick="document.getElementById('error').setAttribute('style','display: none;');">&times;</a>
            <span><?php echo e($message); ?></span>
        </div>
        <?php elseif($message = Session::get('success')): ?>
        <div id="success" class="message">
          <a id="close" title="Message"  href="javascript::void(0);" onClick="document.getElementById('success').setAttribute('style','display: none;');">&times;</a>
            <span><?php echo e($message); ?></span>
        </div>
        <?php endif; ?>  
    </div> 
    <p class="intro">登録されている部の名称を一覧表示しています。</p>
      <!-- tables -->          
    <div class="agile-tables">
            <div class="w3l-table-info agile_info_shadow">
              <div class="row mar-bottom15">
                <div class="col-md-12 text-right">
                  <input onclick="location.href='<?php echo e(route('backend.division.regist')); ?>'" value="部の新規登録" type="button" class="btn btn-primary btn-xs">
                </div>
              </div>
              <table id="table">
                <thead>
                  <tr>
                    <th>削除</th>
                    <th>部のコード</th>
                    <th>部の名称</th>
                    <th>配下の課一覧</th>
                    <th>配下の課の編集</th>
                    <th>編集</th>
                    <th colspan="4" align="center" style="text-align: center;">表示順序</th>
                  </tr>
                </thead>
                <?php 
                  $i = 0;
                  $max = count($belongs);
                ?>
                <?php if(empty($belongs) || count($belongs) < 1): ?>
                <tr>
                <td colspan="7">
                  <h3 align="center">該当するデータがありません。</h3>
                </td>
              </tr>
                <?php else: ?>                    
                <tbody>
                  <?php $__currentLoopData = $belongs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $belong): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $i++; ?>
                      <tr data-id='<?php echo e($belong->belong_id); ?>'>
                        <td align="center"><input name="btnDelete" id="btnDelete" value="削除" type="button" class="btn btn-primary btn-xs" onclick="btnDelete('<?php echo e($belong->belong_id); ?>');"></td>
                        <td><?php echo e($belong->belong_code); ?></td>
                        <td><?php echo e($belong->belong_name); ?></td>
                        <td><?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                               <?php if($section->belong_parent_id==$belong->belong_id): ?>
                               <?php echo e($section->belong_name); ?>

                               <?php endif; ?> 
                            <br />
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></td>
                        <td align="center"><input onclick="location.href='<?php echo e(asset('section/' . $belong->belong_id)); ?>'" value="配下の課の編集" type="button" class="btn btn-primary btn-xs"></td>
                        <td align="center"><input onclick="location.href='<?php echo e(asset('division/edit/' . $belong->belong_id)); ?>'" value="編集" type="button" class="btn btn-primary btn-xs"></td>
                        <td style="width: 50px;"><input name="btnTop" id="btnTop" value="TOP" type="button" class="btn btn-primary btn-xs <?php if($i < 2): ?> <?php echo e('hidden'); ?> <?php endif; ?>" onclick="location.href='<?php echo e(asset('division/orderby-top?id=' . $belong->belong_id)); ?>'" ></td>
                        <td style="width: 50px;"><input name="btnUp" id="btnUp" value="↑" type="button" class="btn btn-primary btn-xs <?php if($i < 2): ?> <?php echo e('hidden'); ?> <?php endif; ?>" onclick="location.href='<?php echo e(asset('division/orderby-up?id=' . $belong->belong_id)); ?>'"></td>
                        <td style="width: 50px;"><input name="btnDown" id="btnDown" value="↓" type="button" class="btn btn-primary btn-xs <?php if($i == $max): ?> <?php echo e('hidden'); ?> <?php endif; ?>" onclick="location.href='<?php echo e(asset('division/orderby-down?id=' . $belong->belong_id)); ?>'" ></td>
                        <td style="width: 50px;"><input name="btnLast" value="Last" type="button" class="btn btn-primary btn-xs <?php if($i == $max): ?> <?php echo e('hidden'); ?> <?php endif; ?>" onclick="location.href='<?php echo e(asset('division/orderby-last?id=' . $belong->belong_id)); ?>'"></td>
                      </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                   </tbody>
                <?php endif; ?>                  
                </tbody>
              </table>
            </div>
          </div></div>
<!-- start: Delete Coupon Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"
                    aria-hidden="true">&times;</button>
                <h3 class="modal-title" id="myModalLabel">Warning!</h3>
            </div>
            <div class="modal-body">
                <h4>Are you sure you want to DELETE?</h4>

            </div>
            <!--/modal-body-collapse -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="btnDelteYes" href="#">Yes</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            </div>
            <!--/modal-footer-collapse -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script type="text/javascript">
  $('#btnDelete').on('click', function (e) {    
    var id = $(this).closest('tr').data('id');
    $('#myModal').data('id', id).modal('show');
});
function btnDelete($id)
 {
      var id = $id;
    $('#myModal').data('id', id).modal('show');
 } 
$('#btnDelteYes').click(function () {
    var id = $('#myModal').data('id');   
    location.href='<?php echo e(asset('division/delete/')); ?>'+'/'+ id ;    
});
</script>    

<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>