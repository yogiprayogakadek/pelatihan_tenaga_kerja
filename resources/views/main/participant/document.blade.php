@extends('templates.master')

@section('page-title', 'Peserta')
@section('page-sub-title', 'Data')

@section('content')
    <div class="row">
        <div class="col-12">
            <form id="formEdit">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                Data Peserta
                            </div>
                            {{-- <div class="col-6 d-flex align-items-center">
                                <div class="m-auto"></div>
                                <button type="button" class="btn btn-outline-primary btn-data">
                                    <i class="nav-icon i-Pen-2 font-weight-bold"></i> Data
                                </button>
                            </div> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <input type="hidden" name="user_id" id="user_id" value="{{$participant->user->id}}">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control name" name="name" id="name" placeholder="masukkan nama" value="{{$participant->name}}" disabled>
                            <div class="invalid-feedback error-name"></div>
                        </div>
                        <div class="form-group">
                            <label for="place-of-birth">Tempat Lahir</label>
                            <input type="text" class="form-control place_of_birth" name="place_of_birth" id="place-of-birth" placeholder="masukkan tempat lahir" value="{{$participant->place_of_birth}}" disabled>
                            <div class="invalid-feedback error-place_of_birth"></div>
                        </div>
                        <div class="form-group">
                            <label for="date-of-birth">Tanggal Lahir</label>
                            <input type="date" class="form-control date_of_birth" name="date_of_birth" id="date-of-birth" placeholder="masukkan tanggal lahir" value="{{$participant->date_of_birth}}" disabled>
                            <div class="invalid-feedback error-date_of_birth"></div>
                        </div>
                        <div class="form-group">
                            <label for="gender">Jenis Kelamin</label>
                            <select name="gender" id="gender" class="form-control gender" disabled>
                                <option value="">Pilih jenis kelamin...</option>
                                <option value="1" {{$participant->gender == 1 ? 'selected' : ''}}>Laki - Laki</option>
                                <option value="0" {{$participant->gender == 0 ? 'selected' : ''}}>Perempuan</option>
                            </select>
                            <div class="invalid-feedback error-gender"></div>
                        </div>
                        <div class="form-group">
                            <label for="phone">No. Telp</label>
                            <input type="text" class="form-control phone" name="phone" id="phone" placeholder="masukkan no. telp" value="{{$participant->phone}}" disabled>
                            <div class="invalid-feedback error-phone"></div>
                        </div>
                        <div class="form-group">
                            <label for="phone">Alamat</label>
                            <textarea name="address" id="address" class="form-control address" rows="6" disabled>{{$participant->address}}</textarea>
                            <div class="invalid-feedback error-address"></div>
                        </div>
                        <div class="form-group">
                            <label for="user">Username</label>
                            <input type="text" class="form-control username" name="username" id="username" placeholder="masukkan username" value="{{$participant->user->username}}" disabled>
                            <div class="invalid-feedback error-username"></div>
                        </div>
                        <div class="form-group">
                            <label><h5><strong>Dokumen</strong></h5></label>
                            <table class="table">
                                <tr>
                                    <th>CV</th>
                                    <th>Sertifikat Pengalaman Kerja</th>
                                    <th>Foto 3x4</th>
                                    <th>Ijazah SMA/SMK</th>
                                    <th>Ijazah Perguruan Tinggi</th>
                                    <th>Kartu Keluarga</th>
                                    <th>KTP</th>
                                    <th>Akte Lahir</th>
                                </tr>
                                <tr>
                                    @foreach (json_decode($participant->documents, true) as $key => $value)
                                    <td>
                                        {!! $value == 'empty' ? '<span class="badge badge-primary pointer btn-upload" data-id="'.$participant->id.'" data-document="'.$key.'">Unggah</span>' : '<a href="'.asset($value).'" target="_blank"><span class="badge badge-info">Lihat</span></a>  <span class="badge badge-secondary pointer btn-upload" data-id="'.$participant->id.'" data-document="'.$key.'" '. ($participant->payment != null ? "hidden" : '') .'>Ubah</span>' !!}
                                    </td>
                                    @endforeach
                                </tr>
                            </table>
                        </div>
                    </div>
                    {{-- <div class="card-footer">
                        <div class="mc-footer">
                            <div class="row">
                                <div class="col-lg-12">
                                    <button type="button" class="btn btn-outline-secondary m-1">Kembali</button>
                                </div>
                            </div>
                        </div>
                    </div> --}}
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
                                <label for="file">File Dokumen</label>
                                <input type="file" name="file" id="file" class="form-control file">
                                <div class="invalid-feedback error-file"></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-primary process-upload">Unggah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{asset('assets/function/participant/main.js')}}"></script>
@endpush