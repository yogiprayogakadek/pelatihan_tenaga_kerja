@extends('templates.master')

@section('page-title', 'Certificate')
@section('page-sub-title', 'Data')

@section('content')
    <div class="row render">
        {{-- <div class="col-12">
            @if ($assessment > 0)
            <div class="alert alert-primary">
                <span>
                    You can download your certificate from following link,
                    <a href="{{route('certificate.download')}}">download</a>
                </span>
            </div>
            @else
            <div class="alert alert-info">
                <span>
                    You haven't complete your exam or your assessor haven't entered your exam value.
                </span>
            </div>
            @endif
        </div> --}}
    </div>
@endsection

@push('script')
    <script src="{{asset('assets/function/certificate/main.js')}}"></script>
@endpush