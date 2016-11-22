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
		return view('administrator');
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
}