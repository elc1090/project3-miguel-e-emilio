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

        return Inertia::render('Play',[
            'question' => $question['subject'],
            'choices' => $question['choices'],
        ]);
    }
}
