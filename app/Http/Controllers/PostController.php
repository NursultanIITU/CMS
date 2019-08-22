<?php

namespace App\Http\Controllers;
use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\CreatePostsRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('verifyCategoriesCount')->only(['create','store']);
    }

    public function index()
    {
        return view('posts.index')->with('posts', Post::all());
    }

    public function create()
    {
        return view('posts.create')->with('categories', Category::all())->with('tags',Tag::all());
    }

    public function store(CreatePostsRequest $request)
    {
       $image=$request->file('image')->store('posts');
       //dd($request->all());

       $post=Post::create([
           'title'  => $request->title,
           'content' => $request->content1,
           'description' =>$request->description,
           'image'  => $image,
           'published_at' => $request->published_at,
           'category_id'  => $request->category,
           'user_id' =>auth()->user()->id
       ]);

       if($request->tags)
       {
           $post->tags()->attach($request->tags);
       }

       session()->flash('success', 'Post created successfully');

       return redirect()->route('posts.index');
    }

    public function show($id)
    {
        //
    }

    public function edit(Post $post)
    {
        return view('posts.create')->with('post', $post)->with('categories', Category::all())->with('tags', Tag::all());
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        // dd($request->all());
        $data=$request->only(['title','content1', 'description','published_at']);
        $data2=[
            'title' => 'title',
            'content1' =>'content',
            'description' => 'description',
            'published_at' => 'published_at'
        ];
        $data = array_combine(array_map(function($el) use ($data2) {
            return $data2[$el];
        }, array_keys($data)), array_values($data));

        if($request->hasFile('image'))
        {
            $image=$request->file('image')->store('posts');
            $post->deleteImage();
            $data['image']=$image;
        }

        if($request->tags)
        {
            $post->tags()->sync($request->tags);
        }

        $post->update($data);
        session()->flash('success','Post Updated Successfully');

        return redirect()->route('posts.index');
    }

    public function destroy($id)
    {
        $post=Post::withTrashed()->where('id', $id)->firstOrFail();
        if ($post->trashed())
        {
            $post->deleteImage();

            $post->forceDelete();
        }else{
            $post->delete();
        }

        session()->flash('success', 'Post deleted successfully');

        return redirect()->route('posts.index');
    }

    public function trashed(){
        $trashedPosts=Post::onlyTrashed()->get();

        return view('posts.index')->withPosts($trashedPosts);
    }
    public function restore($id)
    {
        $post=Post::withTrashed()->where('id', $id)->firstOrFail();
        $post->restore();
        session()->flash('success', 'Post restored successfully');
        return redirect()->back();
    }
}
