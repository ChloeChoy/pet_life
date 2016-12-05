<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/


Route::get('/', function () {
    return view('signin');
})->name('home');

Route::get('/signup', function () {
    return view('signup');
});

Route::post('/signup', [
    'uses' => 'UserController@postSignUp',
    'as' => 'signup'
]);

Route::post('/signin', [
    'uses' => 'UserController@postSignIn',
    'as' => 'signin'
]);

Route::get('/logout', [
    'uses' => 'UserController@getLogout',
    'as' => 'logout'
]);

Route::get('/account', [
    'uses' => 'UserController@getAccount',
    'as' => 'account'
]);

Route::post('/upateaccount', [
    'uses' => 'UserController@postSaveAccount',
    'as' => 'account.save'
]);

Route::get('/userimage/{filename}', [
    'uses' => 'UserController@getUserImage',
    'as' => 'account.image'
]);

Route::get('/dashboard', [
    'uses' => 'PostController@getDashboard',
    'as' => 'dashboard',
    'middleware' => 'auth'
]);

Route::post('/createpost', [
    'uses' => 'PostController@postCreatePost',
    'as' => 'post.create',
    'middleware' => 'auth'
]);

Route::get('/delete-post/{post_id}', [
    'uses' => 'PostController@getDeletePost',
    'as' => 'post.delete',
    'middleware' => 'auth'
]);

Route::post('/edit', [
    'uses' => 'PostController@postEditPost',
    'as' => 'edit'
]);

Route::post('/like', [
    'uses' => 'PostController@postLikePost',
    'as' => 'like',
    'middleware' => 'auth'
]);

//route admin
Route::get('/administrator', ['uses' => 'AdminController@index', 'as' => 'administrator']);

//route to user info
Route::get('/userinfo', 
    [
        'uses' => 'UserController@userInfo',
        'as'    => 'userinfo'
    ]
);

//route to user photos
Route::get('/photos', 
    [
        'uses' => 'UserController@userPhotos',
        'as'    => 'photos'
    ]
);

//route to post view
Route::get('/post/{post_id}', 
    [
        'uses' => 'PostController@getPostView',
        'as'    => 'post.view'
    ]
);
Route::get('facebook/redirect', 'Auth\SocialController@redirectToProvider');
Route::get('facebook/callback', 'Auth\SocialController@handleProviderCallback');

Route::get('google/redirect', 'Auth\SocialController@redirectToProviderGoogle');
Route::get('google/callback', 'Auth\SocialController@handleProviderCallbackGoogle');

//route to news page
Route::get('/news', [
        'uses'  => 'PostController@getPostNews',
        'as'    => 'post.news'
    ]
);

//route to admin remove users
Route::get('/administrator/remove-users', [
        'uses'  => 'AdminController@getRemoveUsers',
        'as'    => 'remove.users'
    ]
);

//route to search page
Route::get('/search', 
    [
        'uses' => 'PostController@getSearchUsers',
        'as'    => 'search'
    ]
);

//route upload avatar/cover photo
Route::post('upload-photo',
    [
        'uses'  => 'UserController@uploadAvatarCover',
        'as'    => 'upload.photo'
    ]
);

//route to admin add user
Route::get('/administrator/adduser', 
    [
        'uses' => 'AdminController@getAddUser',
        'as'    => 'adduser'
    ]
);

//route admin create user
Route::post('/administrator/admin-adduser',
    [
        'uses'  => 'AdminController@addNewUser',
        'as'    => 'admin.adduser',
        'middleware' => 'auth'
    ]
);

//route to create post in profile page
Route::post('/profile-post',
    [
        'uses'  => 'UserController@postInProfile',
        'as'    => 'post.profile',
        'middleware' => 'auth'
    ]
);

//route to view other user's frofile page
Route::get('/account/{otherUser}',
    [
        'uses'  => 'UserController@getOtherAccount',
        'as'    => 'other.profile',
        'middleware' => 'auth'
    ]
);

//route to post address in userinfo
Route::post('/updateaddress', [
    'uses' => 'UserController@postAddress',
    'as' => 'post.address'
    ]
);
//route to post job in userinfo
Route::post('/updatejob', [
    'uses' => 'UserController@postJob',
    'as' => 'post.job'
    ]
);
//route to post birthday in userinfo
Route::post('/updatebirthday', [
    'uses' => 'UserController@postBirthday',
    'as' => 'post.birthday'
    ]
);
//route to post gender in userinfo
Route::post('/updategender', [
    'uses' => 'UserController@postGender',
    'as' => 'post.gender'
    ]
);

//route to view other user's frofile page
Route::get('/account/{otherUser}',
    [
        'uses'  => 'UserController@getOtherAccount',
        'as'    => 'other.profile',
        'middleware' => 'auth'
    ]
);
Route::get('/userinfo/{otherUser}',
    [
        'uses'  => 'UserController@getOtherUserInfo',
        'as'    => 'other.user.info',
        'middleware' => 'auth'
    ]
);

//route to trending page
Route::get('trending',
    [
        'uses'  => 'PostController@getTrendingPost',
        'as'    => 'trending',
        'middleware' => 'auth'
    ]
);