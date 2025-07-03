@extends('form')
@section('title') {{$page['title']}} @endsection
@section('css')
@endsection

@section('button')
    <button class="btn btn-sm btn-primary-light" form="form">Kaydet<i class="ri-save-line ms-2 d-inline-block align-middle"></i></button>
@endsection



@section('add_javascript')


        <script>
            $(document).ready(function () {
                @if(!isset($row['id']))   let counter = 0; @else  let counter = 1000; @endif

                var form = $('.repeater');
                form.repeater({
                    @if(!isset($row['id']))  initEmpty: true, @endif
                    show: function() {
                        $(this).slideDown();
                        // Benzersiz ID atama
                        counter++;
                        $(this).attr('id', 'elem-'+counter);
                        $(this).find('.item-id').attr('data-id', 'elem-'+counter);
                    },
                });
            });

            $(document).ready(function() {
                $('.repeater').on('click', '[data-repeater-create]', function() {
                    $("select").select2({
                        placeholder: "<?= ___('Choose') ?>"
                    });
                    $(".currency").on({
                        keyup: function() {
                            formatCurrency($(this));
                        },
                        blur: function() {
                            formatCurrency($(this), "blur");
                        }
                    });
                });
            });
            function getaddress(elem){
                var id = $(elem).val();
                $.ajax({
                    type: "post",
                    url: "",
                    data: {id:id,_token:"{{ csrf_token() }}"},
                    dataType: 'json',
                    success: function(json){
                        if(json['success']){
                            $('#qtyprd').val(json['success']);
                        }
                    }
                });
            }
            function get_product(elem){
                var product = $(elem).val();
                var elemid = $(elem).data('id');
                var currency = $('#currency').val();
                $.ajax({
                    url: "{{route('offer.get_product')}}",
                    type: "POST",
                    dataType: 'json',
                    data: {
                        currency: currency,
                        product: product,
                        _token: token
                    },
                    success: function success(response) {
                        if(response){
                            $("#"+elemid+" .unit_price").val(response.price);

                            $("#"+elemid+" .unit").val(response.unit).trigger('change');
                        }
                    }
                });
            }

            function get_address(elem){
                var elemid = $(elem).val();
                $.ajax({
                    url: "{{route('offer.get_address')}}",
                    type: "POST",
                    dataType: 'json',
                    data: {
                        id: elemid,
                        _token: token
                    },
                    success: function success(response) {
                        if(response){
                            $("#addres").html(response);
                        }
                    }
                });
            }
            function get_person(elem){
                var elemid = $(elem).val();
                $.ajax({
                    url: "{{route('offer.get_person')}}",
                    type: "POST",
                    dataType: 'json',
                    data: {
                        id: elemid,
                        _token: token
                    },
                    success: function success(response) {
                        if(response){
                            $("#person").html(response);
                        }
                    }
                });
            }

            function get_product_unit(elem){
                var elemid = $(elem).data('id');
                var unit = $(elem).val();
                var product = $("#"+elemid+' #product').val();
                var money = $("#"+elemid+' #qtyprd').val();

                $.ajax({
                    url: "{{route('offer.get_product_unit')}}",
                    type: "POST",
                    dataType: 'json',
                    data: {
                        product: product,
                        money: money,
                        unit: unit,
                        _token: token
                    },
                    success: function success(response) {
                        if(response){
                            $("#"+elemid+" .unit_price").val(response.price);
                        }
                    }
                });
            }
        </script>
        <script src="{{ asset('assets/js/jquery.repeater.min.js') }}"></script>

    {{--@include('backend.partials.tinymce')--}}

@endsection