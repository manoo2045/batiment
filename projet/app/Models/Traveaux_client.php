<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Traveaux_client extends Model
{
    use HasFactory;

    public static function getTraveaux_clientById($id){
        return DB::table('traveaux_client')
            ->where('id',$id)
            ->first();
    }

    public function getAllTraveaux_client() {
        return DB::table('traveaux_client')
            ->get();
    }


}
