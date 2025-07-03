    @push('css')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    @endpush

    <!-- Page Header Close -->
    <!-- Start::row-1 -->
    <div class="modal-body">
        <div class="row">
            @include('partials.form')
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">{{___('Cancel')}}</button>
        <button type="submit" form="form" class="btn btn-primary" >{{___('Save')}}</button>
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
