@extends('layouts.content-layout')
@section('title')
    Trending posts
@endsection

@section('content')

<section class="main-content">
	<div class="container">
		<div class="row">
			<div class="col s12 col l8 offset-l2">
				<div class="trending-content">
					<span class="title">Trending posts</span>
					@foreach($posts as $post)
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
                                    <div class="post-media post-img multi-medias" id="post-media{{$post->id}}">
                                        @for($i = 0; $i < count($postImg); $i++)
                                            @if($postImg[$i] != '')
                                                    <img src="{{URL::to('post-images/'.$postImg[$i])}}" alt="image" class="responsive-img" data-mfp-src="{{URL::to('post-images/'.$postImg[$i])}}">
                                                    <?php $numOfPostMedia++;?>
                                            @endif
                                        @endfor
                                        <span class="num-of-img">{{$numOfPostMedia - 1}}+</span>
                                    </div>
                                    @else
                                    <div class="post-media post-img" id="post-media{{$post->id}}">
                                        @for($i = 0; $i < count($postImg); $i++)
                                            @if($postImg[$i] != '')
                                                    <img src="{{URL::to('post-images/'.$postImg[$i])}}" alt="image" class="responsive-img" data-mfp-src="{{URL::to('post-images/'.$postImg[$i])}}">
                                            @endif
                                        @endfor
                                    </div>
                                    @endif

                                    <!-- post images's name -->
                                    <input id="post-img{{$post->id}}" type="hidden" name="post-img" value="{{$post->original_filename}}">

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
				</div>
			</div>
		</div>
	</div>
</section>

@endsection