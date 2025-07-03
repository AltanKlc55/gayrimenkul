<div class="form-group mb-3  <?php echo e(!empty($grid) ? $grid : ''); ?> <?php echo e($errors->has($name) ? 'has-error' : ''); ?>">

    <label><?php echo e($title); ?></label>
    <textarea class="form-control tinymce"
              <?php if(isset($multilang) and $multilang == true): ?>
                  name="<?php echo e($name); ?>[<?php echo e($lang); ?>]"
              <?php else: ?>
                  name="<?php echo e($name); ?>"
              <?php endif; ?>
    ><?php echo (isset($entry) and !empty($entry)) ?  html_entity_decode($entry)  : ''; ?></textarea>
    <?php if($errors->has($name)): ?>
        <span class="help-block">
            <strong>
                <?php echo e($errors->first($name)); ?>

            </strong>
        </span>
    <?php endif; ?>
</div><?php /**PATH C:\Users\astok\Desktop\private_real_estate\resources\views/components/forms/textarea.blade.php ENDPATH**/ ?>