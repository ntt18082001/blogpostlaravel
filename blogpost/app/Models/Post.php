<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'summary',
        'content',
        'cover_path',
        'status',
        'category_id',
        'author_id'
    ];

    public function category() {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
    public function author() {
        return $this->hasOne(User::class, 'id', 'author_id');
    }
}
