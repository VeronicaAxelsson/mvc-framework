<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Classes\Yatzy\Game;
use App\Models\HighScore;
use Illuminate\Http\Request;

/**
 * Controller for the index route.
 */
class YatzyController extends Controller
{
    /**
     * Display a message.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        if (session()->missing('yatzy')) {
            session()->put('yatzy', new Game());
        }
        // $request->session()->forget('yatzy');

        session('yatzy')->playGame();
        $data = session('yatzy')->getData();
        return view('/yatzy', $data);
    }

    /**
     * Store a new user.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function throw()
    {
        session("yatzy")->moveDice();
        // session("yatzy")->showPost();

        return redirect()->route('yatzy');
    }

    /**
     * Display a message.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function newGame()
    {
        $data = session('yatzy')->getData();
        $highScore = new HighScore();
        $highScore->score = $data['totalScore'];
        $highScore->save();

        session()->put('yatzy', new Game());
        session()->put('yatzySum', 0);

        return redirect()->route('yatzy');
    }

    /**
     * Display a message.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function newRound()
    {

        session("yatzy")->sumRound();
        session("yatzy")->newRound();

        return redirect()->route('yatzy');
    }
}
