<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Traveaux extends Model
{
    use HasFactory;

    public static function getTraveauxById($id){
        return DB::table('traveaux')
            ->where('id',$id)
            ->first();
    }

    public function getAllTraveaux() {
        return DB::table('traveaux')
            ->paginate(5);
    }


}
