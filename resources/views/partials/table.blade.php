@push('css')
    <link href="{{asset('../assets/libs/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>
@endpush
@push('javascript')
    <script src='{{asset("../assets/libs/datatables/js/jquery.dataTables.min.js")}}'  type="text/javascript"></script>



    <script>
        $(document).ready(function() {
            $('#globaltable').DataTable( {
                "ajax": {
                    'url': '{{$page['table']}}',
                    @if(isset($page['table_query']) and !empty($page['table_query']))
                    "data": @json($page['table_query']),
                    @endif
                },
                // "processing": true,
                //  "serverSide": true,

                'bProcessing': true,
                'bJQueryUI': true,
                'order': [[ 1, "asc" ]],
                "scrollX": true,
                'language': {
                    'url': '{{asset("../assets/libs/datatables/tr.json")}}'
                },
                "initComplete": function(  ) {
                    $('[data-toggle="tooltip"]').tooltip()
                }
            } );
        } );

        function tableupdate(){
            $('.globaltable').DataTable().ajax.reload();
        }

    </script>



@endpush


@section('table')
<div class="table-responsive">
    <table id="globaltable" class="table globaltable table-striped  table-bordered text-nowrap w-100 dataTable no-footer" aria-describedby="datatable-basic_info">
        <thead>
        <tr>
            @foreach($page['tablerow'] as $thead)
                <th>{{$thead['title']}}</th>
            @endforeach
        </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>
@endsection