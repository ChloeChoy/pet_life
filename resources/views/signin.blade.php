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
                            <span class="signin-title">Sign in with</span>
                            <div class="col s4">
                                <a id="signin-fb" class="waves-effect waves-light btn"><i class="fa fa-facebook"></i></a>
                            </div>
                            <div class="col s4">
                                <a id="signin-gg" class="waves-effect waves-light btn" title="Sign in with google+"><i class="fa fa-google-plus"></i></a>
                            </div>
                            <div class="col s4">
                                <a id="signin-twt" class="waves-effect waves-light btn"><i class="fa fa-twitter"></i></a>
                            </div>
                        </div>
                        <form class="signin-form" action="{{ route('signin') }}" method="post">
                            <h5>Sign in</h5>
                            <div class="input-field {{ $errors->has('email') ? 'has-error' : '' }}">
                                <i class="material-icons prefix">email</i>
                                <input id="signin-email" type="email" name="email" class="validate" value="{{ Request::old('email') }}">
                                <label for="signin-email" data-error="invalid email format">Email</label>
                            </div>
                            <div class="input-field {{ $errors->has('password') ? 'has-error' : '' }}">
                                <i class="material-icons prefix">lock</i>
                                <input id="signin-pwd" type="password" class="validate" name="password" value="{{ Request::old('password') }}">
                                <label for="signin-pwd">Password</label>
                            </div>
                            <div class="field-small">
                                <p>
                                  <input type="checkbox" class="filled-in" id="filled-in-box" name="sign_remember" checked="checked" />
                                  <label for="filled-in-box">Remember me</label>
                                </p>
                                <a id="forgot-pass" href="#">Forgot password</a>
                            </div>
                            <div class="input-field" style="padding-left: 44px;">
                                <button class="waves-effect waves-light btn">Sign in</button>
                            </div>
                            <input type="hidden" name="_token" value="{{ Session::token() }}">
                        </form>
                        <a class="create-acc" href="{{ route('signup') }}">Create account here</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection