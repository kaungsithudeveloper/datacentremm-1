<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Genre;
use Illuminate\Support\Facades\Validator;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function GenreIndex()
    {
        $genres = Genre::get();
        return view('backend.genres.genres_index',compact('genres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function GenreStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:genres,name,NULL,id,type,'.$request->type,
            'slug' => 'nullable|string|max:255|unique:genres,slug,NULL,id,type,'.$request->type,
            'type' => 'required|in:movie,serie,game',
        ], [
            'name.unique' => 'The name has already been taken for this type.',
            'slug.unique' => 'The slug has already been taken for this type.',
            'type.in' => 'The type must be one of the following values: movie, serie, game.',
        ]);

        $genre = new Genre();
        $genre->name = $request->name;
        $genre->slug = strtolower(str_replace(' ', '-', $request->name));
        $genre->type = $request->type;
        $genre->save();

        $notification = [
            'message' => 'Genre Created Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('genres')->with($notification);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function GenreEdit($id)
    {
        $genre = Genre::find($id);
        $genres = Genre::get();
        return view('backend.genres.genres_edit', compact('genre','genres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function GenreUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:genres,name,NULL,id,type,'.$request->type,
            'slug' => 'nullable|string|max:255|unique:genres,slug,NULL,id,type,'.$request->type,
            'type' => 'required|in:movie,serie,game',
        ], [
            'name.unique' => 'The name has already been taken for this type.',
            'slug.unique' => 'The slug has already been taken for this type.',
            'type.in' => 'The type must be one of the following values: movie, serie, game.',
        ]);


        $id = $request->id;
        $genre = Genre::find($id);
        $genre->name = $request->name;
        $genre->slug = strtolower(str_replace(' ', '-', $request->name));
        $genre->type = $request->type;
        $genre->save();

        $notification = [
            'message' => 'Genre Update Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('genres')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function GenreDestroy($id)
    {
        $genre = Genre::findOrFail($id);
        if (!is_null($genre)) {
            $genre->delete();
        }

         $notification = array(
            'message' => 'Genre Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
