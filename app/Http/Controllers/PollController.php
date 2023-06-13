<?php

namespace App\Http\Controllers;

use App\Events\PollSent;
use App\Http\Requests\PollStoreRequest;
use App\Http\Resources\PollResource;
use App\Models\Event;
use App\Models\Type;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Request;

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

        // store
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
        //$event->save();

        $question = new PollResource($request->question);

        broadcast(new PollSent($question));

        // redirect
        return redirect()->route('polls.index')
            ->with('success', 'Le sondage a été envoyé');
    }

    public function getPolls()
    {
        return Event::GetEventsWithType("poll")->get();
    }

    public function getAPoll($id)
    {
        return Event::GetAEvent($id)->get();
    }

    public function getAnswersFromAPoll($id)
    {
        return Event::find($id)->answers;
    }
}
