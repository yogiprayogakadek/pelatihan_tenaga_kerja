<div class="col-12">
    <div class="card mb-4">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    Data Participant
                </div>
                <div class="col-6 d-flex align-items-center">
                    <div class="m-auto"></div>
                    <button type="button" class="btn btn-outline-primary btn-data">
                        <i class="nav-icon i-Pen-2 font-weight-bold"></i> Data Class
                    </button>
                    <button type="button" class="btn btn-outline-success ml-3 btn-create-attendance" data-meeting-number="{{count(collect($attendance)->unique('meeting_number'))+1}}">
                        <i class="nav-icon i-Pen-2 font-weight-bold"></i> Create Attendance to-{{count(collect($attendance)->unique('meeting_number'))+1}}
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th rowspan="2" class="align-middle text-center">No</th>
                    <th rowspan="2" class="align-middle text-center">Name</th>
                    <th class="colspan text-center">Meeting</th>
                </tr>
                <tr>
                    {{-- @foreach ($participant as $key => $data) --}}
                    @foreach (collect($attendance)->unique('meeting_number') as $key => $att)
                        <td class="attendance text-center pointer btn-edit-attendance" data-meeting-number="{{$att->meeting_number}}" data-class-id="{{$att->class_id}}">
                            {{$att->meeting_number}}
                        </td>
                    @endforeach
                    {{-- @endforeach --}}
                </tr>
                <tbody>
                    @foreach ($participant as $participant)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$participant->name}}</td>
                            @foreach ($participant->attendance as $attendance)
                            <td class="text-center">
                                {{$attendance->is_attend == 1 ? 'Present' : 'Absence'}}
                            </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- <script>
    $('#tableData').DataTable({
        language: {
            paginate: {
                previous: "Previous",
                next: "Next"
            },
            info: "Showing _START_ to _END_ from _TOTAL_ data",
            infoEmpty: "Showing 0 to 0 from 0 data",
            lengthMenu: "Showing _MENU_ data",
            search: "Search:",
            emptyTable: "Data doesn't exists",
            zeroRecords: "Data doesn't match",
            loadingRecords: "Loading..",
            processing: "Processing...",
            infoFiltered: "(filtered from _MAX_ total data)"
        },
        lengthMenu: [
            [5, 10, 15, 20, -1],
            [5, 10, 15, 20, "All"]
        ],
    });
</script> --}}