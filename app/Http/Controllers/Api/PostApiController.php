<?php

namespace App\Http\Controllers\Api;

use App\Base\BaseController;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;
use Validator;
class PostApiController extends BaseController
{
    private $postRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function getAllPostWithComments()
    {
        return response()->json($this->postRepository->getAllPostWithComments(), 200);
    }

    public function addComment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'comment'   => 'required',
            'post_id'   => 'required|exists:posts,id',
            'parent_id' => 'nullable'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Invalid data.', $validator->messages()->all(), 200);
        }

        $post = $this->postRepository->findOrFail($request->post_id);
        $post->addComment([
            'comment' => $request->comment,
            'parent_id' => $request->parent_id,
            'user_id'   => auth()->id()
        ]);

        return $this->sendResponse([], 'Comment saved successfully.');
    }
}
