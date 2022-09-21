@extends('templates.master')

@section('page-title', 'Absensi')
@section('page-sub-title', 'Data')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            Data Absensi
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th rowspan="2" class="align-middle text-center">No</th>
                            <th rowspan="2" class="align-middle text-center">Nama</th>
                            <th class="text-center" colspan="{{count($participant->attendance)}}">Pertemuan</th>
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
                                        {{$attendance->is_attend == 1 ? 'H' : 'A'}}
                                    </td>
                                    @endforeach
                                </tr>
                            {{-- @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection