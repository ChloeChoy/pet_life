@extends('layouts.master')

@section('title')
    Welcome!
@endsection

@section('content')
    @include('includes.message-block')
    

    <section class="main-signin">
        <div class="container">
            <div class="row">
                <div class="col s12 m8 l6">
                    <div class="col-signin">
                        <div class="social-signin row">
                            <span class="signin-title">Sign up with</span>
                            <div class="col s4">
                                <a id="signin-fb" class="waves-effect waves-light btn" title="Sign in with facebook" href="{{ url('facebook/redirect') }}"><i class="fa fa-facebook"></i></a>
                            </div>
                            <div class="col s4">
                                <a id="signin-gg" class="waves-effect waves-light btn" title="Sign in with google+" href="{{ url('google/redirect') }}"><i class="fa fa-google-plus"></i></a>
                            </div>
                            <div class="col s4">
                                <a id="signin-twt" class="waves-effect waves-light btn" title="Sign in with twitter"><i class="fa fa-twitter"></i></a>
                            </div>
                        </div>
                        <form class="signin-form" action="{{ route('signup') }}" method="post">
                            <h5>Sign up</h5>
                            <div class="input-field {{ $errors->has('name') ? 'has-error' : '' }}">
                                <i class="material-icons prefix">account_circle</i>
                                <input id="signup_username" type="text" name="name" class="validate" value="{{ Request::old('first_name') }}">
                                <label for="signup_username">Username</label>
                            </div>
                            <div class="input-field {{ $errors->has('email') ? 'has-error' : '' }}">
                                <i class="material-icons prefix">email</i>
                                <input id="signup-email" name="email" type="email" class="validate" value="{{ Request::old('email') }}">
                                <label for="signup-email" data-error="invalid email format">Email</label>
                            </div>
                            <div class="input-field {{ $errors->has('password') ? 'has-error' : '' }}">
                                <i class="material-icons prefix">lock</i>
                                <input id="signup-pwd" type="password" name="password" class="validate" value="{{ Request::old('password') }}">
                                <label for="signup-pwd">Password</label>
                            </div>
                            <div class="field-small" style="padding-left: 5px;">
                                Gender:
                                <p>
                                    <input class="with-gap" name="gender" type="radio" id="male" value="1" />
                                    <label for="male">Male</label>
                                </p>
                                <p>
                                    <input class="with-gap" name="gender" type="radio" id="female" value="0" />
                                    <label for="female">Female</label>
                                </p>
                            </div>
                            <div class="input-field" style="padding-left: 44px;">
                                <button class="waves-effect waves-light btn">Sign up</button>
                            </div>
                            <input type="hidden" name="_token" value="{{ Session::token() }}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection