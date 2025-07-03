@extends('master')


@section('content')

    @include('breadcrump')

    <!-- Page Header Close -->

    <!-- Start::row-1 -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        @yield('title', $page['title'] ?? '')


                    </div>
                    <div class="prism-toggle">
                        @foreach($page['button'] as $button)
                            <x-forms.button
                                    type="{{$button['type']}}"
                                    title="{{$button['title']}}"
                                    class="{{$button['class']}}"
                                    icon="{{$button['icon']}}"
                                    color="{{$button['color']}}"
                                    id="{{$button['id']}}"
                                    onclick="{{isset($button['onclick']) ? $button['onclick'] : false}}"
                                    href="{{isset($button['href']) ? $button['href'] : false}}"

                            />
                        @endforeach

                    </div>
                </div>

            </div>
        </div>
        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <div class="card custom-card team-member-card">
                <div class="teammember-cover-image">
                    <img src="../assets/images/media/team-covers/5.jpg" class="card-img-top" alt="...">
                    <span class="avatar avatar-xl avatar-rounded">
                                                <img src="../assets/images/faces/13.jpg" alt="">
                                            </span>
                    <a href="javascript:void(0);" class="team-member-star text-warning">
                        <i class="ri-star-fill fs-16"></i>
                    </a>
                </div>
                <div class="card-body p-0">
                    <div class="d-flex flex-wrap align-item-center mt-sm-0 mt-5 justify-content-between border-bottom border-block-end-dashed p-3">
                        <div class="team-member-details flex-fill">
                            <p class="mb-0 fw-semibold fs-16 text-truncate">
                                <a href="javascript:void(0);">{{ $page['employee']->name }}  {{ $page['employee']->surname }}</a>
                            </p>
                            <p class="mb-0 fs-12 text-muted text-break"><a href="mailto:{{ $page['employee']->email }}">{{ $page['employee']->email }}</p>
                        </div>

                    </div>
                    <div class="team-member-stats d-sm-flex justify-content-evenly">
                        <div class="text-center p-3 my-auto">
                            <p class="fw-semibold mb-0">{{___('Departman')}}</p>
                            <span class="text-muted fs-12">{{ get_definition($page['employee']->department) }}</span>
                        </div>
                        <div class="text-center p-3 my-auto">
                            <p class="fw-semibold mb-0">{{___('Pozisyon')}}</p>
                            <span class="text-muted fs-12">{{ get_definition($page['employee']->position) }}</span>
                        </div>
                        <div class="text-center p-3 my-auto">
                            <p class="fw-semibold mb-0">{{___('İşe Giriş Tarihi')}}</p>
                            <span class="text-muted fs-12">{{ $page['start_date'] }}</span>
                        </div>
                        <div class="text-center p-3 my-auto">
                            <p class="fw-semibold mb-0">{{___('Toplam Kullanılan İzin')}}</p>
                            <span class="text-muted fs-12">{{ $page['sum_leave'] }}</span>
                        </div>
                    </div>
                </div>
                <div class="card-footer border-block-start-dashed text-center hidden">
                    <div class="btn-list">
                        <div class="btn-list">
                            <button class="btn btn-sm btn-icon btn-light btn-wave waves-effect waves-light">
                                <i class="ri-facebook-line fw-bold"></i>
                            </button>
                            <button class="btn btn-sm btn-icon btn-secondary-light btn-wave waves-effect waves-light">
                                <i class="ri-twitter-line fw-bold"></i>
                            </button>
                            <button class="btn btn-sm btn-icon btn-warning-light btn-wave waves-effect waves-light">
                                <i class="ri-instagram-line fw-bold"></i>
                            </button>
                            <button class="btn btn-sm btn-icon btn-success-light btn-wave waves-effect waves-light">
                                <i class="ri-github-line fw-bold"></i>
                            </button>
                            <button class="btn btn-sm btn-icon btn-danger-light btn-wave waves-effect waves-light">
                                <i class="ri-youtube-line fw-bold"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card custom-card bg-white" style="height: 97%;">
                <div class="card-header  justify-content-between">
                    <div class="card-title text-dark">
                        Kullandığı izinler
                    </div>
                    <div class="dropdown">
                        <a aria-label="anchor" href="javascript:void(0);" class="btn btn-icon btn-sm btn-light" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fe fe-more-vertical"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="">Tümü</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled crm-top-deals mb-0 text-white">

                            <li>
                                @foreach($page['employee_leave'] as $employee_leave)
                                    <li>
                                        <div class="d-flex align-items-top flex-wrap">
                                            <div class="flex-fill">
                                                <a href="{{ route('employee_leave.edit',$employee_leave->id) }}">
                                                    <p class="fw-semibold mb-0 " >{{ $employee_leave->title}} -> {{ $employee_leave->leave_day  }} Gün</p></a>
                                                <span class="text-muted fs-12">
                                                    Gidiş Tarihi : {{ \Carbon\Carbon::parse($employee_leave->contract_date)->translatedFormat('d F Y') }} ->
                                                    Dönüş Tarihi : {{ \Carbon\Carbon::parse($employee_leave->contract_date)->translatedFormat('d F Y') }}
                                                </span>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </li>

                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card custom-card bg-white" style="height: 97%;">
                <div class="card-header  justify-content-between">
                    <div class="card-title text-dark">
                        Özlük Dosyaları
                    </div>
                    <div class="dropdown">
                        <a aria-label="anchor" href="javascript:void(0);" class="btn btn-icon btn-sm btn-light" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fe fe-more-vertical"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="">Tümü</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled crm-top-deals mb-0 text-white">

                        <li>
                            @foreach($page['employee_file'] as $employee_file)
                                <li>
                                    <div class="d-flex align-items-top flex-wrap">
                                        <div class="flex-fill">
                                            <a href="{{ url('uploads/employee_file',$employee_file->contract_file) }}">
                                                <p class="fw-semibold mb-0 " >{{ $employee_file->title}}</p></a>
                                            <span class="text-muted fs-12">Belge Tarihi : {{ \Carbon\Carbon::parse($employee_file->contract_date)->translatedFormat('d F Y') }}</span>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </li>

                    </ul>
                </div>
            </div>
        </div>

    </div>



@endsection
