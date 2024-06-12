<?php

namespace App\Http\Controllers;

use App\Models\Devis;
use App\Models\Finition;
use App\Models\Import;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    public function index() {
        return view('admin.import');
    }

    public function importPayment(Request $request) {
        $paiment = $request->file('paiment');

        try {
            $filename = "CSVP_".time().".".$paiment->getClientOriginalExtension();
            $path = 'data/'. $filename;

            $paiment->move(storage_path('data/'), $filename);

            $import = new Import();

            $error = $import->inportPaiment($path);

            if (count($error) > 0){
                return back()->with([
                    'err'=> $error
                ]);
            }
            return back()->with([
                'message'=> ['Import termine']
            ]);
        } catch (\Exception $e) {
            $err[] = $e->getMessage();
            return back()->with('cath',$err);
        }
    }

    public function inportMaisonTraveaux(Request $request) {
//        $request->validate([
//            'traveaux_maison' => ['required'],
//            'devis' => ['required']
//        ]);

        $maisonTraveaux = $request->file('traveaux_maison');
        $devis = $request->file('devis');

        try {

            $filename1 = "CSV1_".time().".".$devis->getClientOriginalExtension();
            $filename2 = "CSV2_".time().".".$devis->getClientOriginalExtension();
            $path1 = 'data/'. $filename1;
            $path2 = 'data/'. $filename2;
            $maisonTraveaux->move(storage_path('data/'), $filename1);
            $devis->move(storage_path('data/'), $filename2);

            $import = new Import();

            $error = $import->inportTM($path1,$path2);

//            dd($error);

            if (count($error) > 0){
                return back()->with([
                    'errtm'=> $error
                ]);
            }
            return back()->with([
                'message'=> ['Import termine']
            ]);
        } catch (\Exception $e) {
            $err[] = $e->getMessage();
            return back()->with('cath',$err);
        }
    }


    public function exportDevis($ref) {
        $deviss = new Devis();
        $devis = $deviss->getDevisById($ref);

        $traveaux = $deviss->getTraveauxByIdMaison($devis->id_maison);

        $finition = Finition::getFinitionById($devis->id_finition);

        $paiment = $deviss->getPaiment($devis->ref_devis);

//        return view('client.devis.export',[
//            'finition' => $finition,
//            'devis' => $devis,
//            'travaux' => $traveaux
//        ]);

        return Pdf::loadView('client.devis.export',[
            'devis' => $devis,
            'travaux' => $traveaux,
            'paiment' => $paiment
        ])->download();
    }
}
