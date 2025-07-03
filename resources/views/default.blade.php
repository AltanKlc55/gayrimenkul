@extends('interfacemaster')
@section('content')
    <section class="flat-slider home-1">
        <div class="video-container">
            <video autoplay muted loop class="background-video">
                <source src="https://samplelib.com/lib/preview/mp4/sample-5s.mp4" type="video/mp4">
                Tarayıcınız video etiketini desteklemiyor.
            </video>
        </div>
        <div class="container relative">
            <div class="row">
                <div class="col-lg-12">
                    <div class="slider-content">
                        <div class="heading text-center">
                            <h1 class="title-large text-white animationtext slide">
                                Hemen Bulun
                                <span class="tf-text s1 cd-words-wrapper">
                                    <span style="color: #878787 !important;" class="item-text is-visible">Arsa</span>
                                    <span style="color: #878787 !important;" class="item-text is-hidden">Ev</span>
                                    <span style="color: #878787 !important;" class="item-text is-hidden">İş Yeri</span>
                                </span>
                            </h1>
                            <p class="subtitle text-white body-2 wow fadeInUp" data-wow-delay=".2s"></p>
                        </div>
                        <div class="flat-tab flat-tab-form">
                            <ul class="nav-tab-form style-1 justify-content-center" role="tablist">
                                <li class="nav-tab-item" role="presentation">
                                    <a href="#forRent" class="nav-link-item active" data-bs-toggle="tab">Kiralık</a>
                                </li>
                                <li class="nav-tab-item" role="presentation">
                                    <a href="#forSale" class="nav-link-item" data-bs-toggle="tab">Satılık</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                        <div class="tab-pane fade active show" role="tabpanel">
                                            <div class="form-sl">
                                                <form method="post">
                                                    <div class="wd-find-select">
                                                        <div class="inner-group">
                                                            <div class="form-group-1 search-form form-style">
                                                                <div class="group-select">
                                                                    <label for="">İl</label>
                                                                    <div class="nice-select" tabindex="0"><span class="current">İl</span>
                                                                        <ul class="list">  
                                                                            <li data-value class="option selected">All</li>                                                        
                                                                            <li data-value="villa" class="option">Villa</li>
                                                                            <li data-value="studio" class="option">Studio</li>
                                                                            <li data-value="office" class="option">Office</li>
                                                                            <li data-value="house" class="option">House</li>
                                                                        </ul>
                                                                    </div>
                                                                </div> 
                                                            </div>

                                                            <div class="form-group-1 search-form form-style">
                                                                <div class="group-select">
                                                                <label for="">İlçe</label>

                                                                    <div class="nice-select" tabindex="0"><span class="current">İlçe</span>
                                                                        <ul class="list">  
                                                                            <li data-value class="option selected">All</li>                                                        
                                                                            <li data-value="villa" class="option">Villa</li>
                                                                            <li data-value="studio" class="option">Studio</li>
                                                                            <li data-value="office" class="option">Office</li>
                                                                            <li data-value="house" class="option">House</li>
                                                                        </ul>
                                                                    </div>
                                                                </div> 
                                                            </div>

                                                            <div class="form-group-1 search-form form-style">
                                                                <div class="group-select">
                                                                <label for="">Mahalle</label>

                                                                    <div class="nice-select" tabindex="0"><span class="current">Mahalle</span>
                                                                        <ul class="list">  
                                                                            <li data-value class="option selected">All</li>                                                        
                                                                            <li data-value="villa" class="option">Villa</li>
                                                                            <li data-value="studio" class="option">Studio</li>
                                                                            <li data-value="office" class="option">Office</li>
                                                                            <li data-value="house" class="option">House</li>
                                                                        </ul>
                                                                    </div>
                                                                </div> 
                                                            </div>
                                                      
                                                        </div>
                                                        <div class="box-btn-advanced">
                                                            <div class="form-group-4 box-filter">
                                                                <a class="tf-btn btn-line filter-advanced pull-right">
                                                                    <span class="text-1">Filtrele</span>
                                                                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M5.5 12.375V3.4375M5.5 12.375C5.86467 12.375 6.21441 12.5199 6.47227 12.7777C6.73013 13.0356 6.875 13.3853 6.875 13.75C6.875 14.1147 6.73013 14.4644 6.47227 14.7223C6.21441 14.9801 5.86467 15.125 5.5 15.125M5.5 12.375C5.13533 12.375 4.78559 12.5199 4.52773 12.7777C4.26987 13.0356 4.125 13.3853 4.125 13.75C4.125 14.1147 4.26987 14.4644 4.52773 14.7223C4.78559 14.9801 5.13533 15.125 5.5 15.125M5.5 15.125V18.5625M16.5 12.375V3.4375M16.5 12.375C16.8647 12.375 17.2144 12.5199 17.4723 12.7777C17.7301 13.0356 17.875 13.3853 17.875 13.75C17.875 14.1147 17.7301 14.4644 17.4723 14.7223C17.2144 14.9801 16.8647 15.125 16.5 15.125M16.5 12.375C16.1353 12.375 15.7856 12.5199 15.5277 12.7777C15.2699 13.0356 15.125 13.3853 15.125 13.75C15.125 14.1147 15.2699 14.4644 15.5277 14.7223C15.7856 14.9801 16.1353 15.125 16.5 15.125M16.5 15.125V18.5625M11 6.875V3.4375M11 6.875C11.3647 6.875 11.7144 7.01987 11.9723 7.27773C12.2301 7.53559 12.375 7.88533 12.375 8.25C12.375 8.61467 12.2301 8.96441 11.9723 9.22227C11.7144 9.48013 11.3647 9.625 11 9.625M11 6.875C10.6353 6.875 10.2856 7.01987 10.0277 7.27773C9.76987 7.53559 9.625 7.88533 9.625 8.25C9.625 8.61467 9.76987 8.96441 10.0277 9.22227C10.2856 9.48013 10.6353 9.625 11 9.625M11 9.625V18.5625" stroke="#161E2D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                                    </svg>                                                                          
                                                                </a>
                                                            </div>
                                                            <button type="submit" class="tf-btn btn-search primary">Ara <i class="icon icon-search"></i> </button>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="wd-search-form">
                                                        <div class="grid-2 group-box">
                                                            <div class="group-select grid-2">
                                                                <div class="box-select">
                                                                    <label class="title-select fw-6">Min Fiyat</label>
                                                                    <input type="text" class="form-control" value="" title="Search for" required="">
                                                                </div>
                                                                <div class="box-select">
                                                                    <label class="title-select fw-6">Max Fiyat</label>
                                                                    <input type="text" class="form-control" value="" title="Search for" required="">
                                                                </div>
                                                            </div>
                                                            <div class="group-select grid-2">
                                                                <div class="box-select">
                                                                    <label class="title-select fw-6">Min M2</label>
                                                                    <input type="text" class="form-control" value="" title="Search for" required="">
                                                                </div>
                                                                <div class="box-select">
                                                                    <label class="title-select fw-6">Max M2</label>
                                                                    <input type="text" class="form-control" value="" title="Search for" required="">
                                                                </div>
                                                            </div>
                                                           
                                                        </div>
                                                       
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        <div class="overlay"></div>
    </section>
    <section class="flat-section flat-recommended">
        <div class="container">
            <div class="box-title text-center wow fadeInUp">
                <div class="text-subtitle text-primary">Yeni</div>
                <h3 class="mt-4 title">Son Eklenenler</h3>
            </div>
            <div class="flat-tab-recommended flat-animate-tab wow fadeInUp" data-wow-delay=".2s">
                <div class="tab-content">
                    <div>
                        <div class="row">
                            @foreach ($data['ilanlar'] as $ilan)                            
                             <div class="col-xl-4 col-lg-6 col-md-6">
                                <div class="homelengo-box">
                                    <div class="archive-top">
                                        <a href="property-details-v1.html" class="images-group">
                                            <div class="images-style">
                                              <img class="lazyload" data-src="{{ $ilan->images[0] ?? '' }}"
                                                  src="{{ $ilan->images[0] ?? ''}}" alt="img">
                                            </div>
                                            <div class="bottom">
                                                  <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M10 7C10 7.53043 9.78929 8.03914 9.41421 8.41421C9.03914 8.78929 8.53043 9 8 9C7.46957 9 6.96086 8.78929 6.58579 8.41421C6.21071 8.03914 6 7.53043 6 7C6 6.46957 6.21071 5.96086 6.58579 5.58579C6.96086 5.21071 7.46957 5 8 5C8.53043 5 9.03914 5.21071 9.41421 5.58579C9.78929 5.96086 10 6.46957 10 7Z"
                                                        stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path
                                                        d="M13 7C13 11.7613 8 14.5 8 14.5C8 14.5 3 11.7613 3 7C3 5.67392 3.52678 4.40215 4.46447 3.46447C5.40215 2.52678 6.67392 2 8 2C9.32608 2 10.5979 2.52678 11.5355 3.46447C12.4732 4.40215 13 5.67392 13 7Z"
                                                        stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                  </svg>
                                                  {{ $ilan->adress }}
                                            </div>
                                        </a>
                                    </div>
                                    <div class="archive-bottom">
                                        <div class="content-top">
                                            <h6 class="text-capitalize"><a href="property-details-v1.html" class="link">
                                                    {{ $ilan->ilan_adi }}</a></h6>
                                            <ul class="meta-list">

                                                <li class="item">
                                                    <i class="icon icon-bed"></i>
                                                    <span class="text-variant-1">Oda:</span>
                                                    <span class="fw-6">
                                                        <?php $odakey = 7;
                                                        $result3 = array_filter($ilan->property_properties, function ($item) use ($odakey) {
                                                            return isset($item['key']) && $item['key'] == $odakey;
                                                        });
                                                        if (!empty($result3)) {
                                                            $result3 = array_values($result3);
                                                            print_r($result3[0]['value']);
                                                        }
                                                      ?></span>
                                                </li>

                                                <li class="item">
                                                    <i class="icon icon-bath"></i>
                                                    <span class="text-variant-1">Banyo:</span>
                                                    <span class="fw-6"><?php $banyokey = 5;
                                                        $result2 = array_filter($ilan->property_properties, function ($item) use ($banyokey) {
                                                            return isset($item['key']) && $item['key'] == $banyokey;
                                                        });
                                                        if (!empty($result2)) {
                                                            $result2 = array_values($result2);
                                                            print_r($result2[0]['value']);
                                                        }
                                                      ?></span>
                                                </li>

                                                <li class="item">
                                                    <i class="icon icon-sqft"></i>
                                                    <span class="text-variant-1">M2:</span>
                                                    <span class="fw-6"><?php $keyToFind = 4;
                                                        $result = array_filter($ilan->property_properties, function ($item) use ($keyToFind) {
                                                            return isset($item['key']) && $item['key'] == $keyToFind;
                                                        });
                                                     print_r($result[0]['value']); ?></span>
                                                  </li>

                                            </ul>
                                        </div>
                                        <div class="content-bottom">
                                            <div class="d-flex gap-8 align-items-center">
                                                <span>Private Real Estate</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="text-center">
                            <a href="/ilanlar" class="tf-btn btn-view primary size-1 hover-btn-view">Tümünü Keşfet<span class="icon icon-arrow-right2"></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="flat-location px-10">
        <div class="box-title text-center wow fadeInUp">
            <div class="text-subtitle text-primary">Private Real Estate</div>
            <h3 class="mt-4 title">Projelerimiz</h3>
        </div>
         <div class="wow fadeInUp" data-wow-delay=".2s">
            <div dir="ltr" class="swiper tf-sw-location" data-preview="4" data-tablet="3" data-mobile-sm="2" data-mobile="1"
                data-space-lg="4" data-space-md="4" data-space="6" data-pagination="1" data-pagination-sm="2"
                data-pagination-md="3" data-pagination-lg="3">
                <div class="swiper-wrapper">
                @foreach ($data["projelerimiz"]  as $prj)
                  <div class="swiper-slide">
                      <div class="box-location">
                          <a href="projects/{{$prj->slug}}" class="image img-style">
                            <img style="height:350px;" class="lazyload" data-src="uploads/page/{{$prj->image}}"
                                src="uploads/page/{{$prj->image}}" alt="image-location">
                          </a>
                          <div class="content">
                              <div class="inner-left">
                                  <h6 class="title link">{{$prj->title}}</h6>
                              </div>
                              <a href="projects/{{$prj->slug}}" class="box-icon line w-44 round"><i class="icon icon-arrow-right2"></i></a>
                          </div>
                      </div>
                  </div>
                 @endforeach
                </div>
              <div class="sw-pagination sw-pagination-location text-center"></div>
            </div>
          </div>
    </section>
    <section style="margin-top:100px" class="mx-5 bg-primary-new radius-30">
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
    <section class="flat-section">
        <div class="container">
            <div class="box-title text-center wow fadeInUp">
                <div class="text-subtitle text-primary">Hizmetlerimiz</div>
                <h3 class="mt-4 title">Neler Yapıyoruz ?</h3>
            </div>
            <div class="tf-grid-layout md-col-3 wow fadeInUp" data-wow-delay=".2s">
                @foreach ($data['hizmetlerimiz'] as $hiz)
                    <div class="box-service">
                        <div class="image">
                          <img style="height: 130px !important;" class="lazyload" data-src="uploads/page/{{ $hiz->image }}" src="uploads/page/{{ $hiz->image }}" alt="image-location">
                        </div>
                        <div class="content">
                          <h5 class="title">{{ $hiz->name }}</h5>
                          <a href="/ilanlar" class="tf-btn btn-line">Keşfet <span class="icon icon-arrow-right2"></span></a>  
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="flat-section bg-primary-new">
        <div class="container">
            <div class="box-title text-center wow fadeInUp">
                <div class="text-subtitle text-primary">Yeniler</div>
                <h3 class="title mt-4">Bloglarımız</h3>
            </div>
            <div dir="ltr" class="swiper tf-sw-latest wow fadeInUp" data-wow-delay=".2s" data-preview="3" data-tablet="2"
                data-mobile-sm="2" data-mobile="1" data-space-lg="30" data-space-md="15" data-space="15">
                <div class="swiper-wrapper">
                   @foreach ($data['blog'] as $blog)
                    <div class="swiper-slide">
                        <a href="{{ $blog->slug }}" class="flat-blog-item hover-img">
                            <div class="img-style">
                                <img class="lazyload" data-src="uploads/page/{{ $blog->image }}" src="uploads/page/{{ $blog->image }}"
                                    alt="img-blog">
                                <span class="date-post">{{ $blog->created_at->format('d-m-Y') }}</span>
                            </div>
                            <div class="content-box">
                                <div class="post-author">
                                    <span class="fw-6">Private Real Estate</span>
                                </div>
                                <h5 class="title link">{{ $blog->name }}</h5>
                            </div>

                        </a>
                    </div>
                    @endforeach                                         
                </div>
                <div class="sw-pagination sw-pagination-latest text-center"></div>
            </div>
        </div>
    </section>
@endsection