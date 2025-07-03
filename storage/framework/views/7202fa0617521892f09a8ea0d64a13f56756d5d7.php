<?php $__env->startPush('css'); ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('breadcrump', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Page Header Close -->

<!-- Start::row-1 -->
<div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                    <div class="card-header justify-content-between">
                        <div class="card-title">
                            <?php echo $__env->yieldContent('title', $page['title'] ?? ''); ?>
                        </div>
                        <div class="prism-toggle">
                            <?php echo $__env->yieldContent('button'); ?>
                        </div>
                    </div>
                    <div class="card-body">

                        <?php echo $__env->make('partials.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



                    </div>
            </div>
    </div>
</div>
<!--End::row-1 -->
<?php $__env->startPush('javascript'); ?>
    <?php echo $__env->yieldContent('add_javascript'); ?>
    <!-- Select2 Cdn -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $( document ).ready(function() {
        $("select").select2({
            placeholder: "<?= ___('Choose') ?>"
        });
        });

        
    </script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\astok\Desktop\private_real_estate\resources\views/form.blade.php ENDPATH**/ ?>