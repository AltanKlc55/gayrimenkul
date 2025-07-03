<header class="app-header">

    <!-- Start::main-header-container -->
    <div class="main-header-container container-fluid">

        <!-- Start::header-content-left -->
        <div class="header-content-left">

            <!-- Start::header-element -->
            <div class="header-element">
                <div class="horizontal-logo">
                    <a href="/" class="header-logo">
                        <h3><strong>
                            <?php echo e(get_config('company_name')); ?>

                            </strong></h3>
                    </a>
                </div>
            </div>
            <!-- End::header-element -->

            <!-- Start::header-element -->
            <div class="header-element">
                <!-- Start::header-link -->
                <a aria-label="Hide Sidebar" class="sidemenu-toggle header-link animated-arrow hor-toggle horizontal-navtoggle" data-bs-toggle="sidebar" href="javascript:void(0);"><span></span></a>
                <!-- End::header-link -->
            </div>
            <!-- End::header-element -->

        </div>
        <!-- End::header-content-left -->

        <!-- Start::header-content-right -->
        <div class="header-content-right">

          
            <!-- Start::header-element -->
            <div class="header-element">
                <!-- Start::header-link|dropdown-toggle -->
                <a href="javascript:void(0);" class="header-link dropdown-toggle" id="mainHeaderProfile" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <?php if(auth('manager')->user()->image): ?>
                            <div class="me-sm-2 me-0">
                              <!--  <img src="<?php echo e(asset('uploads/manager/'.auth('manager')->user()->image)); ?>" alt="img" width="32" height="32" class="rounded-circle">  -->
                            </div>
                        <?php endif; ?>

                        <div class="d-sm-block d-none">
                            <p class="fw-semibold mb-0 lh-1"><?php echo e(auth('manager')->user()->username); ?></p>
                        </div>
                    </div>
                </a>
                <!-- End::header-link|dropdown-toggle -->
                <ul class="main-header-dropdown dropdown-menu pt-0 overflow-hidden header-profile-dropdown dropdown-menu-end" aria-labelledby="mainHeaderProfile">
                    <!-- <li><a class="dropdown-item d-flex" href="profile.html"><i class="ti ti-user-circle fs-18 me-2 op-7"></i>Profile</a></li>
                     <li><a class="dropdown-item d-flex" href="mail.html"><i class="ti ti-inbox fs-18 me-2 op-7"></i>Inbox <span class="badge bg-success-transparent ms-auto">25</span></a></li>
                     <li><a class="dropdown-item d-flex border-block-end" href="to-do-list.html"><i class="ti ti-clipboard-check fs-18 me-2 op-7"></i>Task Manager</a></li>
                     <li><a class="dropdown-item d-flex" href="mail-settings.html"><i class="ti ti-adjustments-horizontal fs-18 me-2 op-7"></i>Settings</a></li>
                     <li><a class="dropdown-item d-flex border-block-end" href="javascript:void(0);"><i class="ti ti-wallet fs-18 me-2 op-7"></i>Bal: $7,12,950</a></li>
                     <li><a class="dropdown-item d-flex" href="chat.html"><i class="ti ti-headset fs-18 me-2 op-7"></i>Support</a></li> -->
                    <li><a class="dropdown-item d-flex" href="<?php echo e(route('logout')); ?>"><i class="ti ti-logout fs-18 me-2 op-7"></i><?php echo e(___('Log Out')); ?></a></li>
                </ul>
            </div>
            <!-- End::header-element -->





        </div>
        <!-- End::header-content-right -->

    </div>
    <!-- End::main-header-container -->

</header><?php /**PATH C:\Users\astok\Desktop\private_real_estate\resources\views/headbar.blade.php ENDPATH**/ ?>