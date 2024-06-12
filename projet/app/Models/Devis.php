<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Devis extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function creerDevis($idClient,$idMaison,$idFinition,$dateDevis,$dateDebut,$lieu){

        $finition = Finition::getFinitionById($idFinition);
        $maison = Maison::getMaisonById($idMaison);

        $date = Carbon::parse($dateDebut);
        $fin = $date->addDay($maison->duree);
        $idDevis = DB::table('traveaux_client')->insertGetId([
            'id_client' => $idClient,
            'id_maison' => $idMaison,
            'id_finition' => $idFinition,
            'date_devis' => $dateDevis,
            'debut' => $dateDebut,
            'lieu' => $lieu
        ],'ref_devis');

        $this->saveDevis($idDevis,$idMaison,$idFinition);
    }

    public function getAll() {
        return DB::table('traveaux_client')
            ->get();
    }

    public function getDevisById($ref_dev) {
        return DB::table('v_devis_traveaux_client')
            ->where('ref_devis',$ref_dev)
            ->first();
    }

    public static function getFinitionById($id){
        return DB::table('finition_maison')
            ->where('id',$id)
            ->first();
    }

    public static function getTraveauxByIdMaison($idMaison) {
        return DB::table('v_devis_traveaux_detail')
            ->where('id_maison',$idMaison)
            ->orderBy('code')
            ->get();
    }

    public static function getTraveauxByRef($ref) {
        return DB::table('v_devis_traveaux_detail')
            ->where('ref_devis',$ref)
            ->orderBy('code')
            ->get();
    }

    public function saveDevis($ref_devis,$idMaison,$idFinition) {
        $traveaux = Devis::getTraveauxByIdMaison($idMaison);
        $finition = Devis::getFinitionById($idFinition);
        foreach ($traveaux as $t){
            DB::table('devis_traveaux_maison')->insert([
                'id_traveaux' => $t->id,
                'ref_devis' => $ref_devis,
                'prix_unitaire' => $t->prix_unitaire,
                'quantite' => $t->quantite,
            ]);
        }
        DB::table('devis_finition')->insert([
            'ref_devis' => $ref_devis,
            'id_finition' => $finition->id,
            'pourcentage' => $finition->pourcentage,
        ]);
    }

    public function getPaiment($ref) {
        return DB::table('payment_client')
            ->where('ref_devis',$ref)
            ->get();
    }
}
