@extends('interfacemaster')
@section('content')

<section class="flat-title-page" style="background-image: url(uploads/page/{{ $data["sayfa"][0]->banner }});">
                <div class="container">
                    <div class="breadcrumb-content">
                        <ul class="breadcrumb">
                            <li><a href="/" class="text-white">Anasayfa</a></li>
                            <li class="text-white">/ {{ $data["sayfa"][0]->name }}</li>
                        </ul>
                        <h1 class="text-center text-white title">{{ $data["sayfa"][0]->name }}</h1>
                    </div>
                </div>
            </section>

            <section class="flat-section">
                <div class="container">
                    <div class="row">
                    @foreach ($data['projeler'] as $prj)                    
                        <div class="col-lg-4 col-md-6">
                            <a href="projects/{{$prj->slug}}" class="flat-blog-item hover-img">
                                <div class="img-style">
                                    <img class="lazyload" data-src="uploads/page/{{$prj->image}}" src="uploads/page/{{$prj->image}}" alt="img-blog">
                                    <span class="date-post">{{ $prj->created_at->format('d-m-Y') }}</span>
                                </div>
                                <div class="content-box">
                                    <div class="post-author">
                                        <span class="fw-6">Private Real Estate</span>
                                    </div>
                                    <h5 class="title link">{{ $prj->name }}</h5>
                                </div>
                            </a>
                        </div>
                    @endforeach
                    </div>
                </div>
            </section>

@endsection