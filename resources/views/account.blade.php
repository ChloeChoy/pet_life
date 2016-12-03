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
                        
                        <a class="edit-wall-img" data-toggle="modal" href="#modal-upload-images"><i class="material-icons">photo_camera</i> Change cover photo</a>
                    @endif

                    </div>
                    <div class="account-avatar">
                    @if($user)
                        @if($user->avatar)
                            <img src="{{URL::to('post-images/'.$user->avatar)}}" alt="" class="responsive-img">
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
                        @if($user->avatar)
                            <img src="{{URL::to('post-images/'.$user->avatar)}}" alt="" class="resposive-img">
                        @endif

                        @if($user->cover_photo)
                            <img src="{{URL::to('post-images/'.$user->cover_photo)}}" alt="" class="resposive-img">
                        @endif
                        <!-- end avatar/cover image -->

                        <!-- post photo -->

                        @foreach($posts as $post)
                            <?php if($post->user_id == Auth::user()->id && $post->original_filename != ''): ?>
                                @if(strpos($post->mime, 'image') !== false)
                                    <?php 
                                        $postImg = explode(',', $post->original_filename);
                                        $numOfPostMedia = 0;
                                    ?>
                                   
                                    @for($i = 0; $i < count($postImg); $i++)
                                        <?php if($numOfPostMedia > 5){break;} ?>
                                        @if($postImg[$i] != '')
                                            <?php $numOfPostMedia++; ?>
                                            <img src="{{ URL::to('post-images/'.$postImg[$i]) }}" alt="image" class="responsive-img" data-mfp-src="{{URL::to('post-images/'.$postImg[$i]) }}">
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
                                <?php if($post->user_id == Auth::user()->id && $post->original_filename != ''): ?>
                                    @if(strpos($post->mime, 'video') !== false)
                                    <?php
                                        $postVideo = explode(',', $post->original_filename);
                                        $countVideo = 0;
                                    ?>
                                    @for($i = 0; $i < count($postVideo); $i++)
                                        <?php if($countVideo > 5){break;} ?>

                                        @if($postVideo[$i] != '')
                                        <?php $countVideo++; ?>
                                        <video class="responsive-video">
                                          <source src="{{URL::to('post-images/'.$postVideo[$i]) }}" type="video/mp4">
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
                    <form class="post-form" action="{{ route('post.profile') }}" method="post" enctype="multipart/form-data">
                        <div class="attach-files">
                            <a class="att-btn" id="att-video"><i class="material-icons">videocam</i> Upload videos</a>
                            <a class="att-btn att-image"><i class="material-icons">image</i> Upload images</a>
                            <div style='display: none'>
                                <input id="att-files" type="file" name="att_files[]" multiple onchange="previewFiles('att-files', 'preview')"/>
                            </div>
                        </div>
                        <div class="input-field col s12">
                            <textarea id="new-post" class="materialize-textarea"  name="body" required></textarea>
                            <label for="textarea1">What's your status</label>
                        </div>
                        <div id="preview"></div>
                        <div class="input-field input-url" style="display:none">
                            <input id="emb-video" type="text" name="embed_video">
                        </div>
                        <div class="field-submit">
                            <a class="embedded-video"><i class="material-icons">attachment</i></a>
                            <button id="create-post" type="submit" class="waves-effect waves-light btn">Post</button>
                        </div>
                        <input id="post-token" type="hidden" value="{{ Session::token() }}" name="_token">
                    </form>

                    <!-- post -->
                    @foreach($posts as $post)
                    @if($post->user_id == Auth::user()->id)
                        <div class="post-row" data-postid="{{ $post->id }}">
                            <div class="post-info">
                                <div class="user-avatar">
                                    <a href="#">
                                        @if($post->user->avatar)
                                        <img class="user-avatar" alt="avatar" src="{{URL::to('post-images/'.$post->user->avatar)}}" class="responsive-img">
                                        @else
                                        <img class="user-avatar" alt="avatar" src="{{ URL::to('src/images/boa_hancock_wallpaper_blue_red_by_gian519.png') }}" class="responsive-img">
                                        @endif
                                    </a>
                                </div>
                                <div class="user-post">
                                    <span class="post-username"><a href="#">{{ $post->user->name }}</a></span>
                                    <span class="post-on">Posted on {{  date_format($post->created_at, 'd M Y') }}</span>
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
                                <p>
                                <?php
                                    echo preg_replace('/(https?|ssh|ftp):\/\/[^\s"]+/', '<div class="video-container"><iframe src="$0" height="400" width="400" allowfullscreen>$0</iframe></div>', $post->body)
                                ?>
                                </p>

                                @if(strpos($post->mime, 'image') !== false)
                                    <?php 
                                        $postImg = explode(',', $post->original_filename);
                                        $numOfPostMedia = 0;
                                    ?>
                                    @if(count($postImg) > 2)
                                    <div class="post-media multi-medias" id="post-media{{$post->id}}">
                                        @for($i = 0; $i < count($postImg); $i++)
                                            @if($postImg[$i] != '')
                                                    <img src="{{URL::to('post-images/'.$postImg[$i]) }}" alt="image" class="responsive-img" data-mfp-src="{{URL::to('post-images/'.$postImg[$i]) }}">
                                                    <?php $numOfPostMedia++;?>
                                            @endif
                                        @endfor
                                        <span class="num-of-img">{{$numOfPostMedia - 1}}+</span>
                                    </div>
                                    @else
                                    <div class="post-media" id="post-media{{$post->id}}">
                                        @for($i = 0; $i < count($postImg); $i++)
                                            @if($postImg[$i] != '')
                                                    <img src="{{URL::to('post-images/'.$postImg[$i]) }}" alt="image" class="responsive-img" data-mfp-src="{{URL::to('post-images/'.$postImg[$i]) }}">
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
                                                mainClass: 'mfp-fade',
                                                zoom: {
                                                    enabled: true,
                                                    duration: 300, // don't foget to change the duration also in CSS
                                                    opener: function(element) {
                                                      return element.find('img');
                                                    }
                                                  }
                                            });
                                    </script>

                                @endif

                                @if(strpos($post->mime, 'video') !== false)
                                <?php
                                    $postVideo = explode(',', $post->original_filename);
                                ?>
                                <div class="post-media">
                                    @for($i = 0; $i < count($postVideo); $i++)
                                        @if($postVideo[$i] != '')
                                        <video class="responsive-video" controls>
                                          <source src="{{URL::to('post-images/'.$postVideo[$i]) }}" type="video/mp4">
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
                    @endif
                    @endforeach
                    <!-- end post -->
                </div>
            </div>
        </div>
    </section>

    <!-- modal edit post    -->
    <!-- Modal Structure -->
    <div id="modal-edit-post" class="modal fade" role="dialog">
        <div class="modal-dialog">
        <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Edit post</h4>
                </div>
                <div class="modal-body">
                    <form action="{{route('edit')}}" method="post">
                        <div class="input-field col s12">
                            <textarea id="post-body" class="materialize-textarea"  name="body" autofocus></textarea>
                        </div>
                        <!-- <input id="media-edit" type="file" name="media_edit" style="display:none" onchange="previewFiles('media-edit', 'preview-img-post')"> -->
                        <input id="rm-old-img" type="hidden" name="rm_old-img" value="">
                        <div id="preview-img-post"></div>
                    </form>
                </div>
            <div class="modal-footer">
                <button id="modal-save" type="button" class="btn btn-default" data-dismiss="modal">Save</button>
                <a class="btn cancel" data-dismiss="modal">Cancel</a>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal edit post -->

    <!-- form change cover/profile images -->
    <div id="modal-upload-images" class="modal fade" role="dialog">
        <div class="modal-dialog">
        <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Upload photos</h4>
                </div>
                <div class="modal-body">
                    <form id="form-upload-photos" action="{{ route('upload.photo') }}"  method="post" enctype="multipart/form-data">
                        <div class="input-field col s12">
                            <a class="change-user-photos btn"><i class="material-icons">image</i> Upload images</a>
                            <input id="profile-img" type="file" name="cover_img" onchange="previewFiles('profile-img')" style="display:none;">
                        </div>
                        <div id="preview"></div>
                        <div class="form-btn">
                            <a class="btn" data-dismiss="modal">Cancel</a>
                            <button id="modal-save" type="submit" class="btn btn-default">Save</button>
                        </div>
                        <input id="post-token" type="hidden" value="{{ Session::token() }}" name="_token">
                    </form>
                </div>
        </div>
    </div>
    <!-- end form change cover/profile images -->
    
     <script type="text/javascript">
        var token = '{{ Session::token() }}';
        var urlEdit = '{{ route('edit') }}';
        var urlLike = '{{ route('like') }}';

        var routePost = "{{ route('post.create') }}";
        var userAvatar = '{{ URL::to('src/images/boa_hancock_wallpaper_blue_red_by_gian519.png') }}';

        var routeDropzone = '{{ URL::to('src/images') }}';
    </script>
@endsection