<aside class="app-sidebar sticky" id="sidebar">

    <!-- Start::main-sidebar-header -->
    <div class="main-sidebar-header">
        <a href="index.html" class="header-logo">
            <h5 class="text-white">Yönetim Paneli</h5>

        </a>
    </div>
    <!-- End::main-sidebar-header -->

    <!-- Start::main-sidebar -->
    <div class="main-sidebar" id="sidebar-scroll">

        <!-- Start::nav -->
        <nav class="main-menu-container nav nav-pills flex-column sub-open">
            <div class="slide-left" id="slide-left">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"> <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path> </svg>
            </div>
            <ul class="main-menu">
                <?php $__currentLoopData = config('menu_configs'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $get_menu_list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $__currentLoopData = $get_menu_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $get_menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(isset($get_menu['list']) and !empty($get_menu['list'])): ?>
                        <li class="slide has-sub">
                            <a href="javascript:void(0);" class="side-menu__item">
                                <i class="<?php echo e($get_menu['icon']); ?> side-menu__icon"></i>
                                <span class="side-menu__label"><?php echo e($get_menu['title']); ?></span>
                                <i class="fe fe-chevron-right side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child1">
                                <li class="slide side-menu__label1">
                                    <a href="javascript:void(0)"><?php echo e($get_menu['title']); ?></a>
                                </li>
                                <?php $__currentLoopData = $get_menu['list']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu_child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <?php if(isset($menu_child['subchild']) and !empty($menu_child['subchild'])): ?>

                                        <li class="slide has-sub">
                                            <a href="javascript:void(0);" class="side-menu__item"><?php echo e($menu_child['title']); ?>

                                                <i class="fe fe-chevron-right side-menu__angle"></i></a>
                                            <ul class="slide-menu child2">
                                                <?php $__currentLoopData = $menu_child['subchild']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_menu_child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                <li class="slide">
                                                    <a href="<?php echo e(route($sub_menu_child['url'])); ?>" class="side-menu__item"><?php echo e($sub_menu_child['title']); ?></a>
                                                </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            </ul>
                                        </li>

                                    <?php else: ?>

                                        <li class="slide">
                                            <a href="<?php echo e(route($menu_child['url'])); ?>" class="side-menu__item"><?php echo e($menu_child['title']); ?></a>


                                        </li>

                                    <?php endif; ?>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="slide">
                            <a href="<?php echo e(route($get_menu['url'])); ?>" class="side-menu__item">
                                <i class="<?php echo e($get_menu['icon']); ?> side-menu__icon"></i>
                                <span class="side-menu__label"><?php echo e($get_menu['title']); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"> <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path> </svg></div>
        </nav>
        <!-- End::nav -->

    </div>
    <!-- End::main-sidebar -->

</aside><?php /**PATH C:\Users\astok\Desktop\private_real_estate\resources\views/sidebar.blade.php ENDPATH**/ ?>