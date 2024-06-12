<?php

namespace App\Http\Controllers;

use App\Models\Statistique;
use Illuminate\Http\Request;

class StatistiqueController extends Controller
{
    public function getHistograme(Request $request) {
        $anne = $request->get('anne');
        $stat = new Statistique();
        $donne = $stat->getHistogramme($anne);
        $res = [];
        foreach ($donne as $d){
            $res[] = $d->nb;
        }
        return response()->json([
                'donne' => $res,
            ]
        );
    }
}
