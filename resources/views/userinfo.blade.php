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

            <!-- content user info -->
            <div class="row">
            	<div class="col m4 l4 col-tabs">
            		<div class="tab-info z-depth-1">
            			<div class="tabs">
            				<a id="place-live" class="tab-link link-active">Living</a>
            			</div>
            			<div class="tabs">
            				<a id="workplace" class="tab-link">Works</a>
            			</div>
            			<div class="tabs">
            				<a id="user-birth" class="tab-link">Birthday</a>
            			</div>
                        <div class="tabs">
                            <a id="gender-info" class="tab-link">Gender</a>
                        </div>
            		</div>
            	</div>
            	<div class="col m8 l8 s12 col-info z-depth-1">
            		<div class="main-user-info">
            			<div class="infor living">
            				<span class="title">Living information</span>
            				<ul class="collapsible" data-collapsible="accordion">
							    <li>
							      	<div class="collapsible-header" id="live-info">
							      		<i class="material-icons">place</i> Add location
							      		<i class="material-icons edit-icon">mode_edit</i>
							      	</div>
							      	<div class="collapsible-body">
							      		<form>
							      			<div class="input-field">
							      				<input type="text" name="living">
							      			</div>
							      		</form>
							      		<div class="input-field">
						      				<button class="btn cancel">Cancel</button>
						      				<button class="btn save-info">Save</button>
						      			</div>
							      	</div>
							    </li>
							</ul>
            			</div>
            			<div class="infor works">
            				<span class="title">Works information</span>
            				<ul class="collapsible" data-collapsible="accordion">
							    <li>
							      	<div class="collapsible-header" id="work-info">
							      		<i class="material-icons">work</i> Add a workplace
							      		<i class="material-icons edit-icon">mode_edit</i>
							      	</div>
							      	<div class="collapsible-body">
							      		<form>
							      			<div class="input-field">
							      				<input type="text" name="works">
							      			</div>
							      		</form>
							      		<div class="input-field">
						      				<button class="btn cancel">Cancel</button>
						      				<button class="btn save-info">Save</button>
						      			</div>
							      	</div>
							    </li>
							</ul>
            			</div>
            			<div class="infor birthday">
            				<span class="title">Your birthday</span>
            				<ul class="collapsible" data-collapsible="accordion">
							    <li>
							      	<div class="collapsible-header" id="birthday-info">
							      		<i class="material-icons">date_range</i> Add your birthday
							      		<i class="material-icons edit-icon">mode_edit</i>
							      	</div>
							      	<div class="collapsible-body">
							      		<form>
							      			<div class="input-field">
							      				<input type="date" class="datepicker" name="birthday">
							      			</div>
							      		</form>
							      		<div class="input-field">
						      				<button class="btn cancel">Cancel</button>
						      				<button class="btn save-info">Save</button>
						      			</div>
							      	</div>
							    </li>
							</ul>
            			</div>
                        <div class="infor gender">
                            <span class="title">Gender</span>
                            <ul class="collapsible" data-collapsible="accordion">
                                <li>
                                    <div class="collapsible-header" id="user-gender-info">
                                        <i class="material-icons">person</i> Add gender information
                                        <i class="material-icons edit-icon">mode_edit</i>
                                    </div>
                                    <div class="collapsible-body">
                                        <form>
                                            <div class="input-field">
                                                <p>
                                                    <input class="with-gap" name="gender" type="radio" id="male"  />
                                                    <label for="male">Male</label>
                                                </p>
                                                <p>
                                                    <input class="with-gap" name="gender" type="radio" id="female"  />
                                                    <label for="female">Female</label>
                                                </p>
                                            </div>
                                        </form>
                                        <div class="input-field">
                                            <button class="btn cancel">Cancel</button>
                                            <button class="btn save-info">Save</button>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
            		</div>
            	</div>
            </div>
            <!-- end content user info -->
		</div>
	</section>

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

@endsection