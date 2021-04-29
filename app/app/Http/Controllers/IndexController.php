<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

/**
 * Controller for the index route.
 */
class IndexController extends Controller
{
    /**
     * Display a message.
     *
     * @param  string  $message
     * @return \Illuminate\Contracts\View\View
     */
    public function index($message = null)
    {

        return view('index', [
            "header" => "Index page",
            'message' => $message ?? "Hello, this is the index page, rendered as a layout."
        ]);
    }
}
