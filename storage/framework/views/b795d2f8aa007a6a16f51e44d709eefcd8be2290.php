<div class="form-group mb-3  <?php echo e(!empty($grid) ? $grid : ''); ?> <?php echo e($errors->has($name) ? 'has-error' : ''); ?>">

    <label><?php echo e($title); ?></label>
    <?php if(!empty($description)): ?>
        <p><?php echo e($description); ?></p>
    <?php endif; ?>
    <?php $optname =  (isset($child) and !empty($child)) ? $child : 'name' ?>

    <select  class="form-control  <?php echo e(!empty($class) ? $class : ''); ?>"  <?php echo e(!empty($multiple) ? 'multiple' : ''); ?> <?php echo e(!empty($tags) ? 'tags=true' : ''); ?>  id="<?php echo e(!empty($id) ? $id : ''); ?>" <?php echo !empty($attribute) ? $attribute : ''; ?>

    name="<?php echo e(!empty($multiple) ? $name."[]" : $name); ?>">


        <option></option>
        <?php if(is_array($options) and !empty($options)): ?>
            <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


                <?php if(isset($format) && $format == "select_json"): ?>

                    <?php if(in_array($option['id'],$selected)): ?>
                        <?php

                            $is_select = "selected";
                        ?>
                    <?php else: ?>
                        <?php
                            $is_select = "";
                        ?>
                    <?php endif; ?>

                <?php else: ?>
                    <?php
                        $is_select = ($selected == $option['id']) ? 'selected' : '';
                    ?>

                <?php endif; ?>

                <option value="<?php echo e($option['id']); ?>" <?php echo e($is_select); ?>>
                    <?php if(is_array(json_decode($option[$optname],true))): ?>
                        <?php echo e(getlanguage($option[$optname],get_language())); ?>

                    <?php else: ?>
                        <?php echo e($option[$optname]); ?>

                    <?php endif; ?>
                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>

    </select>
    <?php if($errors->has($name)): ?>
        <span class="help-block">
        <strong>
            <?php echo e($errors->first($name)); ?>

        </strong>
    </span>
    <?php endif; ?>
</div><?php /**PATH C:\Users\astok\Desktop\private_real_estate\resources\views/components/forms/select.blade.php ENDPATH**/ ?>