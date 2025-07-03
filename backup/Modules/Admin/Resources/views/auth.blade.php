<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cloud MicroApp</title>
    <meta name="Author" content="Cloud MicroApp">
    <meta name="description" content="Cloud MicroApp Yazılım, Hatay bölgesinde faaliyet gösteren profesyonel bir iş  yazılım firmasıdır. Müşterilerimize özel web tasarımı, yazılım geliştirme,  e-ticaret ve dijital pazarlama hizmetleri sunuyoruz." />
    <meta property="og:description" content="Cloud MicroApp Yazılım, Hatay bölgesinde faaliyet gösteren profesyonel bir iş  yazılım firmasıdır. Müşterilerimize özel web tasarımı, yazılım geliştirme,  e-ticaret ve dijital pazarlama hizmetleri sunuyoruz." />

    <!-- Favicon -->
    <link rel="icon" href="../assets/images/brand-logos/favicon.ico" type="image/x-icon">

    <!-- Main Theme Js -->
    <script src="../assets/js/authentication-main.js"></script>

    <!-- Bootstrap Css -->
    <link id="style" href="../assets/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet" >

    <!-- Style Css -->
    <link href="../assets/css/styles.min.css" rel="stylesheet" >
    <link href="../assets/css/default.css?v=<?= time() ?>" rel="stylesheet" >

    <!-- Icons Css -->
    <link href="../assets/css/icons.min.css" rel="stylesheet" >
    <link rel="stylesheet" href="../assets/libs/swiper/swiper-bundle.min.css">


</head>

<body>
<div class="row authentication mx-0">

    <div class="col-xxl-7 col-xl-7 col-lg-12">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-xxl-6 col-xl-7 col-lg-7 col-md-7 col-sm-8 col-12">
                <div class="p-5">
                    <div class="mb-3">
                        <a href="index.html">
                            <img src="../global/img/logo.png" alt="" style="max-width: 200px">
                        </a>
                    </div>
                    <p class="h5 fw-semibold mb-2 text-center">Giriş Yap</p>
                    <form action="{{route('manager.auth')}}" method="post">
                        @csrf
                        @include('partials.error')

                        <div class="row gy-3">
                            <div class="col-xl-12">
                                <label for="signin-username" class="form-label text-default">E-Mail</label>
                                <input type="text" class="form-control form-control-lg" name="email" id="signin-username" placeholder="use@use.com">
                            </div>
                            <div class="col-xl-12 mb-2">
                                <label for="signin-password" class="form-label text-default d-block">Şifre</label>
                                <input type="password" class="form-control form-control-lg" name="password" placeholder="****">

                            </div>
                            <div class="mt-2">
                                <div class="form-check">
                                    <input class="form-check-input" name="remember_me" type="checkbox" value="1" id="defaultCheck1">
                                    <label class="form-check-label text-muted fw-normal" for="defaultCheck1">
                                        Oturumu Açık Tut ?
                                    </label>
                                </div>
                            </div>
                            <div class="col-xl-12 d-grid mt-2">
                                <button type="submit" class="btn btn-lg btn-dark">Giriş Yap</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-5 col-xl-5 col-lg-5 d-xl-block d-none px-0">
        <div class="authentication-cover">

        </div>
    </div>

</div>



<!-- Bootstrap JS -->
<script src="../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../assets/libs/swiper/swiper-bundle.min.js"></script>

<!-- Show Password JS -->
<script src="../assets/js/show-password.js"></script>

</body>

</html>