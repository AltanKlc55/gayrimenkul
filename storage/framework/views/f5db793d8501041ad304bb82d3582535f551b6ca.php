    
    <?php echo $__env->make('partials.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php $__env->startSection('content'); ?>
    <?php echo $__env->make('breadcrump', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        <?php echo $__env->yieldContent('title', $page['title'] ?? ''); ?>
                    </div>
                    <div class="prism-toggle">
                        <?php $__currentLoopData = $page['button']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $button): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if (isset($component)) { $__componentOriginal49b2fc8ba42c39d638e648b21b88e1b33ae2822c = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Forms\Button::class, ['type' => ''.e($button['type']).'','title' => ''.e($button['title']).'','class' => ''.e($button['class']).'','icon' => ''.e($button['icon']).'','color' => ''.e($button['color']).'','id' => ''.e($button['id']).'','onclick' => ''.e(isset($button['onclick']) ? $button['onclick'] : false).'','href' => ''.e(isset($button['href']) ? $button['href'] : false).'']); ?>
<?php $component->withName('forms.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal49b2fc8ba42c39d638e648b21b88e1b33ae2822c)): ?>
<?php $component = $__componentOriginal49b2fc8ba42c39d638e648b21b88e1b33ae2822c; ?>
<?php unset($__componentOriginal49b2fc8ba42c39d638e648b21b88e1b33ae2822c); ?>
<?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <div class="card-body">
                    <?php echo $__env->yieldContent('table'); ?>
                </div>
            </div>
        </div>
    </div>
    <!--End::row-1 -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\astok\Desktop\private_real_estate\Modules/Ilanlar\Resources/views/lists.blade.php ENDPATH**/ ?>