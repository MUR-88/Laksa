<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\PushNotification;

class ReminderPesananReservasiController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $invoice = Invoice::where('status', 1)
            ->where('status_ordered', 3)
            ->where('status_pembayaran', 1)
            ->whereBetween('sesi', [now()->subHour()->format('Y-m-d H:i:s'), now()->addHour()->format('Y-m-d H:i:s')])
            ->get();

        foreach($invoice as $item){
            // PushNotification::create([
                
            // ]);
        }
    }
}
