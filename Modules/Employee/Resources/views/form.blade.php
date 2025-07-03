@extends('form')
@section('title') {{$page['title']}} @endsection
@section('css')
@endsection

@section('button')
    <button class="btn btn-sm btn-primary-light" form="form">{{ ___('Save') }}<i class="ri-save-line ms-2 d-inline-block align-middle"></i></button>
@endsection



@section('add_javascript')


    <script>


        $(document).ready(function () {
            let counter = 0;
            var form = $('.repeater');
            form.repeater({
                initEmpty: true,
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

        function get_stock(elem){
            var current = $('#current').val();
            var product = $(elem).val();
            $.ajax({
                url: _baseurl + "/manager/offer/getstock",
                type: "POST",
                dataType: 'json',

                data: {
                    current: current,
                    product: product,
                    _token: token
                },
                success: function success(response) {
                    var label = elem.previousElementSibling;
                    label.textContent = response;
                }
            });
        }

    </script>
    <script src="{{ asset('assets/js/jquery.repeater.min.js') }}"></script>

    {{--@include('backend.partials.tinymce')--}}

@endsection