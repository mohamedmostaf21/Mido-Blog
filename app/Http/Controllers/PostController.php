<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

//convention over configuration
class PostController extends Controller
{
    public function index(){
        $postsFromDb = Post::all(); //collection object
      //  dd($postsFromDb); // for testing purposes, remove it in production code.
        return view('posts.index',['posts' => $postsFromDb]);
    }


    public function show(Post $post){ //type hinting for route model binding so we don't have to write sql queries or any code
      //  $singlePostInfo = Post::findOrFail($postId); //model object
        //$singlePostInfo = Post::where('id', $postId); //elquonte builder
        //$singlePostInfo = Post::where('id', $postId)->first(); //single model object
        //$singlePostInfo = Post::where('id', $postId)->get(); //collection object with one item


        //if id is not found
        //first solution
        // if(is_null($singlePostInfo)){
        //     return to_route('posts.index');
        // }
        //second solution using Post::findOrfail();
        return view ('posts.show', ['post' => $post]);
    }

    public function create(){
        $users = User::all();
        return view('posts.create', ['users' => $users]);
    }

    public function store(){
        $data = request()->all();

        //code to vaildate the data

        request()->validate([
            'title'=> ['required', 'min:3'],
            'description'=> ['required', 'min:5'],
            'post_creator' => ['required', 'exists:users,id'],
        ]);
        
        $title = request()->title;
        $description = request()->description;
        $post_creator = request()->post_creator;
        //store the submmited post into the database
        // $post = new Post;
 
        // $post->title = $title;
        // $post->description = $description;
        // $post->save(); //insert the post into posts
        // dd($data);

        //second method protection from mass assignment
        $post = Post::create([
            'title' => $title,
            'description' => $description,
            'user_id' => $post_creator
        ]);

        //redirect to the index page after creating a new post
        return to_route('posts.index');
    }
    public function edit(Post $post) { //type hinting for route model binding so we don't have to write sql queries or any code
        $users = User::all();
        return view('posts.edit', ['users'=> $users, 'post' => $post]);
    }

    public function update($postId){
        //get the user data
        
        $title = request()->title;
        $description = request()->description;
        $post_creator = request()->post_creator;

        //find the post and update the data
        $singlePostFromDB = Post::find($postId);
        //update the post
        $singlePostFromDB->update([
            'title' => $title,
            'description' => $description,
            'user_id' => $post_creator
        ]);
        
        return to_route('posts.show', $postId);
    }

    public function destroy($postId){

        $post = Post::find($postId);

        $post->delete();
        //second method
       // Post::where('id',$postId )->delete();
        return to_route('posts.index');
    }
}
