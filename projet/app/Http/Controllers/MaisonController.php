<?php

namespace App\Http\Controllers;

use App\Models\Maison;
use App\Models\Finition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MaisonController extends Controller
{
    public function list() {
        $obj = new Maison();
        $maison = $obj->getAllMaison();
        return view('maison.list_maison',[
            'maisons' => $maison
        ]);
    }

    public function insert(Request $request){
        $request->validate(
        [
		'nom'=> ['required'],
		'surface'=> ['required'],
		'description'=> ['required'],
		'duree'=> ['required'],
	]
        );
        try {
            $id = DB::table('maison')->insertGetId([
		'nom'=> $request->nom,
		'surface'=> $request->surface,
		'description'=> $request->description,
		'duree'=> $request->duree,
	],'id');
            return back()->with('message',['Inserer maison avec succes']);
        } catch (\Exception $e) {
            return back()->with('errors',$e->getMessage());
        }
    }

    public function maisonEditView($id) {
        $maison = Maison::getMaisonById($id);

        return view('maison.update_maison',[
            'maison' => $maison
        ]);
    }

    public function maisonEdit(Request $request) {
        $request->validate(
        [
		'nom'=> ['required'],
		'surface'=> ['required'],
		'description'=> ['required'],
		'duree'=> ['required'],
	]
        );

        try {
            DB::table('maison')
                ->where('id', $request->id)
                ->update(
                    [
		'nom'=> $request->nom,
		'surface'=> $request->surface,
		'description'=> $request->description,
		'duree'=> $request->duree,
	]
                );

            return redirect('/maison')->with('message',['Modier avec succes']);

        } catch (\Exception $e) {
            return back()->with('errors',$e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            DB::table('maison')
                ->where('id',$id)
                ->delete();
            dd('ttt');
            return redirect('/maison')->with('success',['Supprimer avec succes']);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return back()->with('errors',$e->getMessage());
        }
    }

}
