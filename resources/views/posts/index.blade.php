@extends('layouts.app')
@section('title') index @endsection
@section('content')
  <div class="container   text-center mt-4">
    <a href="{{route('posts.create')}}">
      <button  type="button" class="btn btn-success">Create Post</button>
    </a>
  </div>

  <table class="table mt-4">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">Posted by</th>
        <th scope="col">Created at</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
    <!-- we cannot to loop on model object but php makes a magic method here to loop on all posts-->
    <!-- Loop through posts and display them in the table -->
    @foreach ($posts as $post)
        <tr>
            <th scope="row">{{$post->id}}</th>
            <td>{{$post->title}}</td>
            <td>{{$post->user ? $post->user->name : 'not found'}}</td>
            <td>{{$post->created_at}}</td>
            <td>
                <a href="{{route('posts.show', $post->id)}}" class="btn btn-info">View</a>
                <a href="{{route('posts.edit', $post->id)}}" class="btn btn-primary">Edit</a>
                <form style="display:inline;" method="POST" action="{{route('posts.destroy', $post->id)}}">
                  @csrf
                  @method('DELETE')
                  <button onclick="confirmDelete()" type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
  </table>
  <script>
    function confirmDelete(){
      return confirm('Are you sure you want to delete this post?');
    }
  </script>
@endsection
  
    
