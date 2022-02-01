@extends('layouts.app')

@section('title') Create @endsection

@section('content')
        
        <form method="POST" enctype="multipart/form-data" action="{{ route('posts.store') }}">
            @csrf
            @if(isset($post))
                <input type="hidden" name="id" value="{{$post->id}}">
                <input type="hidden" name="old_title" value="{{$post->title}}">
            @endif
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                
                <input type="text" class="form-control" name="title" id="title" value="{{ isset($post) ? $post['title'] : '' }}">
            </div>
            
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="description" rows="3" >{{ isset($post) ? $post['description'] : '' }}</textarea>  
            </div>
            @if(isset($post))
            <div class="mb-3">
                <label for="description" class="form-label">Post Image</label>
                <input class="form-control" type="file" name="image" id="image" value="{{ isset($post) && isset($post->image) ? $post->image->title : '' }}">
            </div>
            @endif
            
            <div class="mb-3">
                <label for="post_creator" class="form-label">Post Creator</label>
                <select name="post_creator" class="form-control" id="post_creator" >
                    @foreach($users as $user)
                    <option value="{{$user->id}}"  
                    @if (isset($post) && $post->user->id == $user->id)
                        selected="selected"
                    @endif
                    >{{$user->name}}</option>
                    @endforeach
                </select>
            </div>
            
            <button class="btn {{ isset($post) ? 'btn-primary' : 'btn-success' }}">{{ isset($post) ? 'Update' : 'Create Post' }}</button>
        </form>
@endsection