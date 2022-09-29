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
            <table class="table table-hover table-striped" id="tableParticipant">
                <thead>
                    <th>No</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Place, Date of Birth</th>
                    <th>Gender</th>
                    <th>Phone</th>
                    <th>Photo</th>
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