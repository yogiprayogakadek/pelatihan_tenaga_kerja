@extends('templates.master')

@section('page-title', 'Participant')
@section('page-sub-title', 'Data')

@section('content')
    <div class="row render">
        {{-- data rendered --}}
    </div>
@endsection

@push('script')
    <script src="{{asset('assets/function/participant/main.js')}}"></script>
@endpush