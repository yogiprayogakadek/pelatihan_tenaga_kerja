<div class="col-12">
    <div class="card mb-4">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    Data Peserta
                </div>
                <div class="col-6 d-flex align-items-center">
                    <div class="m-auto"></div>
                    <button type="button" class="btn btn-outline-primary btn-data">
                        <i class="nav-icon i-Pen-2 font-weight-bold"></i> Data Kelas
                    </button>
                    <button type="button" class="btn btn-outline-success ml-3 btn-create-attendance" data-meeting-number="{{count(collect($attendance)->unique('meeting_number'))+1}}">
                        <i class="nav-icon i-Pen-2 font-weight-bold"></i> Buat Absensi Ke-{{count(collect($attendance)->unique('meeting_number'))+1}}
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th rowspan="2" class="align-middle text-center">No</th>
                    <th rowspan="2" class="align-middle text-center">Nama</th>
                    <th class="colspan text-center">Pertemuan</th>
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
                                {{$attendance->is_attend == 1 ? 'H' : 'A'}}
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
                previous: "Sebelumnya",
                next: "Selanjutnya"
            },
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
            lengthMenu: "Menampilkan _MENU_ data",
            search: "Cari:",
            emptyTable: "Tidak ada data tersedia",
            zeroRecords: "Tidak ada data yang cocok",
            loadingRecords: "Memuat data...",
            processing: "Memproses...",
            infoFiltered: "(difilter dari _MAX_ total data)"
        },
        lengthMenu: [
            [5, 10, 15, 20, -1],
            [5, 10, 15, 20, "All"]
        ],
    });
</script> --}}