<?php
use App\Post;
use App\User;
use App\Country;
use App\Photo;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});

Route::get('walk/{name?}', function ($name = 'Allen Walker') {
    return $name;
});

Route::get('/post/{id}', 'PostController@index')->where('id', '[0-9]+');

Route::get('/insert',function (){
    DB::insert('insert into posts(title, body) values(?, ?)', ['PHP with Laravel','Learning Laravel is the best thing that has happened to me']);
});

//Route::get('/read', function(){
//
//    $results = DB::select('select * from posts where id=?', [1]);
////    dd($results);
//    foreach ( $results as $post){
//       return $post->title.' '.$post->body;
//    }
//
//});

//Route::get('/delete', function(){
//
//    $results = DB::delete('delete from posts where=?', [1]);
//
//    return $results;
//});

Route::get('/read', function(){
    $posts = Post::all();
    foreach ($posts as $post){
        return $post->title;
    }
});

Route::get('/find', function(){
    $post=Post::find(1);
    return $post->body;
});

Route::get('/findwhere', function (){

    $post=Post::all()->where('id',1);
    return $post;
});

Route::get('/basicinsert', function (){

    $post = new Post;
    $post->title= "Don't give up";
    $post->body='I will make it to the very end';
    $post->save();
});

Route::get('/erase', function(){
    $post = Post::destroy('id', 2);
});

Route::get('/basicinsert2', function (){
    $post=Post::find(3);
    $post->title = "Don't give up now";
    $post->save();
});

Route::get('/update1', function (){
    $post=Post::find(3);
    $post->title="Trae tha truth";
    $post->update();
});

Route::get('/create2', function (){
    Post::create(['title'=>'NEFFLEX', 'body'=>'Never back down']);
});

Route::get('/softdelete', function (){
    Post::find(1)->delete();
});

Route::get('/readsoftdelete', function (){
    $posts = Post::withTrashed()->get();
    return $posts;
});

Route::get('/user/{id}/post', function ($id){

    return User::find($id)->post;

});

Route::get('/post/{id}/user', function ($id){
    return Post::find($id)->user->name;
});

Route::get('user/{id}/posts', function($id){

    $user = User::find($id);
    foreach ($user->posts as $post){
        echo $post->title . "</br>";
    }
});

Route::get('user/{id}/role', function($id){

    $user = User::find($id);
    foreach ($user->roles as $role){
        echo $role->name . "</br>";
    }
});

Route::get('user/{id}/pivot', function($id){

    $user = User::find($id);

    foreach ($user->roles as $role){

        echo $role->pivot . "</br>";

    }
});

Route::get('/user/country/{id}', function($id){

    $country = Country::find($id);

    foreach ($country->posts as $post){

        return $post->title;

    }

});



Route::get('post/{id}/photo', function($id){

    $post = Post::find($id);

    foreach ($post->photos as $photo){

        return $photo;
    }

});

Route::get('user/{id}/photo', function($id){

    $user = User::find($id);

    foreach ($user->photos as $photo){

        return $photo->path;
    }

});