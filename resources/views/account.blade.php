@extends('layouts.content-layout')

@section('title')
    Account
@endsection

@section('content')
    <section class="profile-image">
        <div class="container">
            <!-- wall images -->
            <div class="row">
                <div class="col s12 wall">
                    <div class="cover-img">
                        <img class="responsive-img" src="{{ URL::to('src/images/default-wall.jpg') }}">
                        <a class="edit-wall-img"><i class="material-icons">photo_camera</i> Change cover photo</a>
                    </div>
                    <div class="account-avatar">
                        @if (Storage::disk('local')->has($user->first_name . '-' . $user->id . '.jpg'))
                            <img src="{{ route('account.image', ['filename' => $user->first_name . '-' . $user->id . '.jpg']) }}" alt="" class="responsive-img">
                        @else
                            <img class="responsive-img" src="{{ URL::to('src/images/boa_hancock_wallpaper_blue_red_by_gian519.png') }}">
                        @endif
                        <a class="edit-avatar"><i class="material-icons">photo_camera</i></a>
                    </div>
                    <div class="profile-menu">
                        <a href="#">Time line</a>
                        <a href="#">Info</a>
                        <a href="#">Friends</a>
                        <a href="#">Photos</a>
                        <a href="#">Videos</a>
                    </div>
                </div>
            </div>
            <!-- end wall images -->

            <div class="row">
                <div class="col l4 col-info hide-on-med-and-down">
                    <div class="main-info">
                        <div class="live info">
                            <span>
                                <i class="material-icons">home</i>
                                Lives in:  &nbsp;No information
                            </span>
                            <a title="Edit">
                                <i class="material-icons">mode_edit</i>
                            </a>
                        </div>
                        <div class="work info">
                            <span>
                                <i class="material-icons">work</i>
                                Works at:  &nbsp;No information
                            </span>
                            <a title="Edit">
                                <i class="material-icons">mode_edit</i>
                            </a>
                        </div>
                        <div class="birthday info">
                            <span>
                                <i class="material-icons">date_range</i>
                                Birthday:  &nbsp;No information
                            </span>
                            <a title="Edit">
                                <i class="material-icons">mode_edit</i>
                            </a>
                        </div>
                    </div>
                    <div class="photo-box">
                        <span class="title-info">Photos</span>
                        <div class="photo thumnail">
                        @if (Storage::disk('local')->has($user->first_name . '-' . $user->id . '.jpg'))
                            <img src="{{ route('account.image', ['filename' => $user->first_name . '-' . $user->id . '.jpg']) }}" alt="" class="resposive-img">
                        @else
                            <span class="photo-alert">You have no photo. Please post your photo.</span>
                        @endif
                        </div>
                    </div>
                    <div class="video-box">
                        <span class="title-info">Videos</span>
                        <div class="video thumnail"></div>
                    </div>
                </div>
                <div class="col l8 s12 col-user-post">
                    <form class="post-form" action="{{ route('account') }}" method="post">
                        <div class="attach-files">
                            <a class="att-btn"><i class="material-icons">videocam</i> Upload videos</a>
                            <a class="att-btn"><i class="material-icons">image</i> Upload images</a>
                        </div>
                        <div class="input-field col s12">
                            <textarea id="new-post" class="materialize-textarea"  name="body"></textarea>
                            <label for="textarea1">What's your status</label>
                        </div>
                        <div class="field-submit">
                            <button type="submit" class="waves-effect waves-light btn">Post</button>
                        </div>
                        <input type="hidden" value="{{ Session::token() }}" name="_token">
                    </form>

                    <!-- post -->
                    @foreach($posts as $post)
                        @if(Auth::user() == $post->user)
                        <div class="post-row" data-postid="{{ $post->id }}">
                            <div class="post-info">
                                <div class="user-avatar">
                                    <a href="#"><img alt="avatar" src="{{ URL::to('src/images/boa_hancock_wallpaper_blue_red_by_gian519.png') }}" class="responsive-img"></a>
                                </div>
                                <div class="user-post">
                                    <span class="post-username"><a href="#">{{ $post->user->first_name }}</a></span>
                                    <span class="post-on">posted on {{ $post->created_at }}</span>
                                </div>
                                <div class="post-act">
                                    <a class="popup-post-menu"><i class="material-icons"><i class="material-icons">keyboard_arrow_down</i></i></a>
                                    <div class="post-menu-act" style="display:none;">
                                        <a class="edit-post"><i class="material-icons">mode_edit</i> Edit</a>
                                        <a class="delete-post" href="{{ route('post.delete', ['post_id' => $post->id]) }}"><i class="material-icons">delete</i> Delete</a>
                                    </div>
                                </div>
                            </div>
                            <div class="post-content">
                                <p>{{ $post->body }}</p>
                            </div>
                            <div class="interaction">
                                <a href="#" class="like"><i class="material-icons">thumb_up</i> {{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'You like this post' : 'Like' : 'Like'  }}</a>
                                <a href="#" class="share-post"><i class="material-icons">share</i> Share</a>
                            </div>
                        </div>
                        @endif
                    @endforeach
                    <!-- end post -->
                </div>
            </div>
        </div>
    </section>

    <!-- <section class="row new-post">
        <div class="col-md-6 col-md-offset-3">
            <header><h3>Your Account</h3></header>
            <form action="{{ route('account.save') }}" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" name="first_name" class="form-control" value="{{ $user->first_name }}" id="first_name">
                </div>
                <div class="form-group">
                    <label for="image">Image (only .jpg)</label>
                    <input type="file" name="image" class="form-control" id="image">
                </div>
                <button type="submit" class="btn btn-primary">Save Account</button>
                <input type="hidden" value="{{ Session::token() }}" name="_token">
            </form>
        </div>
    </section>
    @if (Storage::disk('local')->has($user->first_name . '-' . $user->id . '.jpg'))
        <section class="row new-post">
            <div class="col-md-6 col-md-offset-3">
                <img src="{{ route('account.image', ['filename' => $user->first_name . '-' . $user->id . '.jpg']) }}" alt="" class="img-responsive">
            </div>
        </section>
    @endif -->
@endsection