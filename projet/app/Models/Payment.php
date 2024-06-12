<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Payment extends Model
{
    use HasFactory;

    public function effecterPayment($idDevis,$montant,$date) {

        return DB::table('payment_client')->insert([
            'ref_paiement' => 'P002',
            'ref_devis' => $idDevis,
            'montant' => $montant,
            'date' => $date
        ]);
    }

    public function getAll() {
        return DB::table('v_detail_paiment')->get();
    }
}
