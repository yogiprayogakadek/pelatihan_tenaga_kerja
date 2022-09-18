<div class="col-12">
    <div class="card mb-4">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    Data Training Kelas
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
                    <th>Kategori</th>
                    <th>Nama</th>
                    <th>Deskripsi</th>
                    <th>Assessor</th>
                    <th>Peserta</th>
                    <th>Absensi</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                    @foreach ($class as $class)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$class->category}}</td>
                        <td>{{$class->name}}</td>
                        <td>{{$class->description}}</td>
                        <td>{{$class->assessor->name}}</td>
                        <td>
                            <span class="pointer btn-participant badge badge-primary" data-id="{{$class->id}}">Lihat</span>
                        </td>
                        <td>
                            <span class="pointer btn-attendance badge badge-primary" data-id="{{$class->id}}">Lihat Absensi</span>
                        </td>
                        <td>
                            <i class="nav-icon i-Pen-2 font-weight-bold btn-edit text-success mr-2 pointer" data-id="{{$class->id}}"></i>
                            <i class="nav-icon i-Close-Window font-weight-bold btn-delete text-danger pointer" data-id="{{$class->id}}"></i>
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