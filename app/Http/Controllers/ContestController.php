<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContestStoreRequest;
use App\Models\Answer;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Participant;
use Illuminate\View\View;
use App\Models\Type;

class ContestController extends Controller
{

    public function index(): View
    {
        $events = Event::GetEventsWithType("contest")->with('user')->get();

        return view('contests.index', [
            'events' => $events,
        ]);
    }

    public function create(): View
    {

        return view('contests.index');
    }

    public function store(ContestStoreRequest $request)
    {

        $idType = Type::getIDOfAType('contest')->first();

        // store Event
        $event = new Event();
        $event->name_of = $request->name_of;
        $event->description = $request->description;
        $event->question = $request->question;
        $event->duration = $request->duration;
        if ($request->is_predefined) $event->is_predefined = false;
        else $event->is_predefined = true;
        $event->is_active = true;
        $event->type_id = $idType->id;
        $event->user_id = request()->session()->get('id');
        $event->save();

        // store Answers if exists
        if ($request->choices) {
            $count = 1;
            foreach ($request->choices as $choice) {
                $answer = new Answer();
                $answer->no = $count;
                $answer->name_of = $choice;
                $answer->is_answer = false;
                $answer->is_active = true;
                $answer->event_id = $event->id;
                $answer->user_id = request()->session()->get('id');
                $answer->save();
                $count++;
            }
        }
    }

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
