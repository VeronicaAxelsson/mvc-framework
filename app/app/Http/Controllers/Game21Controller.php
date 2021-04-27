<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Classes\Game21\Game;
use Illuminate\Http\Request;

/**
 * Controller for the index route.
 */
class Game21Controller extends Controller
{
    public function index()
    {
        if (session()->missing('game21')) {
            session()->put('game21', new Game());
        }
        session('game21')->playGame();
        $data = session('game21')->getData();

        return view('/game21', $data);
    }

    public function roll()
    {
        session('game21')->rollDice();
        return redirect()->route('game21');
    }

    public function end()
    {
        session('game21')->playComputer();
        session('game21')->checkWinner();

        return redirect()->route('game21');
    }

    public function reset()
    {
        session()->put('game21', new Game());
        session('game21')->resetGame();

        return redirect()->route('game21');
    }

    public function newRound()
    {
        session('game21')->resetGame();

        return redirect()->route('game21');
    }
}
