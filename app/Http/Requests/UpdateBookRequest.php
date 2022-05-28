<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Interfaces\BookRepositoryInterface;

class UpdateBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(BookRepositoryInterface $bookRepository)
    {
        $book = $bookRepository->getBookByTag($this->route('tag'));
        return [
            'name' => 'required|string',
            'tag' => 'required|string|unique:books,tag,'.$book->id,
            'description' => 'required',
            'price' => 'required|min:0|max:9999',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Name',
            'tag' => 'Tag',
            'description' => 'Description',
            'price' => 'Price',
        ];
    }
}
