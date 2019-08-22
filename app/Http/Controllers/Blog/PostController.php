<?php

namespace App\Http\Controllers\Blog;

use App\Category;
use App\Post;
use App\Tag;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function showblog(Post $post)
    {
        return view('blog.show')->with('post', $post);
    }

    public function category(Category $category)
    {
        return view('blog.category')
            ->with('category', $category)
            ->with('posts', $category->posts()->searched()->simplePaginate(2))
            ->with('categories', Category::all())
            ->with('tags', Tag::all());
    }

    public function tag(Tag $tag)
    {
        return view('blog.tag')->with('tag', $tag)
            ->with('posts', $tag->posts()->searched()->simplePaginate(2))
            ->with('categories', Category::all())
            ->with('tags', Tag::all());
    }

}
