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
                    @if($user)
                        @if($user->cover_photo)
                            <img src="{{URL::to('post-images/'.$user->cover_photo)}}" alt="" class="responsive-img">
                        @else
                            <img class="responsive-img" src="{{ URL::to('src/images/default-wall.jpg') }}">
                        @endif
                        
                    @endif
                    </div>

                    <div class="account-avatar">
                    @if($user)
                        @if($user->avatar)
                            <img src="{{URL::to('post-images/'.$user->avatar)}}" alt="" class="responsive-img">
                        @else
                            <img class="responsive-img" src="{{ URL::to('src/images/boa_hancock_wallpaper_blue_red_by_gian519.png') }}">
                        @endif
                    @endif
                    </div>
                    <div class="profile-menu">
                        <a href="{{ route('other.profile', ['otherUser' => $user->id]) }}">Timeline</a>
                        <a href="{{ route('other.user.info', ['otherUser' => $user->id]) }}">Info</a>
                        <a href="#">Friends</a>
                        <a href="{{ route('user.media', ['id' => $user->id]) }}">Media</a>
                    </div>
                </div>
            </div>
            <!-- end wall images -->

             <!-- media content -->
            <div class="row">
                <div class="col s12 user-photos z-depth-1">
                    <!-- photo -->
                    <span class="title">Photos</span>
                    <div id="user-photos-gallery">

                        <!-- avatar/cover image -->
                        @if($user->avatar)
                            <div class="photo-item col s6 m4 l2">
                                <img src="{{URL::to('post-images/'.$user->avatar)}}" alt="" class="resposive-img" data-mfp-src="{{URL::to('post-images/'.$user->avatar)}}">
                            </div>
                        <!-- @endif -->

                        @if($user->cover_photo)
                            <div class="photo-item col s6 m4 l2">
                                <img src="{{URL::to('post-images/'.$user->cover_photo)}}" alt="" class="responsive-img" data-mfp-src="{{URL::to('post-images/'.$user->cover_photo)}}">
                            </div>
                        @endif
                        <!-- end avatar/cover image -->
                    
                        <!-- post photo -->

                        @foreach($posts as $post)
                            <?php if($post->user_id == $user->id && $post->original_filename != ''): ?>
                                @if(strpos($post->mime, 'image') !== false)
                                    <?php 
                                        $postImg = explode(',', $post->original_filename);
                                    ?>
                                   
                                    @for($i = 0; $i < count($postImg); $i++)
                                        @if($postImg[$i] != '')
                                            <div class="photo-item col s6 m4 l2">
                                                <img src="{{URL::to('post-images/'.$postImg[$i])}}" alt="image" class="responsive-img" data-mfp-src="{{URL::to('post-images/'.$postImg[$i])}}">
                                            </div>
                                        @endif
                                    @endfor
                                @endif
                            <?php endif;?>
                        @endforeach
                        <!-- end post photo -->
                    </div>
                    <!-- end photos -->

                    <!-- videos -->
                    <span class="title videos">Videos</span>
                    <div id="user-videos-gallery">
                        @foreach($posts as $post)
                            <?php if($post->user_id == $user->id && $post->original_filename != ''): ?>
                                @if(strpos($post->mime, 'video') !== false)
                                    <?php
                                        $postVideo = explode(',', $post->original_filename);
                                    ?>
                                    @for($i = 0; $i < count($postVideo); $i++)
                                        @if($postVideo[$i] != '')
                                        <div class="video-item col s12 m6 l4">
                                            <video class="responsive-video" controls>
                                                <source src="{{URL::to('post-images/'.$postVideo[$i])}}" type="video/mp4">
                                            </video>
                                        </div>
                                        @endif
                                    @endfor
                                @endif
                            <?php endif;?>
                        @endforeach
                    </div>
                    <!-- end video -->
                </div>
            </div>
            <!-- end medias content -->

        </div>
    </section>

@endsection