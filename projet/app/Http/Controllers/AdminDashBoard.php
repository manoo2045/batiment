<?php

namespace App\Http\Controllers;

use App\Models\Statistique;
use Illuminate\Http\Request;

class AdminDashBoard extends Controller
{
    public function index() {
        $anne = Statistique::getAnne();

        $stat = new Statistique();
        $donne = $stat->getHistogramme('2023');
        $res = [];
        foreach ($donne as $d){
            $res[] = $d->nb;
        }

        $totalDevis = $stat->getTotalDevis();
        $totalePaiment = $stat->getTotalePaiment();

//        dd($totalDevis);
        return view('admin.dashboard',[
            'annees' => $anne,
            'donnees' => $res,
            'totalDevis' => $totalDevis[0]->totale,
            'totalePaiment' => $totalePaiment[0]->total_paiment
        ]);
    }
}
