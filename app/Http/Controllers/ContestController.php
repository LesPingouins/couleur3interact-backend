<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Participant;

class ContestController extends Controller
{

    public function getContests()
    {
        return Event::GetEventsWithType("contest")->get();
    }

    public function getAContest($id)
    {
        return Event::GetAEvent($id)->get();
    }

    public function answerContest(Request $request)
    {

        $participant = new Participant();
        $participant->is_active = true;
        $participant->event_id = $request->event_id;
        $participant->user_id = $request->user_id;
        $participant->save();


        $answer = new Answer();
        $answer->name_of = $request->answer;
        $answer->is_answer = false;
        $answer->is_active = true;
        $answer->event_id = $request->event_id;
        $answer->user_id = $request->user_id;
        $answer->save();

        return $request;
    }
}
