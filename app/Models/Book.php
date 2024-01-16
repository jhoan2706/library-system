<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    public function isAvailable()
    {
        // Check if the book has available copies
        return $this->total_copies > 0;
    }

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }
}
