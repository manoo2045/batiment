<?php

namespace App\Http\Controllers;

use App\Models\Traveaux_client;
use App\Models\Finition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Traveaux_clientController extends Controller
{
    public function list() {
        $obj = new Traveaux_client();
        $traveaux_client = $obj->getAllTraveaux_client();
        return view('traveaux_client.list_traveaux_client',[
            'traveaux_clients' => $traveaux_client
        ]);
    }

    public function insert(Request $request){
        $request->validate(
        [
		'ref_devis'=> ['required'],
		'date_devis'=> ['required'],
		'debut'=> ['required'],
		'fin'=> ['required'],
		'lieu'=> ['required'],
		'id_client'=> ['required'],
		'id_maison'=> ['required'],
		'id_finition'=> ['required'],
	]
        );
        try {
            $id = DB::table('traveaux_client')->insertGetId([
		'ref_devis'=> $request->ref_devis,
		'date_devis'=> $request->date_devis,
		'debut'=> $request->debut,
		'fin'=> $request->fin,
		'lieu'=> $request->lieu,
		'debut'=> $request->debut,
		'fin'=> $request->fin,
		'lieu'=> $request->lieu,
	],'id');
            return back()->with('message',['Inserer traveaux_client avec succes']);
        } catch (\Exception $e) {
            return back()->with('errors',$e->getMessage());
        }
    }

    public function traveaux_clientEditView($id) {
        $traveaux_client = Traveaux_client::getTraveaux_clientById($id);

        return view('traveaux_client.update_traveaux_client',[
            'traveaux_client' => $traveaux_client
        ]);
    }

    public function traveaux_clientEdit(Request $request) {
        $request->validate(
        [
		'ref_devis'=> ['required'],
		'date_devis'=> ['required'],
		'debut'=> ['required'],
		'fin'=> ['required'],
		'lieu'=> ['required'],
		'id_client'=> ['required'],
		'id_maison'=> ['required'],
		'id_finition'=> ['required'],
	]
        );

        try {
            DB::table('traveaux_client')
                ->where('id', $request->id)
                ->update(
                    [
		'ref_devis'=> $request->ref_devis,
		'date_devis'=> $request->date_devis,
		'debut'=> $request->debut,
		'fin'=> $request->fin,
		'lieu'=> $request->lieu,
		'debut'=> $request->debut,
		'fin'=> $request->fin,
		'lieu'=> $request->lieu,
	]
                );

            return redirect('/traveaux_client')->with('message',['Modier avec succes']);

        } catch (\Exception $e) {
            return back()->with('errors',$e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            DB::table('traveaux_client')
                ->where('id',$id)
                ->delete();
            return back()->with('success',['Supprimer avec succes']);
        } catch (\Exception $e) {
            return back()->with('errors',$e->getMessage());
        }
    }

}
