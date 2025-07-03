<div class="col-md-12 pl-15 pr-15">
    <div class="repeater">
        <div data-repeater-list="items">
            @if(isset($page['childs']) and !empty($page['childs']))
                @foreach($page['childs'] as $child)
                    <div class="col-md-12 pl-20 pr-20 repeater_item" data-repeater-item>
                        <div class="row align-items-center">

                            <div class="form-group col-md-11">
                                <div class="row">

                                    @foreach($page['repeater'] as $form)
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
                                                        entry="{{$child[$form['name']]}}"
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
                                                        entry="{{$child[$form['name']]}}"

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
                                                        entry="{{$child[$form['name']]}}"

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
                                                        entry="{{$child[$form['name']]}}"

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
                                                        entry="{{$child[$form['name']]}}"

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
                                                        entry="{{$child[$form['name']]}}"

                                                />
                                                @break
                                            @case('textarea')
                                                <x-forms.textarea
                                                        title="{{$form['title']}}"
                                                        name="{{$form['name']}}"
                                                        grid="{{$form['grid']}}"
                                                        entry="{{$child[$form['name']]}}"

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
                                                        format="{{$form['format']}}"
                                                        tags="{{isset($form['tags']) ? $form['tags'] : false}}"
                                                        selected="{{$child[$form['name']]}}"
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
                                                        format="{{$form['format']}}"
                                                        child="{{isset($form['child']) ? $form['child'] : "name"}}"
                                                        tags="{{isset($form['tags']) ? $form['tags'] : false}}"
                                                        selected="{{$child[$form['name']]}}"
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
                                                        entry="{{$child[$form['name']]}}"

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
                                                        entry="{{$child[$form['name']]}}"

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
                                                        entry="{{$child[$form['name']]}}"

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
                                                        entry="{{$child[$form['name']]}}"
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
                                                        entry="{{$child[$form['name']]}}"
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
                                                        entry="{{$child[$form['name']]}}"
                                                />
                                                @break
                                        @endswitch
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group col text-end">
                                <button type="button" class="btn btn-danger " data-repeater-delete>{{ ___('Delete') }}</button>
                            </div>
                        </div>
                    </div>
                @endforeach

            @else
                <div class="col-md-12 pl-20 pr-20 repeater_item" data-repeater-item>
                    <div class="row align-items-center">

                        <div class="form-group col-md-11">
                            <div class="row">

                                @foreach($page['repeater'] as $form)
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
                                                    format="{{$form['format']}}"
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
                                                    entry="{{isset($page['row']) ? $page['row'][$form['name']] : ''}}"
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
                                                    entry="{{isset($page['row']) ? $page['row'][$form['name']] : ''}}"
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
                                    @endswitch
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group col text-end">
                            <button type="button" class="btn btn-danger " data-repeater-delete>{{ ___('Delete') }}</button>
                        </div>
                    </div>
                </div>
            @endif

        </div>
        <button type="button" class="btn btn-success mt-3" data-repeater-create>{{ ___('Yeni Satır Ekle') }}</button>
    </div>
</div>