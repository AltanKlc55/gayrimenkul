<?php if($type == "hidden"): ?>
    <input type="<?php echo e($type); ?>"
        name="<?php echo e($name); ?>"
        value="<?php echo e((isset($entry) and !empty($entry)) ? $entry : ''); ?>"
    >
<?php else: ?>
<div class="form-group mb-3  <?php echo e(($type == 'hidden') ? 'hidden' : ''); ?> <?php echo e(!empty($grid) ? $grid : ''); ?> <?php echo e($errors->has($name) ? 'has-error' : ''); ?>">
    <label><?php echo e($title); ?></label>
    <?php if(!empty($description)): ?>
       <p><?php echo e($description); ?></p>
    <?php endif; ?>
<div class="row align-items-end">
    <div class="<?php echo e($type == "file" ? 'col-md-10' : ''); ?>">
        <input type="<?php echo e($type); ?>" <?php echo e(!empty($readonly) ? 'readonly' : ''); ?> <?php echo e(!empty($disabled) ? 'disabled' : ''); ?>

        <?php if($entry == "" and $type !="password"): ?>
            <?php echo e(!empty($required) ? 'required' : ''); ?>

        <?php endif; ?>

        <?php echo e(!empty($attribute) ? $attribute : ''); ?>  class="form-control input-default  <?php echo e(!empty($class) ? $class : ''); ?>" id="<?php echo e(!empty($id) ? $id : ''); ?>"
               <?php if(isset($multilang) and $multilang == true): ?>
                   name="<?php echo e($name); ?>[<?php echo e($lang); ?>]"
               value="<?php echo e((isset($entry) and !empty($entry)) ? $entry : ''); ?>"
               <?php else: ?>
                   name="<?php echo e($name); ?>"
               value="<?php echo e(($type !="password") ? $entry : ''); ?>"
                <?php endif; ?>
        >

    </div>
    <?php if($type == "file" and $entry != ""): ?>
    <div class="col-md-2">
            <?php if($filetype == "image"): ?>
                    <a class="btn btn-sm btn-info" href="<?php echo e(asset($path.$entry)); ?>" target="_blank"> <i class="ri-eye-line"></i>
                    </a>
            <?php else: ?>
                    <a class="btn btn-sm btn-info" href="<?php echo e(asset($path.$entry)); ?>" target="_blank"><i class="ri-eye-line"></i></a>
            <?php endif; ?>
    </div>
    <?php endif; ?>

</div>
    <?php if($errors->has($name)): ?>
        <span class="help-block">
        <strong>
            <?php echo e($errors->first($name)); ?>

        </strong>
    </span>
    <?php endif; ?>
</div>
<?php endif; ?>
<?php /**PATH C:\Users\astok\Desktop\private_real_estate\resources\views/components/forms/input.blade.php ENDPATH**/ ?>