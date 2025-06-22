<?php

namespace App\Http\Controllers;

use App\Models\Book;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $client = new Client();
        $url = "http://127.0.0.1:8000/api/book";
        $response = $client->request('GET', $url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        $data = $contentArray['data'];

        return view('book.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            'title' => $request->title,
            'author' => $request->author,
            'published_date' => $request->published_date,
        ];

        if (in_array(null, $data, true)) {
            return redirect()->to('book')->withErrors([
                'error' => 'All fields are required.'
            ])->withInput();
        }

        $client = new Client();
        $url = "http://127.0.0.1:8000/api/book";
        $client->request('POST', $url, [
            'headers' => [
                'Content-type' => 'application/json',
            ],
            'body' => json_encode($data)
        ]);

        return redirect()->to('book')->with('success', 'Book created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dataId = Book::find($id);
        if ($dataId == null) {
            return redirect()->to('book')->withErrors([
                'error' => 'Data Not Found.'
            ])->withInput();
        }

        $client = new Client();
        $url = "http://127.0.0.1:8000/api/book/$id";
        $response = $client->request('GET', $url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        $data = $contentArray['data'];
        return view('book.index', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = [
            'title' => $request->title,
            'author' => $request->author,
            'published_date' => $request->published_date,
        ];

        if (in_array(null, $data, true)) {
            return redirect()->to('book/' . $id)->withErrors([
                'error' => 'All fields are required.'
            ])->withInput();
        }

        $client = new Client();
        $url = "http://127.0.0.1:8000/api/book/$id";
        $client->request('PUT', $url, [
            'headers' => [
                'Content-type' => 'application/json',
            ],
            'body' => json_encode($data)
        ]);

        return redirect()->to('book')->with('success', 'Book updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $client = new Client();
        $url = "http://127.0.0.1:8000/api/book/$id";
        $client->request('DELETE', $url);

        return redirect()->to('book')->with('success', 'Book deleted successfully!');
    }
}
