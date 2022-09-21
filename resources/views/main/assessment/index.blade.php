@extends('templates.master')

@section('page-title', 'Assessment')
@section('page-sub-title', 'Data')

@section('content')
    <div class="row render">
        {{-- data rendered --}}
    </div>
@endsection

@push('script')
    <script src="{{asset('assets/function/assessment/main.js')}}"></script>
@endpush