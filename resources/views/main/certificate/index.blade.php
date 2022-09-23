@extends('templates.master')

@section('page-title', 'Certificate')
@section('page-sub-title', 'Data')

@section('content')
    <div class="row">
        <div class="col-12">
            @if ($assessment > 0)
            <div class="alert alert-primary">
                <span>
                    Anda dapat mengunduh sertifikat anda pada link berikut, 
                    <a href="{{route('certificate.download')}}">download</a>
                </span>
            </div>
            @else
            <div class="alert alert-info">
                <span>
                    Belum ada nilai untuk ujian anda, mohon untuk menghubungi asesor anda.
                </span>
            </div>
            @endif
        </div>
    </div>
@endsection