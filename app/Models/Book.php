<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'publication_year',
        'category',
        'is_available',
        'cover_image',
        'description',
    ];

    protected $casts = [
        'is_available' => 'boolean',
        'publication_year' => 'integer',
    ];

    /**
     * Get the borrows for the book.
     */
    public function borrows()
    {
        return $this->hasMany(Borrow::class);
    }
}
