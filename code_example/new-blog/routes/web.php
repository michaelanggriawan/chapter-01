<?php

use Illuminate\Support\Facades\Route;
use App\Post;

/*
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/softDeletes', function() {
    Post::find(3)->delete();
});

Route::get('/delete', function() {
    $post = Post::find(1);

    // Post::destroy([4,5]);
    // Post::where('id', 2)->delete();    

    $post->delete();
});

Route::get('/update', function() {

    Post::where('id', 2)->update(['title' => 'NEW PHP TITLE', 'content' => 'I love my instructor online']);

});

Route::get('/create', function() {
    Post::create(['title' => 'This is a new title', 'content' => 'This is a new content']);
});

Route::get('/basicinsert', function() {
    $post = new Post;
    $post->title = 'new Eloquent title';
    $post->content = 'Wow eloquent is really cool, look at this content';

    $post->save();

});

Route::get('/basicupdate', function() {
    $post = Post::find(1);
    $post->title = 'Updated new Eloquent title';
    $post->content = 'Wow eloquent is really cool, look at this content updated';

    $post->save();
});

Route::get('/find', function () {
    $posts = Post::all();

    // return $posts;
    foreach($posts as $post) {
        echo '<br>'. $post->title .'</br>';
    }

    return;
});

Route::get('/findOne', function () {
    $post = Post::find(3);       

    return $post->title;

});

Route::get('/findwhere', function () {
    $posts = Post::where('id', 2)->orderBy('id', 'desc')->take(1)->get();

    return $posts;
});

Route::get('/findmore', function() {
    // $posts = Post::findOrFail(2);

    // return $posts;

    $posts = Post::where('users_count', '<', 50)->firstOrFail();

});

// ================Raw-Sql================

Route::get('/insert', function() {
    DB::insert('insert into posts (title, content) values (?, ?)', ['PHP With Laravel', 'Laravel is the best thing that has happened to php']);
});

Route::get('/read', function() {
    $results = DB::select('select * from posts where id = ?', [1]);
    foreach($results as $post) {
        return $post->content;
    }
    // return $results;
});

// Route::get('/update', function() {
//     $updated = DB::update('update posts set content = "Update title in the laravel framework" where id = ?', [1]);

//     return $updated;
// });

// Route::get('/delete', function() {
//     $deleted = DB::delete('delete from posts where id = ?', [1]);

//     return $deleted;
// });

// ================Raw-Sql================

// Route::resource('posts', 'PostsController');

// Route::get('/contact', 'PostsController@contact');

// Route::get('/post/{id}/{name}/{password}', 'PostsController@show_post');

// Route::get('/post/{id}', 'PostsController@index');

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/contact', function () {
//     return "This is contact page";
// });

// Route::get('/about', function () {
//     return "This is about page";
// });

// Route::get('/post/{id}/{name}', function($id, $name) {
//     return "This post number " .$id. " " .$name;
// });

// Route::get('/admin/posts/example', array('as' => 'admin.home', function() {
//     $url = route('admin.home');

//     return "this url is". $url;
// }));

