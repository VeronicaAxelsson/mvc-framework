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
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $data = [];
        $diceHand = "";

        if (session()->missing('dice')) {
            $diceHand = new DiceHand();
        }

        if (session()->exists('dice')) {
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function roll()
    {
        // $dice = $request->dice;
        $dice = $_POST["dice"];
        return redirect()->route('dice')->with('dice', $dice);
    }
}
