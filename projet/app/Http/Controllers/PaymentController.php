<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function paymentDevis(Request $request){

        $idDevis = $request->devis;
        $montant = $request->montant;
        $date = $request->date;

        $payment = new Payment();
        $payment->effecterPayment($idDevis,$montant,$date);

        return back()->with('message',['Payment effectue']);
    }

    public function loadView($ref) {
        return view('client.devis.payment',[
            'ref' => $ref
        ]);
    }

}
