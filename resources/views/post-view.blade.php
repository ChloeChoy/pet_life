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
                        <img class="responsive-img" alt="avatar" src="{{ URL::to('src/images/boa_hancock_wallpaper_blue_red_by_gian519.png') }}">
                        <a href="{{ route('account')}}"><i class="material-icons">mode_edit</i> Update profile</a>
                    </div>
                    <ul class="menu-left">
                        <li><a href="#"><i class="material-icons">wallpaper</i> News</a></li>
                        <li><a href="#"><i class="material-icons">message</i> Messages</a></li>
                        <li><a href="#"><i class="fa fa-globe" aria-hidden="true"></i> Notifications</a></li>
                        <li><a href="#"><i class="material-icons">photo_library</i> Photos</a></li>
                        <li><a href="#"><i class="material-icons">video_library</i> Videos</a></li>
                        <li><a href="#"><i class="material-icons">settings</i> Settings</a></li>
                    </ul>
                </div>
				<div class="col s12 l8">
					<div class="post-row" data-postid="{{ $post->id }}" style="margin-top: 0;">
                        <div class="post-info">
                            <div class="user-avatar">
                                <a href="#"><img alt="avatar" src="{{ URL::to('src/images/boa_hancock_wallpaper_blue_red_by_gian519.png') }}" class="responsive-img"></a>
                            </div>
                            <div class="user-post">
                                <span class="post-username"><a href="#">{{ $post->user->first_name }}</a></span>
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
                                <?php $postImg = explode(',', $post->filename);?>
                                @if(count($postImg) > 2)
                                <div class="post-media multi-medias" id="post-media{{$post->id}}">
                                    @for($i = 0; $i < count($postImg); $i++)
                                        @if($postImg[$i] != '')
                                                <img src="{{ route('account.image', ['filename' => $postImg[$i]]) }}" alt="image" class="responsive-img materialboxed" data-mfp-src="{{ route('account.image', ['filename' => $postImg[$i]]) }}">
                                        @endif
                                    @endfor
                                </div>
                                @else
                                <div class="post-media" id="post-media{{$post->id}}">
                                    @for($i = 0; $i < count($postImg); $i++)
                                        @if($postImg[$i] != '')
                                                <img src="{{ route('account.image', ['filename' => $postImg[$i]]) }}" alt="image" class="responsive-img materialboxed" data-mfp-src="{{ route('account.image', ['filename' => $postImg[$i]]) }}">
                                        @endif
                                    @endfor
                                </div>
                                @endif
                            @endif
                            
                        </div>
                        <div class="interaction">
                            <span class="num-of-like">0</span>
                            <a class="like"><i class="material-icons">thumb_up</i> Like</a>
                            <a class="share-post"><i class="material-icons">share</i> Share</a>
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