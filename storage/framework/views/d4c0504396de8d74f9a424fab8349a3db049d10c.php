<?php if(isset($page['multilang']) and $page['multilang'] == true): ?>
    <ul class="nav nav-tabs mb-3 border-0 <?= (count(conf_language()) > 1) ? '' : 'hidden' ?>" role="tablist">
        <?php $__currentLoopData = conf_language(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="nav-item" role="presentation">
                <a class="nav-link <?php echo e(($key == "0") ? "active" : ''); ?>" data-bs-toggle="tab" role="tab" href="#<?php echo e($lang->slug); ?>"aria-selected="true"><?php echo e($lang->name); ?></a>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </ul>
<?php endif; ?>
<form method="POST" id="form" action="<?php echo e($page['action']); ?>" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <?php if(isset($page['multilang']) and $page['multilang'] == true): ?>



        <div class="tab-content">
            <?php $__currentLoopData = conf_language(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="tab-pane <?php echo e(($key == "0") ? "show active" : ''); ?> text-muted" id="<?php echo e($lang->slug); ?>" role="tabpanel">
                    <div class="row">

                        <?php $__currentLoopData = $page['form']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $form): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(isset($form['multilang']) and $form['multilang'] == true): ?>
                                <?php switch($form['type']):
                                    case ('text'): ?>
                                        <?php if (isset($component)) { $__componentOriginal30600fd1d86901c8d1e2118fb7bb2cb7e3d1570f = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Forms\Input::class, ['type' => ''.e($form['type']).'','title' => ''.e($form['title']).'','name' => ''.e($form['name']).'','class' => ''.e($form['class']).'','grid' => ''.e($form['grid']).'','id' => ''.e($form['id']).'','readonly' => ''.e(isset($form['readonly']) ? $form['readonly'] : false).'','multilang' => ''.e(isset($form['multilang']) ? $form['multilang'] : false).'','lang' => ''.e(isset($lang->slug) ? $lang->slug : false).'','path' => ''.e(isset($form['path']) ?  $form['path'] : '').'','description' => ''.e(isset($form['description']) ? $form['description'] : '').'','required' => ''.e(isset($form['required']) ? $form['required'] : false).'','disabled' => ''.e(isset($form['disabled']) ? $form['disabled'] : false).'','filetype' => ''.e(isset($form['filetype']) ? $form['filetype']  : '').'','attribute' => ''.e(isset($form['attribute']) ?  $form['attribute'] : '').'','entry' => ''.e(isset($page['row']) ? getlanguage($page['row'][$form['name']],$lang->slug) : '').'']); ?>
<?php $component->withName('forms.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal30600fd1d86901c8d1e2118fb7bb2cb7e3d1570f)): ?>
<?php $component = $__componentOriginal30600fd1d86901c8d1e2118fb7bb2cb7e3d1570f; ?>
<?php unset($__componentOriginal30600fd1d86901c8d1e2118fb7bb2cb7e3d1570f); ?>
<?php endif; ?>
                                        <?php break; ?>
                                    <?php case ('textarea'): ?>
                                        <?php if (isset($component)) { $__componentOriginal582987c8de0d25188b5e8e44b2a5588ebcdc0b11 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Forms\Textarea::class, ['title' => ''.e($form['title']).'','name' => ''.e($form['name']).'','grid' => ''.e($form['grid']).'','lang' => ''.e(isset($lang->slug) ? $lang->slug : false).'','multilang' => ''.e(isset($form['multilang']) ? $form['multilang'] : false).'','entry' => ''.e(isset($page['row']) ? getlanguage($page['row'][$form['name']],$lang->slug) : '').'']); ?>
<?php $component->withName('forms.textarea'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal582987c8de0d25188b5e8e44b2a5588ebcdc0b11)): ?>
<?php $component = $__componentOriginal582987c8de0d25188b5e8e44b2a5588ebcdc0b11; ?>
<?php unset($__componentOriginal582987c8de0d25188b5e8e44b2a5588ebcdc0b11); ?>
<?php endif; ?>
                                        <?php break; ?>
                                <?php endswitch; ?>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


        </div>
    <?php endif; ?>
    <div class="col-md-12 pl-20 pr-20">

        <div class="row">
            <?php $__currentLoopData = $page['form']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $form): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(!isset($form['multilang']) or $form['multilang'] == false): ?>
                    <?php switch($form['type']):
                        case ('text'): ?>
                            <?php
                                $value = (isset($form['value'])) ? $form['value'] : '';
                            ?>
                            <?php if (isset($component)) { $__componentOriginal30600fd1d86901c8d1e2118fb7bb2cb7e3d1570f = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Forms\Input::class, ['type' => ''.e($form['type']).'','title' => ''.e($form['title']).'','name' => ''.e($form['name']).'','class' => ''.e($form['class']).'','grid' => ''.e($form['grid']).'','id' => ''.e($form['id']).'','readonly' => ''.e(isset($form['readonly']) ? $form['readonly'] : false).'','path' => ''.e(isset($form['path']) ?  $form['path'] : '').'','description' => ''.e(isset($form['description']) ? $form['description'] : '').'','required' => ''.e(isset($form['required']) ? $form['required'] : false).'','disabled' => ''.e(isset($form['disabled']) ? $form['disabled'] : false).'','filetype' => ''.e(isset($form['filetype']) ? $form['filetype']  : '').'','attribute' => ''.e(isset($form['attribute']) ?  $form['attribute'] : '').'','entry' => ''.e(isset($page['row']) ? $page['row'][$form['name']] : $value).'']); ?>
<?php $component->withName('forms.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal30600fd1d86901c8d1e2118fb7bb2cb7e3d1570f)): ?>
<?php $component = $__componentOriginal30600fd1d86901c8d1e2118fb7bb2cb7e3d1570f; ?>
<?php unset($__componentOriginal30600fd1d86901c8d1e2118fb7bb2cb7e3d1570f); ?>
<?php endif; ?>
                            <?php break; ?>
                        <?php case ('textvideo'): ?>
                            <?php
                                $value = (isset($form['value'])) ? $form['value'] : '';
                            ?>
                            <?php if (isset($component)) { $__componentOriginal30600fd1d86901c8d1e2118fb7bb2cb7e3d1570f = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Forms\Input::class, ['type' => ''.e($form['type']).'','title' => ''.e($form['title']).'','name' => ''.e($form['name']).'','class' => ''.e($form['class']).'','grid' => ''.e($form['grid']).'','id' => ''.e($form['id']).'','readonly' => ''.e(isset($form['readonly']) ? $form['readonly'] : false).'','path' => ''.e(isset($form['path']) ?  $form['path'] : '').'','description' => ''.e(isset($form['description']) ? $form['description'] : '').'','required' => ''.e(isset($form['required']) ? $form['required'] : false).'','disabled' => ''.e(isset($form['disabled']) ? $form['disabled'] : false).'','filetype' => ''.e(isset($form['filetype']) ? $form['filetype']  : '').'','attribute' => ''.e(isset($form['attribute']) ?  $form['attribute'] : '').'','entry' => ''.e(isset($page['row']) ? $page['row'][$form['name']] : $value).'']); ?>
<?php $component->withName('forms.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal30600fd1d86901c8d1e2118fb7bb2cb7e3d1570f)): ?>
<?php $component = $__componentOriginal30600fd1d86901c8d1e2118fb7bb2cb7e3d1570f; ?>
<?php unset($__componentOriginal30600fd1d86901c8d1e2118fb7bb2cb7e3d1570f); ?>
<?php endif; ?>
                            <?php break; ?>
                        <?php case ('date'): ?>
                            <?php if (isset($component)) { $__componentOriginal30600fd1d86901c8d1e2118fb7bb2cb7e3d1570f = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Forms\Input::class, ['type' => ''.e($form['type']).'','title' => ''.e($form['title']).'','name' => ''.e($form['name']).'','class' => ''.e($form['class']).'','grid' => ''.e($form['grid']).'','id' => ''.e($form['id']).'','readonly' => ''.e(isset($form['readonly']) ? $form['readonly'] : false).'','path' => ''.e(isset($form['path']) ?  $form['path'] : '').'','description' => ''.e(isset($form['description']) ? $form['description'] : '').'','required' => ''.e(isset($form['required']) ? $form['required'] : false).'','disabled' => ''.e(isset($form['disabled']) ? $form['disabled'] : false).'','filetype' => ''.e(isset($form['filetype']) ? $form['filetype']  : '').'','attribute' => ''.e(isset($form['attribute']) ?  $form['attribute'] : '').'','entry' => ''.e(isset($page['row']) ? $page['row'][$form['name']] : (isset($form['entry']) ? $form['entry'] : '')).'']); ?>
<?php $component->withName('forms.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal30600fd1d86901c8d1e2118fb7bb2cb7e3d1570f)): ?>
<?php $component = $__componentOriginal30600fd1d86901c8d1e2118fb7bb2cb7e3d1570f; ?>
<?php unset($__componentOriginal30600fd1d86901c8d1e2118fb7bb2cb7e3d1570f); ?>
<?php endif; ?>
                            <?php break; ?>
                        <?php case ('datetime-local'): ?>
                            <?php if (isset($component)) { $__componentOriginal30600fd1d86901c8d1e2118fb7bb2cb7e3d1570f = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Forms\Input::class, ['type' => ''.e($form['type']).'','title' => ''.e($form['title']).'','name' => ''.e($form['name']).'','class' => ''.e($form['class']).'','grid' => ''.e($form['grid']).'','id' => ''.e($form['id']).'','readonly' => ''.e(isset($form['readonly']) ? $form['readonly'] : false).'','path' => ''.e(isset($form['path']) ?  $form['path'] : '').'','description' => ''.e(isset($form['description']) ? $form['description'] : '').'','required' => ''.e(isset($form['required']) ? $form['required'] : false).'','disabled' => ''.e(isset($form['disabled']) ? $form['disabled'] : false).'','filetype' => ''.e(isset($form['filetype']) ? $form['filetype']  : '').'','attribute' => ''.e(isset($form['attribute']) ?  $form['attribute'] : '').'','entry' => ''.e(isset($page['row']) ? $page['row'][$form['name']] : (isset($form['entry']) ? $form['entry'] : '')).'']); ?>
<?php $component->withName('forms.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal30600fd1d86901c8d1e2118fb7bb2cb7e3d1570f)): ?>
<?php $component = $__componentOriginal30600fd1d86901c8d1e2118fb7bb2cb7e3d1570f; ?>
<?php unset($__componentOriginal30600fd1d86901c8d1e2118fb7bb2cb7e3d1570f); ?>
<?php endif; ?>
                            <?php break; ?>
                        <?php case ('checkbox'): ?>
                            <?php if (isset($component)) { $__componentOriginaldf5bb0e32b087bca724e42ed3cdc51682b267e1e = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Forms\Checkbox::class, ['title' => ''.e($form['title']).'','name' => ''.e($form['name']).'','grid' => ''.e($form['grid']).'','checked' => ''.e((isset($page['row']) and $page['row'][$form['name']] == 1) ? 'checked' : '').'','readonly' => ''.e(isset($form['readonly']) ? $form['readonly'] : false).'','required' => ''.e(isset($form['required']) ? $form['required'] : false).'','disabled' => ''.e(isset($form['disabled']) ? $form['disabled'] : false).'','attribute' => ''.e(isset($form['attribute']) ?  $form['attribute'] : '').'','entry' => ''.e(isset($page['row']) ? $page['row'][$form['name']] : '').'']); ?>
<?php $component->withName('forms.checkbox'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['type' => 'checkbox']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldf5bb0e32b087bca724e42ed3cdc51682b267e1e)): ?>
<?php $component = $__componentOriginaldf5bb0e32b087bca724e42ed3cdc51682b267e1e; ?>
<?php unset($__componentOriginaldf5bb0e32b087bca724e42ed3cdc51682b267e1e); ?>
<?php endif; ?>
                            <?php break; ?>
                        <?php case ('radio'): ?>
                            <?php if (isset($component)) { $__componentOriginald8738d15765d6b35d603018b407a63f14ee18785 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Forms\Radio::class, ['title' => ''.e($form['title']).'','name' => ''.e($form['name']).'','grid' => ''.e($form['grid']).'','checked' => ''.e((isset($page['row']) and $page['row'][$form['name']] == 1) ? 'checked' : '').'','readonly' => ''.e(isset($form['readonly']) ? $form['readonly'] : false).'','required' => ''.e(isset($form['required']) ? $form['required'] : false).'','disabled' => ''.e(isset($form['disabled']) ? $form['disabled'] : false).'','attribute' => ''.e(isset($form['attribute']) ?  $form['attribute'] : '').'','entry' => ''.e(isset($page['row']) ? $page['row'][$form['name']] : '').'']); ?>
<?php $component->withName('forms.radio'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['type' => 'radio']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald8738d15765d6b35d603018b407a63f14ee18785)): ?>
<?php $component = $__componentOriginald8738d15765d6b35d603018b407a63f14ee18785; ?>
<?php unset($__componentOriginald8738d15765d6b35d603018b407a63f14ee18785); ?>
<?php endif; ?>
                            <?php break; ?>
                        <?php case ('hidden'): ?>
                            <?php if (isset($component)) { $__componentOriginal30600fd1d86901c8d1e2118fb7bb2cb7e3d1570f = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Forms\Input::class, ['type' => ''.e($form['type']).'','title' => ''.e($form['title']).'','name' => ''.e($form['name']).'','class' => ''.e($form['class']).'','grid' => ''.e($form['grid']).'','id' => ''.e($form['id']).'','readonly' => ''.e(isset($form['readonly']) ? $form['readonly'] : false).'','path' => ''.e(isset($form['path']) ?  $form['path'] : '').'','description' => ''.e(isset($form['description']) ? $form['description'] : '').'','required' => ''.e(isset($form['required']) ? $form['required'] : false).'','disabled' => ''.e(isset($form['disabled']) ? $form['disabled'] : false).'','filetype' => ''.e(isset($form['filetype']) ? $form['filetype']  : '').'','attribute' => ''.e(isset($form['attribute']) ?  $form['attribute'] : '').'','entry' => ''.e(isset($page['row']) ? $page['row'][$form['name']] : $form['value']).'']); ?>
<?php $component->withName('forms.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal30600fd1d86901c8d1e2118fb7bb2cb7e3d1570f)): ?>
<?php $component = $__componentOriginal30600fd1d86901c8d1e2118fb7bb2cb7e3d1570f; ?>
<?php unset($__componentOriginal30600fd1d86901c8d1e2118fb7bb2cb7e3d1570f); ?>
<?php endif; ?>
                            <?php break; ?>
                        <?php case ('email'): ?>
                            <?php if (isset($component)) { $__componentOriginal30600fd1d86901c8d1e2118fb7bb2cb7e3d1570f = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Forms\Input::class, ['type' => ''.e($form['type']).'','title' => ''.e($form['title']).'','name' => ''.e($form['name']).'','class' => ''.e($form['class']).'','grid' => ''.e($form['grid']).'','id' => ''.e($form['id']).'','readonly' => ''.e(isset($form['readonly']) ? $form['readonly'] : false).'','path' => ''.e(isset($form['path']) ?  $form['path'] : '').'','description' => ''.e(isset($form['description']) ? $form['description'] : '').'','required' => ''.e(isset($form['required']) ? $form['required'] : false).'','disabled' => ''.e(isset($form['disabled']) ? $form['disabled'] : false).'','filetype' => ''.e(isset($form['filetype']) ? $form['filetype']  : '').'','attribute' => ''.e(isset($form['attribute']) ?  $form['attribute'] : '').'','entry' => ''.e(isset($page['row']) ? $page['row'][$form['name']] : '').'']); ?>
<?php $component->withName('forms.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal30600fd1d86901c8d1e2118fb7bb2cb7e3d1570f)): ?>
<?php $component = $__componentOriginal30600fd1d86901c8d1e2118fb7bb2cb7e3d1570f; ?>
<?php unset($__componentOriginal30600fd1d86901c8d1e2118fb7bb2cb7e3d1570f); ?>
<?php endif; ?>
                            <?php break; ?>
                        <?php case ('password'): ?>
                            <?php if (isset($component)) { $__componentOriginal30600fd1d86901c8d1e2118fb7bb2cb7e3d1570f = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Forms\Input::class, ['type' => ''.e($form['type']).'','title' => ''.e($form['title']).'','name' => ''.e($form['name']).'','class' => ''.e($form['class']).'','grid' => ''.e($form['grid']).'','id' => ''.e($form['id']).'','readonly' => ''.e(isset($form['readonly']) ? $form['readonly'] : false).'','path' => ''.e(isset($form['path']) ?  $form['path'] : '').'','description' => ''.e(isset($form['description']) ? $form['description'] : '').'','required' => ''.e(isset($form['required']) ? $form['required'] : false).'','disabled' => ''.e(isset($form['disabled']) ? $form['disabled'] : false).'','filetype' => ''.e(isset($form['filetype']) ? $form['filetype']  : '').'','attribute' => ''.e(isset($form['attribute']) ?  $form['attribute'] : '').'','entry' => ''.e(isset($page['row']) ? $page['row'][$form['name']] : '').'']); ?>
<?php $component->withName('forms.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal30600fd1d86901c8d1e2118fb7bb2cb7e3d1570f)): ?>
<?php $component = $__componentOriginal30600fd1d86901c8d1e2118fb7bb2cb7e3d1570f; ?>
<?php unset($__componentOriginal30600fd1d86901c8d1e2118fb7bb2cb7e3d1570f); ?>
<?php endif; ?>
                            <?php break; ?>
                        <?php case ('textarea'): ?>
                            <?php if (isset($component)) { $__componentOriginal582987c8de0d25188b5e8e44b2a5588ebcdc0b11 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Forms\Textarea::class, ['title' => ''.e($form['title']).'','name' => ''.e($form['name']).'','grid' => ''.e($form['grid']).'','entry' => ''.e(isset($page['row']) ? $page['row'][$form['name']] : '').'']); ?>
<?php $component->withName('forms.textarea'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal582987c8de0d25188b5e8e44b2a5588ebcdc0b11)): ?>
<?php $component = $__componentOriginal582987c8de0d25188b5e8e44b2a5588ebcdc0b11; ?>
<?php unset($__componentOriginal582987c8de0d25188b5e8e44b2a5588ebcdc0b11); ?>
<?php endif; ?>
                            <?php break; ?>
                        <?php case ('select'): ?>


                            <?php if (isset($component)) { $__componentOriginalaa9e2e00dcec6b58db49b9128f7191370bc93381 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Forms\Select::class, ['title' => ''.e($form['title']).'','name' => ''.e($form['name']).'','class' => ''.e($form['class']).'','grid' => ''.e($form['grid']).'','options' => $form['option'],'id' => ''.e($form['id']).'','child' => ''.e($form['child']).'','format' => ''.e($form['format']).'','tags' => ''.e(isset($form['tags']) ? $form['tags'] : false).'','selected' => ''.e(isset($form['selected']) ? $form['selected'] : (isset($page['row']) ? $page['row'][$form['name']] : '')).'','readonly' => ''.e(isset($form['readonly']) ? $form['readonly'] : false).'','multiple' => ''.e(isset($form['multiple']) ? $form['multiple'] : false).'','description' => ''.e(isset($form['description']) ? $form['description'] : '').'','required' => ''.e(isset($form['required']) ? $form['required'] : false).'','attribute' => ''.isset($form['attribute']) ?  $form['attribute'] : ''.'']); ?>
<?php $component->withName('forms.select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['data-selected' => ''.e(isset($page['row']) ? $page['row'][$form['name']] : '').'','disabled' => ''.e(isset($form['disabled']) ? $form['disabled'] : false).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalaa9e2e00dcec6b58db49b9128f7191370bc93381)): ?>
<?php $component = $__componentOriginalaa9e2e00dcec6b58db49b9128f7191370bc93381; ?>
<?php unset($__componentOriginalaa9e2e00dcec6b58db49b9128f7191370bc93381); ?>
<?php endif; ?>



                            <?php break; ?>
                        <?php case ('select_json'): ?>
                            <?php if (isset($component)) { $__componentOriginalaa9e2e00dcec6b58db49b9128f7191370bc93381 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Forms\Select::class, ['title' => ''.e($form['title']).'','name' => ''.e($form['name']).'','class' => ''.e($form['class']).'','grid' => ''.e($form['grid']).'','options' => $form['option'],'id' => ''.e($form['id']).'','child' => ''.e($form['child']).'','format' => ''.e($form['format']).'','tags' => ''.e(isset($form['tags']) ? $form['tags'] : false).'','readonly' => ''.e(isset($form['readonly']) ? $form['readonly'] : false).'','multiple' => ''.e(isset($form['multiple']) ? $form['multiple'] : false).'','description' => ''.e(isset($form['description']) ? $form['description'] : '').'','required' => ''.e(isset($form['required']) ? $form['required'] : false).'','attribute' => ''.e(isset($form['attribute']) ?  $form['attribute'] : '').'','selected' => isset($page['row']) ? json_decode($page['row'][$form['name']],true) : array()]); ?>
<?php $component->withName('forms.select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['disabled' => ''.e(isset($form['disabled']) ? $form['disabled'] : false).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalaa9e2e00dcec6b58db49b9128f7191370bc93381)): ?>
<?php $component = $__componentOriginalaa9e2e00dcec6b58db49b9128f7191370bc93381; ?>
<?php unset($__componentOriginalaa9e2e00dcec6b58db49b9128f7191370bc93381); ?>
<?php endif; ?>
                            <?php break; ?>
                        <?php case ('category'): ?>
                            <x-forms.category
                                    title="<?php echo e($form['title']); ?>"
                                    name="<?php echo e($form['name']); ?>"
                                    class="<?php echo e($form['class']); ?>"
                                    grid="<?php echo e($form['grid']); ?>"
                                    :options="$form['option']"
                                    id="<?php echo e($form['id']); ?>"
                                    format="<?php echo e($form['format']); ?>"
                                    child="<?php echo e(isset($form['child']) ? $form['child'] : "name"); ?>"
                                    tags="<?php echo e(isset($form['tags']) ? $form['tags'] : false); ?>"
                                    selected="<?php echo e(isset($page['row']) ? $page['row'][$form['name']] : ''); ?>"
                                    readonly="<?php echo e(isset($form['readonly']) ? $form['readonly'] : false); ?>"
                                    multiple="<?php echo e(isset($form['multiple']) ? $form['multiple'] : false); ?>"
                                    description="<?php echo e(isset($form['description']) ? $form['description'] : ''); ?>"
                                    required="<?php echo e(isset($form['required']) ? $form['required'] : false); ?>"
                                    disabled="<?php echo e(isset($form['disabled']) ? $form['disabled'] : false); ?>"
                                    attribute="<?php echo e(isset($form['attribute']) ?  $form['attribute'] : ''); ?>"
                            />

                            <?php break; ?>
                        <?php case ('number'): ?>
                            <?php if (isset($component)) { $__componentOriginal30600fd1d86901c8d1e2118fb7bb2cb7e3d1570f = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Forms\Input::class, ['type' => ''.e($form['type']).'','title' => ''.e($form['title']).'','name' => ''.e($form['name']).'','class' => ''.e($form['class']).'','grid' => ''.e($form['grid']).'','readonly' => ''.e(isset($form['readonly']) ? $form['readonly'] : false).'','path' => ''.e(isset($form['path']) ?  $form['path'] : '').'','description' => ''.e(isset($form['description']) ? $form['description'] : '').'','required' => ''.e(isset($form['required']) ? $form['required'] : false).'','disabled' => ''.e(isset($form['disabled']) ? $form['disabled'] : false).'','filetype' => ''.e(isset($form['filetype']) ? $form['filetype']  : '').'','attribute' => ''.e(isset($form['attribute']) ?  $form['attribute'] : '').'','entry' => ''.e(isset($page['row']) ? $page['row'][$form['name']] : '').'']); ?>
<?php $component->withName('forms.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal30600fd1d86901c8d1e2118fb7bb2cb7e3d1570f)): ?>
<?php $component = $__componentOriginal30600fd1d86901c8d1e2118fb7bb2cb7e3d1570f; ?>
<?php unset($__componentOriginal30600fd1d86901c8d1e2118fb7bb2cb7e3d1570f); ?>
<?php endif; ?>
                            <?php break; ?>
                        <?php case ('file'): ?>
                            <?php if (isset($component)) { $__componentOriginal30600fd1d86901c8d1e2118fb7bb2cb7e3d1570f = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Forms\Input::class, ['type' => ''.e($form['type']).'','title' => ''.e($form['title']).'','name' => ''.e($form['name']).'','class' => ''.e($form['class']).'','grid' => ''.e($form['grid']).'','id' => ''.e($form['id']).'','readonly' => ''.e(isset($form['readonly']) ? $form['readonly'] : false).'','path' => ''.e(isset($form['path']) ?  $form['path'] : '').'','description' => ''.e(isset($form['description']) ? $form['description'] : '').'','required' => ''.e(isset($form['required']) ? $form['required'] : false).'','disabled' => ''.e(isset($form['disabled']) ? $form['disabled'] : false).'','filetype' => ''.e(isset($form['filetype']) ? $form['filetype']  : '').'','attribute' => ''.e(isset($form['attribute']) ?  $form['attribute'] : '').'','entry' => ''.e(isset($page['row']) ? $page['row'][$form['name']] : '').'']); ?>
<?php $component->withName('forms.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal30600fd1d86901c8d1e2118fb7bb2cb7e3d1570f)): ?>
<?php $component = $__componentOriginal30600fd1d86901c8d1e2118fb7bb2cb7e3d1570f; ?>
<?php unset($__componentOriginal30600fd1d86901c8d1e2118fb7bb2cb7e3d1570f); ?>
<?php endif; ?>
                            <?php break; ?>

                    <?php endswitch; ?>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    <?php if(isset($page['repeater']) and !empty($page['repeater'])): ?>
        <?php echo $__env->make('partials.repeater', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
</form><?php /**PATH C:\Users\astok\Desktop\private_real_estate\resources\views/partials/form.blade.php ENDPATH**/ ?>