<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @extends Model
 */
class Question extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'seed'];

    public $timestamps = false;
}
