@extends('master')
@section('content')

    @include('breadcrump')



    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        @yield('title', $page['title'] ?? '')
                    </div>
                    <div class="prism-toggle">
                        <button class="btn btn-sm btn-primary-light" form="form">{{___('Save')}}<i class="ri-save-line ms-2 d-inline-block align-middle"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" id="form" action="{{route('haspermission.store',$page['role'])}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
{{--                             <pre>--}}
{{--                                                   @php--}}
{{--                                                       print_r($page['roles'])--}}
{{--                                                   @endphp--}}
{{--                                                        </pre>--}}
                            @foreach($page['roles'] as $key => $row)


                                <div class="col-xl-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <strong><?= ___($key) ?></strong>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="row">
                                                @foreach($row as $keys => $item)
                                                    <div class="col-2">
                                                        <div class="custom-toggle-switch d-flex align-items-center mb-4">
                                                            <input id="toggleswitch<?= $key.$item['group'].$keys ?>" name="permissions[<?= $key ?>][]" value="<?= $item['group_control'] ?>" type="checkbox" {{has_permission($page['role'],$key,$item['group_control']) ? 'checked' : ''}} >
                                                            <label for="toggleswitch<?= $key.$item['group'].$keys ?>" class="label-primary"></label><span class="ms-3"><?= ___($item['name']) ?></span>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection