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
                        @if(Auth::user()->cover_photo)
                            @if (Storage::disk('local')->has(Auth::user()->cover_photo))
                                <img src="{{ route('account.image', ['filename' => $user->cover_photo]) }}" alt="" class="responsive-img">
                            @endif
                        @else
                            <img class="responsive-img" src="{{ URL::to('src/images/default-wall.jpg') }}">
                        @endif
                        
                        <a class="edit-wall-img" data-toggle="modal" href="#modal-upload-images"><i class="material-icons">photo_camera</i> Change cover photo</a>
                    @endif

                    </div>
                    <div class="account-avatar">
                    @if($user)
                        @if($user->avatar)
                            @if (Storage::disk('local')->has($user->avatar))
                                <img src="{{ route('account.image', ['filename' => $user->avatar]) }}" alt="" class="responsive-img">
                            @endif
                        @else
                            <img class="responsive-img" src="{{ URL::to('src/images/boa_hancock_wallpaper_blue_red_by_gian519.png') }}">
                        @endif
                        <a class="edit-avatar" data-toggle="modal" href="#modal-upload-images"><i class="material-icons">photo_camera</i></a>
                    @endif
                    </div>
                    <div class="profile-menu">
                        <a href="{{ route('account') }}">Timeline</a>
                        <a href="{{ route('userinfo') }}">Info</a>
                        <a href="#">Friends</a>
                        <a href="{{ route('photos') }}">Media</a>
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
                                Living:  &nbsp;No information
                            </span>
                            <a class="edit-user-info" title="Edit" href="{{ route('userinfo')}}">
                                <i class="material-icons">mode_edit</i>
                            </a>
                        </div>
                        <div class="work info">
                            <span>
                                <i class="material-icons">work</i>
                                Works at:  &nbsp;No information
                            </span>
                            <a class="edit-user-info" title="Edit" href="{{ route('userinfo')}}">
                                <i class="material-icons">mode_edit</i>
                            </a>
                        </div>
                        <div class="birthday info">
                            <span>
                                <i class="material-icons">date_range</i>
                                Birthday:  &nbsp;No information
                            </span>
                            <a class="edit-user-info" title="Edit" href="{{ route('userinfo')}}">
                                <i class="material-icons">mode_edit</i>
                            </a>
                        </div>
                    </div>
                    <div class="photo-box">
                        <span class="title-info">Photos</span>
                        <div class="photo thumnail">
                    @if($user)
                        <!-- avatar/cover image -->
                        <?php if (Storage::disk('local')->has($user->avatar) && $user->avatar): ?>
                            <img src="{{ route('account.image', ['filename' => $user->avatar]) }}" alt="" class="resposive-img">
                        @endif

                        <?php if(Storage::disk('local')->has($user->cover_photo) && $user->cover_photo): ?>
                            <img src="{{ route('account.image', ['filename' => $user->cover_photo]) }}" alt="" class="resposive-img">
                        @endif
                        <!-- end avatar/cover image -->

                        <!-- post photo -->

                        @foreach($posts as $post)
                            <?php if($post->user_id == Auth::user()->id && $post->filename != ''): ?>
                                @if(strpos($post->mime, 'image') !== false)
                                    <?php 
                                        $postImg = explode(',', $post->filename);
                                        $numOfPostMedia = 0;
                                    ?>
                                   
                                    @for($i = 0; $i < count($postImg); $i++)
                                        <?php if($numOfPostMedia > 5){break;} ?>
                                        @if($postImg[$i] != '')
                                            <?php $numOfPostMedia++; ?>
                                            <img src="{{ route('account.image', ['filename' => $postImg[$i]]) }}" alt="image" class="responsive-img" data-mfp-src="{{ route('account.image', ['filename' => $postImg[$i]]) }}">
                                        @endif
                                    @endfor
                                @endif
                            <?php endif;?>
                        @endforeach
                        <!-- end post photo -->

                    @endif
                        </div>
                    </div>
                    <div class="video-box">
                        <span class="title-info">Videos</span>
                        <div class="video thumnail">
                            @foreach($posts as $post)
                                <?php if($post->user_id == Auth::user()->id && $post->filename != ''): ?>
                                    @if(strpos($post->mime, 'video') !== false)
                                    <?php
                                        $postVideo = explode(',', $post->filename);
                                        $countVideo = 0;
                                    ?>
                                    @for($i = 0; $i < count($postVideo); $i++)
                                        <?php if($countVideo > 5){break;} ?>

                                        @if($postVideo[$i] != '')
                                        <?php $countVideo++; ?>
                                        <video class="responsive-video">
                                          <source src="{{ route('account.image', ['filename' => $postVideo[$i]]) }}" type="video/mp4">
                                        </video>
                                        @endif
                                    @endfor
                                    @endif
                                <?php endif;?>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col l8 s12 col-user-post">
  
                    <!-- post -->
                    @foreach($posts as $post)
                        <div class="post-row" data-postid="{{ $post->id }}">
                            <div class="post-info">
                                <div class="user-avatar">
                                    <a href="#">
                                        @if($post->user->avatar)
                                        <img class="user-avatar" alt="avatar" src="{{route('account.image', ['filename' => $post->user->avatar])}}" class="responsive-img">
                                        @else
                                        <img class="user-avatar" alt="avatar" src="{{ URL::to('src/images/boa_hancock_wallpaper_blue_red_by_gian519.png') }}" class="responsive-img">
                                        @endif
                                    </a>
                                </div>
                                <div class="user-post">
                                    <span class="post-username"><a href="#">{{ $post->user->name }}</a></span>
                                    <span class="post-on">Posted on {{  date_format($post->created_at, 'D M Y') }}</span>
                                </div>
                                @if(Auth::user() == $post->user)
                                <div class="post-act">
                                    <a class="popup-post-menu"><i class="material-icons"><i class="material-icons">keyboard_arrow_down</i></i></a>
                                    <div class="post-menu-act" style="display:none;">
                                        <a class="edit-post" data-toggle="modal" href="#modal-edit-post"><i class="material-icons">mode_edit</i> Edit</a>
                                        <a class="delete-post"><i class="material-icons">delete</i> Delete</a>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="post-content">
                                <p>{{ $post->body }}</p>

                                @if(strpos($post->mime, 'image') !== false)
                                    <?php 
                                        $postImg = explode(',', $post->filename);
                                        $numOfPostMedia = 0;
                                    ?>
                                    @if(count($postImg) > 2)
                                    <div class="post-media multi-medias" id="post-media{{$post->id}}">
                                        @for($i = 0; $i < count($postImg); $i++)
                                            @if($postImg[$i] != '')
                                                    <img src="{{ route('account.image', ['filename' => $postImg[$i]]) }}" alt="image" class="responsive-img" data-mfp-src="{{ route('account.image', ['filename' => $postImg[$i]]) }}">
                                                    <?php $numOfPostMedia++;?>
                                            @endif
                                        @endfor
                                        <span class="num-of-img">{{$numOfPostMedia - 1}}+</span>
                                    </div>
                                    @else
                                    <div class="post-media" id="post-media{{$post->id}}">
                                        @for($i = 0; $i < count($postImg); $i++)
                                            @if($postImg[$i] != '')
                                                    <img src="{{ route('account.image', ['filename' => $postImg[$i]]) }}" alt="image" class="responsive-img" data-mfp-src="{{ route('account.image', ['filename' => $postImg[$i]]) }}">
                                            @endif
                                        @endfor
                                    </div>
                                    @endif

                                    <script type="text/javascript">
                                            $('#post-media'+ {{$post->id}}).magnificPopup({
                                                delegate: 'img',
                                                type: 'image',
                                                // other options
                                                gallery: {
                                                      enabled:true
                                                },
                                                removalDelay: 300,

                                                // Class that is added to popup wrapper and background
                                                // make it unique to apply your CSS animations just to this exact popup
                                                mainClass: 'mfp-fade'
                                            });
                                    </script>

                                @endif

                                @if(strpos($post->mime, 'video') !== false)
                                <?php
                                    $postVideo = explode(',', $post->filename);
                                ?>
                                <div class="post-media">
                                    @for($i = 0; $i < count($postVideo); $i++)
                                        @if($postVideo[$i] != '')
                                        <video class="responsive-video" controls>
                                          <source src="{{ route('account.image', ['filename' => $postVideo[$i]]) }}" type="video/mp4">
                                        </video>
                                        @endif
                                    @endfor
                                </div>
                                @endif
                            </div>
                            <div class="interaction">
                                <span class="num-of-like">
                                    @foreach($postLikes as $key => $value)
                                        @if($post->id == $value->post_id)
                                            {{$value->total .' likes'}}
                                        @endif
                                    @endforeach
                                </span>
                                <a class="like"><i class="material-icons">thumb_up</i> Like</a>
                                <a class="share-post"><i class="material-icons">share</i> Share</a>
                                <span class="islike" style="display:none">0</span>
                                <a class="comment-post">Comment</a>
                                
                            </div>
                        </div>
                    @endforeach
                    <!-- end post -->
                </div>
            </div>
        </div>
    </section>
    
     <script type="text/javascript">
        var token = '{{ Session::token() }}';
        var urlEdit = '{{ route('edit') }}';
        var urlLike = '{{ route('like') }}';

        var routePost = "{{ route('post.create') }}";
        var userAvatar = '{{ URL::to('src/images/boa_hancock_wallpaper_blue_red_by_gian519.png') }}';

        var routeDropzone = '{{ URL::to('src/images') }}';
    </script>
@endsection