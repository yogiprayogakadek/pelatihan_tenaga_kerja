<div class="col-12">
    <div class="card mb-4">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    Data Training Class
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
            <table class="table table-hover table-striped" id="tableData">
                <thead>
                    <th>No</th>
                    <th>Category</th>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Assessor</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach ($class as $class)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$class->category}}</td>
                        <td>{{$class->code}}</td>
                        <td>{{$class->name}}</td>
                        <td>{{$class->description}}</td>
                        <td>{{$class->assessor->name ?? '-'}}</td>
                        <td>
                            @if (!in_array($class->id, $alreadyRegis))
                            <span class="pointer btn-join badge badge-primary" data-id="{{$class->id}}">Join Class</span>
                            @else
                            <span class="pointer badge badge-info" data-id="{{$class->id}}">Joined</span>
                            @endif
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
</script>