<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\SearchRepositoryInterface;
use App\Models\Book;

class SearchController extends Controller
{
    private SearchRepositoryInterface $searchRepository;

    public function __construct(SearchRepositoryInterface $searchRepository)
    {
        $this->pivot = $searchRepository;
    }

    public function search(Request $request)
    {
        if ($request->has('question')) {
            $searched = $this->pivot->search($request['question']);
            if ($request->filled('sort') && $searched->isNotEmpty()) {
                $filtered = $this->pivot->filter($searched, $request['sort']);
            } elseif ($searched->isNotEmpty()) {
                $filtered = $this->pivot->filter($searched, 'abc');
            } else {
                return response(['answer' => 'Nothing found'], 404);
            }
            return response()->json(['answer' => $filtered], 200);
        }
        return response(['answer' => 'Nothing found'], 404);
    }
}
