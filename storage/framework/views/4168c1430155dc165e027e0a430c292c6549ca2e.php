
<?php $__env->startSection('content'); ?>

          <section class="flat-section">
                <div class="container flat-header-wrapper-about">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 text-center">
                            <h1 class="title">Hoş Geldiniz</h1>
                            <p class="text-variant-1 desc"> 
                               <?php echo $data['ilk_data'][0]->description; ?>

                            </p>
                            <div class="signature-box">
                                <div class="top">
                                    <h6>Private Real Estate</h6>
                                </div>
                                <img src="images/banner/signature.png" alt="">
                            </div>
                            <a href="contact.html" class="tf-btn btn-view primary hover-btn-view">
                                İletişim
                                <span class="icon icon-arrow-right2"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </section>          
            <section class="mx-5 bg-primary-new radius-30">
        <?php $__currentLoopData = $data["hakkimizda"]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="flat-img-with-text">
            <div class="content-left img-animation wow">
                <img class="lazyload" data-src="uploads/page/<?php echo e($hk->image); ?>" src="uploads/page/<?php echo e($hk->image); ?>" alt="">
            </div>
            <div class="content-right">
                <div class="box-title wow fadeInUp">
                    <div class="text-subtitle text-primary">Biz Kimiz</div>
                    <h3 class="title mt-4">Hakkımızda</h3>
                </div>
                <div class="flat-service wow fadeInUp" data-wow-delay=".2s">
                 <?php echo $hk->description; ?>

                </div>
            </div>
         </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('interfacemaster', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\astok\Desktop\private_real_estate\resources\views/interface_pages/about.blade.php ENDPATH**/ ?>