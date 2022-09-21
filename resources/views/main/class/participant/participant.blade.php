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
            <table class="table table-hover table-striped" id="tableParticipant">
                <thead>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>TTL</th>
                    <th>Jenis Kelamin</th>
                    <th>No. Hp</th>
                    <th>Foto</th>
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
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $('#tableParticipant').DataTable({
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