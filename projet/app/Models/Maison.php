<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Maison extends Model
{
    use HasFactory;

    public static function getMaisonById($id){
        return DB::table('maison')
            ->where('id',$id)
            ->first();
    }

    public function getAllMaison() {
        return DB::table('v_maison')
            ->get();
    }


}
