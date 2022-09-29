<div class="col-12">
    <form id="formAdd">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        Add Training Class
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
                    <label for="category">Category</label>
                    <select name="category" id="category" class="form-control category">
                        <option value="">Choose Category...</option>
                        @foreach ($category as $category)
                            <option value="{{$category}}">{{$category}}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback error-category"></div>
                </div>
                <div class="form-group">
                    <label for="name">Class name</label>
                    <input type="text" class="form-control name" name="name" id="name" placeholder="enter class name">
                    <div class="invalid-feedback error-name"></div>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control description" name="description" id="description" placeholder="enter class description"></textarea>
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