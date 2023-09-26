<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookStoreRequest;
use App\Models\Book;
use App\Models\Cart;
use App\Models\Category;
use App\Models\CategoryBook;
use App\Models\Media;
use Illuminate\Http\Request;
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
        $books = Book::with('medias')->paginate(config('app.paginate_book'));

        return view('books.list', ['books' => $books]);
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
     * @param  \Illuminate\Http\Request $request
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

        if ($request->has('image')) {
            $file = $request->file('image');
            $url = Storage::disk('public')->put('public/img', $file);

            $media = new Media();
            $media->book_id = $book->id;
            $media->link = $url;
            $media->type = config('app.media_type');

            $media->save();
        }

        return redirect()->route('books.index')->with('success', __('messages.book_added_successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view('books.show', [
            'book' => $book,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $categories = Category::all();

        return view('books.edit', compact('book', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Book $book
     * @return \Illuminate\Http\Response
     */
    public function update(BookStoreRequest $request, Book $book)
    {
        $book->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'publisher' => $request->publisher,
            'publisher_year' => $request->publisher_year,
            'author' => $request->author,
            'page_nums' => $request->page_nums,
        ]);

        $book->categories()->sync($request->category);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $url = Storage::disk('public')->put('public/img', $file);

            Media::where('book_id', '=', $book->id)->delete();
            $media = new Media();
            $media->book_id = $book->id;
            $media->link = $url;
            $media->type = config('app.media_type');

            $media->save();
        }

        return redirect()->route('books.show', $book)->with('success', __('Book updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        try {
            CategoryBook::where('book_id', $book->id)->delete();

            Media::where('book_id', $book->id)->delete();

            Cart::where('book_id', $book->id)->delete();

            $book->delete();

            return response()->json(['message' => __('Book deleted successfully')], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => __('Failed to delete the book')], 500);
        }
    }

    public function search(Request $request)
    {
        $categories = Category::all();
        $searchTerm = $request->input('input-search');
        $category = $request->input('category');

        if ($category !== 'all') {
            $books = Book::select('books.*')
                ->join('category_book', 'books.id', '=', 'category_book.book_id')
                ->where('category_book.category_id', $category)
                ->where('name', 'like', '%' . $searchTerm . '%')
                ->paginate(config('app.paginate_book'));
        } else {
            $books = Book::where('name', 'like', '%' . $searchTerm . '%')->paginate(config('app.paginate_book'));
        }

        return view('search', compact('books', 'searchTerm', 'categories', 'category'));
    }
}
