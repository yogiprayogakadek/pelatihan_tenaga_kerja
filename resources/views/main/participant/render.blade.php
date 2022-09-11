<div class="col-12">
    <div class="card mb-4">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    Data Peserta
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-hover table-striped" id="tableData">
                <thead>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>TTL</th>
                    <th>Jenis Kelamin</th>
                    <th>No. Hp</th>
                    <th>Foto</th>
                    <th>Dokumen</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                    @foreach ($participant as $participant)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$participant->name}}</td>
                        <td>{{$participant->address}}</td>
                        <td>{{$participant->place_of_birth}}, {{$participant->date_of_birth}}</td>
                        <td>{{$participant->gender == 1 ? 'Laki - Laki' : 'Perempuan'}}</td>
                        <td>{{$participant->phone}}</td>
                        <td class="text-center"><img src="{{asset($participant->user->image)}}" width="80px" class="img-rounded"></td>
                        {{-- <td>{{$participant->documents == null ? 'Belum ada dokumen yang di unggah' : 'Lihat'}}</td> --}}
                        <td>
                            @php
                                $count = array_count_values(json_decode($participant->documents, true))['empty'] ?? 0
                            @endphp
                            {{$count == 8 ? 'Belum ada data yang di unggah' : ($count == 0 ? 'Lihat' : 'Dokumen belum lengkap')}}
                        </td>
                        <td>-</td>
                        <td>
                            <i class="nav-icon i-Pen-2 font-weight-bold btn-edit text-success mr-2 pointer" data-id="{{$participant->id}}"></i>
                            <i class="nav-icon i-Close-Window font-weight-bold btn-delete text-danger pointer" data-id="{{$participant->id}}"></i>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
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
</script>