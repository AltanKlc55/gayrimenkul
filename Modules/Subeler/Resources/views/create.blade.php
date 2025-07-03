@extends('master')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <link href="{{asset('../assets/libs/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
@endpush
@push('javascript')
    <script src='{{asset("../assets/libs/datatables/js/jquery.dataTables.min.js")}}' type="text/javascript"></script>

@endpush

@section('content')
@include('breadcrump')
<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <form action="{{route('ilanlar.store')}}" id="form" name="form" method="POST">
                @csrf
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        @yield('title', $page['title'] ?? '')
                    </div>
                    <div class="prism-toggle">
                        <button class="btn btn-sm btn-primary-light" form="form" type="submit">Kaydet<i
                                class="ri-save-line ms-2 d-inline-block align-middle"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="form-group mb-3 col-md-6">
                                    <label>İlan Başlığı</label>
                                    <input type="text" name="test_name" required class="form-control answer-text"
                                        value="">
                                </div>
                                <input type="hidden" name="selected_values" id="selected_values" value="">
                                <div class="form-group mb-3 col-md-6">
                                    <label>İlan Açıklaması</label>
                                    <input type="text" name="test_description" required
                                        class="form-control answer-value" value="">
                                </div>
                                <div class="form-group mb-3 col-md-6">
                                    <label>İlan Kategorisi</label>
                                    <select class="select form-control" name="category" id="category">
                                        <option value="test">TEST</option>
                                        <option value="test">TEST</option>
                                        <option value="test">TEST</option>
                                        <option value="test">TEST</option>
                                        <option value="test">TEST</option>
                                    </select>
                                </div>

                                <div id="question_zone">

                                </div>

                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    Gayrimenkule Özellik Ekle
                                </button>

                                <div class="modal fade" id="exampleModal" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Soru Ekle</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">



                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Kapat</button>
                                                <button type="button" class="btn btn-primary save_question_test"
                                                    data-bs-dismiss="modal">Seçili Olanları ekle</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="container">
                                <div id="form-container">
                                    <div class="form-group-wrapper mb-3"
                                        style="background: darkgrey; padding: 11px; border-radius: 15px;">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal">
                                                    Görsel Seç
                                                </button>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-danger btn-sm remove-group">Sil</button>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="button" id="add-group" class="btn btn-primary mt-3">+ Görsel</button>
                                </div>
                            </div>
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
            var table = $('#globaltable').DataTable({
                'bProcessing': true,
                'bJQueryUI': true,
                'order': [[1, "asc"]],
                "scrollX": true,
                'language': {
                    'url': '{{asset("../assets/libs/datatables/tr.json")}}'
                },
                "initComplete": function () {
                    $('[data-toggle="tooltip"]').tooltip();
                }
            });

            $('#exampleModal').on('shown.bs.modal', function () {
                table.columns.adjust().draw();
            });

            $('.save_question_test').on('click', function () {
                var selectedValues = [];
                $('.table_check:checked').each(function () {
                    selectedValues.push($(this).val());
                });
                console.log(selectedValues);
                $('#selected_values').val(selectedValues);

                $.ajax({
                    url: '{{route('test.test_question_filtered')}}',
                    method: 'POST',
                    data: {
                        ids: selectedValues,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        var tableBody = $('#question_zone');
                        tableBody.empty();
                        var questions = [];

                        response.data.forEach(function (item) {
                            var answersHtml = '';
                            var answersArray = [];
                            if (typeof item.answers_json === 'string') {
                                try {
                                    answersArray = JSON.parse(item.answers_json);
                                } catch (e) {
                                    console.error("JSON parse hatası:", e);
                                }
                            } else if (Array.isArray(item.answers_json)) {
                                answersArray = item.answers_json;
                            }

                            answersArray.forEach(function (answer) {
                                answersHtml += `
                                <p>${answer.text} - Cevap Puanı = ${answer.value}</p>`;
                            });

                            tableBody.append(`
                                 <div class="card mb-3">
                                     <div class="card-header">
                                         <strong>Soru:</strong> ${item.question}
                                     </div>
                                     <div class="card-body">
                                         ${answersHtml}
                                     </div>
                                 </div>
                             `);
                        });
                    },
                    error: function (xhr) {
                        console.error(xhr.responseText);
                        alert('Veriler getirilirken bir hata oluştu.');
                    }
                });
            })

            document.getElementById('add-group').addEventListener('click', function () {
                const formContainer = document.getElementById('form-container');
                const groupHtml = `
                                 <div class="form-group-wrapper mb-3"
                            style="background: darkgrey; padding: 11px; border-radius: 15px;">
                            <div class="row">
                                <div class="form-group mb-3 col-md-6">
                                    <label>Minimum Puan</label>
                                    <input type="text" required class="form-control min_point" value="">
                                </div>
                                <div class="form-group mb-3 col-md-6">
                                    <label>Maksimum Puan</label>
                                    <input type="text" required class="form-control max_point"
                                        value="">
                                </div>
                                <div class="form-group mb-3 col-md-12">
                                    <label>Sonuç Açıklaması</label>
                                    <input type="text" required class="form-control result_description" value="">
                                </div>

                            </div>
                            <button type="button" class="btn btn-danger btn-sm remove-group">Sil</button>
                        </div>`;

                formContainer.insertAdjacentHTML('beforeend', groupHtml);
            });

            $('#form-container').on('click', '.remove-group', function () {
                $(this).closest('.form-group-wrapper').remove();
            });

            document.getElementById('form').addEventListener('submit', function (e) {
                e.preventDefault();

                const formContainer = document.getElementById('form-container');
                const groups = formContainer.querySelectorAll('.form-group-wrapper');

                let points = [];

                groups.forEach(group => {
                    const min_point = group.querySelector('.min_point').value;
                    const max_point = group.querySelector('.max_point').value;
                    const result_description = group.querySelector('.result_description').value;

                    points.push({
                        min_point: min_point,
                        max_point: max_point,
                        result_description: result_description
                    });
                });

                document.getElementById('points_json').value = JSON.stringify(points);
                this.submit();
            });

        });
    </script>
@endpush
@endsection