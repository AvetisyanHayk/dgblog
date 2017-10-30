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
        $content = Tools::convertMultilineToSingleLine($request->input('content'));
        $post = $this->build($request, $content);
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
     * Update Post (POST)
     * @param Request $request
     * @return $this
     */
    public function postAdminUpdate(Request $request) {
        $this->validatePost($request);
        $content = Tools::convertMultilineToSingleLine($request->input('content'));
        $post = Post::find($request->input('id'));
        $post->reference = $request->input('reference');
        $post->title = $request->input('title');
        $post->content = $content;
        $post->urlid = $request->input('urlid');
        $post->date = $request->input('date');
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

    private function validatePost($request) {
        $this->validate($request, [
            'reference' => 'required|integer',
            'title' => 'max:64',
            'content' => 'required|max:4000',
            'date' => 'required|date',
            'urlid' => 'max:32'
        ]);
    }

    private function build($request, $content) {
        return new Post([
            'reference' => $request->input('reference'),
            'title' => $request->input('title'),
            'content' => $content,
            'urlid' => $request->input('urlid'),
            'date' => $request->input('date')
        ]);
    }
}