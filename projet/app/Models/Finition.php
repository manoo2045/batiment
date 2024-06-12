<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Finition extends Model
{
    use HasFactory;


    public static function getFinitionById($id){
        return DB::table('finition_maison')
            ->where('id',$id)
            ->first();
    }

    public function getAll() {
        return DB::table('finition_maison')
            ->get();
    }

    public static function getAllTravaux() {
        return DB::table('traveaux')->get();
    }

    public static function getTaveauxById($id) {
        return DB::table('traveaux')
            ->where('id',$id)
            ->first();
    }

}
