<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Classes\Yatzy\Game;
use Illuminate\Http\Request;

/**
 * Controller for the index route.
 */
class YatzyController extends Controller
{
    /**
     * Display a message.
     *
     * @return \Illuminate\View\View
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function throw(Request $request)
    {
        session("yatzy")->moveDice();
        // session("yatzy")->showPost();

        return redirect()->route('yatzy');
    }

    /**
     * Display a message.
     *
     * @return Illuminate\Routing\RedirectResponse
     */
    public function newGame()
    {
        session()->put('yatzy', new Game());
        session()->put('yatzySum', 0);

        return redirect()->route('yatzy');
    }

    /**
     * Display a message.
     *
     * @return Illuminate\Routing\RedirectResponse
     */
    public function newRound()
    {
        session("yatzy")->sumRound();
        session("yatzy")->newRound();

        return redirect()->route('yatzy');
    }
}
