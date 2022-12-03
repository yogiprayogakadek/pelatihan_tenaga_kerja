@extends('templates.master')

@section('page-title', 'Dashboard')
@section('page-sub-title', 'Dashboard')

@section('content')
    <div class="row">
        @can('participant')
            {{-- @if (auth()->user()->payment != null) --}}
            <div class="{{auth()->user()->participant->payment == null ? 'col-12' : 'col-4'}}">
                <div class="card mb-4">
                    <div class="card-header">
                        {{auth()->user()->participant->payment == null ? 'Message' : 'Announcement'}}
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            @if (participant_document() == 8)
                                You have not uploaded the required documents, please upload them.
                            @elseif(participant_document() > 0)
                                Please complete your documents first to be able to proceed to the next process.
                            @else
                                @if (registration()->is_qualified == 1)
                                    @if (auth()->user()->participant->payment == null)
                                    <h3><span class="badge bg-success text-white">You pass the administration, please pay off the payment</span></h3>
                                    @else

                                        @foreach (announcement() as $key => $announcement)
                                        <div class="d-flex flex-column flex-sm-row align-items-center mb-3">
                                            {{-- <img class="avatar-lg mb-3 mb-sm-0 rounded mr-sm-3" src="http://gull-html-laravel.ui-lib.com/assets/images/products/headphone-4.jpg" alt=""> --}}
                                            <div class="flex-grow-1">
                                                <h5 class="">Announcement {{$key+1}} <span class="announcement-title{{$announcement->id}}"></span></h5>
                                                <p class="m-0 text-small text-muted announcement{{$announcement->id}}">
                                                    {{strlen($announcement->description > 50) ? substr($announcement->description,0,50) . "..." : $announcement->description}}
                                                    {{-- {{strlen(strip_tags($announcement->description)) > 50 ? " <a href='#' class='read-more'>...</a>" : "" }} --}}
                                                </p>
                                            </div>
                                            <div>
                                                <button class="btn btn-outline-primary btn-rounded btn-sm btn-announcement{{$announcement->id}} announcement-detail" data-announcement-id="{{$announcement->id}}">View details</button>
                                            </div>
                                        </div>
                                        @endforeach

                                    @endif
                                @elseif (registration()->note == null)
                                    <h3><span class="badge bg-info text-white">Please wait for validation from admin</span></h3>
                                @else
                                    <h3><span class="badge bg-danger text-white">You did not pass the administration, ' {{registration()->note}}.'</span></h3>
                                @endif
                                {{-- {!! registration()->is_qualified == 1 ? '<h3><span class="badge bg-success text-white">Anda lolos administrasi, mohon untuk melunasi pembayaran</span></h3>' : (registration()->note == null ? '<h3><span class="badge bg-info text-white">Mohon menunggu validasi dari admin</span></h3>' : '<h3><span class="badge bg-danger text-white">Anda tidak lolos administrasi, '.registration()->note.'</span></h3>') !!} --}}
                            @endif
                        </p>

                        @if (registration()->is_qualified == 0 && registration()->note == null && participant_document() > 0)
                            <a href="{{route('participant.document')}}" class="btn btn-primary btn-rounded">Complete your documents</a>
                        @endif
                    </div>
                </div>
            </div>
            {{-- @endif --}}
        @endcan

        @cannot('participant')
            @foreach (menu() as $key => $item)                
                <div class="col-4 pointer">
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
        @can('admin')
        <div class="col-4 pointer">
            <a href="{{route('participant.index')}}">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center">
                        <i class="i-Administrator"></i>
                        <div class="content">
                            {{-- <p class="text-muted mt-2 mb-0">Participant Need Validate</p> --}}
                            <p class="text-primary text-24 line-height-1 mt-2">{{needValidate()}}</p>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <p class="text-muted mt-2 mb-0">Participant Need Validate</p>
                    </div>
                </div>
            </a>
        </div>
        @endcan
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function () {
            $('.announcement-detail').on('click', function() {
                let announcement_id = $(this).data('announcement-id');
                $.get("announcement/detail/"+announcement_id, function (data) {
                    $('.announcement-title'+announcement_id).text('- ' + data.title);
                    $('.announcement'+announcement_id).text(data.more);
                    $('.btn-announcement'+announcement_id).text('View less');
                    $('.btn-announcement'+announcement_id).addClass('view-less')
                    $('.btn-announcement'+announcement_id).removeClass('announcement-detail')
                });
            });

            $('body').on('click', '.view-less', function() {
                let announcement_id = $(this).data('announcement-id');
                $.get("announcement/detail/"+announcement_id, function (data) {
                    $('.announcement-title'+announcement_id).text('');
                    $('.announcement'+announcement_id).text(data.less);
                    $('.btn-announcement'+announcement_id).text('View details');
                    $('.btn-announcement'+announcement_id).removeClass('view-less')
                    $('.btn-announcement'+announcement_id).addClass('announcement-detail')
                });
            });
        });
    </script>
@endpush