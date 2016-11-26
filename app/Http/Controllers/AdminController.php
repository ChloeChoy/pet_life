<?php
namespace App\Http\Controllers;

use App\Like;
use App\Post;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class AdminController extends Controller
{
	public function index(){
		if(!Auth::user()){
			return redirect()->route('home');
		}

		$posts = Post::orderBy('created_at', 'desc')->get();
		$sep = 0;
		$oct = 0;
		$nov = 0;
		$dec = 0;
		foreach ($posts as $post) {
			$date = date_format($post->created_at, 'm');
			$date == '9' ? $sep +=1 : ($date == '10' ? $oct += 1 : ($date == '11' ? $nov += 1 : ($date == '12'
				? $dec += 1 : '')));
		}

		$users = User::orderBy('created_at', 'desc')->get();
		$male = 0;
		$female = 0;
		for($i = 0; $i < count($users); $i++){
			if($users[$i]['gender'] == 1)
				$male += 1;
			if($users[$i]['gender'] == 0)
				$female += 1;
		}
		
		return view('administrator', ['posts' => $posts, 'users' => $users,
			 'male' => $male, 'female' => $female, 'sep' => $sep, 'oct' => $oct, 'nov' => $nov, 'dec' => $dec]);
	}

	/**
	* manage account function
	*/
	public function getRemoveUsers(){
		if(!Auth::user()){
			return redirect()->route('home');
		}
		$users = User::orderBy('created_at', 'desc')->get();
		return view('admin-remove-user', ['users' => $users]);
	}

	/**
	* admin add user link
	*/
	public function getAddUser(){
		return view('admin-adduser');
	}

	/**
	* add new user
	*/
	public function addNewUser(Request $request){
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

        try {
        	$user->save();	
        	return response()->json(['success' => 'Add success'], 200);
        } catch (Exception $e) {
        	return $e.getMessage();
        	// return respone()->json(['error' => 'An error occur when create user'], 500);
        }
	}
}