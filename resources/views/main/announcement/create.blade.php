<div class="col-12">
    <form id="formAdd">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        Add Announcement
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
                    <label for="title">Title</label>
                    <input type="text" class="form-control title" name="title" id="title" placeholder="enter announcement title">
                    <div class="invalid-feedback error-title"></div>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control description" name="description" id="description" placeholder="enter announcement description"></textarea>
                    <div class="invalid-feedback error-description"></div>
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