@extends('master')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
@endpush
@section('content')
@include('breadcrump')
<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
          <form action="{{route('testcreate.update')}}" id="form" name="form" method="POST">
          @csrf
            <div class="card-header justify-content-between">
                <div class="card-title">
                    @yield('title', $page['title'] ?? '')
                </div>
                <div class="prism-toggle">
                    <button class="btn btn-sm btn-primary-light" form="form" type="submit">Değişiklikleri Kaydet<i
                            class="ri-save-line ms-2 d-inline-block align-middle"></i></button>
                </div>
            </div>
            <div class="card-body">
                    <div class="row">
                        <div class="form-group mb-3   col-md-12 ">
                            <label>Soru Metni</label>
                            <div class="row align-items-end">
                                <div class="">
                                   <input type="text" required="" class="form-control input-default" id=""
                                        name="question_text" value="{{ $page['row']->question }}">
                                </div>
                            </div>
                            <input type="hidden" name="answers_json" id="answers_json">
                            <input type="hidden" name="id" id="id" value="{{ $page['row']->id }}">
                        </div>
                        <div class="container">
                            <div id="form-container">
                              @foreach ($page['cevaplar'] as $cp)
                                <div class="form-group-wrapper mb-3"
                                    style="background: darkgrey; padding: 11px; border-radius: 15px;">
                                    <div class="row">
                                        <div class="form-group mb-3 col-md-4">
                                            <label>Cevap Metni</label>
                                            <input type="text" required class="form-control answer-text" value="{{$cp->text}}">
                                        </div>
                                        <div class="form-group mb-3 col-md-4">
                                            <label>Cevap Değeri</label>
                                            <input type="text" required class="form-control answer-value"
                                                value="{{$cp->value}}">
                                        </div>
                                        <div class="form-group mb-3 col-md-4">
                                            <label>Hizmet Kategorisi</label>
                                            <select class="form-control select answer-category">
                                                @foreach ($categories as $category)
                                                <option value="{{ $category['id'] }}" 
                                                 {{ $category['id'] == $cp->category ? 'selected' : '' }}>
                                                 {{ $category['name'] }}
                                               </option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                    <button type="button" class="btn btn-danger btn-sm remove-group">Sil</button>
                                </div>
                                @endforeach  
                            </div>
                            <button type="button" id="add-group" class="btn btn-primary mt-3">Cevap Ekle</button>
                        </div>
                    </div>
            </div>
         </form>
        </div>
    </div>
</div>
@push('javascript')
    @yield('add_javascript')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $("select").select2({
                placeholder: "<?= ___('Choose') ?>"
            });

            document.getElementById('add-group').addEventListener('click', function () {
                const formContainer = document.getElementById('form-container');
                const categories = @json($categories);
                let options = '';
                categories.forEach(function (category) {
                    options += `<option value="${category.id}">${category.name}</option>`;
                });

                const groupHtml = `
                    <div class="form-group-wrapper mb-3" style="background: darkgrey; padding: 11px; border-radius: 15px;">
                                <div class="row">
                                    <div class="form-group mb-3 col-md-4">
                                        <label>Cevap Metni</label>
                                        <input type="text" required class="form-control answer-text" name="question[]" value="">
                                    </div>
                                    <div class="form-group mb-3 col-md-4">
                                        <label>Cevap Değeri</label>
                                        <input type="text" required class="form-control answer-value" name="value[]" value="">
                                    </div>
                                    <div class="form-group mb-3 col-md-4">
                                        <label>Hizmet Kategorisi</label>
                                        <select class="form-control select answer-category" name="category[]">
                                          ${options}
                                        </select>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-danger btn-sm remove-group">Sil</button>
                            </div> `;

                formContainer.insertAdjacentHTML('beforeend', groupHtml);
            });

            $('#form-container').on('click', '.remove-group', function () {
                $(this).closest('.form-group-wrapper').remove();
            });

            document.getElementById('form').addEventListener('submit', function (e) {
                e.preventDefault();

                const formContainer = document.getElementById('form-container');
                const groups = formContainer.querySelectorAll('.form-group-wrapper');

                let answers = [];

                groups.forEach(group => {
                    const text = group.querySelector('.answer-text').value;
                    const value = group.querySelector('.answer-value').value;
                    const category = group.querySelector('.answer-category').value;

                    answers.push({
                        text: text,
                        value: value,
                        category: category
                    });
                });

                document.getElementById('answers_json').value = JSON.stringify(answers);

                this.submit();
            });



        });
    </script>
@endpush
@endsection