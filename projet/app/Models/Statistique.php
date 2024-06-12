<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Statistique extends Model
{
    use HasFactory;

    public function getHistogramme($anne){
        return DB::select('WITH all_months as (
                                    select generate_series(date_trunc(\'year\',\''.$anne.'-01-01\'::date),date_trunc(\'year\',\''.$anne.'-01-01\'::date)+INTERVAL \'1 year -1 day\',\'1 month\') as month
                                )
                                select to_char(all_months.month,\'YYYY-MM\') as month,coalesce(sum(vt.prixtotale),0) as nb from all_months
                                    left join v_devis_traveaux_client vt on date_trunc(\'month\',vt.date_devis) = all_months.month
                                    group by month
                                    order by month;');
    }

    public static function getAnne() {
        return DB::table('traveaux_client')
            ->select(DB::raw('DISTINCT EXTRACT(YEAR FROM date_devis) as year'))
            ->orderBy('year')
            ->get();
    }

    public function getTotalDevis() {
        return DB::select('select sum(prixtotale) totale from v_devis_traveaux_client');
    }

    public function getTotalePaiment() {
        return DB::select('select sum(montant) total_paiment from v_detail_paiment');

    }
}
