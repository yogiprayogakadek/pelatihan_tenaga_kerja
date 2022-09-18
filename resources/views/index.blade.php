@extends('templates.master')

@section('page-title', 'Dashboard')
@section('page-sub-title', 'Dashboard')

@section('content')
    <div class="row">
        @can('participant')
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header">
                    Pesan
                </div>
                <div class="card-body">
                    <p class="card-text">
                        @if (participant_document() == 8)
                            Anda belum mengunggah dokumen yang diperlukan, mohon untuk mengunggah dokumen.
                        @elseif(participant_document() > 0)
                            Mohon untuk melengkapi dokumen anda terlebih dahulu untuk dapat melanjutkan ke proses selanjutnya.
                        @else
                            {!! registration()->is_qualified == 1 ? '<h3><span class="badge bg-success text-white">Anda lolos administrasi</span></h3>' : '<h3><span class="badge bg-danger text-white">Anda tidak lolos administrasi, '.registration()->note.'</span></h3>'!!}
                        @endif
                    </p>

                    @if (registration()->is_qualified == 0 && registration()->note == null)
                        <a href="{{route('participant.document')}}" class="btn btn-primary btn-rounded">Lengkapi Dokumen</a>
                    @endif
                </div>
            </div>
        </div>
        @endcan
    </div>
@endsection