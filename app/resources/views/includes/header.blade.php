<!-- /**
 * Standard view template to generate a simple web page, or part of a web page.
 */ -->

<!doctype html>
<html>
    <meta charset="utf-8">
    <!-- <title><?= $title ?? "No title" ?></title> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/favicon.ico">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<header>
    <nav>
        <a href="{{ url('/index') }}">Home</a>
        <!-- <a href="/session">Session</a> -->
        <a href="{{ url('/dice') }}">Dice</a>
        <a href="{{ url('/game21') }}">Game21</a>
        <a href="{{ url('/yatzy') }}">Yatzy</a>
    </nav>
</header>
<main>
