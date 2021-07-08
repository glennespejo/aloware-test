<?php

namespace App\Models;

use Eloquent;
use App\Base\BaseModel;

/**
 * App\Models\Post
 *
 * @property int         $id
 * @property string|null $title
 * @mixin Eloquent
 */
class Post extends BaseModel
{
    /**
     * Get comments.
     *
     * @return HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function getRecursiveComments(){
		return $this->comments()->with('user')->get()->recursive();
	}

    public function addComment($data)
	{
		$comment = (new Comment())->forceFill($data);
		$comment->user_id = auth()->id();
		return $this->comments()->save($comment);
	}
}
