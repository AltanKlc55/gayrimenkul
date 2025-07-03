@extends('master')
@include('breadcrump')
@section('content')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />


    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        @yield('title', $page['title'] ?? '')


                    </div>
                    <div class="prism-toggle">

                    </div>
                </div>
                <div class="card-body">

                    <form id="notificationForm" action="{{ route('send.notification') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="notification_type" class="form-label">Notification Type</label>
                            <select class="form-select" name="notification_type" id="notification_type" required>
                                <option value="all">All Employees</option>
                                <option value="group">By Group</option>
                                <option value="individual">Individual Employees</option>
                            </select>
                        </div>

                        <div id="group_ids_container" class="mb-3" style="display:none;">
                            <label for="group_ids" class="form-label">Select Group</label>
                            <select class="form-select" name="group_ids[]" id="group_ids">
                                @foreach (get_definitions('groups') as $group)
                                    <option value="{{ $group['id'] }}">{{ $group['title'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div id="employee_ids_container" class="mb-3" style="display:none;">
                            <label for="employee_ids" class="form-label">Select Employees</label>
                            <select class="form-select select2" name="employee_ids[]" id="employee_ids" multiple>
                                @foreach (Modules\Employee\Entities\Employee::all() as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->name }} {{ $employee->surname }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" name="message" id="message" rows="3" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Send Notification</button>
                    </form>

                </div>
            </div>
        </div>
    </div>












<!-- Include jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Include Select2 JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize Select2 for employee select
        $('.select2').select2();

        $('#notification_type').change(function() {
            var value = $(this).val();
            $('#group_ids_container').toggle(value === 'group');
            $('#employee_ids_container').toggle(value === 'individual');
        });
    });
</script>
@endsection