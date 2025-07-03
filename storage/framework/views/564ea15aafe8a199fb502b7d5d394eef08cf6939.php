<?php $__env->startPush('css'); ?>
    <link href="<?php echo e(asset('../assets/libs/datatables/css/jquery.dataTables.min.css')); ?>" rel="stylesheet" type="text/css"/>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('javascript'); ?>
    <script src='<?php echo e(asset("../assets/libs/datatables/js/jquery.dataTables.min.js")); ?>'  type="text/javascript"></script>



    <script>
        $(document).ready(function() {
            $('#globaltable').DataTable( {
                "ajax": {
                    'url': '<?php echo e($page['table']); ?>',
                    <?php if(isset($page['table_query']) and !empty($page['table_query'])): ?>
                    "data": <?php echo json_encode($page['table_query'], 15, 512) ?>,
                    <?php endif; ?>
                },
                // "processing": true,
                //  "serverSide": true,

                'bProcessing': true,
                'bJQueryUI': true,
                'order': [[ 1, "asc" ]],
                "scrollX": true,
                'language': {
                    'url': '<?php echo e(asset("../assets/libs/datatables/tr.json")); ?>'
                },
                "initComplete": function(  ) {
                    $('[data-toggle="tooltip"]').tooltip()
                }
            } );
        } );

        function tableupdate(){
            $('.globaltable').DataTable().ajax.reload();
        }

    </script>



<?php $__env->stopPush(); ?>


<?php $__env->startSection('table'); ?>
<div class="table-responsive">
    <table id="globaltable" class="table globaltable table-striped  table-bordered text-nowrap w-100 dataTable no-footer" aria-describedby="datatable-basic_info">
        <thead>
        <tr>
            <?php $__currentLoopData = $page['tablerow']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $thead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <th><?php echo e($thead['title']); ?></th>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?><?php /**PATH C:\Users\astok\Desktop\private_real_estate\resources\views/partials/table.blade.php ENDPATH**/ ?>