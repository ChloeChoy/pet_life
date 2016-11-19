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
                        <img class="responsive-img" src="{{ URL::to('src/images/default-wall.jpg') }}">
                        <a class="edit-wall-img" data-toggle="modal" href="#modal-upload-images"><i class="material-icons">photo_camera</i> Change cover photo</a>
                    </div>
                    <div class="account-avatar">
                    @if($user)
                        @if (Storage::disk('local')->has($user->first_name . '-' . $user->id . '.jpg'))
                            <img src="{{ route('account.image', ['filename' => $user->first_name . '-' . $user->id . '.jpg']) }}" alt="" class="responsive-img">
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
                        @if (Storage::disk('local')->has($user->first_name . '-' . $user->id . '.jpg'))
                            <img src="{{ route('account.image', ['filename' => $user->first_name . '-' . $user->id . '.jpg']) }}" alt="" class="resposive-img">
                        @else
                            <span class="photo-alert">You have no photo. Please post your photo.</span>
                        @endif
                    @endif
                        </div>
                    </div>
                    <div class="video-box">
                        <span class="title-info">Videos</span>
                        <div class="video thumnail"></div>
                    </div>
                </div>
                <div class="col l8 s12 col-user-post">
                    <form class="post-form" action="{{ route('post.create') }}" method="post" enctype="multipart/form-data">
                        <div class="attach-files">
                            <a class="att-btn"><i class="material-icons">videocam</i> Upload videos</a>
                            <a class="att-btn att-image"><i class="material-icons">image</i> Upload images</a>
                            <div style='display: none'>
                                <input id="att-files" type="file" name="att_files"/>
                            </div>                        
                        </div>
                        <div class="input-field col s12">
                            <textarea id="new-post" class="materialize-textarea"  name="body" required></textarea>
                            <label for="textarea1">What's your status</label>
                        </div>
                        <div class="field-submit">
                            <button id="create-post" type="submit" class="waves-effect waves-light btn">Post</button>
                        </div>
                        <input type="file" name="file" style="display:none;" />
                        <input id="post-token" type="hidden" value="{{ Session::token() }}" name="_token">
                    </form>

                    <!-- post -->
                    @foreach($posts as $post)
                        @if(Auth::user() == $post->user)
                        <div class="post-row" data-postid="{{ $post->id }}">
                            <div class="post-info">
                                <div class="user-avatar">
                                    <a href="#"><img alt="avatar" src="{{ URL::to('src/images/boa_hancock_wallpaper_blue_red_by_gian519.png') }}" class="responsive-img"></a>
                                </div>
                                <div class="user-post">
                                    <span class="post-username"><a href="#">{{ $post->user->first_name }}</a></span>
                                    <span class="post-on">Posted on {{  date_format($post->created_at, 'D M Y') }}</span>
                                </div>
                                <div class="post-act">
                                    <a class="popup-post-menu"><i class="material-icons"><i class="material-icons">keyboard_arrow_down</i></i></a>
                                    <div class="post-menu-act" style="display:none;">
                                        <a class="edit-post" data-toggle="modal" href="#modal-edit-post"><i class="material-icons">mode_edit</i> Edit</a>
                                        <a class="delete-post"><i class="material-icons">delete</i> Delete</a>
                                    </div>
                                </div>
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
                    <form class="upload-photos"  method="post" enctype="multipart/form-data">
                        <div class="input-field col s12">
                            <a class="change-user-photos btn"><i class="material-icons">image</i> Upload images</a>
                            <input id="profile-img" type="file" name="cover_img" style="display:none;">
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