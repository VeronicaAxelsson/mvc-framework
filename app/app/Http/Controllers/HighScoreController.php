<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\HighScore;
use Illuminate\Http\Request;

/**
 * Controller for the index route.
 */
class HighScoreController extends Controller
{
    /**
     * Create diceHand with given dice
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {

        $data = $this->allHighScores();
        return view('/high-score', $data);
    }

    /**
     * Get five highest scores
     *
     * @return Array
     */
    public function allHighScores()
    {
        $data = [];
        $highScore = HighScore::all()
               ->sortByDesc('score')
               ->skip(0)
               ->take(5)
               ->toArray();
        $data['highScores'] = $highScore;
        return $data;
    }
}
