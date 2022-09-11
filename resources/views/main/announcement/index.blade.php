@extends('templates.master')

@section('page-title', 'Announcement')
@section('page-sub-title', 'Data')

@section('content')
    <div class="row render">
        {{-- data rendered --}}
    </div>
@endsection

@push('script')
    <script src="{{asset('assets/function/announcement/main.js')}}"></script>
@endpush