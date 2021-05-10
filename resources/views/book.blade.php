<?php

/**
 * View for Dice.
 */

declare(strict_types=1);

$books = $books ?? [];
// var_dump($books);
?>

@include('includes.header')

<h1>Böcker</h1>
<table>
    <?php foreach ($books as $book) { ?>
        <tr>
            <td class="no-frame"><?= $book['title'] ?><br><br><?= $book['author'] ?><br><br><?= $book['ISBN'] ?></td>
            <td class="no-frame"><img src="img/<?= $book['img'] ?>" alt="<?= $book['img'] ?>"></td>
        </tr>
    <?php } ?>
</table>

@include('includes.footer')
