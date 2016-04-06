<?php

/*
|--------------------------------------------------------------------------
| 前台路由
|--------------------------------------------------------------------------
*/
Route::group(['namespace' => 'Frontend', 'as' => 'frontend::'], function () {
    // 主页
    Route::get('/', ['as' => 'index', 'uses' => 'IndexController@index']);
    Route::get('/sendemail', ['as' => 'sendemail', 'uses' => 'IndexController@sendEmail']);

    // 登录注册
    Route::get('/login', ['as' => 'login', 'uses' => 'AuthController@getLogin']);
    Route::post('/login', ['as' => 'login', 'uses' => 'AuthController@postLogin']);
    Route::get('/register', ['as' => 'register', 'uses' => 'AuthController@getRegister']);
    Route::post('/register', ['as' => 'register', 'uses' => 'AuthController@postRegister']);
    Route::get('/logout', ['as' => 'logout', 'uses' => 'AuthController@getLogout']);

    // 忘记密码
    Route::get('/get_reset_email', ['as' => 'get_reset_email', 'uses' => 'PasswordController@getEmail']);
    Route::post('/send_reset_email', ['as' => 'send_reset_email', 'uses' => 'PasswordController@postEmail']);
    Route::get('/get_reset_password/{token}', ['as' => 'get_reset_password', 'uses' => 'PasswordController@getReset']);
    Route::post('/post_reset_password', ['as' => 'post_reset_password', 'uses' => 'PasswordController@postReset']);

    // 用户相关(个人)
    Route::get('/user', ['as' => 'user.authprofile', 'uses' => 'ProfileController@show']);
    Route::get('/user/edit', ['as' => 'user.authprofile.edit', 'uses' => 'ProfileController@edit']);
    Route::put('/user/{user_id}', ['as' => 'user.authprofile.update', 'uses' => 'ProfileController@update']);
    Route::get('/user/focus_posts', ['as' => 'user.focus_posts', 'uses' => 'UserController@getUserFocusPosts']);

    // 用户相关(公开)
    Route::get('/users/{user_id}', ['as' => 'user.profile', 'uses' => 'ProfileController@show']);
    Route::get('/users/{user_id}/posts', ['as' => 'user.posts', 'uses' => 'UserController@getUserPosts']);
    Route::get('/users/{user_id}/comments', ['as' => 'user.comments', 'uses' => 'UserController@getUserComments']);
    Route::get('/users/{user_id}/events', ['as' => 'user.events', 'uses' => 'UserController@getUserEvents']);
    Route::get('/users/{user_id}/favorites', ['as' => 'user.favorites', 'uses' => 'UserController@getUserFavorites']);
    Route::get('/users/{user_id}/followers', ['as' => 'user.followers', 'uses' => 'UserController@getUserFollowers']);
    Route::get('/users/{user_id}/followings', ['as' => 'user.followings', 'uses' => 'UserController@getUserFollowings']);
    Route::get('/users/{user_id}/follow', ['as' => 'user.follow', 'uses' => 'UserController@getFollowUser']);
    Route::get('/users/{user_id}/unfollow', ['as' => 'user.unfollow', 'uses' => 'UserController@getUnfollowUser']);
    Route::get('/users/{user_id}/remove_follower', ['as' => 'user.remove_follower', 'uses' => 'UserController@getRemoveFollower']);

    // 消息提示
    Route::get('/notifications', ['as' => 'notifications.index', 'uses' => 'NotificationController@index']);

    // 动态相关
    Route::get('/posts/{post_id}/addfavorite', ['as' => 'posts.addFavorite', 'uses' => 'FavoriteController@getAddFavoritePost']);
    Route::get('/posts/{post_id}/upvote', ['as' => 'posts.upvote', 'uses' => 'PostController@getUpvotePost']);
    Route::get('/posts/{post_id}/downvote', ['as' => 'posts.downvote', 'uses' => 'PostController@getDownvotePost']);
    Route::resource('/posts', 'PostController');
    Route::resource('/categories', 'CategoryController');

    // 评论相关
    Route::get('/comments/{comment_id}/upvote', ['as' => 'comments.upvote', 'uses' => 'CommentController@getUpvoteComment']);
    Route::get('/comments/{comment_id}/downvote', ['as' => 'comments.downvote', 'uses' => 'CommentController@getDownvoteComment']);
    Route::resource('/comments', 'CommentController');

    // 活动相关
    Route::get('/events/{event_id}/upvote', ['as' => 'events.upvote', 'uses' => 'EventController@getUpvoteEvent']);
    Route::get('/events/{event_id}/downvote', ['as' => 'events.downvote', 'uses' => 'EventController@getDownvoteEvent']);
    Route::resource('/events', 'EventController');

    // 站点公告
    Route::get('/notices/{notice_id}', ['as' => 'notices.show', 'uses' => 'NoticeController@show']);

    // 搜索模块
    Route::get('/search', ['as' => 'search.posts', 'uses' => 'SearchController@getSearch']);
    Route::get('/search/users', ['as' => 'search.users', 'uses' => 'SearchController@getUsersResult']);
    Route::get('/search/events', ['as' => 'search.events', 'uses' => 'SearchController@getEventsResult']);
});


/*
|--------------------------------------------------------------------------
| 后台路由
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'admin', 'namespace' => 'Backend', 'as' => 'backend::'], function () {
    // 主页
    Route::get('', ['as' => 'admin.home', 'uses' => 'AdminIndexController@index']);
    Route::get('/', ['as' => 'admin.index', 'uses' => 'AdminIndexController@index']);

    // 登录注册
    Route::get('/login', ['as' => 'admin.login', 'uses' => 'AdminAuthController@getLogin']);
    Route::post('/login', ['as' => 'admin.login', 'uses' => 'AdminAuthController@postLogin']);
    Route::post('/register', ['as' => 'admin.register', 'uses' => 'AdminAuthController@postRegister']);
    Route::get('/register', ['as' => 'admin.register', 'uses' => 'AdminAuthController@getRegister']);
    Route::get('/logout', ['as' => 'admin.logout', 'uses' => 'AdminAuthController@getLogout']);

    // 动态管理
    Route::resource('/posts', 'AdminPostController');

    // 评论管理
    Route::resource('/comments', 'AdminCommentController');

    // 活动管理
    Route::resource('/events', 'AdminEventController');
    Route::get('/events/{event_id}/to_state/{to_state}', ['as' => 'admin.events.to_state', 'uses'=>'AdminEventController@getChangeEventState']);

    // 动态分类管理
    Route::resource('/categories', 'AdminCategoryController');

    // 站点导航管理
    Route::resource('/navigations', 'AdminNavigationController');

    // 站点公告管理
    Route::resource('/notices', 'AdminNoticeController');

    // 用户管理
    Route::post('/users/send_email', ['as' => 'admin.users.send_email', 'uses' => 'AdminUserController@sendEmailToUsers']);
    Route::resource('/users', 'AdminUserController');

    // 站点幻灯片管理
    Route::resource('/carousels', 'AdminCarouselController');

    // 刷新站点缓存
    Route::get('/flush',  ['as' => 'admin.flush', 'middleware' => 'admin', function (\Illuminate\Support\Facades\Cache $cache) {
        $cache::flush();
        return Redirect::route('backend::admin.index')->with('flush_message', '成功刷新站点缓存！');
    }]);
});