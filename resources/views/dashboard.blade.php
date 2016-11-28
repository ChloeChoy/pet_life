@extends('layouts.content-layout')
@section('title')
    Dashboard
@endsection

@section('content')
    <!-- @include('includes.message-block') -->

    <section class="main-content">
        <div class="container">
            <div class="row">
                <div class="col l2 col-left-link">
                    <div class="link-profile">
                        @if(Auth::user()->avatar)
                        <img class="responsive-img" alt="avatar" src="{{ route('account.image', ['filename' => Auth::user()->avatar]) }}">
                        @else
                        <img class="responsive-img" alt="avatar" src="{{ URL::to('src/images/boa_hancock_wallpaper_blue_red_by_gian519.png') }}">
                        @endif
                        <a href="{{ route('account')}}"><i class="material-icons">mode_edit</i> {{ $user->name }}</a>
                    </div>
                    <ul class="menu-left">
                        <li><a href="{{route('post.news')}}"><i class="material-icons">wallpaper</i> News</a></li>
                        <li><a href="#"><i class="material-icons">message</i> Messages</a></li>
                        <li><a href="#"><i class="fa fa-globe" aria-hidden="true"></i> Notifications</a></li>
                        <li><a href="{{route('photos')}}"><i class="material-icons">photo_library</i> Photos</a></li>
                        <li><a href="{{route('photos')}}"><i class="material-icons">video_library</i> Videos</a></li>
                        <li><a href="#"><i class="material-icons">settings</i> Settings</a></li>
                    </ul>
                </div>
                <div class="col m12 s12 l7">
                    <form class="post-form" action="{{ route('post.create') }}" method="post" enctype="multipart/form-data">
                        <div class="attach-files">
                            <a class="att-btn"><i class="material-icons">videocam</i> Upload videos</a>
                            <a class="att-btn att-image"><i class="material-icons">image</i> Upload images</a>
                            <div style='display: none'>
                                <input id="att-files" type="file" name="att_files[]" multiple onchange="previewFiles('att-files')"/>
                            </div>
                        </div>
                        <div class="input-field col s12">
                            <textarea id="new-post" class="materialize-textarea"  name="body" required></textarea>
                            <label for="textarea1">What's your status</label>
                        </div>
                        <div id="preview"></div>
                        <div class="field-submit">
                            <button id="create-post" type="submit" class="waves-effect waves-light btn">Post</button>
                        </div>
                        <input id="post-token" type="hidden" value="{{ Session::token() }}" name="_token">
                    </form>

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
                @if($trendPosts)
                    <div class="col l3 trending hide-on-med-and-down">
                        <!-- trending post -->
                        <h5 class="title">Trending posts</h5>
                        <div class="posts">
                            @foreach($trendPosts as $trendPost)
                            <a class="trend-row" href='{{route("post.view",["post_id" => $trendPost->id])}}' data-postid="{{ $trendPost->id }}">
                                <div class="post-info">
                                    <div class="user-avatar">
                                        <img alt="avatar" src="{{ URL::to('src/images/boa_hancock_wallpaper_blue_red_by_gian519.png') }}" class="responsive-img">
                                    </div>
                                    <div class="user-post">
                                        <span class="post-username">{{ $trendPost->user->name }}</span>
                                    </div>
                                </div>
                                <div class="post-content">
                                    <p>{{ $trendPost->body }}</p>

                                    <!-- image -->
                                    @if(strpos($trendPost->mime, 'image') !== false)
                                        <?php
                                            $postImg = explode(',', $trendPost->filename);
                                            $numOfImg = 0;
                                        ?>
                                        @if(count($postImg) > 2)
                                        <div class="trend-img multi-img" id="post-media{{$trendPost->id}}">
                                            @for($i = 0; $i < count($postImg); $i++)
                                                @if($postImg[$i] != '')
                                                    <?php $numOfImg++; ?>
                                                    <img src="{{ route('account.image', ['filename' => $postImg[$i]]) }}" alt="image" class="responsive-img" data-mfp-src="{{ route('account.image', ['filename' => $postImg[$i]]) }}">
                                                @endif
                                            @endfor
                                            <span class="num-of-img">{{$numOfImg - 1}}+</span>
                                        </div>
                                        @else
                                        <div class="trend-img" id="post-media{{$trendPost->id}}">
                                            @for($i = 0; $i < count($postImg); $i++)
                                                @if($postImg[$i] != '')
                                                    <img src="{{ route('account.image', ['filename' => $postImg[$i]]) }}" alt="image" class="responsive-img" data-mfp-src="{{ route('account.image', ['filename' => $postImg[$i]]) }}">
                                                @endif
                                            @endfor
                                        </div>
                                        @endif
                                    @endif
                                    <!-- end image -->

                                    <!-- video -->
                                    @if(strpos($trendPost->mime, 'video') !== false)
                                    <?php
                                        $postVideo = explode(',', $trendPost->filename);
                                    ?>
                                    <div class="post-media">
                                        @for($i = 0; $i < count($postVideo); $i++)
                                            @if($postVideo[$i] != '')
                                            <video class="responsive-video">
                                              <source src="{{ route('account.image', ['filename' => $postVideo[$i]]) }}" type="video/mp4">
                                            </video>
                                            @endif
                                        @endfor
                                    </div>
                                    @endif
                                    <!-- end video -->

                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                @endif
                <!-- end trenpost -->

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
                    <form>
                        <div class="input-field col s12">
                            <textarea id="post-body" class="materialize-textarea"  name="body" autofocus></textarea>
                        </div>
                    </form>
                </div>
            <div class="modal-footer">
                <button id="modal-save" type="button" class="btn btn-default" data-dismiss="modal">Save</button>
                <a class="btn cancel" data-dismiss="modal">Cancel</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        var token = '{{ Session::token() }}';
        var urlEdit = '{{ route('edit') }}';
        var urlLike = '{{ route('like') }}';

        var routePost = "{{ route('post.create') }}";
        var userAvatar = '{{ URL::to('src/images/boa_hancock_wallpaper_blue_red_by_gian519.png') }}';

        var routeDropzone = '{{ URL::to('src/images') }}';
    </script>
    <script type="text/javascript">
         // function getFile(){
         //   document.getElementById("image").click();
         // }
         // function sub(obj){
         //    var file = obj.value;
         //    var fileName = file.split("\\");
         //    document.getElementById("yourBtn").innerHTML = fileName[fileName.length-1];
         //    document.myForm.submit();
         //    event.preventDefault();
         //  }
    </script>
@endsection