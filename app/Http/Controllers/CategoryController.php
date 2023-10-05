<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function getAllCategoryAndBook()
    {
        $categories = Category::all();
        $books = Book::leftJoin('reviews', 'books.id', '=', 'reviews.book_id')
                    ->select('books.*', DB::raw('AVG(reviews.rating) as average_rating'))
                    ->groupBy('books.id')->with('categories')->paginate(config('app.paginate_book'));

        return view('welcome', ['categories' => $categories, 'books' => $books]);
    }
}
