@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end mb-2">
        <a href="{{route('posts.create')}}" class="btn btn-success">Add Posts</a>
    </div>

    <div class="card card-default">
        <div class="card-header">Posts</div>
        <div class="card-body">
            @if($posts->count()>0)
               <table class="table">
                <thead>
                   <th>Image</th>
                   <th>Title</th>
                   <th>Category</th>
                   <th></th>
                   <th></th>
                </thead>
                <tbody>
                   @foreach($posts as $post)
                    <tr>
                        <td>
                            <img src="{{asset('storage/'.$post->image)}}"  width="120px" height="60px" alt="">
                        </td>
                        <td>{{$post->title}}</td>
                        <td>
                            <a href="{{route('categories.edit', $post->category_id)}}">
                                {{$post->category->name}}
                            </a>
                        </td>
                        <td>
                          @if(!$post->trashed())
                                <a href="{{route('posts.edit', $post->id)}}" class="btn btn-primary btn-sm">Edit</a>
                          @else
                                <form action="{{route('restore-post', $post->id)}}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success btn-sm">Restore</button>
                                </form>
                          @endif
                        </td>
                        <td>
                            <form action="{{route('posts.destroy', $post->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit">
                                    {{$post->trashed()?'Delete':'Trash'}}
                                </button>
                            </form>
                        </td>
                    </tr>
                   @endforeach
                </tbody>
            </table>
            @else
               <h3 class="text-center">No Posts yet</h3>
            @endif
        </div>
    </div>
@endsection
