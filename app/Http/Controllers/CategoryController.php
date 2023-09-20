<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Pagination\Paginator;

class CategoryController extends Controller
{
    public function getAllCategoryAndBook()
    {
        $categories = Category::all();
        $books = Book::with('categories')->paginate(16);

        return view('welcome', ['categories' => $categories, 'books' => $books]);
    }
}
