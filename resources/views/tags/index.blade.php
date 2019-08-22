@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end mb-2">
        <a href="{{route('tags.create')}}" class="btn btn-success">Add Tag</a>
    </div>
    <div class="card card-default">
        <div class="card-header">Tags</div>
        <div class="card-body">
           @if($tags->count()>0)
                <table class="table">
                    <thead>
                    <th>Name</th>
                    <th>Posts count</th>
                    <th></th>
                    </thead>
                    <tbody>
                    @foreach($tags as $tags)
                        <tr>
                            <td>
                                {{$tags->name}}
                            </td>
                            <td>
                                {{$tags->posts->count()}}
                            </td>
                            <td>
                                <a href="{{route('tags.edit', $tags->id)}}" class="btn btn-info btn-sm">Edit</a>
                                <button type="button" class="btn btn-danger btn-sm" onclick="handDelete({{$tags->id}})">
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
                                    Do you wanna delete Tag?
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
                    No tags yet
                </h3>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function handDelete(id){
            var del=document.getElementById('delete');
            del.action='/tags/'+id;
            $('#deleteModal').modal('show')
        }
    </script>
@endsection