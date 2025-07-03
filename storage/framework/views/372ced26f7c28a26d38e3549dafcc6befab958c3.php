<?php $__env->startSection('title'); ?> <?php echo e($page['title']); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('button'); ?>
    <button class="btn btn-sm btn-primary-light" form="form">Kaydet<i class="ri-save-line ms-2 d-inline-block align-middle"></i></button>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>

    

<?php $__env->stopSection(); ?>
<?php echo $__env->make('form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\astok\Desktop\private_real_estate\Modules/Config\Resources/views/config.blade.php ENDPATH**/ ?>