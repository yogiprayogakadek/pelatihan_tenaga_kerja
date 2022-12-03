@extends('templates.master')

@section('page-title', 'Training Class')
@section('page-sub-title', 'Data')

@section('content')
    <div class="row render">
        {{-- data rendered --}}
    </div>
@endsection

@push('script')
    <script src="{{asset('assets/function/class/participant/attendance/main.js')}}"></script>
@endpush