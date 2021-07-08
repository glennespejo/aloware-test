<?php

namespace App\Collections;

use Illuminate\Database\Eloquent\Collection;

class CommentCollection extends Collection
{
    public function recursive()
    {
        $comments = parent::groupBy('parent_id');
        if (count($comments)) {
            $comments['root'] = $comments[''];
            unset($comments['']);
        }
        return $comments;
    }
}
