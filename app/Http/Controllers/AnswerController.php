<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answer;

class AnswerController extends Controller
{

    public function getAnswersFromAPoll($id)
    {
        return Answer::GetAnswersFromAPoll($id);
    }

    public function getSameAnswersFromAPoll($id)
    {
        $answers = Answer::where('event_id', $id)->get();

        dd($answers);
    }
}
