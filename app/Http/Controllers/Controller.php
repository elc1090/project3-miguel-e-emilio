<?php

namespace App\Http\Controllers;

use App\Actions\CreateNewQuestion;
use App\Models\Question;
use App\Models\Team;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function play (Request $request) {
        $user = $request->user();

        $question = $user->openQuestion ?? (new CreateNewQuestion)->create($user);

        $question = json_decode(
            json: Http::get("https://real-heavy-paneer.glitch.me/question?seed=$question->seed")->body(),
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

        Question::unguard();
        $user->openQuestion->update([
            'correct' => $verify['result'] === 'right'
        ]);
        Question::reguard();

        \Session::flash('flash.banner', $verify['result']);

        if ($verify['result'] === 'wrong') {
            \Session::flash('flash.bannerStyle', 'danger');
        }

        return redirect('play');
    }

    public function rank (Request $request) {

        $user = $request->user();

        $team = $user->currentTeam;

        /** @var Collection $teamUsers */
        $teamUsers = $team->allUsers()
            ->filter(fn($user) => $user->answeredQuestions->isNotEmpty())
            ->load('answeredQuestions')
            ->sortByDesc('score')
            ->values();

        /** @var Collection $teams */
        $teams = Team::with([
            'users.answeredQuestions',
            'owner.answeredQuestions',
        ])->get()
            ->filter(fn($team) => $team->answeredQuestions->isNotEmpty())
            ->append('answeredQuestions')
            ->sortByDesc('score')
            ->values();

        return Inertia::render('Rank',[
            'team_users' => $teamUsers,
            'teams' => $teams ?? []
        ]);
    }
}
