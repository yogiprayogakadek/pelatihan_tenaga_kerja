<div class="col-12">
    <div class="card mb-4">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    Data Participant
                </div>
                <div class="col-6 d-flex align-items-center">
                    <div class="m-auto"></div>
                    <button type="button" class="btn btn-outline-primary btn-data">
                        <i class="nav-icon i-Pen-2 font-weight-bold"></i> Data Class
                    </button>
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
                    <th>Value</th>
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
                        <td>
                            <span class="pointer btn-assessment badge badge-primary {{$participant->assessment != null ? 'btn-view-assessment' : ''}}" data-participant-id="{{$participant->id}}" data-training-class="{{$participant->class_id}}">{{$participant->assessment != null ? 'View' : 'Value'}}</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalAssessment" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">Value</h5>
                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-times"></i>
                    </button>
            </div>
            <form id="formAssessment">
                @csrf
                <div class="modal-body">
                    <div class="container-fluid">
                        <input type="hidden" id="participant_id" name="participant_id">
                        <input type="hidden" id="training_class_id" name="training_class_id">
                        <div class="form-group group-speaking">
                            <label for="speaking">Speaking</label>
                            <input type="text" name="speaking" id="speaking" class="form-control speaking">
                            <div class="invalid-feedback error-speaking"></div>
                        </div>
                        <div class="form-group group-writing">
                            <label for="writing">Writing</label>
                            <input type="text" name="writing" id="writing" class="form-control writing">
                            <div class="invalid-feedback error-writing"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-save">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- end modal --}}

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