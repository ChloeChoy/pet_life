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
        // if(!Auth::user())
        //     return redirect()->route('home');
        
        $productList    = array();
        $user = User::orderBy('created_at', 'desc')->get();
        foreach ($user as $item ) {
            if ($item->name) {
                $temp    = array(
                    'desc'  => $item->email,
                    'value' => $item->name,
                    'image' => $item->avatar ? route('account.image', ['filename' => $item->avatar]) : '/pet_life/public/src/images/boa_hancock_wallpaper_blue_red_by_gian519.png'    // user avatar
                );
                array_push($productList, $temp);
            }
        }
        $suggestUsers = json_encode($productList);
        File::put('users.js', 'var searchplus = '.$suggestUsers);

        $posts = Post::orderBy('created_at', 'desc')->get();
        $trendPosts = $posts->first();
        return view('dashboard', ['posts' => $posts, 'user' => Auth::user(), 'trendPost' => $trendPosts]);
    }

    public function postCreatePost(Request $request)
    {
        // $this->validate($request, [
        //     'body' => 'required|max:1000'
        // ]);
        $post = new Post();
        $user = Auth::user();
        $file = $request->file('att_files');
        if($file[0] != null){
            for ($i=0; $i < count($file); $i++) { 
                $extension = $file[$i]->getClientOriginalExtension();
                Storage::disk('local')->put($file[$i]->getFilename().'.'.$extension,  File::get($file[$i]));
                $post->mime .= $file[$i]->getClientMimeType();
                $post->original_filename .= $file[$i]->getClientOriginalName() .',';
                $post->filename .= $file[$i]->getFilename().'.'.$extension .',';   
            }
        }
        
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
        $user = Auth::user();
        if ($user->id != $post->user->id) {
            return response()->json(['error' => 'You not permitted to delete this post'],401);
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
        $is_like = $request['isLike'];
        // return response()->json(['isLike' => $is_like]);
        $update = false;
        $post = Post::find($post_id);
        if (!$post) {
            return null;
        }
        //num of likes
        // $nlike = 0;
        // $numLike = Like::where('post_id', $post_id);;
        // for($i = 0; $i < count($numLike); $i++){
        //     if($numLike->post_id == $post_id){
        //         $nlike += 1;
        //     }
        // }
        // return response()->json(['like' => $nlike]);
        $user = Auth::user();
        $like = $user->likes()->where('post_id', $post_id)->first();
        if ($like) {
            $already_like = $like->like;
            $update = true;
            if ($already_like != $is_like) {
                $like->delete();
                // $numLike -= 1;
                // return null;
                return response()->json(['unlike' => 'unlike']);
            }
        } else {
            $like = new Like();
        }
        $like->like = $is_like;
        // $numLike += 1;
        $like->user_id = $user->id;
        $like->post_id = $post->id;
        if ($update) {
            $like->update();
        } else {
            $like->save();
        }
        return response()->json(['like' => 'like']);
        // return null;
    }

    /**
    * get post view
    */
    public function getPostView($post_id){
        $post = Post::where('id', $post_id)->first();
        return view('post-view', ['post' => $post, 'user' => Auth::user()]);
    }

    /**
    * get post for news page
    */
    public function getPostNews(){
        $user = User::orderBy('created_at', 'desc')->get();
        $posts = Post::orderBy('created_at', 'desc')->limit(5)->get();
        $trendPost = $posts->first();
        return view('news', ['posts' => $posts, 'user' => Auth::user(), 'trendPost' => $trendPost]);
    }

    /**
    * get searched users
    */
    public function getSearchUsers(Request $request){
        $users = User::where('name', 'like', '%' . $request['q'] . '%')->get();
        return view('search', ['users' => $users]);
    }
}