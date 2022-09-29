<div class="col-12">
    <form id="formEdit">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        Edit Announcement
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
                    <input type="hidden" name="id" id="id" value="{{$announcement->id}}">
                    <label for="title">Title</label>
                    <input type="text" class="form-control title" name="title" id="title" placeholder="enter announcement title" value="{{$announcement->title}}">
                    <div class="invalid-feedback error-title"></div>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control description" name="description" id="description" placeholder="enter announcement description">{{$announcement->description}}</textarea>
                    <div class="invalid-feedback error-description"></div>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control status">
                        <option value="">Choose Status</option>
                        <option value="1" {{$announcement->is_active == 1 ? 'selected' : ''}}>Active</option>
                        <option value="0" {{$announcement->is_active == 0 ? 'selected' : ''}}>Non-Active</option>
                    </select>
                    <div class="invalid-feedback error-status"></div>
                </div>
            </div>
            <div class="card-footer">
                <div class="mc-footer">
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="button" class="btn  btn-primary m-1 btn-update">Save</button>
                            <button type="button" class="btn btn-outline-secondary m-1 btn-data">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>