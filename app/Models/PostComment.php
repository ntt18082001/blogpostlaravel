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

    /**
     * Config foreign post comment to user
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function author()
    {
        return $this->hasOne(User::class, 'id', 'author_id')->select('avatar', 'full_name');
    }

    /**
     * Config foreign post comment to post
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function post()
    {
        return $this->hasOne(Post::class, 'id', 'post_id');
    }

    /**
     * Config foreign post comment to post comment (1-n)
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comment_childs()
    {
        return $this->hasMany(PostComment::class, 'parent_id')->orderByDesc('id')->take(5);
    }
}
