<div class="col-12">
    <form id="formEdit">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        Ubah Training Kelas
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
                    <input type="hidden" name="id" id="id" value="{{$class->id}}">
                    <label for="category">Kategori</label>
                    <select name="category" id="category" class="form-control category">
                        <option value="">Pilih kategori...</option>
                        @foreach ($category as $category)
                            <option value="{{$category}}" {{$category == $class->category ? 'selected' : ''}}>{{$category}}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback error-category"></div>
                </div>
                <div class="form-group">
                    <label for="name">Nama Kelas</label>
                    <input type="text" class="form-control name" name="name" id="name" placeholder="masukkan nama kelas" value="{{$class->name}}">
                    <div class="invalid-feedback error-name"></div>
                </div>
                <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <textarea class="form-control description" name="description" id="description" placeholder="masukkan deskripsi">{{$class->description}}</textarea>
                    <div class="invalid-feedback error-description"></div>
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