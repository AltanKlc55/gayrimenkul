@extends('master')
@include('partials.table')

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
                    <div class="prism-toggle">
                        @yield('button')
                    </div>
                </div>
                <div class="card-body">
                    @yield('table')
                </div>
            </div>
        </div>
    </div>
    <!--End::row-1 -->
@endsection