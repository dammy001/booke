<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Library;

class LibraryController extends Controller
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function save()
    {
        $this->request->validate([
            'book_id' => 'required'
        ]);

        $check = Library::findOrFail($this->request->input('book_id'));

        if($check)
            return $this->sendError('Book already exists');

        $check->user()->create([
            'book_id' => $this->request->input('book_id')
        ]);
        return $this->sendSuccess('Book added to library');

    }
}
