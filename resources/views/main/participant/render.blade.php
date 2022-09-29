<div class="col-12">
    <div class="card mb-4">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    Data Participant
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
                    <th>Document</th>
                    <th>Status</th>
                    <th>Description</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach ($participant as $participant)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$participant->name}}</td>
                        <td>{{$participant->address}}</td>
                        <td>{{$participant->place_of_birth}}, {{$participant->date_of_birth}}</td>
                        <td>{{$participant->gender == 1 ? 'Male' : 'Female'}}</td>
                        <td>{{$participant->phone}}</td>
                        <td class="text-center"><img src="{{asset($participant->user->image)}}" width="80px" class="img-rounded"></td>
                        {{-- <td>{{$participant->documents == null ? 'Belum ada dokumen yang di unggah' : 'View'}}</td> --}}
                        <td>
                            @php
                                $count = array_count_values(json_decode($participant->documents, true))['empty'] ?? 0
                            @endphp
                            {{$count == 8 ? 'No data uploaded yet' : ($count == 0 ? 'Documents complete' : 'Documents are not complete')}}
                        </td>
                        <td>{{$participant->registration->is_qualified == 1 ? 'Accepted' : ($participant->registration->note == null ? 'Waiting for validation' : 'Rejected')}}</td>
                        <td>{{$participant->registration->note ?? '-'}}</td>
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