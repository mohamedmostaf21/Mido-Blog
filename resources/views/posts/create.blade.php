@extends('layouts.app')
@section('title') create @endsection
@section('url') {{route('posts.index')}} @endsection
@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="POST" action="{{route('posts.store')}}">
    @csrf
    <div class="mb-3">
        <label class="form-label">Title</label>
            <input name="title" type="text" class="form-control" placeholder="title" value="{{old('title')}}"> {{-- reuired is just frontend validation can be hacked --}}
    </div>
    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="5">{{old('description')}}</textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Post Creator</label>
        <select name="post_creator" class="form-control">
            @foreach ($users as $user)
                <option value="{{$user->id}}">{{$user->name}}</option>
            @endforeach
        
        </select>
    </div>
    <button class="btn btn-success">Submit</button>
</form>

@endsection

