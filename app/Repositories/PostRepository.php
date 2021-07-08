<?php

namespace App\Repositories;

use App\Base\BaseRepository;
use App\Models\Post;

class PostRepository extends BaseRepository
{

    /**
     * @inheritDoc
     */

    protected function model()
    {
        return new Post();
    }

    public function getAllPostWithComments()
    {
        $posts = $this->all();
        $posts->each(function($post) {
            $post['comments'] = $post->getRecursiveComments();
        });
        return $posts;
    }
}
