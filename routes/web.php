<?php
Route::get('try',function(){
	return App\post::with('user','likes','comments')->get();
});
Route::get('newMessage','ProfileController@newMessage');
Route::post('sendNewMessage', 'ProfileController@sendNewMessage');
Route::post('/sendMessage', 'ProfileController@sendMessage');

Route::get('/', function () {
  //$posts = App\post::with('user','likes','comments')->orderBy('created_at','DESC')->get();
  return view('auth/login');
  });

Route::get('/posts', function () {
      return App\post::with('user','likes','comments')->orderBy('created_at','DESC')->get();
});

Route::post('addPost', 'PostsController@addPost');
Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'ProfileController@friends');
    Route::get('/profile', 'HomeController@index');
    Route::get('/profile/{slug}', 'ProfileController@index');
    Route::get('/changePhoto', function() {
        return view('profile.pic');
    });
    Route::post('/uploadPhoto', 'ProfileController@uploadPhoto');
    Route::get('editProfile', 'ProfileController@editProfileForm');
    Route::post('/updateProfile', 'ProfileController@updateProfile');
    Route::get('/findFriends', 'ProfileController@findFriends');
    Route::get('/addFriend/{id}', 'ProfileController@sendRequest');
    Route::get('/requests', 'ProfileController@requests');
    Route::get('/accept/{name}/{id}', 'ProfileController@accept');
    Route::get('friends', 'ProfileController@friends');
    Route::get('requestRemove/{id}', 'ProfileController@requestRemove');

    Route::get('/unfriend/{id}', function($id){
             $loggedUser = Auth::user()->id;
              DB::table('friendships')
              ->where('requester', $loggedUser)
              ->where('user_requested', $id)
              ->delete();
              DB::table('friendships')
              ->where('user_requested', $loggedUser)
              ->where('requester', $id)
              ->delete();
               return back()->with('msg', 'You are not friend with this person');
        });

        //forgot password
        Route::get('forgotPassword',function(){
          return view('profile.forgotPassword');
        });

        Route::post('setToken','ProfileController@setToken');
        //get random token by email
        Route::get('/getToken/{token}',function($token){
        // token is right or wrong
        if(isset($token) && $token!=""){
         $getData = DB::table('password_resets')->where('token',$token)->get();
         if(count($getData)!=0){
           return view('profile.setPassword')->with('data',$getData);
         }else{echo "token is wrong";}
        }else{echo "token not found";}
        });


        //set/update new password
        Route::get('setPass','ProfileController@setPass');
        //messenger start
        Route::get('/messages', function(){
          return view('messages');
        });

    //save image
    Route::post('saveImg', 'PostsController@saveImg');

});
Route::get('/logout', 'Auth\LoginController@logout');
