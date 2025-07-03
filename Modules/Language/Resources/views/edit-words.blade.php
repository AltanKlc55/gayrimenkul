@extends('master')

@section('content')

    @include('breadcrump')


    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        <form action="{{route('language.add.new.string')}}" method="post">
                            @csrf
                            <div class="row align-items-end">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="string">{{___('String')}}</label>
                                        <input type="text" class="form-control" name="string" placeholder="{{___('String')}}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="translate_string">{{___('Translated String')}}</label>
                                        <input type="text" class="form-control" name="translate_string" placeholder="{{___('Translated String')}}">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <button type="submit" class="btn btn-primary">{{___('Submit')}}</button>
                                </div>
                            </div>
                            <input type="hidden" name="slug" value="{{$lang_slug}}">
                        </form>
                    </div>
                    <div class="prism-toggle">
                        <a href="{{route('language.index')}}" class="btn btn-xs btn-primary"><i class="fas fa-angle-double-left"></i>{{___('All Languages')}}</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('partials.error')

                    <form action="{{route('language.words.update',$lang_slug)}}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="type" value="{{$type}}">
                        @csrf
                        <div class="row">
                            @foreach($all_word as $key => $value)
                                <div class="col-lg-3 col-md-6 mb-15">
                                    <div class="form-group">
                                        <label for="{{Str::slug(($key))}}"><strong>{{$key}}</strong></label>
                                        <input type="text" name="word[{{$key}}]"  class="form-control" value="{{$value}}" id="{{Str::slug(($key))}}">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{___('Update Changes')}}</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection
@push('javascript')

@endpush