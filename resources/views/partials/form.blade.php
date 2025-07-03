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
    @csrf
    @if(isset($page['multilang']) and $page['multilang'] == true)



        <div class="tab-content">
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


        </div>
    @endif
    <div class="col-md-12 pl-20 pr-20">

        <div class="row">
            @foreach($page['form'] as $form)
                @if(!isset($form['multilang']) or $form['multilang'] == false)
                    @switch($form['type'])
                        @case('text')
                            @php
                                $value = (isset($form['value'])) ? $form['value'] : '';
                            @endphp
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
                                    entry="{{isset($page['row']) ? $page['row'][$form['name']] : $value}}"
                            />
                            @break
                        @case('textvideo')
                            @php
                                $value = (isset($form['value'])) ? $form['value'] : '';
                            @endphp
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
                                    entry="{{isset($page['row']) ? $page['row'][$form['name']] : $value}}"
                            />
                            @break
                        @case('date')
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
                                    entry="{{isset($page['row']) ? $page['row'][$form['name']] : (isset($form['entry']) ? $form['entry'] : '') }}"
                            />
                            @break
                        @case('datetime-local')
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
                                    entry="{{isset($page['row']) ? $page['row'][$form['name']] : (isset($form['entry']) ? $form['entry'] : '')}}"
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
                                    data-selected="{{isset($page['row']) ? $page['row'][$form['name']] : ''}}"
                                    child="{{$form['child']}}"
                                    format="{{$form['format']}}"
                                    tags="{{isset($form['tags']) ? $form['tags'] : false}}"
                                    selected="{{isset($form['selected']) ? $form['selected'] : (isset($page['row']) ? $page['row'][$form['name']] : '')}}"
                                    readonly="{{isset($form['readonly']) ? $form['readonly'] : false}}"
                                    multiple="{{isset($form['multiple']) ? $form['multiple'] : false}}"
                                    description="{{isset($form['description']) ? $form['description'] : ''}}"
                                    required="{{isset($form['required']) ? $form['required'] : false}}"
                                    disabled="{{isset($form['disabled']) ? $form['disabled'] : false}}"
                                    attribute="{!!  isset($form['attribute']) ?  $form['attribute'] : ''!!}"
                            />



                            @break
                        @case('select_json')
                            <x-forms.select
                                    title="{{$form['title']}}"
                                    name="{{$form['name']}}"
                                    class="{{$form['class']}}"
                                    grid="{{$form['grid']}}"
                                    :options="$form['option']"
                                    id="{{$form['id']}}"
                                    child="{{$form['child']}}"
                                    format="{{$form['format']}}"
                                    tags="{{isset($form['tags']) ? $form['tags'] : false}}"
                                    readonly="{{isset($form['readonly']) ? $form['readonly'] : false}}"
                                    multiple="{{isset($form['multiple']) ? $form['multiple'] : false}}"
                                    description="{{isset($form['description']) ? $form['description'] : ''}}"
                                    required="{{isset($form['required']) ? $form['required'] : false}}"
                                    disabled="{{isset($form['disabled']) ? $form['disabled'] : false}}"
                                    attribute="{{isset($form['attribute']) ?  $form['attribute'] : ''}}"

                                    :selected="isset($page['row']) ? json_decode($page['row'][$form['name']],true) : array()"
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
                                    format="{{$form['format']}}"
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
        </div>
    </div>

    @if(isset($page['repeater']) and !empty($page['repeater']))
        @include('partials.repeater')
    @endif
</form>