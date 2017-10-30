<?php

namespace App\Http\Controllers;

use App\Http\Tools;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Session\Store;

class PostController extends Controller
{
    /**
     * Create Post (POST)
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postAdminCreate(Request $request) {
        $this->validatePost($request);
        $post = $this->build($request);
        $post->save();
        return redirect()->route('_admin.post.edit', ['reference' => $request->input('reference')])
            ->with(['result' => 'save-ok']);
    }

    /**
     * Update Post (GET)
     * @param $reference
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function postAdminEdit($reference) {
        $post = Post::where('reference', $reference)->first();
        if ($post === null) {
            return view('admin.post_notfound', ['reference' => $reference]);
        } else {
            return view('admin.post', ['post' => $post]);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postAdminUpdate(Request $request) {
        $this->validatePost($request);
        $post = Post::find($request->input('id'));
        $post = build($request, $post);
        $post->save();
        return redirect()->route('_admin.post.edit', ['reference' => $request->input('reference')])
            ->with(['result' => 'edit-ok'])
            ->withInput();
    }

    /**
     * Delete Post (POST)
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postAdminDelete(Request $request) {
        $post = Post::find($request->input('id'));
        $post->delete();
        return redirect()->route('_admin.post.report')
            ->with(['result' => 'delete-ok']);
    }

    /**
     * Report (GET)
     * @param Store $session
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function postAdminReport(Store $session, Request $request) {
        if ($session === null || !$session->has('result')) {
            return redirect()->route('_admin.posts');
        } else {
            return view('admin.report', ['result' => $session->get('result')]);
        }
    }

    /**
     * @return string
     */
    public function postsAdminGetPosts() {
        return "Posts";
    }

    /**
     * Content Accessor
     * @param $value
     * @return string
     */
    public function getContentAttribute($value) {
        return Tools::convertSinglelineToMultiline($value);
    }

    /**
     * Content Mutator
     * @param $value
     */
    public function setContentAttribute($value) {
        $this->attributes['content'] = Tools::convertMultilineToSingleline($value);
    }

    private function validatePost($request) {
        $this->validate($request, [
            'reference' => 'required|integer',
            'title' => 'max:64',
            'content' => 'required|max:4000',
            'date' => 'required|date',
            'urlid' => 'max:32'
        ]);
    }

    private function build($request, $post = null) {
        if (!isset($post)) {
            $post = new Post();
        }
        $post->reference = $request->input('reference');
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->urlid = $request->input('urlid');
        $post->date = $request->input('date');
        return $post;
    }
}