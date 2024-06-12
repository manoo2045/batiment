<?php

namespace App\Http\Controllers;

use App\Models\Traveaux;
use App\Models\Finition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TraveauxController extends Controller
{
    public function list() {
        $obj = new Traveaux();
        $traveaux = $obj->getAllTraveaux();
        return view('traveaux.list_traveaux',[
            'traveauxs' => $traveaux
        ]);
    }

    public function insert(Request $request){
        $request->validate(
            [
                'code'=> ['required'],
                'nom'=> ['required'],
                'prix_unitaire'=> ['required'],
                'unite'=> ['required'],
            ]
        );
        try {
            $id = DB::table('traveaux')->insertGetId([
                'code'=> $request->code,
                'nom'=> $request->nom,
                'prix_unitaire'=> $request->prix_unitaire,
                'unite'=> $request->unite,
            ],'id');
            return back()->with('message',['Inserer traveaux avec succes']);
        } catch (\Exception $e) {
            return back()->with('errors',$e->getMessage());
        }
    }

    public function traveauxEditView($id) {
        $traveaux = Traveaux::getTraveauxById($id);

        return view('traveaux.update_traveaux',[
            'traveaux' => $traveaux
        ]);
    }

    public function traveauxEdit(Request $request) {
        $request->validate(
        [
		'code'=> ['required'],
		'nom'=> ['required'],
		'prix_unitaire'=> ['required'],
		'unite'=> ['required'],
	]
        );

        try {
            DB::table('traveaux')
                ->where('id', $request->id)
                ->update(
                    [
		'code'=> $request->code,
		'nom'=> $request->nom,
		'prix_unitaire'=> $request->prix_unitaire,
		'unite'=> $request->unite,
	]
                );

            return redirect('/traveaux')->with('message',['Modier avec succes']);

        } catch (\Exception $e) {
            return back()->with('errors',$e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            DB::table('traveaux')
                ->where('id',$id)
                ->delete();
            return redirect('traveaux')->with('success',['Supprimer avec succes']);
        } catch (\Exception $e) {
            return back()->with('traveaux',$e->getMessage());
        }
    }

}
