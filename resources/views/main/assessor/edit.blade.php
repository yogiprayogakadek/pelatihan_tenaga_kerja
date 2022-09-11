<div class="col-12">
    <form id="formEdit">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        Ubah Assessor
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
                    <input type="hidden" name="user_id" id="user_id" value="{{$assessor->user->id}}">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control name" name="name" id="name" placeholder="masukkan nama" value="{{$assessor->name}}">
                    <div class="invalid-feedback error-name"></div>
                </div>
                <div class="form-group">
                    <label for="place-of-birth">Tempat Lahir</label>
                    <input type="text" class="form-control place_of_birth" name="place_of_birth" id="place-of-birth" placeholder="masukkan tempat lahir" value="{{$assessor->place_of_birth}}">
                    <div class="invalid-feedback error-place_of_birth"></div>
                </div>
                <div class="form-group">
                    <label for="date-of-birth">Tanggal Lahir</label>
                    <input type="date" class="form-control date_of_birth" name="date_of_birth" id="date-of-birth" placeholder="masukkan tanggal lahir" value="{{$assessor->date_of_birth}}">
                    <div class="invalid-feedback error-date_of_birth"></div>
                </div>
                <div class="form-group">
                    <label for="gender">Jenis Kelamin</label>
                    <select name="gender" id="gender" class="form-control gender">
                        <option value="">Pilih jenis kelamin...</option>
                        <option value="1" {{$assessor->gender == 1 ? 'selected' : ''}}>Laki - Laki</option>
                        <option value="0" {{$assessor->gender == 0 ? 'selected' : ''}}>Perempuan</option>
                    </select>
                    <div class="invalid-feedback error-gender"></div>
                </div>
                <div class="form-group">
                    <label for="phone">No. Telp</label>
                    <input type="text" class="form-control phone" name="phone" id="phone" placeholder="masukkan no. telp" value="{{$assessor->phone}}">
                    <div class="invalid-feedback error-phone"></div>
                </div>
                <div class="form-group">
                    <label for="phone">Alamat</label>
                    <textarea name="address" id="address" class="form-control address" rows="6">{{$assessor->address}}</textarea>
                    <div class="invalid-feedback error-address"></div>
                </div>
                <div class="form-group">
                    <label for="user">Username</label>
                    <input type="text" class="form-control username" name="username" id="username" placeholder="masukkan username" value="{{$assessor->user->username}}">
                    <div class="invalid-feedback error-username"></div>
                </div>
                <div class="form-group">
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
                    <label for="image">Foto</label>
                    <input type="file" class="form-control image" name="image" id="image" placeholder="masukkan image">
                    <span class="text-muted text-small">*kosongkan jika tidak ingin mengganti foto</span>
                    <div class="invalid-feedback error-image"></div>
                </div>
            </div>
            <div class="card-footer">
                <div class="mc-footer">
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="button" class="btn  btn-primary m-1 btn-update">Simpan</button>
                            <button type="button" class="btn btn-outline-secondary m-1 btn-data">Batal</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>