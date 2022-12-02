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
                        <i class="nav-icon i-Pen-2 font-weight-bold"></i> Add
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-hover table-striped" id="tableData">
                <thead>
                    <th>No</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Place, Date of Birth</th>
                    <th>Gender</th>
                    <th>Phone</th>
                    <th>Photo</th>
                    <th>Status</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach ($assessor as $assessor)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$assessor->name}}</td>
                        <td>{{$assessor->address}}</td>
                        <td>{{$assessor->place_of_birth}}, {{$assessor->date_of_birth}}</td>
                        <td>{{$assessor->gender == 1 ? 'Male' : 'Female'}}</td>
                        <td>{{$assessor->phone}}</td>
                        <td class="text-center"><img src="{{asset($assessor->user->image)}}" width="80px" class="img-rounded"></td>
                        <td>{{$assessor->is_active == 1 ? 'Active' : 'Non-Active'}}</td>
                        <td>
                            <button class="btn btn-edit btn-default" data-id="{{$assessor->id}}">
                                <i class="fa fa-eye text-success mr-2 pointer" ></i> Edit dan View
                            </button>
                            {{-- <i class="nav-icon i-Close-Window font-weight-bold btn-delete text-danger pointer" data-id="{{$assessor->id}}"></i> --}}
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