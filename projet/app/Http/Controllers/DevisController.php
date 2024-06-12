<?php

namespace App\Http\Controllers;

use App\Models\Devis;
use App\Models\Finition;
use App\Models\Maison;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DevisController extends Controller
{
    public function viewDemandeDevis(Request $request) {
        $maison = new Maison();
        $f = new Finition();

        $maisons = $maison->getAllMaison();
        $data['maisons'] = $maisons;
        $data['finitions'] = $f->getAll();;

        return view('client.creer_devis',$data);
    }


    public function demandeDevis(Request $request){
        $request->validate([
            'maison' => ['required'],
            'date_devis' => ['required'],
            'finition' => ['required'],
            'lieu' => ['required'],
        ]);

        $user = Auth::user();
        $idClient = $user->id;
        $idMaison = $request->maison;
        $idFinition = $request->finition;
        $dateDevis = Carbon::now();
        $dateDebut = $request->date_devis;
        $lieu = $request->lieu;
        $devis = new Devis();
        $devis->creerDevis($idClient,$idMaison,$idFinition,$dateDevis,$dateDebut,$lieu);

        return back()->with('message',['Creation terminer']);
    }

    public function listeDevis(){
        $payment = new Payment();
        $data['devis'] = $payment->getAll();

        return view('client.devis.liste',$data);
    }

    public function listeDevisEnCour(){
        $payment = new Payment();
        $data['devis'] = $payment->getAll();

        return view('admin.devis.listeDevisAdmin',$data);
    }

    public function detailDevis($ref) {
        $devis = new Devis();
        $traveaux = $devis->getTraveauxByRef($ref);

        return view('admin.DetailDevis',[
            'travaux' => $traveaux
        ]);
    }
}


