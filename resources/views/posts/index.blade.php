@extends('layouts.app')

@section('title')Index @endsection

@section('content')
<div class="text-center mb-5">
    <a href="{{ route('posts.create') }}" class="btn btn-success">Create Post</a>
</div>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Posted By</th>
            <th scope="col">Created At</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($posts as $post)
        <tr>
            <th scope="row">{{ $post->id }}</th>
            <td>{{ $post->title }}</td>
            <td>{{ $post->user->name }}</td>
            <td>{{ $post->created_at }}</td>
            <td>
                <a href="{{ route('posts.show', ['post' => $post['id']]) }}" class="btn btn-info">View</a>
                <a href="{{ route('posts.edit', ['post' => $post['id']]) }}" class="btn btn-primary">Edit</a>
                <a href="{{ route('posts.destroy', ['post'=>$post['id']]) }}" class="btn btn-danger">Delete</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<nav aria-label="Page navigation example">
    <ul class="pagination">
        <li class="page-item"><a class="page-link" href="{{ route('posts.paginate', ['page'=>1]) }}">Previous</a></li>
        <li class="page-item"><a class="page-link" href="{{ route('posts.paginate', ['page'=>2]) }}">1</a></li>
        <li class="page-item"><a class="page-link" href="{{ route('posts.paginate', ['page'=>3]) }}">2</a></li>
        <li class="page-item"><a class="page-link" href="{{ route('posts.paginate', ['page'=>4]) }}">3</a></li>
        <li class="page-item"><a class="page-link" href="{{ route('posts.paginate', ['page'=>5]) }}">Next</a></li>
    </ul>
</nav>
<div class="container">

    <!-- Trigger the modal with a button -->
    <button type="button" class="btn btn-info btn-lg" id="alertbox">Click here</button>

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modal Header</h4>
                </div>
                <div class="modal-body">
                    <p id="error"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection

@section('script')
<script src="{{ URL::asset('js/index.js') }}" type="text/javascript"></script> -->
@endsection
