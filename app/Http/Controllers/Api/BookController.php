<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Book::orderBy('id', 'asc')->get();

        return response()->json([
            'status' => true,
            'message' => 'List of Books',
            'data' => $data,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'published_date' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation Error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $validator->validate();
        $book = Book::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Book created successfully',
            'data' => $book,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Book::find($id);

        if ($data) {
            return response()->json([
                'status' => true,
                'message' => 'Book found',
                'data' => $data,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Book not found',
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'status' => false,
                'message' => 'Book not found',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'published_date' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation Error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $validator->validate();

        $book->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Book updated successfully',
            'data' => $book,
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'status' => false,
                'message' => 'Book not found',
            ], 404);
        }

        $book->delete();

        return response()->json([
            'status' => true,
            'message' => 'Book deleted successfully',
        ], 200);
    }
}
