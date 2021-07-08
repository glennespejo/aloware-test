<?php

namespace App\Models;

use Eloquent;
use App\Base\BaseModel;
use App\Collections\CommentCollection;

/**
 * App\Models\Comment
 *
 * @property int         $id
 * @property string|null $title
 * @mixin Eloquent
 */
class Comment extends BaseModel
{
    /**
     * Get User.
     *
     * @return BelongsTo
     */
    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function newCollection(array $models = [])
    {
        return new CommentCollection($models);
    }
}
