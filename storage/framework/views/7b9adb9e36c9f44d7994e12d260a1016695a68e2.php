<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
    <meta charset="utf-8">
    <title>PRIVATE - Real Estate</title>
    <meta name="keywords" content="HTML, CSS, JavaScript, Bootstrap">
    <meta name="description" content="Real Estate HTML Template">
    <meta name="author" content="themesflat.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="../interface/fonts/fonts.css">
    <link rel="stylesheet" href="../interface/fonts/font-icons.css">
    <link rel="stylesheet" href="../interface/css/bootstrap.min.css">
    <link rel="stylesheet" href="../interface/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="../interface/css/animate.css">
    <link rel="stylesheet" type="text/css" href="../interface/css/styles.css"/>
    <link rel="shortcut icon" href="../interface/images/logo/favicon.png">
    <link rel="apple-touch-icon-precomposed" href="../interface/images/logo/favicon.png">
</head>
<body class="body">
    <div class="preload preload-container">
        <div class="preload-logo">
            <div class="spinner"></div>
            <span class="icon icon-villa-fill"></span>
        </div>
    </div>
    <div id="wrapper">
        <div id="pagee" class="clearfix">
            <header id="header" class="main-header header-fixed fixed-header">
                <div class="header-lower">
                    <div class="row">                      
                        <div class="col-lg-12">         
                            <div class="inner-header">
                                <div class="inner-header-left">
                                    <div class="logo-box flex">
                                        <div class="logo"><a href="index.html"><img src="../interface/images/logo/logo@2x.png" alt="logo" width="166" height="48"></a></div>
                                    </div>
                                    <div class="nav-outer flex align-center">
                                            <nav class="main-menu show navbar-expand-md">
                                                <div class="navbar-collapse collapse clearfix" id="navbarSupportedContent">
                                                    <ul class="navigation clearfix">
                                                        <li><a href="<?php echo e(route('interface.index')); ?>">Anasayfa</a></li>
                                                        <li><a href="<?php echo e(route('interface.ilanlar')); ?>?status=sell">Satılık</a></li>
                                                        <li><a href="<?php echo e(route('interface.ilanlar')); ?>?status=rental">Kiralık</a></li>
                                                        <li><a href="<?php echo e(route('interface.projeler')); ?>">Projeler</a></li>
                                                        <li><a href="<?php echo e(route('interface.about')); ?>">Hakkımızda</a></li>
                                                        <li><a href="<?php echo e(route('interface.blogs')); ?>">Bloglar</a></li>
                                                        <li><a href="<?php echo e(route('interface.contact')); ?>">İletişim</a></li>
                                                    </ul>
                                                </div>
                                            </nav>
                                    </div>
                                </div>
                                <div class="mobile-nav-toggler mobile-button"><span></span></div>
                            </div>
                        </div>
                    </div>
                </div>
            
                <div class="close-btn"><span class="icon flaticon-cancel-1"></span></div>    
                <div class="mobile-menu">
                    <div class="menu-backdrop"></div>                            
                    <nav class="menu-box">
                        <div class="nav-logo"><a href="index.html"><img src="images/logo/logo@2x.png" alt="nav-logo" width="174" height="44"></a></div>
                        <div class="bottom-canvas">
                            <div class="login-box flex align-center">
                                <a href="#modalLogin" data-bs-toggle="modal">Login</a>
                                <span>/</span>
                                <a href="#modalRegister" data-bs-toggle="modal">Register</a>
                            </div>
                            <div class="menu-outer"></div>
                            <div class="button-mobi-sell">
                                <a class="tf-btn primary" href="add-property.html">Submit Property</a>
                            </div> 
                            <div class="mobi-icon-box">
                                <div class="box d-flex align-items-center">
                                    <span class="icon icon-phone2"></span>
                                    <div>1-333-345-6868</div>
                                </div>
                                <div class="box d-flex align-items-center">
                                    <span class="icon icon-mail"></span>
                                    <div>themesflat@gmail.com</div>
                                </div>
                            </div>
                        </div>
                    </nav>                
                </div>
            </header><?php /**PATH C:\Users\astok\Desktop\private_real_estate\resources\views/interface/header.blade.php ENDPATH**/ ?>