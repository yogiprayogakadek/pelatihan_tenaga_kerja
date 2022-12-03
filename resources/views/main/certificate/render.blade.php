<div class="col-12">
    <div class="card mb-4">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    Data Training Class
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
                    <th>Status Completion</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach ($participantClass as $class)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$class->trainingClass->category}}</td>
                        <td>{{$class->trainingClass->code}}</td>
                        <td>{{$class->trainingClass->name}}</td>
                        <td>
                            @if ($class->participant->assessment !=  null)
                            <span>
                                You can download your certificate from following link,
                                {{-- <a href="{{route('certificate.download')}}">download</a> --}}
                            </span>
                            @else
                            <span>
                                You haven't complete your exam or your assessor haven't entered your exam value.
                            </span>
                            @endif
                        </td>
                        <td>
                            @if ($class->participant->assessment !=  null)
                            <span>
                                <a href="{{route('certificate.download', $class->id)}}">download</a>
                            </span>
                            @else
                            <span>
                                -
                            </span>
                            @endif
                            {{-- <span class="pointer btn-view-attendance badge badge-primary" data-id="{{$class->trainingClass->id}}">View</span> --}}
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