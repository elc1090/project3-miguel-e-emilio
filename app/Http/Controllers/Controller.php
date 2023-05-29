<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function play (Request $request) {
        $user = $request->user();

        $seed = $request->get("seed","123");

        $question = json_decode(
            json: Http::get("https://real-heavy-paneer.glitch.me/question?seed=$seed")->body(),
            associative: true
        );

        $question['choices'] = collect($question['choices'])->map(fn($choice) => [
            'id' => $choice['id'],
            'name' => ($choice['name'] === 'MINOR_CHARACTER') ? 'Minor character' : $choice['name']
        ])->toArray();

        return Inertia::render('Play',[
            'question_number' => 3,
            'question' => $question['subject'],
            'question_id' => $question['id'],
            'choices' => $question['choices'],
        ]);
    }

    public function answer (Request $request) {
        $user = $request->user();
        $question = $request->input('question');
        $answer = $request->input('answer');

        $verify = json_decode(
            json: Http::get("https://real-heavy-paneer.glitch.me/verify?id=$question&answer=$answer")->body(),
            associative: true
        );

        \Session::flash('flash.banner', $verify['result']);
        if ($verify['result'] === 'wrong') {
            \Session::flash('flash.bannerStyle', 'danger');
        }

        return redirect('play');
    }
}
