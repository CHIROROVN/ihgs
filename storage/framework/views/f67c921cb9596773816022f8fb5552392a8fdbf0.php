<?php if($paginator->hasPages()): ?>
    <ul class="pagination">
        
        <?php if($paginator->onFirstPage()): ?>
            <input type="button" disabled value="前の<?php echo e(LIMIT_PAGE); ?>件を表示" class="btn btn-primary btn-sm">
        <?php else: ?>
            <input type="button" onClick="location.href='<?php echo e($paginator->previousPageUrl()); ?>'"  rel="prev" value="前の<?php echo e(LIMIT_PAGE); ?>件を表示" class="btn btn-primary btn-sm">
        <?php endif; ?>

        
        <?php if($paginator->hasMorePages()): ?>
            <input type="button" onClick="location.href='<?php echo e($paginator->nextPageUrl()); ?>'" rel="next" value="次の<?php echo e(LIMIT_PAGE); ?>件を表示" class="btn btn-primary btn-sm" >
        <?php else: ?>
            <input type="button" disabled value="次の<?php echo e(LIMIT_PAGE); ?>件を表示" class="btn btn-primary btn-sm">
        <?php endif; ?>
    </ul>
<?php endif; ?>

