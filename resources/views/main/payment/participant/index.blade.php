@extends('templates.master')

@section('page-title', 'Payment')
@section('page-sub-title', 'Data')
@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <div class="row render">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            Data Payment
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-striped" id="tableData">
                        <thead>
                            <th>No</th>
                            <th>Name</th>
                            <th>Address</th>
                            {{-- <th>Place, Date of Birth</th> --}}
                            {{-- <th>Gender</th> --}}
                            <th>Phone</th>
                            <th>Class Code</th>
                            <th>Payment Status</th>
                            {{-- <th>Photo</th>
                            <th>Status</th> --}}
                        </thead>
                        <tbody>
                            @foreach ($participant as $participant)
                                @foreach ($participant->manyClass as $class)    
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$class->participant->name}}</td>
                                    <td>{{$class->participant->address}}</td>
                                    {{-- <td>{{$participant->place_of_birth}}, {{$participant->date_of_birth}}</td> --}}
                                    {{-- <td>{{$participant->gender == 1 ? 'Male' : 'Female'}}</td> --}}
                                    <td>{{$class->participant->phone}}</td>
                                    <td>{{$class->trainingClass->code}}</td>
                                    <td>{!! $class->participant->payment == null ? 'Have not made a payment yet | <span class="badge badge-primary pointer btn-payment" data-class="'.$class->class_id.'">Pay</span>' : (json_decode($class->participant->payment->payment_data, true)['transaction_status'] == 'settlement' ? 'Payment success | ' . $class->participant->payment->payment_date . ' | Rp' . number_format($class->participant->payment->total,0,'.','.') : '') !!}</td>
                                </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-WLa4T_aeiQfLdfyC"></script>
<script src="{{asset('assets/function/payment/main.js')}}"></script>
<script>
    $('#tableData').DataTable({
        language: {
            paginate: {
                previous: "Previous",
                next: "Next"
            },
            info: "Showing _START_ to _END_ from _TOTAL_ data",
            infoEmpty: "Showing 0 to 0 from 0 data",
            lengthMenu: "Showing _MENU_ data",
            search: "Search:",
            emptyTable: "Data doesn't exists",
            zeroRecords: "Data doesn't match",
            loadingRecords: "Loading..",
            processing: "Processing...",
            infoFiltered: "(filtered from _MAX_ total data)"
        },
        lengthMenu: [
            [5, 10, 15, 20, -1],
            [5, 10, 15, 20, "All"]
        ],
    });
</script>
@endpush