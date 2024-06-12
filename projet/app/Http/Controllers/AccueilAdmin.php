<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class AccueilAdmin extends Controller
{
    public function home() {
        return view('admin.home');
    }

    public function clearBd() {
        $tables = Schema::getAllTables();
        DB::statement('SET session_replication_role = replica');

        DB::beginTransaction();
        try {
            foreach ($tables as $table) {
//                dd($table->tablename);
                DB::table($table->tablename)->truncate();
                DB::statement('ALTER SEQUENCE ' . $table . '_id_seq RESTART WITH 1');
            }

            DB::commit();

            return redirect('home');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        } finally {
            DB::statement('SET session_replication_role = DEFAULT');
            $user = User::create([
                'pseudo' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin'),
                'is_admin' => true
            ]);
        }
    }
}
