@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end mb-2">
        <a href="{{route('categories.create')}}" class="btn btn-success">Add Category</a>
    </div>
    <div class="card card-default">
        <div class="card-header">Categories</div>
        <div class="card-body">
           @if($categories->count()>0)
                <table class="table">
                    <thead>
                    <th>Name</th>
                    <th>Posts count</th>
                    <th></th>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>
                                {{$category->name}}
                            </td>
                            <td>{{$category->posts->count()}}</td>
                            <td>
                                <a href="{{route('categories.edit', $category->id)}}" class="btn btn-info btn-sm">Edit</a>
                                <button type="button" class="btn btn-danger btn-sm" onclick="handDelete({{$category->id}})">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <!-- Modal -->
                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form action="" method="post" id="delete">
                                @csrf
                                @method('delete')
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel">Delete</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Do you wanna delete Category?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-danger">Yes Delete</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
           @else
                <h3 class="text-center">
                    No categories yet
                </h3>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function handDelete(id){
            var del=document.getElementById('delete');
            del.action='/categories/'+id;
            $('#deleteModal').modal('show')
        }
    </script>
@endsection