<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Classes\Dice\DiceHand;
use Illuminate\Http\Request;

/**
 * Controller for the index route.
 */
class DiceController extends Controller
{
    /**
     * Create diceHand with given dice
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if (session()->missing('dice')) {
            $diceHand = new DiceHand();
        } else {
            $dice = intval(session()->get('dice'));
            $diceHand = new DiceHand($dice);
        }

        $diceHand->roll();
        $data['classes'] = $diceHand->graphic();
        return view('/dice', $data);
    }

    /**
     * Roll dice
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function roll(Request $request)
    {
        $dice = $request->dice;
        return redirect()->route('dice')->with('dice', $dice);
    }
}
