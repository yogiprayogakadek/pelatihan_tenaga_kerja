@extends('templates.master')

@section('page-title', 'Assessor')
@section('page-sub-title', 'Data')

@section('content')
    <div class="row render">
        {{-- data rendered --}}
    </div>
@endsection

@push('script')
    <script src="{{asset('assets/function/assessor/main.js')}}"></script>
@endpush