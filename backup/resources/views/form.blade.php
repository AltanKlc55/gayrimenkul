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
                            @yield('title', $page_title ?? '')
                        </div>
                        <div class="prism-toggle">
                            @yield('button')
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" id="form" action="{{$page['action']}}" enctype="multipart/form-data">
                            <div class="row">
                            @csrf
                        @foreach($page['form'] as $form)
                            @switch($form['type'])
                                @case('text')
                                    <x-forms.input
                                            type="{{$form['type']}}"
                                            title="{{$form['title']}}"
                                            name="{{$form['name']}}"
                                            class="{{$form['class']}}"
                                            grid="{{$form['grid']}}"
                                            id="{{$form['id']}}"
                                            readonly="{{isset($form['readonly']) ? $form['readonly'] : false}}"
                                            path="{{isset($form['path']) ?  $form['path'] : ''}}"
                                            description="{{isset($form['description']) ? $form['description'] : ''}}"
                                            required="{{isset($form['required']) ? $form['required'] : false}}"
                                            disabled="{{isset($form['disabled']) ? $form['disabled'] : false}}"
                                            filetype="{{isset($form['filetype']) ? $form['filetype']  : ''}}"
                                            attribute="{{isset($form['attribute']) ?  $form['attribute'] : ''}}"
                                            entry="{{isset($page['row']) ? $page['row'][$form['name']] : ''}}"
                                    />
                                @break
                                        @case('textarea')
                                    <x-forms.textarea
                                            title="{{$form['title']}}"
                                            name="{{$form['name']}}"
                                            grid="{{$form['grid']}}"
                                            entry="{{isset($page['row']) ? $page['row'][$form['name']] : ''}}"
                                    />
                                @break
                                        @case('select')
                                    <x-forms.select
                                            title="{{$form['title']}}"
                                            name="{{$form['name']}}"
                                            class="{{$form['class']}}"
                                            grid="{{$form['grid']}}"
                                            :options="$form['option']"
                                            id="{{$form['id']}}"
                                            selected="{{isset($form['tags']) ? $form['tags'] : false}}"
                                            selected="{{isset($form['selected']) ? $form['selected'] : false}}"
                                            readonly="{{isset($form['readonly']) ? $form['readonly'] : false}}"
                                            multiple="{{isset($form['multiple']) ? $form['multiple'] : false}}"
                                            description="{{isset($form['description']) ? $form['description'] : ''}}"
                                            required="{{isset($form['required']) ? $form['required'] : false}}"
                                            disabled="{{isset($form['disabled']) ? $form['disabled'] : false}}"
                                            attribute="{{isset($form['attribute']) ?  $form['attribute'] : ''}}"
                                    />
                                @break
                                        @case('category')
                                    <x-forms.category
                                            title="{{$form['title']}}"
                                            name="{{$form['name']}}"
                                            class="{{$form['class']}}"
                                            grid="{{$form['grid']}}"
                                            :options="$form['option']"
                                            id="{{$form['id']}}"
                                            tags="{{isset($form['tags']) ? $form['tags'] : false}}"
                                            selected="{{isset($page['row']) ? $page['row'][$form['name']] : ''}}"
                                            readonly="{{isset($form['readonly']) ? $form['readonly'] : false}}"
                                            multiple="{{isset($form['multiple']) ? $form['multiple'] : false}}"
                                            description="{{isset($form['description']) ? $form['description'] : ''}}"
                                            required="{{isset($form['required']) ? $form['required'] : false}}"
                                            disabled="{{isset($form['disabled']) ? $form['disabled'] : false}}"
                                            attribute="{{isset($form['attribute']) ?  $form['attribute'] : ''}}"
                                    />
                                @break
                                    @case('number')
                                        <x-forms.input
                                                type="{{$form['type']}}"
                                                title="{{$form['title']}}"
                                                name="{{$form['name']}}"
                                                class="{{$form['class']}}"
                                                grid="{{$form['grid']}}"

                                                readonly="{{isset($form['readonly']) ? $form['readonly'] : false}}"
                                                path="{{isset($form['path']) ?  $form['path'] : ''}}"
                                                description="{{isset($form['description']) ? $form['description'] : ''}}"
                                                required="{{isset($form['required']) ? $form['required'] : false}}"
                                                disabled="{{isset($form['disabled']) ? $form['disabled'] : false}}"
                                                filetype="{{isset($form['filetype']) ? $form['filetype']  : ''}}"
                                                attribute="{{isset($form['attribute']) ?  $form['attribute'] : ''}}"
                                                entry="{{isset($page['row']) ? $page['row'][$form['name']] : ''}}"
                                        />
                                        @break
                                    @case('file')
                                        <x-forms.input
                                                type="{{$form['type']}}"
                                                title="{{$form['title']}}"
                                                name="{{$form['name']}}"
                                                class="{{$form['class']}}"
                                                grid="{{$form['grid']}}"
                                                id="{{$form['id']}}"

                                                readonly="{{isset($form['readonly']) ? $form['readonly'] : false}}"
                                                path="{{isset($form['path']) ?  $form['path'] : ''}}"
                                                description="{{isset($form['description']) ? $form['description'] : ''}}"
                                                required="{{isset($form['required']) ? $form['required'] : false}}"
                                                disabled="{{isset($form['disabled']) ? $form['disabled'] : false}}"
                                                filetype="{{isset($form['filetype']) ? $form['filetype']  : ''}}"
                                                attribute="{{isset($form['attribute']) ?  $form['attribute'] : ''}}"
                                                entry="{{isset($page['row']) ? $page['row'][$form['name']] : ''}}"
                                        />
                                        @break
                            @endswitch


                        @endforeach
                            </div>
                        </form>
                    </div>
            </div>
    </div>
</div>
<!--End::row-1 -->

@endsection