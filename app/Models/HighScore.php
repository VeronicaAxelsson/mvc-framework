<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\HighScore
 * @property int $id
 * @property int $score
 */
class HighScore extends Model
{
    // use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'mvc_high_score';

    /**
   * Indicates if the model should be timestamped.
   *
   * @var bool
   */
    public $timestamps = false;
}
