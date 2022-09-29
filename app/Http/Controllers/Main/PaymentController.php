<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Participant;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct()
    {
        \Midtrans\Config::$serverKey = 'SB-Mid-server-v8fMPSR6JziDmV-axCECHRqV';
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;
    }

    public function index()
    {
        if(auth()->user()->role->name == 'Peserta') {
            $participant_id = auth()->user()->participant->id;
            $participant = Participant::whereHas('registration', function($q) {
                $q->where('is_qualified', true);
            })->with(['payment' => function ($q) use ($participant_id) {
                $q->where('participant_id', $participant_id);
            }])->where('id', $participant_id)->get();
        } else {
            $participant = Participant::with(['payment', 'registration' => function($q) {
                $q->where('is_qualified', true);
            }])->get();
        }

        // dd($participant);
        return view('main.payment.participant.index', compact('participant'));
    }

    public function store(Request $request) 
    {
        try {
            $payment = Payment::create([
                'participant_id' => auth()->user()->participant->id,
                'total' => 4500000,
                'payment_date' => date('Y-m-d'),
            ]);

            $payload = array(
                'transaction_details' => array(
                    'order_id' => $payment->id,
                    'gross_amount' => 4500000
                )
            );

            return response()->json([
                'status' => 'success',
                'message' => 'Pesanan berhasil diproses',
                'title' => 'Successfully',
                'payment_id' => $payment->id,
                'snap_token' => \Midtrans\Snap::getSnapToken($payload)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                // 'message' => 'Peminjaman gagal diproses',
                'message' => 'Something went wrong',
                'title' => 'Failed'
            ]);
        }
    }

    public function update(Request $request) {
        try {
            $payment = Payment::with('participant')->where('participant_id', auth()->user()->participant->id)->first();
    
            if($payment !== null) {
                $payment_data = json_decode($request->json_callback);
                $payment->update([
                    'payment_data' => $request->json_callback
                ]);

                // if(json_decode($payment_data, true)['transaction_status'] == 'settlement') {
                    $attendance = Attendance::firstOrNew(
                        [
                            'class_id' => $payment->participant->class_id,
                            'participant_id' => $payment->participant->id,
                            'meeting_number' => 1,
                            'is_attend' => false
                        ],
                    );
                    $attendance->save();
                // } else {
                //     $attendance = Attendance::where('participant_id', $payment->participant->id)->first();
                //     if($attendance !== null) {
                //         $attendance->delete();
                //     }
                // }
            }
            return response()->json([
                'status' => 'success',
                'message' => 'Pembayaran berhasil',
                'title' => 'Successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Pembayaran gagal',
                'title' => 'Failed',
            ]);
        }
    }
}
