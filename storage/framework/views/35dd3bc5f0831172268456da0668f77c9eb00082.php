<?php $__env->startPush('css'); ?>
    <link href="<?php echo e(asset('../assets/libs/toastr/css/toastr.min.css')); ?>" rel="stylesheet" type="text/css"/>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('javascript'); ?>

    <script src='<?php echo e(asset("../assets/libs/toastr/js/toastr.min.js")); ?>'  type="text/javascript"></script>

    <script>
        $( document ).ready(function() {
            <?php if(session()->has('message')): ?>
            toastr.<?php echo e(session('message_type')); ?>("<?php echo e(session('message')); ?>");
            <?php endif; ?>
        });
    </script>
<?php $__env->stopPush(); ?><?php /**PATH C:\Users\astok\Desktop\private_real_estate\resources\views/partials/alert.blade.php ENDPATH**/ ?>