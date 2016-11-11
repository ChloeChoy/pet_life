@extends('layouts.content-layout')

@section('content')
    @include('includes.message-block')
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
                <div class="col m12 l6">
                    <form class="post-form" action="{{ route('post.create') }}" method="post">
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
                        <div class="post-row" data-postid="{{ $post->id }}">
                            <div class="post-info">
                                <div class="user-avatar">
                                    <a href="#"><img alt="avatar" src="{{ URL::to('src/images/boa_hancock_wallpaper_blue_red_by_gian519.png') }}" class="responsive-img"></a>
                                </div>
                                <div class="user-post">
                                    <span class="post-username"><a href="#">{{ $post->user->first_name }}</a></span>
                                    <span class="post-on">posted on {{ $post->created_at }}</span>
                                </div>
                                @if(Auth::user() == $post->user)
                                <div class="post-act">
                                    <a class="popup-post-menu"><i class="material-icons"><i class="material-icons">keyboard_arrow_down</i></i></a>
                                    <div class="post-menu-act" style="display:none;">
                                        <a class="edit-post"><i class="material-icons">mode_edit</i> Edit</a>
                                        <a class="delete-post" href="{{ route('post.delete', ['post_id' => $post->id]) }}"><i class="material-icons">delete</i> Delete</a>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="post-content">
                                <p>{{ $post->body }}</p>
                            </div>
                            <div class="interaction">
                                <a href="#" class="like"><i class="material-icons">thumb_up</i> {{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'You like this post' : 'Like' : 'Like'  }}</a>
                                <a href="#" class="share-post"><i class="material-icons">share</i> Share</a>
                            </div>
                        </div>
                    @endforeach
                    <!-- end post -->

                </div>
                <div class="col l4">
                    <!-- trending post -->
                </div>
            </div>
        </div>
    </section>
    
    <!-- modal edit post    -->
    <div class="modal fade" tabindex="-1" role="dialog" id="edit-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Post</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="post-body">Edit the Post</label>
                            <textarea class="form-control" name="post-body" id="post-body" rows="5"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="modal-save">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <script>
        var token = '{{ Session::token() }}';
        var urlEdit = '{{ route('edit') }}';
        var urlLike = '{{ route('like') }}';
    </script>
@endsection