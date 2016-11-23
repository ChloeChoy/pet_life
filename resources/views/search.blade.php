@extends('layouts.content-layout')
@section('title')
    Search users
@endsection

@section('content')

<section class="main-content">
        <div class="container">
            <div class="row">
            	<div class="col s12 z-depth-1 search-content">
            		<span class="title">Search Results</span>

            		@if(count($users))
	            		@foreach($users as $user)
	            		<div class="result-item">
            				<a class="user-link" href="#">
            					@if (Storage::disk('local')->has($user->name . '-' . $user->id . '.jpg'))
		                            <img src="{{ route('account.image', ['filename' => $user->name . '-' . $user->id . '.jpg']) }}" alt="" class="responsive-img">
		                        @else
		                            <img class="responsive-img" src="{{ URL::to('src/images/boa_hancock_wallpaper_blue_red_by_gian519.png') }}">
		                        @endif
            					<span class="user-name">{{ $user->name }}</span>
            				</a>
	            			<a class="btn add-friend">Add friend</a>
	            		</div>
	            		@endforeach

	            	@else
	            		<span class="no-results">No Results Found</span>

            		@endif

            	</div>
            </div>
        </div>
</section>

@endsection