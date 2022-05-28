<?php

namespace App\Repositories;

use App\Interfaces\SearchRepositoryInterface;
use App\Models\Book;

class SearchRepository implements SearchRepositoryInterface
{

    public function search(string $question): object
    {
        return Book::with(['users'])
            ->whereHas('users', function($query) use ($question)  {
                $query->where('name', 'LIKE', '%' . $question . '%');
            })
            ->orWhere(function ($query) use ($question) {
                $query->where('name', 'LIKE', '%' . $question . '%')
                    ->orWhere('description', 'LIKE', '%' . $question . '%');
            })->get();//->take(5)->get();
    }

    public function filter(object $searched, string $sort = 'abc'): object
    {
        switch ($sort) {
            case 'up':
                return $searched->sortBy('price');
                break;
            case 'dwn':
                return $searched->sortByDesc('price');
                break;
            case 'zyx':
                return $searched->sortByDesc('name');
                break;
            case 'abc':
                return $searched->sortBy('name');
                break;
            default:
                return $searched->sortBy('name');
                break;
        }
    }
}
