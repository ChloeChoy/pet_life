@extends('layouts.content-layout')

@section('title')
    Post view
@endsection

@section('content')

	<section class="main-content">
		<div class="container">
			<div class="row">
                <div class="col l2 col-left-link">
                    <div class="link-profile">
                        @if(Auth::user()->avatar)
                        <img class="responsive-img" alt="avatar" src="{{URL::to('post-images/'.Auth::user()->avatar)}}">
                        @else
                        <img class="responsive-img" alt="avatar" src="{{ URL::to('src/images/boa_hancock_wallpaper_blue_red_by_gian519.png') }}">
                        @endif
                        <a href="{{ route('account')}}"><i class="material-icons">mode_edit</i> {{ $user->name }}</a>
                    </div>
                    <ul class="menu-left">
                        <li><a href="{{route('post.news')}}"><i class="material-icons">rss_feed</i> News</a></li>
                        <li><a href="#"><i class="material-icons">message</i> Messages</a></li>
                        <li><a href="#"><i class="fa fa-globe" aria-hidden="true"></i> Notifications</a></li>
                        <li><a href="{{route('photos')}}"><i class="material-icons">photo_library</i> Photos</a></li>
                        <li><a href="{{route('photos')}}"><i class="material-icons">video_library</i> Videos</a></li>
                        <li><a href="#"><i class="material-icons">settings</i> Settings</a></li>
                    </ul>
                </div>
				<div class="col s12 l8">
					<div class="post-row" data-postid="{{ $post->id }}" style="margin-top: 0;">
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
                            <p class="post-text">
                            <?php
                                echo preg_replace('/(https?|ssh|ftp):\/\/[^\s"]+/', '<div class="video-container"><iframe src="$0" height="400" width="400" allowfullscreen>$0</iframe></div>', $post->body)
                            ?>
                            </p>
                            <script type="text/javascript">
                                    $(".post-text").emojiParse({
                                        icons: [{
                                            path: "dist/img/tieba/",
                                            file: ".jpg",
                                            placeholder: ":{alias}:",
                                            alias: {
                                                1: "hehe",
                                                2: "haha",
                                                3: "tushe",
                                                4: "a",
                                                5: "ku",
                                                6: "lu",
                                                7: "kaixin",
                                                8: "han",
                                                9: "lei",
                                                10: "heixian",
                                                11: "bishi",
                                                12: "bugaoxing",
                                                13: "zhenbang",
                                                14: "qian",
                                                15: "yiwen",
                                                16: "yinxian",
                                                17: "tu",
                                                18: "yi",
                                                19: "weiqu",
                                                20: "huaxin",
                                                21: "hu",
                                                22: "xiaonian",
                                                23: "neng",
                                                24: "taikaixin",
                                                25: "huaji",
                                                26: "mianqiang",
                                                27: "kuanghan",
                                                28: "guai",
                                                29: "shuijiao",
                                                30: "jinku",
                                                31: "shengqi",
                                                32: "jinya",
                                                33: "pen",
                                                34: "aixin",
                                                35: "xinsui",
                                                36: "meigui",
                                                37: "liwu",
                                                38: "caihong",
                                                39: "xxyl",
                                                40: "taiyang",
                                                41: "qianbi",
                                                42: "dnegpao",
                                                43: "chabei",
                                                44: "dangao",
                                                45: "yinyue",
                                                46: "haha2",
                                                47: "shenli",
                                                48: "damuzhi",
                                                49: "ruo",
                                                50: "OK"
                                            }
                                        }]
                                    });
                                </script>
                            
                            @if(strpos($post->mime, 'image') !== false)
                                <?php $postImg = explode(',', $post->original_filename);?>
                                @if(count($postImg) > 2)
                                <div class="multi-medias" id="post-media{{$post->id}}">
                                    @for($i = 0; $i < count($postImg); $i++)
                                        @if($postImg[$i] != '')
                                            <img src="{{URL::to('post-images/'.$postImg[$i])}}" alt="image" class="responsive-img" data-mfp-src="{{URL::to('post-images/'.$postImg[$i])}}">
                                        @endif
                                    @endfor
                                </div>
                                @else
                                <div class="post-media" id="post-media{{$post->id}}">
                                    @for($i = 0; $i < count($postImg); $i++)
                                        @if($postImg[$i] != '')
                                            <img src="{{URL::to('post-images/'.$postImg[$i])}}" alt="image" class="responsive-img" data-mfp-src="{{URL::to('post-images/'.$postImg[$i])}}">
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
                                          <source src="{{URL::to('post-images/'.$postVideo[$i])}}" type="video/mp4">
                                        </video>
                                        @endif
                                    @endfor
                                </div>
                            @endif
                            
                        </div>
                        <div class="interaction">
                            <span class="num-of-like">
                                @if($like != '')
                                    {{$like . ' likes'}}
                                @endif
                            </span>
                            <a class="like"><i class="material-icons">thumb_up</i> Like</a>
                            <a class="share-post"><i class="material-icons">share</i> Share</a>
                            <span class="islike" style="display:none">0</span>
                            <a class="comment-post-view">Comment</a>

                            <div class="fb-comments" data-href="{{Request::url()}}" data-numposts="5"></div>
                        </div>
                    </div>
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
                    <form>
                        <div class="input-field col s12">
                            <textarea id="post-body" class="materialize-textarea"  name="body" autofocus></textarea>
                        </div>
                    </form>
                </div>
            <div class="modal-footer">
                <a class="btn" data-dismiss="modal">Cancel</a>
                <button id="modal-save" type="button" class="btn btn-default" data-dismiss="modal">Save</button>
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

@endsection