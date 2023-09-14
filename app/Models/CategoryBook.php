<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryBook extends Model
{
    use HasFactory;

    protected $table = 'category_book';

    protected $fillable = [
        'category_id',
        'book_id',
    ];

    public function books()
    {
        return $this->belongsToMany(Book::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
