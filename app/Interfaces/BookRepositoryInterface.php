<?php

namespace App\Interfaces;

interface BookRepositoryInterface
{
    public function getAllBooks(): object;
    public function getBookByTag(string $bookTag): object;
    public function deleteBook(string $bookTag): void;
    public function createBook(array $bookDetails): object;
    public function updateBook(string $bookTag, array $newDetails): object;
}
