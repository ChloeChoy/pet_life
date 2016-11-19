<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Socialite;
use App\User;
use App\Social;
use Auth;

class SocialController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('facebook')->user();
       $social = Social::where('provider_user_id', $user->id)->where('provider', 'facebook')->first();
        
       if($social) {
       	$u = User::where('email', $user->email)->first();
       	Auth::login($u);
       	return redirect()->route('dashboard');
       }
       else {
	       	$temp = new Social;
	       	$temp->provider_user_id = $user->id;
	       	$temp->provider = 'facebook';

	       	$u = User::where('email', $user->email)->first();
	       	if(!$u) {
	       		$u = User::create([
	       			'name' => $user->name,
	       			'email' => $user->email
	       		]);
	       	}
	       	$temp->user_id = $u->id;

	       	$temp->save();

	       	Auth::login($u);
	       	return redirect()->route('dashboard');
       }
        // $user->token;
    }

     public function redirectToProviderGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallbackGoogle()
    {
        $user = Socialite::driver('google')->user();
        // dd($user);
       $social = Social::where('provider_user_id', $user->id)->where('provider', 'google')->first();
        
       if($social) {
       	$u = User::where('email', $user->email)->first();
       	Auth::login($u);
       	return redirect()->route('dashboard');
       }
       else {
	       	$temp = new Social;
	       	$temp->provider_user_id = $user->id;
	       	$temp->provider = 'google';

	       	$u = User::where('email', $user->email)->first();
	       	if(!$u) {
	       		$u = User::create([
	       			'name' => $user->name,
	       			'email' => $user->email
	       		]);
	       	}
	       	$temp->user_id = $u->id;

	       	$temp->save();

	       	Auth::login($u);
	       	return redirect()->route('dashboard');
       }
        // $user->token;
    }
}
