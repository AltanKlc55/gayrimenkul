<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('breadcrump', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="row row-cols-12">
        <div class="col">
            <div class="card custom-card">
                <div class="card-body">
                    <div class="d-flex align-items-top">
                        <div class="me-3">
                        <span class="avatar avatar-md p-2 bg-primary">
                            <svg class="svg-white" xmlns="http://www.w3.org/2000/svg"
                                 height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
                                <path d="M0 0h24v24H0V0z" fill="none" />
                                <path
                                        d="M12 5.9c1.16 0 2.1.94 2.1 2.1s-.94 2.1-2.1 2.1S9.9 9.16 9.9 8s.94-2.1 2.1-2.1m0 9c2.97 0 6.1 1.46 6.1 2.1v1.1H5.9V17c0-.64 3.13-2.1 6.1-2.1M12 4C9.79 4 8 5.79 8 8s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4zm0 9c-2.67 0-8 1.34-8 4v3h16v-3c0-2.66-5.33-4-8-4z" />
                            </svg>
                        </span>
                        </div>
                        <div class="flex-fill">
                            <div class="d-flex mb-1 align-items-top justify-content-between">
                                <h5 class="fw-semibold mb-0 lh-1"><?php echo e($current_count->count); ?></h5>
                            </div>
                            <p class="mb-0 fs-10 op-7 text-muted fw-semibold">Toplam Müşteri</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card custom-card">
                <div class="card-body">
                    <div class="d-flex align-items-top">
                        <div class="me-3">
                        <span class="avatar avatar-md p-2 bg-primary">
                            <svg class="svg-white" xmlns="http://www.w3.org/2000/svg"
                                 height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
                                <path d="M0 0h24v24H0V0z" fill="none" />
                                <path
                                        d="M12 5.9c1.16 0 2.1.94 2.1 2.1s-.94 2.1-2.1 2.1S9.9 9.16 9.9 8s.94-2.1 2.1-2.1m0 9c2.97 0 6.1 1.46 6.1 2.1v1.1H5.9V17c0-.64 3.13-2.1 6.1-2.1M12 4C9.79 4 8 5.79 8 8s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4zm0 9c-2.67 0-8 1.34-8 4v3h16v-3c0-2.66-5.33-4-8-4z" />
                            </svg>
                        </span>
                        </div>
                        <div class="flex-fill">
                            <div class="d-flex mb-1 align-items-top justify-content-between">
                                <h5 class="fw-semibold mb-0 lh-1"><?php echo e($current_count->count); ?></h5>
                            </div>
                            <p class="mb-0 fs-10 op-7 text-muted fw-semibold">Toplam Psikolog</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card custom-card">
                <div class="card-body">
                    <div class="d-flex align-items-top">
                        <div class="me-3">
                        <span class="avatar avatar-md p-2 bg-secondary">
                            <svg class="svg-white" xmlns="http://www.w3.org/2000/svg"
                                 enable-background="new 0 0 24 24" height="24px"
                                 viewBox="0 0 24 24" width="24px" fill="#000000">
                                <rect fill="none" height="24" width="24" />
                                <g>
                                    <path
                                            d="M4,13c1.1,0,2-0.9,2-2c0-1.1-0.9-2-2-2s-2,0.9-2,2C2,12.1,2.9,13,4,13z M5.13,14.1C4.76,14.04,4.39,14,4,14 c-0.99,0-1.93,0.21-2.78,0.58C0.48,14.9,0,15.62,0,16.43V18l4.5,0v-1.61C4.5,15.56,4.73,14.78,5.13,14.1z M20,13c1.1,0,2-0.9,2-2 c0-1.1-0.9-2-2-2s-2,0.9-2,2C18,12.1,18.9,13,20,13z M24,16.43c0-0.81-0.48-1.53-1.22-1.85C21.93,14.21,20.99,14,20,14 c-0.39,0-0.76,0.04-1.13,0.1c0.4,0.68,0.63,1.46,0.63,2.29V18l4.5,0V16.43z M16.24,13.65c-1.17-0.52-2.61-0.9-4.24-0.9 c-1.63,0-3.07,0.39-4.24,0.9C6.68,14.13,6,15.21,6,16.39V18h12v-1.61C18,15.21,17.32,14.13,16.24,13.65z M8.07,16 c0.09-0.23,0.13-0.39,0.91-0.69c0.97-0.38,1.99-0.56,3.02-0.56s2.05,0.18,3.02,0.56c0.77,0.3,0.81,0.46,0.91,0.69H8.07z M12,8 c0.55,0,1,0.45,1,1s-0.45,1-1,1s-1-0.45-1-1S11.45,8,12,8 M12,6c-1.66,0-3,1.34-3,3c0,1.66,1.34,3,3,3s3-1.34,3-3 C15,7.34,13.66,6,12,6L12,6z" />
                                </g>
                            </svg>
                        </span>
                        </div>
                        <div class="flex-fill">
                            <div class="d-flex mb-1 align-items-top justify-content-between">
                                <h5 class="fw-semibold mb-0 lh-1"><?php echo e($product_count->count); ?></h5>
                            </div>
                            <p class="mb-0 fs-10 op-7 text-muted fw-semibold">Toplam Test</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card custom-card">
                <div class="card-body">
                    <div class="d-flex align-items-top">
                        <div class="me-3">
                            <span class="avatar avatar-md p-2 bg-warning">
                                <svg class="svg-white" xmlns="http://www.w3.org/2000/svg"
                                     height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path
                                            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zM4 12c0-.61.08-1.21.21-1.78L8.99 15v1c0 1.1.9 2 2 2v1.93C7.06 19.43 4 16.07 4 12zm13.89 5.4c-.26-.81-1-1.4-1.9-1.4h-1v-3c0-.55-.45-1-1-1h-6v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41C17.92 5.77 20 8.65 20 12c0 2.08-.81 3.98-2.11 5.4z" />
                                </svg>
                            </span>
                        </div>
                        <div class="flex-fill">
                            <div class="d-flex mb-1 align-items-top justify-content-between">
                                <h5 class="fw-semibold mb-0 lh-1"><?php echo e($offer_count->count); ?></h5>
                            </div>
                            <p class="mb-0 fs-10 op-7 text-muted fw-semibold">Toplam Görüşme</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-12">
            <div class="card custom-card overflow-hidden">
                <div class="card-header justify-content-between">
                    <div class="card-title">Hızlı Linkler</div>
                </div>
                <div class="card-body text-center">
                    
                        <a href="<?php echo e(route('testcreate.create')); ?>"  style="width: 180px;"  class="btn btn-dark my-1 me-2">
                            <span class="bx bx-bar-chart-alt"></span> Yeni Soru Oluşturun
                        </a>

                        <a href="<?php echo e(route('test.create')); ?>"  style="width: 180px;" class="btn btn-dark my-1 me-2">
                            <span class="bx bx-bar-chart-alt"></span> Yeni Test Oluşturun
                        </a>
                </div>
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <!-- Apex Charts JS -->
    <script src="../assets/libs/apexcharts/apexcharts.min.js"></script>

    <script src="../assets/js/sales-dashboard.js"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\astok\Desktop\private_real_estate\Modules/Dashboard\Resources/views/index.blade.php ENDPATH**/ ?>