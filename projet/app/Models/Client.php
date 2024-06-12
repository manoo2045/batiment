<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Client extends Model
{
    use HasFactory;

    protected $table ='client';

    public function insert($contact){
        return DB::table('client')->insertGetId([
           'contact' => $contact,
        ]);
    }


    public static function user(){
        return DB::table('client')
            ->where('id',Session::get('client'))
            ->first();
    }
}
