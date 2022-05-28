<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Interfaces\BookRepositoryInterface;
use App\Http\Requests\{
    StoreBookRequest,
    UpdateBookRequest,
};
use Illuminate\Http\{JsonResponse, Request, Response};

class BookController extends Controller
{
    private BookRepositoryInterface $Repository;

    public function __construct(BookRepositoryInterface $Repository)
    {
        $this->pivot = $Repository;
    }

    public function index(): JsonResponse
    {
        return response()->json([
            'data' => $this->pivot->getAllBooks()
        ]);
    }

    public function create()
    {
        //
    }

    public function store(StoreBookRequest $request): JsonResponse
    {
        return response()->json(
            [
                'data' => $this->pivot->createBook($request->all())
            ],
            Response::HTTP_CREATED
        );
    }

    public function show(Request $request): JsonResponse
    {
        $bookTag = $request->route('tag');

        return response()->json([
            'data' => $this->pivot->getBookByTag($bookTag)
        ]);
    }

    public function edit(Book $book)
    {
        //
    }

    public function update(UpdateBookRequest $request): JsonResponse
    {
        $bookTag = $request->route('tag');

        return response()->json([
            'data' => $this->pivot->updateBook($bookTag, $request->all())
        ]);
    }

    public function destroy(Request $request): JsonResponse
    {
        $bookTag = $request->route('tag');
        $this->pivot->deleteBook($bookTag);

        return response()->json([
            'message' => 'The book destroy'
        ]);
    }
}
