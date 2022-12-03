<div class="col-12">
    <div class="card mb-4">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    Data Training Class
                </div>
                @can('admin')
                <div class="col-6 d-flex align-items-center">
                    <div class="m-auto"></div>
                    <button type="button" class="btn btn-outline-primary btn-add">
                        <i class="nav-icon i-Pen-2 font-weight-bold"></i> Add
                    </button>
                </div>
                @endcan
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
                    <th>Participant</th>
                    <th>Attendance</th>
                    <th>Status</th>
                    @can('admin')
                    <th>Action</th>
                    @endcan
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
                            <span class="pointer btn-participant badge badge-primary" data-id="{{$class->id}}">View</span>
                        </td>
                        <td>
                            <span class="pointer btn-attendance badge badge-primary" data-id="{{$class->id}}">View Attendance</span>
                        </td>
                        <td>{{$class->status == true ? 'Active' : 'Deactive'}}</td>
                        @can('admin')   
                        <td>
                            <button class="btn btn-edit btn-default" data-id="{{$class->id}}">
                                <i class="fa fa-eye text-success mr-2 pointer" ></i> Edit dan View
                            </button>
                            {{-- <button class="btn btn-delete btn-danger" data-id="{{$class->id}}">
                                <i class="fa fa-trash text-success pointer" ></i> Delete
                            </button> --}}

                            {{-- <i class="nav-icon i-Pen-2 font-weight-bold btn-edit text-success mr-2 pointer" data-id="{{$class->id}}"></i>
                            <i class="nav-icon i-Close-Window font-weight-bold btn-delete text-danger pointer" data-id="{{$class->id}}"></i> --}}
                        </td>
                        @endcan
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