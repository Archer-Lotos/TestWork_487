<?php

namespace App\Repositories;

use App\Interfaces\BookRepositoryInterface;
use App\Models\Book;

class BookRepository implements BookRepositoryInterface
{
    public function getAllBooks(): object
    {
        return Book::with('users')->get();
    }

    public function getBookByTag(string $bookTag): object
    {
        return Book::with('users')->where('tag', $bookTag)->firstOrFail();
    }

    public function deleteBook(string $bookTag): void
    {
        Book::where('tag', $bookTag)->firstOrFail()->delete();
    }

    public function createBook(array $bookDetails): object
    {
        return Book::create($bookDetails);
    }

    public function updateBook(string $bookTag, array $newDetails): object
    {
        $newTag = $newDetails['tag'];

        Book::where('tag', $bookTag)->update($newDetails);

        return Book::where('tag', $newTag)->firstOrFail();
    }
}
