<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function create() {

        return view('reservation');

    }

    public function store(ReservationRequest $request) {

        \App\Reservation::create([
            'room_id' => $request->room_id,
            'start_at' => $request->start_at,
            'end_at' => $request->end_at
        ]);
        return back()->with('result', '予約が完了しました。');

    }
}
