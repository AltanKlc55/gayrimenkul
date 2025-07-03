
<?php $__env->startSection('content'); ?>

    <section class="flat-section flat-recommended flat-sidebar">
        <div class="container">
            <div class="box-title-listing">
                <div class="box-left">
                    <h3 class="fw-8">İlanlar</h3>
                    <p class="text">Sizin İçin Önerilernler</p>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4 col-lg-5">
                    <div class="widget-sidebar fixed-sidebar">
                        <div class="flat-tab flat-tab-form widget-filter-search widget-box">
                            <ul class="nav-tab-form" role="tablist">
                                <li class="nav-tab-item" role="presentation">
                                    <a href="#sell" class="nav-link-item active" data-bs-toggle="tab">Kiralık</a>
                                </li>
                                <li class="nav-tab-item" role="presentation">
                                    <a href="#rental" class="nav-link-item" data-bs-toggle="tab">Satılık</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade active show" role="tabpanel">
                                    <div class="form-sl">
                                        <form method="post">
                                            <div class="wd-filter-select">
                                                <div class="inner-group">
                                                    <div class="box">
                                                        <div class="form-style">
                                                            <input type="text" class="form-control"
                                                                placeholder="İlan Başlığını Yazın...." value=""
                                                                name="property_title_filter" title="Search for" required="">
                                                        </div>
                                                        <div class="form-style">
                                                            <div class="group-select">
                                                                <div class="nice-select" tabindex="0"><span
                                                                        class="current">Mülk Türü</span>
                                                                    <ul class="list">
                                                                        <?php $__currentLoopData = $data['ozellikler']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <li data-value="<?php echo e($o->id); ?>" class="option">
                                                                                <?php echo e($o->name); ?></li>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-style box-select">
                                                            <div class="nice-select" tabindex="0"><span
                                                                    class="current">Room</span>
                                                                <ul class="list">
                                                                    <li data-value="1" class="option">1</li>
                                                                    <li data-value="2" class="option">2</li>
                                                                    <li data-value="3" class="option">3</li>
                                                                    <li data-value="4" class="option">4</li>
                                                                    <li data-value="5" class="option">5</li>
                                                                    <li data-value="6" class="option">6</li>
                                                                    <li data-value="7" class="option">7</li>
                                                                    <li data-value="8" class="option">8 ve Üstü</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="box">
                                                        <div class="form-style widget-price">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Minimum Fiyat" value=""
                                                                        name="min_price">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Maksimum Fiyat" value=""
                                                                        name="max_price">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-style widget-price">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Minimum M2" value="" name="min_m2">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Maksimum M2" value="" name="max_m2">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="box">
                                                        <div class="form-style box-select">
                                                            <div class="nice-select" tabindex="0"><span
                                                                    class="current">İl</span>
                                                                <ul class="list">
                                                                    <li data-value="1" class="option">1</li>
                                                                    <li data-value="2" class="option">2</li>
                                                                    <li data-value="3" class="option">3</li>
                                                                    <li data-value="4" class="option">4</li>
                                                                    <li data-value="5" class="option">5</li>
                                                                    <li data-value="6" class="option">6</li>
                                                                    <li data-value="7" class="option">7</li>
                                                                    <li data-value="8" class="option">8 ve Üstü</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="form-style box-select">
                                                            <div class="nice-select" tabindex="0"><span
                                                                    class="current">İlçe</span>
                                                                <ul class="list">
                                                                    <li data-value="1" class="option">1</li>
                                                                    <li data-value="2" class="option">2</li>
                                                                    <li data-value="3" class="option">3</li>
                                                                    <li data-value="4" class="option">4</li>
                                                                    <li data-value="5" class="option">5</li>
                                                                    <li data-value="6" class="option">6</li>
                                                                    <li data-value="7" class="option">7</li>
                                                                    <li data-value="8" class="option">8 ve Üstü</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="form-style box-select">
                                                            <div class="nice-select" tabindex="0"><span
                                                                    class="current">Mahalle</span>
                                                                <ul class="list">
                                                                    <li data-value="1" class="option">1</li>
                                                                    <li data-value="2" class="option">2</li>
                                                                    <li data-value="3" class="option">3</li>
                                                                    <li data-value="4" class="option">4</li>
                                                                    <li data-value="5" class="option">5</li>
                                                                    <li data-value="6" class="option">6</li>
                                                                    <li data-value="7" class="option">7</li>
                                                                    <li data-value="8" class="option">8 ve Üstü</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-style">
                                                        <button type="submit"
                                                            class="tf-btn btn-view primary hover-btn-view">Ara
                                                            <span class="icon icon-arrow-right2"></span></button>
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
                <div class="col-xl-8 col-lg-7 flat-animate-tab">
                    <div class="tab-content">
                        <div class="tab-pane active show" id="listLayout" role="tabpanel">
                            <div class="row">

                                <?php $__currentLoopData = $data['ilanlar']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ilan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-md-12">
                                    <div class="homelengo-box list-style-1 list-style-2 line">
                                        <div class="archive-top">
                                            <a href="property-details-v1.html" class="images-group">
                                              <div class="images-style">
                                                  <img class="lazyload" data-src="<?php echo e($ilan->images[0] ?? ''); ?>"
                                                      src="<?php echo e($ilan->images[0] ?? ''); ?>" alt="img-property">
                                              </div>
                                            </a>
                                        </div>
                                        <div class="archive-bottom">
                                            <div class="content-top">
                                                <h6 class="text-capitalize"><a href="property-details-v1.html"
                                                        class="link text-line-clamp-1"><?php echo e($ilan->ilan_adi); ?></a></h6>
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
                                                <div class="location">
                                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M10 7C10 7.53043 9.78929 8.03914 9.41421 8.41421C9.03914 8.78929 8.53043 9 8 9C7.46957 9 6.96086 8.78929 6.58579 8.41421C6.21071 8.03914 6 7.53043 6 7C6 6.46957 6.21071 5.96086 6.58579 5.58579C6.96086 5.21071 7.46957 5 8 5C8.53043 5 9.03914 5.21071 9.41421 5.58579C9.78929 5.96086 10 6.46957 10 7Z"
                                                            stroke="#A3ABB0" stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path
                                                            d="M13 7C13 11.7613 8 14.5 8 14.5C8 14.5 3 11.7613 3 7C3 5.67392 3.52678 4.40215 4.46447 3.46447C5.40215 2.52678 6.67392 2 8 2C9.32608 2 10.5979 2.52678 11.5355 3.46447C12.4732 4.40215 13 5.67392 13 7Z"
                                                            stroke="#A3ABB0" stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg>
                                                    <span class="text-line-clamp-1"><?php echo e($ilan->adress); ?></span>
                                                </div>
                                            </div>

                                            <div class="content-bottom">
                                                <div class="d-flex gap-8 align-items-center">
                                                    <span>Private Real Estate</span>
                                                </div>
                                                <h6 class="price"><?php echo e($ilan->price); ?> ₺</h6>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('interfacemaster', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\astok\Desktop\private_real_estate\resources\views/interface_pages/propertylist.blade.php ENDPATH**/ ?>