<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

/**
 * Controller for the index route.
 */
class BookController extends Controller
{
    /**
     * Display all books
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {

        $data = $this->allBooks();
        return view('/book', $data);
    }

    /**
     * Add book to table book
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function addBook()
    {
        $book = new Book();

        $book->title = "Flickorna";
        $book->ISBN = "9789100118679";
        $book->author = "Emma Cline";
        $book->img = 'flickorna.jpg';

        $book->save();
        return view('/book');
    }

    /**
     * Get all books
     *
     * @return Array
     */
    public function allBooks()
    {
        $data = [];
        $book = Book::all()
               ->toArray();
        $data['books'] = $book;
        return $data;
    }

//     /**
//      * Delete book from table book
//      *
//      * @return \Illuminate\Contracts\View\View
//      */
//     public function deleteBook()
//     {
//         $book = new Book();
//         $book->where('author', '=', 'J.K Rowling')->delete();
//         return view('/book');
//     }
// }
