<div class="col-12">
    <div class="card mb-4">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    Data Assessor
                </div>
                <div class="col-6 d-flex align-items-center">
                    <div class="m-auto"></div>
                    <button type="button" class="btn btn-outline-primary btn-add">
                        <i class="nav-icon i-Pen-2 font-weight-bold"></i> Tambah
                    </button>
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
                    <th>Aksi</th>
                </thead>
                <tbody>
                    @foreach ($assessor as $assessor)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$assessor->name}}</td>
                        <td>{{$assessor->address}}</td>
                        <td>{{$assessor->place_of_birth}}, {{$assessor->date_of_birth}}</td>
                        <td>{{$assessor->gender == 1 ? 'Laki - Laki' : 'Perempuan'}}</td>
                        <td>{{$assessor->phone}}</td>
                        <td class="text-center"><img src="{{asset($assessor->user->image)}}" width="80px" class="img-rounded"></td>
                        <td>
                            <i class="nav-icon i-Pen-2 font-weight-bold btn-edit text-success mr-2 pointer" data-id="{{$assessor->id}}"></i>
                            <i class="nav-icon i-Close-Window font-weight-bold btn-delete text-danger pointer" data-id="{{$assessor->id}}"></i>
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