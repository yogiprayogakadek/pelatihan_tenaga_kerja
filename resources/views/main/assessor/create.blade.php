<div class="col-12">
    <form id="formAdd">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        Tambah Assessor
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
                    <label for="name">Nama</label>
                    <input type="text" class="form-control name" name="name" id="name" placeholder="masukkan nama">
                    <div class="invalid-feedback error-name"></div>
                </div>
                <div class="form-group">
                    <label for="place-of-birth">Tempat Lahir</label>
                    <input type="text" class="form-control place_of_birth" name="place_of_birth" id="place-of-birth" placeholder="masukkan tempat lahir">
                    <div class="invalid-feedback error-place_of_birth"></div>
                </div>
                <div class="form-group">
                    <label for="date-of-birth">Tanggal Lahir</label>
                    <input type="date" class="form-control date_of_birth" name="date_of_birth" id="date-of-birth" placeholder="masukkan tanggal lahir">
                    <div class="invalid-feedback error-date_of_birth"></div>
                </div>
                <div class="form-group">
                    <label for="gender">Jenis Kelamin</label>
                    <select name="gender" id="gender" class="form-control gender">
                        <option value="">Pilih jenis kelamin...</option>
                        <option value="1">Laki - Laki</option>
                        <option value="0">Perempuan</option>
                    </select>
                    <div class="invalid-feedback error-gender"></div>
                </div>
                <div class="form-group">
                    <label for="phone">No. Telp</label>
                    <input type="text" class="form-control phone" name="phone" id="phone" placeholder="masukkan no. telp">
                    <div class="invalid-feedback error-phone"></div>
                </div>
                <div class="form-group">
                    <label for="phone">Alamat</label>
                    <textarea name="address" id="address" class="form-control address" rows="6"></textarea>
                    <div class="invalid-feedback error-address"></div>
                </div>
                <div class="form-group">
                    <label for="user">Username</label>
                    <input type="text" class="form-control username" name="username" id="username" placeholder="masukkan username">
                    <div class="invalid-feedback error-username"></div>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control password" name="password" id="password" placeholder="masukkan password">
                    <div class="invalid-feedback error-password"></div>
                </div>
                <div class="form-group">
                    <label for="image">Foto</label>
                    <input type="file" class="form-control image" name="image" id="image" placeholder="masukkan image">
                    <div class="invalid-feedback error-image"></div>
                </div>
            </div>
            <div class="card-footer">
                <div class="mc-footer">
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="button" class="btn  btn-primary m-1 btn-save">Simpan</button>
                            <button type="button" class="btn btn-outline-secondary m-1 btn-data">Batal</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>