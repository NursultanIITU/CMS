@extends('layouts.app')

@section('content')
    <div class="card card default">
        <div class="card-header">{{isset($post)?'Edit Post':'Create Post'}}</div>
        <div class="card-body">
            @include('partials.error')
            <form action="{{isset($post)?route('posts.update',$post->id):route('posts.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                @if(isset($post))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control" id="title" value="{{isset($post)?$post->title:''}}">
                </div>
                <div class="form-group">
                    <label for="title">Description</label>
                    <textarea name="description" id="description" cols="5" rows="5" class="form-control">{{isset($post)?$post->description:''}}</textarea>
                </div>
                <div class="form-group">
                    <label for="title">Content</label>
                    <input id="content1" type="hidden" name="content1" value="{{isset($post)?$post->content:''}}">
                    <trix-editor input="content1"></trix-editor>
                </div>

                <div class="form-group">
                    <label for="published_at">Published At</label>
                    <input type="text" name="published_at" value="{{isset($post)?$post->created_at:''}}" class="form-control" id="published_at">
                </div>

                @if(isset($post))
                    <div class="form-group">
                        <img src="{{asset('storage/'.$post->image)}}" width="100%" alt="">
                    </div>
                @endif

                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" value="{{isset($post)?$post->image:''}}" class="form-control" id="image">
                </div>

                <div class="form-group">
                    <label for="category">Category</label>
                    <select name="category" class="form-control" id="category">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}"
                                    @if(isset($post))
                                    @if($post->category_id==$category->id)
                                    selected
                                    @endif
                                    @endif
                            >{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>

                @if($tags->count()>0)
                    <div class="form-group">
                        <label for="tags">Tag</label>
                        <select name="tags[]" id="tags" class="form-control tags-selector"  multiple>
                            @foreach($tags as $tag)
                                <option value="{{$tag->id}}"
                                  @if(isset($post))
                                      @if($post->hasTag($tag->id))
                                          selected
                                      @endif
                                  @endif
                                >{{$tag->name}}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
                <div class="form-group">
                    <button class="btn btn-success" type="submit">
                        {{isset($post)?'Edit Post':'Create Post'}}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
    <script>
        flatpickr("#published_at",{
            enableTime:true
        });
        $(document).ready(function() {
            $('.tags-selector').select2();
        });
    </script>
@endsection