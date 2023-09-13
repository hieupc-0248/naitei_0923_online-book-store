<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $table = 'medias';

    protected $fillable = [
        'link',
        'type',
        'book_id',
    ];

    public function books()
    {
        return $this->belongsTo(Book::class);
    }
}
