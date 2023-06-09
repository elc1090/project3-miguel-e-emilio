<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property-read integer score *
 * @extends Model
 */
class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url', 'score'
    ];

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    public function answeredQuestions(): HasMany
    {
        return $this->hasMany(Question::class)->whereNotNull('correct');
    }

    public function openQuestion(): HasOne
    {
        return $this->hasOne(Question::class)->whereNull('correct');
    }

    protected function score(): Attribute {
        return Attribute::make(
            get: function(): ?int {

                $questions = $this
                    ->answeredQuestions
                    ->pluck('correct');

                $total = $questions->count();

                return $total === 0 ? null : $questions
                    ->filter(fn($question) => $question)
                    ->count() / $total * 100;
            }
        );
    }
}
