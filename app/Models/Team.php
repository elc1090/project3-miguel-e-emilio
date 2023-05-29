<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Jetstream\Events\TeamCreated;
use Laravel\Jetstream\Events\TeamDeleted;
use Laravel\Jetstream\Events\TeamUpdated;
use Laravel\Jetstream\Team as JetstreamTeam;

class Team extends JetstreamTeam
{
    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'personal_team' => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'personal_team',
    ];

    /**
     * The event map for the model.
     *
     * @var array<string, class-string>
     */
    protected $dispatchesEvents = [
        'created' => TeamCreated::class,
        'updated' => TeamUpdated::class,
        'deleted' => TeamDeleted::class,
    ];

    protected $appends = ['score'];


    public function answeredQuestions(): Attribute {
        return Attribute::make(
            get: fn() => $this
                ->allUsers()
                ->load('answeredQuestions')
                ->map->answeredQuestions
                ->flatten()
        );
    }

    public function score(): Attribute {
        return Attribute::make(
            get: function(): ?int {
                $questions = $this->answeredQuestions;
                $total = $questions->count();
                return $total === 0 ? null : $questions
                        ->filter(fn($question) => $question->correct)
                        ->count() / $total * 100;

            }
        );
    }
}
