<?php

namespace App\Http\Controllers;

use App\Models\Finition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ModifController extends Controller
{
    public function finition() {
        $f = new Finition();
        $finition = $f->getAll();
        return view('admin.finition',[
            'finition' => $finition
        ]);
    }

    public function finitionEdit(Request $request) {
        $request->validate([
            'pourcentage' => ['required','numeric'],
        ]);

        try {
            DB::table('finition_maison')
                ->where('id', $request->id)
                ->update([
                    'pourcentage' => $request->pourcentage
                ]);
            return back()->with('message',['Modier avec succes']);
        } catch (\Exception $e) {
            return back()->with('errors',$e->getMessage());
        }
    }


    public function travaux() {
        $t = Finition::getAllTravaux();

        return view('admin.travaux',[
            'travaux' => $t
        ]);

    }

    public function formEdit($id) {
        $t = Finition::getTaveauxById($id);

        return view('admin.editeTrav',[
            'traveaux' => $t
        ]);
    }

    public function travauxEdit(Request $request) {
        $request->validate([
            'code' => ['required'],
            'nom' => ['required'],
            'pu' => ['required','numeric','min:0']
        ]);

        try {
            DB::table('traveaux')
                ->where('id', $request->id)
                ->update([
                    'code' => $request->code,
                    'nom' => $request->nom,
                    'prix_unitaire' => $request->pu
                ]);
            return redirect('/travaux/liste')->with('message',['Modier avec succes']);
        } catch (\Exception $e) {
            return back()->with('errors',$e->getMessage());
        }
    }
}
