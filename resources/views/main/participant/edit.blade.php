<div class="col-12">
    <form id="formEdit">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        Edit Participant
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
                <div class="form-group">
                    <label for="isActive">User Status</label>
                    <select name="isActive" id="isActive" class="form-control isActive">
                        {{-- <option value="none">Choose status...</option> --}}
                        <option value="1" {{$participant->user->status == 1 ? 'selected' : ''}}>Active</option>
                        <option value="0" {{$participant->user->status == 0 ? 'selected' : ''}}>Deactive</option>
                    </select>
                    <div class="invalid-feedback error-status"></div>
                </div>
                <div class="form-group">
                    <input type="hidden" name="user_id" id="user_id" value="{{$participant->user->id}}">
                    <label for="name">Name</label>
                    <input type="text" class="form-control name" name="name" id="name" placeholder="enter your name" value="{{$participant->name}}" disabled>
                    <div class="invalid-feedback error-name"></div>
                </div>
                <div class="form-group">
                    <label for="place-of-birth">Place of Birth</label>
                    <input type="text" class="form-control place_of_birth" name="place_of_birth" id="place-of-birth" placeholder="enter your place of birth" value="{{$participant->place_of_birth}}" disabled>
                    <div class="invalid-feedback error-place_of_birth"></div>
                </div>
                <div class="form-group">
                    <label for="date-of-birth">Date of Birth</label>
                    <input type="date" class="form-control date_of_birth" name="date_of_birth" id="date-of-birth" placeholder="enter yout date of birth" value="{{$participant->date_of_birth}}" disabled>
                    <div class="invalid-feedback error-date_of_birth"></div>
                </div>
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select name="gender" id="gender" class="form-control gender" disabled>
                        <option value="">Choose your gender...</option>
                        <option value="1" {{$participant->gender == 1 ? 'selected' : ''}}>Male</option>
                        <option value="0" {{$participant->gender == 0 ? 'selected' : ''}}>Female</option>
                    </select>
                    <div class="invalid-feedback error-gender"></div>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control phone" name="phone" id="phone" placeholder="enter your phone number" value="{{$participant->phone}}" disabled>
                    <div class="invalid-feedback error-phone"></div>
                </div>
                <div class="form-group">
                    <label for="phone">Address</label>
                    <textarea name="address" id="address" class="form-control address" rows="6" disabled>{{$participant->address}}</textarea>
                    <div class="invalid-feedback error-address"></div>
                </div>
                <div class="form-group">
                    <label for="user">Username</label>
                    <input type="text" class="form-control username" name="username" id="username" placeholder="enter your username" value="{{$participant->user->username}}" disabled>
                    <div class="invalid-feedback error-username"></div>
                </div>
                <div class="form-group">
                    <label><h5><strong>Documents</strong></h5></label>
                    <table class="table">
                        <tr>
                            <th>CV</th>
                            <th>Sertifikat Pengalaman Kerja</th>
                            <th>Foto 3x4</th>
                            {{-- <th>Ijazah SMA/SMK</th>
                            <th>Ijazah Perguruan Tinggi</th> --}}
                            <th>Ijazah Terakhir</th>
                            <th>Kartu Keluarga</th>
                            <th>KTP</th>
                            <th>Akte Lahir</th>
                        </tr>
                        <tr>
                            @foreach (json_decode($participant->documents, true) as $key => $value)
                            <td>
                                {!! $value == 'empty' ? '<span class="badge badge-primary pointer">Data does not exists</span>' : '<a href="'.asset($value).'" target="_blank"><span class="badge badge-info">View</span></a> ' !!}
                            </td>
                            @endforeach
                        </tr>
                    </table>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control status">
                        <option value="none">Choose status...</option>
                        <option value="1" {{$participant->registration->is_qualified == 1 ? 'selected' : ''}}>Accept</option>
                        <option value="0" {{$participant->registration->is_qualified == 0 ? 'selected' : ''}}>Reject</option>
                    </select>
                    <div class="invalid-feedback error-status"></div>
                </div>
                <div class="form-group note-group" {{$participant->registration->is_qualified == 1 ? 'hidden' : ''}}>
                    <label for="note">Description</label>
                    <textarea name="note" id="note" class="form-control note" rows="7">{{$participant->registration->is_qualified == 0 ? $participant->registration->note : ''}}</textarea>
                    <div class="invalid-feedback error-note"></div>
                </div>

                {{-- <div class="form-group">
                    <label for="current-password">Password Sekarang</label>
                    <input type="password" class="form-control current_password" name="current_password" id="current-password" placeholder="masukkan password sekarang">
                    <div class="invalid-feedback error-current_password"></div>
                </div>
                <div class="form-group">
                    <label for="new-password">Password Baru</label>
                    <input type="password" class="form-control new_password" name="new_password" id="new-password" placeholder="masukkan password baru">
                    <div class="invalid-feedback error-new_password"></div>
                </div>
                <div class="form-group">
                    <label for="confirmation-password">Re-Password</label>
                    <input type="password" class="form-control confirmation_password" name="confirmation_password" id="confirmation-password" placeholder="masukkan konfirmasi password">
                    <div class="invalid-feedback error-confirmation_password"></div>
                </div>
                <div class="form-group">
                    <label for="image">Photo</label>
                    <input type="file" class="form-control image" name="image" id="image" placeholder="enter your photo">
                    <span class="text-muted text-small">*kosongkan jika tidak ingin mengganti foto</span>
                    <div class="invalid-feedback error-image"></div>
                </div> --}}
            </div>
            <div class="card-footer">
                <div class="mc-footer">
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="button" class="btn  btn-primary m-1 btn-update" disabled>Save</button>
                            <button type="button" class="btn btn-outline-secondary m-1 btn-data">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal fade" id="modalUpload" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formUpload">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="document" id="document">
                    <input type="hidden" name="participant_id" id="participant-id">
                    <div class="form-group">
                        <label for="file">Dokument File</label>
                        <input type="file" name="file" id="file" class="form-control file">
                        <div class="invalid-feedback error-file"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary process-upload">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>