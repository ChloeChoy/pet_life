@extends('layouts.content-layout')

@section('title')
    Post view
@endsection

@section('content')

	<section class="main-content">
		<div class="container">
			<div class="row">
				<div class="col s12">
					<div class="post-row" data-postid="{{ $post->id }}">
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
                            <section class="row new-post">
                                <div class="col-md-6 col-md-offset-3">
                                    <img width="450" height="240" src="{{ route('account.image', ['filename' => $post->filename]) }}" alt="" class="img-responsive">
                                </div>
                            </section>
                            @endif
                            @if(strpos($post->mime, 'video') !== false)
                            <section class="row new-post">
                                <video class="col-md-6 col-md-offset-3" width="320" height="240" controls>
                                  <source src="{{ route('account.image', ['filename' => $post->filename]) }}" type="video/mp4">
                                </video>
                            </section>
                            @endif
                        </div>
                        <div class="interaction">
                            <span class="num-of-like">0</span>
                            <a class="like"><i class="material-icons">thumb_up</i> Like</a>
                            <a class="share-post"><i class="material-icons">share</i> Share</a>
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