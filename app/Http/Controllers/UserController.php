<?php
namespace App\Http\Controllers;

use App\User;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function postSignUp(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:users',
            'name' => 'required|max:120',
            'password' => 'required|min:4'
        ]);

        $email = $request['email'];
        $name = $request['name'];
        $password = bcrypt($request['password']);
        $gender = $request['gender'] != '' ? $request['gender'] : '';
        $token = $request['_token'];

        $user = new User();
        $user->email = $email;
        $user->name = $name;
        $user->password = $password;
        $user->gender = $gender;
        $user->remember_token = $token;

        $user->save();

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    public function postSignIn(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        // $remember = $request['sign_remember'];
        // if($remember == 'on'){
        //     if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']], $remember)) {
        //         return redirect()->route('dashboard');
        //     }         
        // }

        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
            return redirect()->route('dashboard');
        }
        return redirect()->back();
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public function getAccount()
    {
        if(!Auth::user()){
            return view('signin');
        }
        $posts = Post::orderBy('created_at', 'desc')->get();
        $postLikes = \DB::table('likes')->select('post_id', \DB::raw("count(likes.like) as total"))
                ->where('user_id', Auth::user()->id)
                ->groupBy('post_id')->orderBy('total', 'DESC')
                ->get();

        return view('account', ['user' => Auth::user(), 'posts' => $posts, 'postLikes' => $postLikes]);
    }

    public function postSaveAccount(Request $request)
    {
        $this->validate($request, [
           'name' => 'required|max:120'
        ]);

        $user = Auth::user();
        $old_name = $user->name;
        $user->name = $request['name'];
        $user->update();
        $file = $request->file('image');
        $filename = $request['name'] . '-' . $user->id . '.jpg';
        $old_filename = $old_name . '-' . $user->id . '.jpg';
        $update = false;
        if (Storage::disk('local')->has($old_filename)) {
            $old_file = Storage::disk('local')->get($old_filename);
            Storage::disk('local')->put($filename, $old_file);
            $update = true;
        }
        if ($file) {
            Storage::disk('local')->put($filename, File::get($file));
        }
        if ($update && $old_filename !== $filename) {
            Storage::delete($old_filename);
        }
        return redirect()->route('account');
    }

    /**
    * upload avatar/cover image
    */
    public function uploadAvatarCover(Request $request){
        $user = Auth::user();
        $file = $request->file('cover_img') ? $request->file('cover_img') : $request->file('profile_img');
        $extension = $file->getClientOriginalExtension();
        Storage::disk('local')->put($file->getFilename().'.'.$extension,  File::get($file));
        
        if($request->file('cover_img')){
            $user->cover_photo = $file->getFilename().'.'.$extension;
            $user->update();
        }

        if($request->file('profile_img')){
            $user->avatar = $file->getFilename().'.'.$extension;
            $user->update();
        }
        return redirect()->route('account');
    }

    public function getUserImage($filename)
    {
        $file = Storage::disk('local')->get($filename);
        return new Response($file, 200);
    }

    /**
    * user post in profile page
    */
    public function postInProfile(Request $request)
    {
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
        $token = $request['_token'];
        $request->user()->posts()->save($post);
        
        return view('account');
    }

    /**
    * user info page
    */
    public function userInfo(){
        return view('userinfo', ['user' => Auth::user()]);
    }

    /**
    * user photo page
    */
    public function userPhotos(){
        if(!Auth::user()){
            return view('signin');
        }
        $posts = Post::where('user_id', Auth::user()->id)->get();
        return view('photos', ['user' => Auth::user(), 'posts' => $posts]);   
    }

    /**
    *   return other user's profile page
    */
    public function getOtherAccount($otherUser){
        $user = User::find($otherUser);
        $posts = Post::where('user_id', $otherUser)->orderBy('created_at', 'desc')->get();
        return view('friend-account', ['user' => $user, 'posts' => $posts]);
    }

}