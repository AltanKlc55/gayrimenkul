@extends('master')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
@endpush

@section('content')
    @include('breadcrump')









    <!-- Start::row-1 -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        @yield('title', $page['title'] ?? '')
                    </div>
                    <div class="prism-toggle">
                        @yield('button')
                    </div>
                </div>
                <div class="card-body">
                    @if(isset($page['multilang']) and $page['multilang'] == true)
                        <ul class="nav nav-tabs mb-3 border-0 <?= (count(conf_language()) > 1) ? '' : 'hidden' ?>" role="tablist">
                            @foreach(conf_language() as $key => $lang)
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link {{($key == "0") ? "active" : ''}}" data-bs-toggle="tab" role="tab" href="#{{$lang->slug}}"aria-selected="true">{{$lang->name}}</a>
                                </li>
                            @endforeach

                        </ul>
                    @endif

                    <form method="POST" id="form" action="{{$page['action']}}" enctype="multipart/form-data">
                        <div class="repeater">
                            <div data-repeater-list="items">
                                @csrf
                                @if(isset($page['multilang']) and $page['multilang'] == true)



                                    <div class="tab-content">
                                        <div data-repeater-item>
                                            <div class="row">
                                                @foreach(conf_language() as $key => $lang)

                                             <div class="tab-pane {{($key == "0") ? "show active" : ''}} text-muted" id="{{$lang->slug}}" role="tabpanel">
                                                <div class="row">

                                                    @foreach($page['form'] as $form)
                                                        @if(isset($form['multilang']) and $form['multilang'] == true)
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
                                                                            multilang="{{isset($form['multilang']) ? $form['multilang'] : false}}"
                                                                            lang="{{isset($lang->slug) ? $lang->slug : false}}"
                                                                            path="{{isset($form['path']) ?  $form['path'] : ''}}"
                                                                            description="{{isset($form['description']) ? $form['description'] : ''}}"
                                                                            required="{{isset($form['required']) ? $form['required'] : false}}"
                                                                            disabled="{{isset($form['disabled']) ? $form['disabled'] : false}}"
                                                                            filetype="{{isset($form['filetype']) ? $form['filetype']  : ''}}"
                                                                            attribute="{{isset($form['attribute']) ?  $form['attribute'] : ''}}"
                                                                            entry="{{isset($page['row']) ? getlanguage($page['row'][$form['name']],$lang->slug) : ''}}"
                                                                    />
                                                                    @break
                                                                @case('textarea')
                                                                    <x-forms.textarea
                                                                            title="{{$form['title']}}"
                                                                            name="{{$form['name']}}"
                                                                            grid="{{$form['grid']}}"
                                                                            lang="{{isset($lang->slug) ? $lang->slug : false}}"
                                                                            multilang="{{isset($form['multilang']) ? $form['multilang'] : false}}"
                                                                            entry="{{isset($page['row']) ? getlanguage($page['row'][$form['name']],$lang->slug) : ''}}"
                                                                    />
                                                                    @break
                                                            @endswitch
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>

                                        @endforeach
                                                    <div class="form-group col-md-2">
                                                        <button type="button" class="btn btn-danger " data-repeater-delete>{{ ___('Delete') }}</button>
                                                    </div>
                                            </div>

                                        </div>

                                    </div>
                                @endif
                                <div class="col-md-12 pl-20 pr-20">

                                    <div class="row">
                                        <div class="col-md-12 pl-20 pr-20" data-repeater-item>
                                            <div class="row">

                                            @foreach($page['form'] as $form)

                                            @if(!isset($form['multilang']) or $form['multilang'] == false)
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
                                                                entry=""
                                                        />
                                                        @break
                                                    @case('checkbox')
                                                        <x-forms.checkbox
                                                                type="checkbox"
                                                                title="{{$form['title']}}"
                                                                name="{{$form['name']}}"
                                                                grid="{{$form['grid']}}"
                                                                checked="{{(isset($page['row']) and $page['row'][$form['name']] == 1) ? 'checked' : ''}}"
                                                                readonly="{{isset($form['readonly']) ? $form['readonly'] : false}}"
                                                                required="{{isset($form['required']) ? $form['required'] : false}}"
                                                                disabled="{{isset($form['disabled']) ? $form['disabled'] : false}}"
                                                                attribute="{{isset($form['attribute']) ?  $form['attribute'] : ''}}"
                                                                entry="{{isset($page['row']) ? $page['row'][$form['name']] : ''}}"
                                                        />
                                                        @break
                                                    @case('radio')
                                                        <x-forms.radio
                                                                type="radio"
                                                                title="{{$form['title']}}"
                                                                name="{{$form['name']}}"
                                                                grid="{{$form['grid']}}"
                                                                checked="{{(isset($page['row']) and $page['row'][$form['name']] == 1) ? 'checked' : ''}}"
                                                                readonly="{{isset($form['readonly']) ? $form['readonly'] : false}}"
                                                                required="{{isset($form['required']) ? $form['required'] : false}}"
                                                                disabled="{{isset($form['disabled']) ? $form['disabled'] : false}}"
                                                                attribute="{{isset($form['attribute']) ?  $form['attribute'] : ''}}"
                                                                entry="{{isset($page['row']) ? $page['row'][$form['name']] : ''}}"
                                                        />
                                                        @break
                                                    @case('hidden')
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
                                                                entry="{{isset($page['row']) ? $page['row'][$form['name']] : $form['value']}}"
                                                        />
                                                        @break
                                                    @case('email')
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
                                                    @case('password')
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
                                                                child="{{$form['child']}}"
                                                                tags="{{isset($form['tags']) ? $form['tags'] : false}}"
                                                                selected=""
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
                                                                child="{{isset($form['child']) ? $form['child'] : "name"}}"
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
                                            @endif

                                        @endforeach
                                                <div class="form-group col-md-2">
                                                    <button type="button" class="btn btn-danger " data-repeater-delete>{{ ___('Delete') }}</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-success mt-3" data-repeater-create>{{ ___('Yeni Satır Ekle') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--End::row-1 -->
    @push('javascript')
        <!-- Select2 Cdn -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script>
            $( document ).ready(function() {
                $("select").select2({
                    placeholder: "<?= ___('Choose') ?>"
                });
            });

        </script>
    @endpush
@endsection