@extends('layouts.app')

@section('title') Create @endsection

@section('content')
        <form method="POST" action="{{ route('posts.store') }}">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                
                <input type="text" class="form-control" name="title" id="title" value="{{ isset($post) ? $post['title'] : '' }}">
            </div>
            
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="description" rows="3" >{{ isset($post) ? $post['description'] : '' }}</textarea>  
            </div>

            <div class="mb-3">
                <label for="post_creator" class="form-label">Post Creator</label>
                <select name="post_creator" class="form-control" id="post_creator" value="{{ isset($post) ? $post['posted_by'] : '' }}">
                    @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
            </div>
            
            <button class="btn btn-success">Create Post</button>
        </form>
@endsection