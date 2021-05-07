<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title
 * @property string $author
 * @property string $ISBN
 * @property string $img
 */
class Book extends Model
{
    // use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'mvc_book';

    /**
   * Indicates if the model should be timestamped.
   *
   * @var bool
   */
    public $timestamps = false;
}
