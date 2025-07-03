<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>

    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Manage</title>
    <meta name="Author" content="Private Gayrimenkul">

    <!-- Favicon -->
    <link rel="icon" href="../assets/images/brand-logos/favicon.ico" type="image/x-icon">

    <!-- Main Theme Js -->
    <script src="../assets/js/authentication-main.js"></script>

    <!-- Bootstrap Css -->
    <link id="style" href="../assets/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet" >

    <!-- Style Css -->
    <link href="../assets/css/styles.min.css" rel="stylesheet" >

    <!-- Icons Css -->
    <link href="../assets/css/icons.min.css" rel="stylesheet" >


</head>

<body>

<div class="container">
    <div class="row justify-content-center align-items-center authentication authentication-basic h-100">
        <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-6 col-sm-8 col-12">

            <div class="card custom-card">
                <div class="card-body p-5">
                <div style="text-align:center;">
                    <img src="/logo.png" style="margin-bottom:20px; height:50px; width:auto;" alt="LOGO">
                    </div>
                    <p class="h6 fw-semibold mb-2 text-center">Giriş Yap</p>
                    <form action="<?php echo e(route('auth')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <?php echo $__env->make('partials.error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        <div class="row gy-3">
                            <div class="col-xl-12">
                                <label for="signin-username" class="form-label text-default">E-Mail</label>
                                <input type="text" class="form-control form-control-lg" name="email" id="signin-username" placeholder="use@use.com">
                            </div>
                            <div class="col-xl-12 mb-2">
                                <label for="signin-password" class="form-label text-default d-block">Şifre</label>
                                <input type="password" class="form-control form-control-lg" name="password" placeholder="****">

                            </div>
                            <div class="col-xl-12 d-grid mt-2">
                                <button type="submit" class="btn btn-lg btn-primary">Giriş Yap</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>


<!-- Bootstrap JS -->
<script src="../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Show Password JS -->
<script src="../assets/js/show-password.js"></script>

</body>

</html><?php /**PATH C:\Users\astok\Desktop\private_real_estate\Modules/Admin\Resources/views/auth.blade.php ENDPATH**/ ?>