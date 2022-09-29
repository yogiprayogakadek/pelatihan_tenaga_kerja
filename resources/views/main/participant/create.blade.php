<div class="col-12">
    <form id="formAdd">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        Add Assessor
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
                    <label for="name">Name</label>
                    <input type="text" class="form-control name" name="name" id="name" placeholder="enter your name">
                    <div class="invalid-feedback error-name"></div>
                </div>
                <div class="form-group">
                    <label for="place-of-birth">Place of Birth</label>
                    <input type="text" class="form-control place_of_birth" name="place_of_birth" id="place-of-birth" placeholder="enter your place of birth">
                    <div class="invalid-feedback error-place_of_birth"></div>
                </div>
                <div class="form-group">
                    <label for="date-of-birth">Date of Birth</label>
                    <input type="date" class="form-control date_of_birth" name="date_of_birth" id="date-of-birth" placeholder="enter yout date of birth">
                    <div class="invalid-feedback error-date_of_birth"></div>
                </div>
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select name="gender" id="gender" class="form-control gender">
                        <option value="">Choose your gender...</option>
                        <option value="1">Male</option>
                        <option value="0">Female</option>
                    </select>
                    <div class="invalid-feedback error-gender"></div>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control phone" name="phone" id="phone" placeholder="enter your phone number">
                    <div class="invalid-feedback error-phone"></div>
                </div>
                <div class="form-group">
                    <label for="phone">Address</label>
                    <textarea name="address" id="address" class="form-control address" rows="6"></textarea>
                    <div class="invalid-feedback error-address"></div>
                </div>
                <div class="form-group">
                    <label for="user">Username</label>
                    <input type="text" class="form-control username" name="username" id="username" placeholder="enter your username">
                    <div class="invalid-feedback error-username"></div>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control password" name="password" id="password" placeholder="enter your password">
                    <div class="invalid-feedback error-password"></div>
                </div>
                <div class="form-group">
                    <label for="image">Photo</label>
                    <input type="file" class="form-control image" name="image" id="image" placeholder="enter your photo">
                    <div class="invalid-feedback error-image"></div>
                </div>
            </div>
            <div class="card-footer">
                <div class="mc-footer">
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="button" class="btn  btn-primary m-1 btn-save">Save</button>
                            <button type="button" class="btn btn-outline-secondary m-1 btn-data">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>