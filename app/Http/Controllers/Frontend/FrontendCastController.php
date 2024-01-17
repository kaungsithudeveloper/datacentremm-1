<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Cast;
use App\Models\Backend\Blog;
use App\Models\Backend\PostCategorie;
use App\Models\Backend\PostTags;
use App\Models\Backend\Movie;
use App\Models\Backend\Genre;
use App\Models\Backend\Product;

class FrontendCastController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movies = Product::where('type', 'movie')->where('status', 1)->latest()->paginate(18);
        $casts = Cast::latest()->paginate(30);
        $genres = Genre::all();
        $posts = Blog::where('status', 1)->latest()->take(6)->get();
        return view('frontend.casts.cast_index',compact('movies', 'casts','genres','posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function CastDetail($id)
    {
        $casts = Cast::find($id);
        $movies = $casts->movies;
        $series = $casts->series;
        $genres = Genre::all();
        $posts = Blog::where('status', 1)->latest()->take(6)->get();
        return view('frontend.casts.cast_detail',compact('casts','movies','series', 'genres','posts'));
    }


}
