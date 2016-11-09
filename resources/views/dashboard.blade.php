@extends('layouts.content-layout')

@section('content')
    @include('includes.message-block')
    <section class="main-content">
        <div class="container">
            <div class="row">
                <div class="col l2">
                    <!-- link -->
                </div>
                <div class="col s12 l6">
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
                                    <img src="{{ URL::to('src/images/boa_hancock_wallpaper_blue_red_by_gian519.png') }}" class="responsive-img">
                                </div>
                                <div class="user-post">
                                    <span class="post-username">{{ $post->user->first_name }}</span>
                                    <span class="post-on">posted on {{ $post->created_at }}</span>
                                </div>
                            </div>
                            <div class="post-content">
                                <p>{{ $post->body }}</p>
                            </div>
                            <div class="interaction">
                                <a href="#" class="like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'You like this post' : 'Like' : 'Like'  }}</a> |
                                @if(Auth::user() == $post->user)
                                    <a href="#" class="edit">Edit</a> |
                                    <a href="{{ route('post.delete', ['post_id' => $post->id]) }}">Delete</a>
                                @endif
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