<?php

namespace App\Http\Controllers;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\CreateTagRequest;
use App\Http\Requests\UpdateTagRequest;

class TagController extends Controller
{
    public function index()
    {
        return view('tags.index')->with('tags',Tag::all());
    }

    public function create()
    {
        return view('tags.create');
    }

    public function store(CreateTagRequest $request)
    {
        Tag::create([
            'name' =>$request->name
        ]);

        session()->flash('success', 'Tag created successfully');

        return redirect()->route('tags.index');
    }

    public function show($id)
    {
        //
    }

    public function edit(Tag $tag)
    {
        return view('tags.create')->with('tag',$tag);
    }

    public function update(UpdateTagRequest $request, Tag $tag)
    {
        $tag->update([
            'name' =>$request->name
        ]);
        session()->flash('success', 'Tag successfully updated');
        return redirect()->route('tags.index');
    }

    public function destroy(Tag $tag)
    {
        if ($tag->posts->count()>0)
        {
            session()->flash('error', 'Tag cannot be deleted. Because it has posts.');
            return redirect()->back();
        }
        $tag->delete();
        session()->flash('success', 'Tag Deleted Successfully');
        return redirect()->route('tags.index');
    }
}
