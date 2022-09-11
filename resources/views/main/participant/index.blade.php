@extends('templates.master')

@section('page-title', 'Peserta')
@section('page-sub-title', 'Data')

@section('content')
    <div class="row render">
        {{-- data rendered --}}
    </div>
@endsection

@push('script')
    <script src="{{asset('assets/function/participant/main.js')}}"></script>
@endpush