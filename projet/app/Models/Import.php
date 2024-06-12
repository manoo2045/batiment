<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Import extends Model
{
    use HasFactory;

    public function inportTM($path,$path2){
        $data = \Maatwebsite\Excel\Facades\Excel::toArray(new \App\Imports\Import(),storage_path($path))[0];
        $datas2 = \Maatwebsite\Excel\Facades\Excel::toArray(new \App\Imports\Import(),storage_path($path2))[0];
        $message = [];
        DB::table('maison_traveau_import')->truncate();
        $i = 0;
        foreach ($data as $d) {
            try {
                $validation = Validator::make([
                    'type_maison' => $d['type_maison'],
                    'description' => $d['description'],
                    'surface' => $d['surface'],
                    'code_travaux' => $d['code_travaux'],
                    'type_travaux' => $d['type_travaux'],
                    'unite' => $d['unite'],
                    'prix_unitaire' => $d['prix_unitaire'],
                    'quantite' => $d['quantite'],
                    'duree_travaux' => $d['duree_travaux']
                ], [
                    'type_maison' => ['required'],
                    'description' => ['required'],
                    'surface' => ['required'],
                    'code_travaux' => ['required'],
                    'type_travaux' => ['required'],
                    'unite' => ['required'],
                    'prix_unitaire' => ['required'],
                    'quantite' => ['required'],
                    'duree_travaux' => ['required']
                ]);
                $validation->validated();
                DB::table('maison_traveau_import')->insert([
                    'type_maison' => $d['type_maison'],
                    'description' => $d['description'],
                    'surface' => str_replace(',', '.', $d['surface']),
                    'code_travaux' => $d['code_travaux'],
                    'type_travaux' => $d['type_travaux'],
                    'unite' => $d['unite'],
                    'prix_unitaire' => str_replace(',', '.', $d['prix_unitaire']),
                    'quantite' => str_replace(',', '.', $d['quantite']),
                    'duree_travaux' => str_replace(',', '.', $d['duree_travaux'])
                ]);
            } catch (\Exception $e) {
                $message[] = $e->getMessage() . ' || ligne : ' . $i;
            }
        }
        DB::table('devis_import')->truncate();
        foreach ($datas2 as $data2) {
            try {
                $validation = Validator::make([
                    'client' => $data2['client'],
                    'ref_devis' =>  $data2['ref_devis'],
                    'type_maison' =>  $data2['type_maison'],
                    'finition' =>  $data2['finition'],
                    'taux_finition'=> $data2['taux_finition'],
                    'date_devis'=>  $data2['date_devis'],
                    'date_debut'=>  $data2['date_debut'],
                    'lieu' =>  $data2['lieu']
                ],[
                    'client' => ['required'],
                    'ref_devis' => ['required'],
                    'type_maison' => ['required'],
                    'finition' =>  ['required'],
                    'taux_finition'=> ['required'],
                    'date_devis'=>  ['required'],
                    'date_debut'=>  ['required'],
                    'lieu' =>  ['required'],
                ]);
                $validation->validated();
                DB::table('devis_import')->insert([
                    'client' => $data2['client'],
                    'ref_devis' =>  $data2['ref_devis'],
                    'type_maison' =>  $data2['type_maison'],
                    'finition' =>  $data2['finition'],
                    'taux_finition'=> str_replace(',','.',str_replace('%','',$data2['taux_finition'])) ,
                    'date_devis'=>  $data2['date_devis'],
                    'date_debut'=>  $data2['date_debut'],
                    'lieu' =>  $data2['lieu']
                ]);

            } catch (\Exception $e) {
                $message[] = $e->getMessage() .' || ligne : '. $i;
            }
        }

        $err =[];
        try {
            DB::insert('insert into client(contact) select client from devis_import group by client');
        } catch (\Exception $e) {
            $message[] = $e->getMessage();
        }

        try {
            DB::insert('insert into maison(nom,description,surface,duree)
                select type_maison,description,surface,duree_travaux from maison_traveau_import group by type_maison,description,surface,duree_travaux;');
        } catch (\Exception $e) {
            $message[] = $e->getMessage();
        }
        try {
            DB::insert('insert into finition_maison(nom,pourcentage)
                            select finition,taux_finition from devis_import group by finition,taux_finition');
        } catch (\Exception $e) {
            $message[] = $e->getMessage();
        }

        try {
            DB::insert('insert into traveaux(code,nom,prix_unitaire,unite)
                select code_travaux,type_travaux,prix_unitaire,unite from maison_traveau_import group by type_travaux,code_travaux,prix_unitaire,unite');
        } catch (\Exception $e) {
            $message[] = $e->getMessage();
        }

        try {
            DB::insert('insert into traveaux_type_maison(id_maison,id_traveaux,quantite)
                select m.id,t.id,mi.quantite from maison_traveau_import mi
                    join maison m on mi.type_maison = m.nom
                    join traveaux t on mi.code_travaux = t.code group by m.id,t.id,mi.quantite;');
        } catch (\Exception $e) {
            $message[] = $e->getMessage();
        }

        try {
            DB::insert('insert into traveaux_client(id_client,ref_devis,id_maison,id_finition,date_devis,debut,lieu)
                select cli.id,di.ref_devis,m.id,f.id,di.date_devis,di.date_debut,di.lieu from devis_import di
                    join client cli on di.client = cli.contact
                    join maison m on di.type_maison = m.nom
                    join finition_maison f on di.finition = f.nom group by cli.id,di.ref_devis,m.id,f.id,di.date_devis,di.date_debut,di.lieu');
        } catch (\Exception $e) {
            $message[] = $e->getMessage();
        }

        try {
            DB::insert('insert into devis_traveaux_maison(id_traveaux,ref_devis,prix_unitaire,quantite)
                        select t.id,tc.ref_devis,t.prix_unitaire,mi.quantite from maison_traveau_import mi
                            join devis_import di on di.type_maison = mi.type_maison
                            join traveaux t on mi.code_travaux = t.code
                            join traveaux_client tc on di.ref_devis= tc.ref_devis group by t.id,tc.ref_devis,t.prix_unitaire,mi.quantite');
        } catch (\Exception $e) {
            $message[] = $e->getMessage();
        }

        try {
            DB::insert('insert into devis_finition(ref_devis,id_finition,pourcentage)
                                select di.ref_devis,f.id,f.pourcentage from devis_import di
                                    join finition_maison f on di.finition = f.nom');
        } catch (\Exception $e) {
            $message[] = $e->getMessage();
        }

        return $message;
    }

    public function inportPaiment($path) {
        $data = \Maatwebsite\Excel\Facades\Excel::toArray(new Import(),storage_path($path));

        $message = [];
        DB::table('paiment_import')->truncate();
        for ($i = 1;$i<count($data[0]);$i++) {
            try {
                $validation = Validator::make([
                    'ref_devis' => $data[0][$i][0],
                    'ref_paiement' =>  $data[0][$i][1],
                    'date_paiement' =>  $data[0][$i][2],
                    'montant' =>  $data[0][$i][3],
                ],[
                    'ref_devis' => ['required'],
                    'ref_paiement' => ['required'],
                    'date_paiement' => ['required'],
                    'montant' =>  ['required'],
                ]);
                $validation->validated();
                DB::table('paiment_import')->insert([
                    'ref_devis' => $data[0][$i][0],
                    'ref_paiement' =>  $data[0][$i][1],
                    'date_paiement' =>  $data[0][$i][2],
                    'montant' =>  str_replace(',','.',$data[0][$i][3]),
                ]);
            } catch (\Exception $e) {
                $message[] = $e->getMessage() .' || ligne : '. $i;
            }
        }
        try {
            DB::insert('insert into payment_client (ref_paiement,ref_devis,montant,date) select ref_paiement,ref_devis,montant,date_paiement from paiment_import');
        } catch (\Exception $e) {
            $message[] = $e->getMessage();
        }

        return $message;
    }

}
