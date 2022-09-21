@extends('templates.master')

@section('page-title', 'Dashboard')
@section('page-sub-title', 'Dashboard')

@section('content')
    <div class="row">
        @can('participant')
            @if (auth()->user()->payment != null)
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
                                {{-- @if (registration()->is_qualified == 1)
                                    <h3><span class="badge bg-success text-white">Anda lolos administrasi, mohon untuk melunasi pembayaran</span></h3>
                                @elseif (registration()->note == null)
                                    <h3><span class="badge bg-info text-white">Mohon menunggu validasi dari admin</span></h3>
                                @else
                                    <h3><span class="badge bg-danger text-white">Anda tidak lolos administrasi, ' {{registration()->note}}.'</span></h3>
                                @endif --}}
                                {!! registration()->is_qualified == 1 ? '<h3><span class="badge bg-success text-white">Anda lolos administrasi, mohon untuk melunasi pembayaran</span></h3>' : (registration()->note == null ? '<h3><span class="badge bg-info text-white">Mohon menunggu validasi dari admin</span></h3>' : '<h3><span class="badge bg-danger text-white">Anda tidak lolos administrasi, '.registration()->note.'</span></h3>') !!}
                            @endif
                        </p>

                        @if (registration()->is_qualified == 0 && registration()->note == null && participant_document() > 0)
                            <a href="{{route('participant.document')}}" class="btn btn-primary btn-rounded">Lengkapi Dokumen</a>
                        @endif
                    </div>
                </div>
            </div>
            @endif
        @endcan

        @cannot('participant')
            @foreach (menu() as $key => $item)                
                <div class="col-lg-4 col-md-6 col-sm-6 pointer">
                    <a href="{{route(strtolower($item[0]) == 'trainingclass' ? 'class.index' : strtolower($item[0]).'.index')}}">
                        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                            <div class="card-body text-center">
                                <i class="{{$item[2]}}"></i>
                                <div class="content">
                                    <p class="text-muted mt-2 mb-0">{{$item[1]}}</p>
                                    <p class="text-primary text-24 line-height-1 mb-2">{{total_data($item[0])}}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        @endcannot

    </div>
@endsection