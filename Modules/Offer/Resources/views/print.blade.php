@extends('print')
@section('content')
    <style type="text/css">
        div#column{display: flex;}
        div#column .col-xl-3 {
            width: 25%;
        }

        .printcategory {
            width: 210mm; /* A4 kağıdının genişliği */
            height: 297mm; /* A4 kağıdının yüksekliği */
        }
        body *{
            font-family: Arial, sans-serif!important; /* Genel font ailesi */
            font-size: 11pt!important; /* Genel font boyutu */
            line-height: 1.6!important; /* Satır aralığı */
            color: #333; /* Metin rengi */
        }
        .table-container {
            overflow-x: auto; /* Yatay kaydırma çubuğu ekle */
            max-width: 100%; /* Tablonun maksimum genişliği */
        }
        table tr th,table tr td{
            border: 1px solid;
        }
        @media print {
            /* Üst bilgileri gizle */
            @page {
                margin-top: 0;
                margin-bottom: 0;
            }

            /* Alt bilgileri gizle */
            body {
                margin-bottom: 0;
            }
        }
        .printcategory img{
            max-width: 100%;
        }
    </style>

    <div class="printcategory">
        <div class="">
            <div class="row gy-3">
                <div class="col-xl-12">
                    @if(get_config('offer_top'))
                        {!! get_config('offer_top') !!}
                    @endif
                </div>
                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">

                            <p class="fw-bold mb-1">
                                {{get_config('company_name')}}
                            </p>
                            <p class="mb-1 text-muted">
                                {{get_config('company_email')}}
                            </p>
                            <p class="mb-1 text-muted">
                                {{get_config('company_phone')}}
                            </p>
                            <p class="mb-1 text-muted">
                                {{get_config('company_address')}}
                            </p>
                            <p>
                                {{get_config('company_tax_address')}} / {{get_config('company_tax_no')}}
                            </p>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 ms-auto mt-sm-0 mt-3">

                            <p class="fw-bold mb-1">
                                {{$buyyer['current_title']}}
                            </p>
                            <p class="text-muted mb-1">
                                {{$buyyer['email']}}
                            </p>
                            <p class="text-muted mb-1">
                                {{$buyyer['phone']}}
                            </p>
                            <p class="text-muted mb-1">
                                {{$buyyer['current_address']}}
                            </p>
                            <p class="text-muted mb-1">
                                {{$buyyer['tax_administration']}} / {{$buyyer['tax_number']}}
                            </p>

                        </div>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="row" id="column">
                        <div class="col-xl-3">
                            <p class="fw-semibold text-muted mb-1">{{___('Teklif Kodu')}} :</p>
                            <p class="fs-15 mb-1">#{{$result->offer_id}}</p>
                        </div>
                        <div class="col-xl-3">
                            <p class="fw-semibold text-muted mb-1">{{___('Veriliş Tarihi')}} :</p>
                            <p class="fs-15 mb-1">{{$result->date_issued}}</p>
                        </div>
                        <div class="col-xl-3">
                            <p class="fw-semibold text-muted mb-1">{{___('Bitiş Tarihi')}} :</p>
                            <p class="fs-15 mb-1">{{$result->due_date}}</p>
                        </div>
                        <div class="col-xl-3">
                            <p class="fw-semibold text-muted mb-1">{{___('Ödenecek Tutar')}} :</p>
                            <p class="fs-16 mb-1 fw-semibold">{{currency($result->price)}} TL</p>
                        </div>

                    </div>
                </div>
                <div class="table-responsive" style="padding:0 14px;">
                    <table class="table nowrap" style="width: 100%;  border: 1px solid;">
                        <thead>
                        <tr>
                            <th colspan="{{($result['is_brand'] == 1) ? '4' : '3'}}"></th>
                            <th colspan="2" style="text-align: center">{{___('Malzeme')}}</th>
                            @if($result['is_works'] == 1)
                            <th colspan="2" style="text-align: center">{{___('İşçilik')}}</th>
                            @endif
                            @if($result['is_delivery'] == 1)
                            <th></th>
                            @endif
                        </tr>
                        <tr>
                            <th>{{___('Yapılacak İşin Açıklaması')}}</th>
                            @if($result['is_brand'] == 1)
                            <th>{{___('Marka')}}</th>
                            @endif
                            <th>{{___('Ölçü')}}</th>
                            <th>{{___('Miktar')}}</th>
                            <th>{{___('Birim Fiyat')}}</th>
                            <th>{{___('Toplam Fiyat')}}</th>
                            @if($result['is_works'] == 1)
                            <th>{{___('İşçilik Birim Fiyat')}}</th>
                            <th>{{___('İşçilik Toplam Fiyat')}}</th>

                            @endif

                            @if($result['is_delivery'] == 1)
                            <th>{{___('Teslim Tarihi')}}</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($page['childs'] as $page)
                            <tr>
                                <td>
                                        {{$page['title']}}
                                </td>

                                @if($result['is_brand'] == 1)
                                    <td>
                                        {{($page['brand']) ? $page['brand'] : '-'}}
                                    </td>
                                @endif

                                <td>
                                    {{($page['unit']) ? $page['unit'] : '-'}}

                                </td>
                                <td class="product-quantity-container">
                                    {{$page['qty']}}
                                </td>
                                <td>
                                    {{currency($page['price'])}} {{get_definition($page['currency'])}}
                                </td>
                                <td>
                                    {{currency($page['price'] * $page['qty'])}} {{get_definition($page['currency'])}}
                                </td>
                                @if($result['is_works'] == 1)
                                <td>
                                    {{currency($page['workmanship_price'])}} {{get_definition($page['workmanship_currency'])}}
                                </td>
                                <td>
                                    {{currency($page['workmanship_price'] * $page['qty'])}} {{get_definition($page['workmanship_currency'])}}
                                </td>
                                @endif

                                @if($result['is_delivery'] == 1)
                                    <td class="product-quantity-container">

                                        {{($page['delivery_at']) ? date('d-m-Y',strtotime($page['delivery_at'])) : '-'}}
                                    </td>
                                @endif

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                @if($result->offer_note)
                    <div class="col-xl-12">
                        <div>
                            {!! strip_tags($result->offer_note) !!}
                        </div>
                    </div>
                @endif
                @if(get_config('offer_bottom'))
                    <div class="col-xl-12">
                        {!! get_config('offer_bottom') !!}
                    </div>
                @endif

                <div class="col-xs-12" style="    display: flex; justify-content: end;">
                    <div style="width: 50%">
                        <table class="table nowrap" style="width: 100%; ">
                            <tbody>
                                @foreach($tax as $currency => $tax_item)
                                    <tr>
                                        <td colspan="9"><?= $currency ?></td>
                                        <td>
                                                <?= currency($tax_item['sub_total']) ?>
                                        </td>
                                    </tr>
                                    @foreach($tax_item['childs'] as $vat => $item)
                                        @php $total = 0;  @endphp
                                        @foreach($item as $subitem)
                                            @php $total += $subitem['total'] - $subitem['sub_total'];  @endphp
                                        @endforeach

                                        <tr>
                                            <td colspan="9">{{___('KDV')}}  % <?= $vat ?></td>
                                            <td>
                                                    <?= currency($total) ?>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="9">{{___('KDV')}} {{___('Dahil Toplam')}}</td>
                                        <td>
                                                <?= currency($tax_item['total']) ?>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                            </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        // window.print()
    </script>
@endsection
