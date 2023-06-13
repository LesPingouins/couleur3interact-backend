<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class ContestController extends Controller
{

    public function getContests()
    {
        return Event::GetEventsWithType("contest")->get();
    }
}
