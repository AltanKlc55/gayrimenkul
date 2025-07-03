
<?php $__env->startSection('content'); ?>

<section class="flat-title-page" style="background-image: url(uploads/page/<?php echo e($data["sayfa"][0]->banner); ?>);">
                <div class="container">
                    <div class="breadcrumb-content">
                        <ul class="breadcrumb">
                            <li><a href="/" class="text-white">Anasayfa</a></li>
                            <li class="text-white">/ <?php echo e($data["sayfa"][0]->name); ?></li>
                        </ul>
                        <h1 class="text-center text-white title"><?php echo e($data["sayfa"][0]->name); ?></h1>
                    </div>
                </div>
            </section>

            <section class="flat-section">
                <div class="container">
                    <div class="row">
                    <?php $__currentLoopData = $data['projeler']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                    
                        <div class="col-lg-4 col-md-6">
                            <a href="projects/<?php echo e($prj->slug); ?>" class="flat-blog-item hover-img">
                                <div class="img-style">
                                    <img class="lazyload" data-src="uploads/page/<?php echo e($prj->image); ?>" src="uploads/page/<?php echo e($prj->image); ?>" alt="img-blog">
                                    <span class="date-post"><?php echo e($prj->created_at->format('d-m-Y')); ?></span>
                                </div>
                                <div class="content-box">
                                    <div class="post-author">
                                        <span class="fw-6">Private Real Estate</span>
                                    </div>
                                    <h5 class="title link"><?php echo e($prj->name); ?></h5>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('interfacemaster', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\astok\Desktop\private_real_estate\resources\views/interface_pages/projects.blade.php ENDPATH**/ ?>