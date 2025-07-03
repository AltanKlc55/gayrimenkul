@extends('interfacemaster')
@section('content')

          <section class="flat-section">
                <div class="container flat-header-wrapper-about">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 text-center">
                            <h1 class="title">Hoş Geldiniz</h1>
                            <p class="text-variant-1 desc"> 
                               {!! $data['ilk_data'][0]->description !!}
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
        @foreach ($data["hakkimizda"] as $hk)
        <div class="flat-img-with-text">
            <div class="content-left img-animation wow">
                <img class="lazyload" data-src="uploads/page/{{ $hk->image }}" src="uploads/page/{{ $hk->image }}" alt="">
            </div>
            <div class="content-right">
                <div class="box-title wow fadeInUp">
                    <div class="text-subtitle text-primary">Biz Kimiz</div>
                    <h3 class="title mt-4">Hakkımızda</h3>
                </div>
                <div class="flat-service wow fadeInUp" data-wow-delay=".2s">
                 {!! $hk->description !!}
                </div>
            </div>
         </div>
        @endforeach
    </section>

@endsection