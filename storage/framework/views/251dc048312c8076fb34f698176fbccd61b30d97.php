
<?php if($type != "link"): ?>
    <button type="<?php echo e($type); ?>"  id="<?php echo e(!empty($id) ? $id : ''); ?>"
            <?php if($onclick): ?>
                onclick="<?php echo e($onclick); ?>"
            <?php endif; ?>
            class="btn btn-<?php echo e($color); ?> btn-wave btn-sm waves-effect waves-light <?php echo e(!empty($class) ? $class : ''); ?>">
        <?php echo e($title); ?>


        <?php if($icon): ?>
            <i class="<?php echo e($icon); ?> ms-2 d-inline-block align-middle"></i>
        <?php endif; ?>
    </button>

<?php else: ?>
    <a href="<?php echo e($href); ?>"  id="<?php echo e(!empty($id) ? $id : ''); ?>"
            <?php if($onclick): ?>
                onclick="<?php echo e($onclick); ?>"
            <?php endif; ?>
                    target="_self"
            class="btn btn-primary btn-wave waves-effect waves-light <?php echo e(!empty($class) ? $class : ''); ?>">
        <?php echo e($title); ?>


        <?php if($icon): ?>
            <i class="<?php echo e($icon); ?> ms-2 d-inline-block align-middle"></i>
        <?php endif; ?>
    </a>

<?php endif; ?><?php /**PATH C:\Users\astok\Desktop\private_real_estate\resources\views/components/forms/button.blade.php ENDPATH**/ ?>