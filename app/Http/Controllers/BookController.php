<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Media;
use App\Http\Requests\BookStoreRequest;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('books.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(BookStoreRequest $request)
    {
        $book = new Book([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'publisher' => $request->input('publisher'),
            'publisher_year' => $request->input('publisher_year'),
            'author' => $request->input('author'),
            'page_nums' => $request->input('page_nums'),
        ]);

        $book->save();

        $book->categories()->attach($request->input('category'));

        if ($request->has("image")) {
            $file = $request->file("image");
            $disk = Storage::disk('public');
            $path = $disk->putFile('img', $file);
            $url = $disk->url($path);

            $media = new Media();
            $media->book_id = $book->id;
            $media->link = $url;
            $media->type = config('app.media_type');

            $media->save();
        }
        
        return redirect()->route('dashboard')->with('success', __('messages.book_added_successfully'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view('books.show', [
            "book" => $book,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
    }
    public function search(Request $request)
    {
        $searchTerm = $request->input('searchTerm');
        $categoryId = $request->input('categoryId');

        $query = Book::query();

        if ($categoryId != 'all') {
            $query->whereHas('categories', function ($query) use ($categoryId) {
                $query->where('categories.id', $categoryId);
            });
        }

        if ($searchTerm) {
            $query->where('name', 'like', '%' . $searchTerm . '%');
        }

        $books = $query->paginate(16);

        return response()->json(['books' => $books]);
    }
}
