<?php
namespace App\Http\Controllers;

use App\Like;
use App\Post;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    public function getDashboard()
    {
        $user = User::orderBy('created_at', 'desc')->get();
        $posts = Post::orderBy('created_at', 'desc')->get();
        // foreach ($posts as $post) {
        //     # code...
        // }
        $trendPost = $posts->first();
        return view('dashboard', ['posts' => $posts, 'user' => Auth::user(), 'trendPost' => $trendPost]);
    }

    public function postCreatePost(Request $request)
    {
        // $this->validate($request, [
        //     'body' => 'required|max:1000'
        // ]);
        $post = new Post();
        $user = Auth::user();
        $file = $request->file('att_files');
        for ($i=0; $i < count($file); $i++) { 
            $extension = $file[$i]->getClientOriginalExtension();
            Storage::disk('local')->put($file[$i]->getFilename().'.'.$extension,  File::get($file[$i]));
            $post->mime .= $file[$i]->getClientMimeType();
            $post->original_filename .= $file[$i]->getClientOriginalName() .',';
            $post->filename .= $file[$i]->getFilename().'.'.$extension .',';   
        }
        // $extension = $file->getClientOriginalExtension();
        // Storage::disk('local')->put($file->getFilename().'.'.$extension,  File::get($file));
        // $post->mime = $file->getClientMimeType();
        // $post->original_filename = $file->getClientOriginalName();
        // $post->filename = $file->getFilename().'.'.$extension;

        $post->body = $request['body'];
        $message = '';
        if ($request->user()->posts()->save($post)) {
            return redirect()->route('dashboard');
            // return response()->json(
            //     [
            //         'post_id'   => $post->id,
            //         'post_user' => $post->user->first_name,
            //         'post_body' => $post->body,
            //         'create_at' => date_format(date_create($post->created_at), 'D M Y'),
            //         'file_name' => $post->filename
            //     ],
            //     200
            // );
            // $message = 'Post successfully created!';
        }else{
            $message = 'An error occur when create post. Please try again!';
        }
    }

    public function getDeletePost($post_id)
    {
        $post = Post::where('id', $post_id)->first();
        if (Auth::user() != $post->user) {
            return redirect()->back();
        }
        $post->delete();
        return response()->json(['ok' => 200],200);
    }

    public function postEditPost(Request $request)
    {
        $this->validate($request, [
            'body' => 'required'
        ]);
        $post = Post::find($request['postId']);
        if (Auth::user() != $post->user) {
            return redirect()->back();
        }
        $post->body = $request['body'];
        $post->update();
        return response()->json(['new_body' => $post->body], 200);
    }

    public function postLikePost(Request $request)
    {
        $post_id = $request['postId'];
        $is_like = $request['isLike'] === 'true';
        $update = false;
        $post = Post::find($post_id);
        if (!$post) {
            return null;
        }
        $user = Auth::user();
        $like = $user->likes()->where('post_id', $post_id)->first();
        if ($like) {
            $already_like = $like->like;
            $update = true;
            if ($already_like == $is_like) {
                $like->delete();
                return null;
            }
        } else {
            $like = new Like();
        }
        $like->like = $is_like;
        $like->user_id = $user->id;
        $like->post_id = $post->id;
        if ($update) {
            $like->update();
        } else {
            $like->save();
        }
        return null;
    }

    /**
    * get post view
    */
    public function getPostView($post_id){
        $post = Post::where('id', $post_id)->first();
        return view('post-view', ['post' => $post, 'user' => Auth::user()]);
    }
}