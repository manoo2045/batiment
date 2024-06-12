<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class TimeController extends Controller
{
    public function index() {
        $durations = [
            ['hours' => 2, 'minutes' => 0, 'seconds' => 0],
            ['hours' => 1, 'minutes' => 0, 'seconds' => 0],
            ['hours' => 3, 'minutes' => 20, 'seconds' => 0],
        ];

        $totalTime = Carbon::createFromTime(0, 0, 0);
        foreach ($durations as $duration) {
            $totalTime->addHours($duration['hours'])
                ->addMinutes($duration['minutes'])
                ->addSeconds($duration['seconds']);
        }

        dd($totalTime->format('H'));
    }
}
