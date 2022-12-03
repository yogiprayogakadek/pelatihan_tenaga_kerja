<div class="col-12">
    <div class="card mb-4">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    Data Attendance
                </div>
                <div class="col-6 d-flex align-items-center">
                    <div class="m-auto"></div>
                    <button type="button" class="btn btn-outline-primary btn-data">
                        <i class="nav-icon i-Pen-2 font-weight-bold"></i> Data
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th rowspan="2" class="align-middle text-center">No</th>
                    <th rowspan="2" class="align-middle text-center">Name</th>
                    <th class="text-center" colspan="{{count($participant->attendance)}}">Meeting</th>
                </tr>
                <tr>
                    {{-- @foreach ($participant as $key => $data) --}}
                    @foreach ($participant->attendance as $key => $att)
                        <td class="text-center">
                            {{$att->meeting_number}}
                        </td>
                    @endforeach
                    {{-- @endforeach --}}
                </tr>
                <tbody>
                    {{-- @foreach ($part as $value) --}}
                        <tr>
                            <td>1</td>
                            <td>{{$participant->name}}</td>
                            @foreach ($participant->attendance as $attendance)
                            <td class="text-center">
                                {{$attendance->is_attend == 1 ? 'Present' : 'Absence'}}
                            </td>
                            @endforeach
                        </tr>
                    {{-- @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>
</div>