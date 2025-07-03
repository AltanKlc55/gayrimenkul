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
                <div class="card-body">
                    @yield('table')
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="orderDetail" tabindex="-1"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel1">{{___('Order Edit')}}</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"   aria-label="Close"></button>
                </div>

            </div>
        </div>
    </div>

    @push('javascript')


        <script>
            function OrderEdit(elem){
                var id = $(elem).data('id');
                $.ajax({
                    type: 'GET',
                    url: "./manager/order/edit/"+id,
                    data: {id:id},
                    dataType: 'json',
                    success: function(response){
                        $('#orderDetail .modal-content').append(response.html);
                        var myModal = new bootstrap.Modal(document.getElementById('orderDetail'));
                        myModal.show();
                    }
                });
            }



            document.addEventListener('DOMContentLoaded', function () {
                var myModal = document.getElementById('orderDetail');
                myModal.addEventListener('hide.bs.modal', function () {
                   location.reload()

                });
            });

        </script>


    @endpush
@endsection


