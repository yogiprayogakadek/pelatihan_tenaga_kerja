<div class="col-12">
    <div class="card mb-4">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <span class="attendance-title">Data Attendance</span>
                </div>
                <div class="col-6 d-flex align-items-center">
                    <div class="m-auto"></div>
                    <button type="button" class="btn btn-outline-primary btn-attendance">
                        <i class="nav-icon i-Pen-2 font-weight-bold"></i> Data Attendance
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form id="formAttendance">
                @csrf
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th rowspan="2" class="align-middle text-center">No</th>
                            <th rowspan="2" class="align-middle text-center">Name</th>
                            <th class="text-center" colspan="2">Description</th>
                        </tr>
                        <tr>
                            <td class="text-center">Present</td>
                            <td class="text-center">Absence</td>
                        </tr>
                    </thead>
                    <tbody>
                        <input type="hidden" name="class_id" id="class_id">
                        <input type="hidden" name="meeting_number" id="meeting_number">
                        @foreach ($participant as $participant)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$participant->name}}</td>
                                <td class="text-center">
                                    <input type="radio" name="attendance_{{$loop->iteration}}" data-participant="{{$participant->id}}" value="1" class="attendance" {{array_key_exists($participant->id, $att) ? ($att[$participant->id] == 1 ? 'checked' : '') : 'checked'}}>
                                </td>
                                <td class="text-center">
                                    <input type="radio" name="attendance_{{$loop->iteration}}" data-participant="{{$participant->id}}" value="0" class="attendance" {{array_key_exists($participant->id, $att) ? ($att[$participant->id] == 0 ? 'checked' : '') : 'checked'}}>
                                </td>
                                {{-- @foreach ($participant->attendance as $attendance)
                                <td class="text-center">
                                    {{$attendance->is_attend == 1 ? 'Present' : 'Absence'}}
                                </td>
                                @endforeach --}}
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-center">
                                <span class="text-muted">
                                    <i>Makesure all of data have you entered are according to participant attendance</i>
                                </span>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-primary btn-process-attendance" type="button">
                                    <i class="fa fa-save"></i> Save
                                </button>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </form>
        </div>
    </div>
</div>
