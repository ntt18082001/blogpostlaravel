<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
    use HasFactory;
    protected $fillable = [
        'content',
        'post_id',
        'author_id',
        'parent_id'
    ];
    public function author() {
        return $this->hasOne(User::class, 'id', 'author_id');
    }
}
