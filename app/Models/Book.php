<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';

    protected $fillable = [
        'name',
        'description',
        'price',
        'publisher',
        'publisher_year',
        'author',
        'page_nums',
        'stock',
    ];

    public function categories()
    {
        return $this->BelongsToMany(Category::class, 'category_book');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function medias()
    {
        return $this->hasMany(Media::class);
    }
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
