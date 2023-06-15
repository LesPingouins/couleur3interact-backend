<?php

namespace App\Http\Controllers;

use App\Events\PollSent;
use App\Http\Requests\PollStoreRequest;
use App\Http\Resources\PollResource;
use App\Models\Answer;
use App\Models\Event;
use App\Models\Type;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PollController extends Controller
{
    public function index(): View
    {
        $events = Event::GetEventsWithType("poll")->with('user')->get();

        return view('polls.index', [
            'events' => $events,
        ]);
    }

    public function create(): View
    {

        return view('polls.create');
    }

    public function store(PollStoreRequest $request)
    {

        $idType = Type::getIDOfAType('poll')->first();

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


        $question = new PollResource($request->question);

        broadcast(new PollSent($question));

        // redirect
        return redirect()->route('polls.index')
            ->with('success', 'Le sondage a été envoyé');
    }

    public function getPolls()
    {
        return Event::GetEventsWithType("poll")->where('is_active', true)->get();
    }

    public function getAPoll($id)
    {
        return Event::GetAEvent($id)->get();
    }

    public function getAnswersFromAPoll($id)
    {
        return Event::find($id)->answers;
    }

    public function setAPollInactive($id)
    {
        $event = Event::find($id);
        $event->is_active = false;
        $event->save();

        return response('Resource updated', 204)
            ->header('Content-Type', 'text/plain');
    }

    public function disablePolls()
    {
        $events = Event::all()->where('is_active', true);

        if ($events != null) {
            foreach (@$events as $key => $value) {

                $date1 = Carbon::now();
                $date2 = Carbon::parse($value->created_at)
                    ->addSeconds($value->duration);

                if ($date1->gte($date2)) {
                    $this->setAPollInactive($value->id);
                }
            }
        }
        return response('All polls disabled', 418)
            ->header('Content-Type', 'application/json');
    }

    public function sendAnswerToAPoll(Request $request)
    {
        $answer = new Answer();

        $answer->name_of = $request->answer;
        $answer->is_answer = false;
        $answer->is_active = true;
        $answer->event_id = $request->event_id;
        $answer->user_id = $request->user_id;
        $answer->save();

        return response('Answer created', 201)
            ->header('Content-Type', 'application/json');
    }

    public function getSameAnswersFromAPoll($id)
    {
        $answers = Answer::select("name_of")->where('event_id', $id)->get()->toArray();

        $newArrayAnswers = [];
        $arrayAnswersToReturn = [];

        foreach ($answers as $key => $value) {
            array_push($newArrayAnswers, $value["name_of"]);
        }

        foreach (array_count_values($newArrayAnswers) as $value => $key) {
            if ($key >= 5) {
                $arrayAnswersToReturn[$value] =  $key;
            }
        }

        return response()->json([
            'answers' => $arrayAnswersToReturn,
        ]);
    }
}
