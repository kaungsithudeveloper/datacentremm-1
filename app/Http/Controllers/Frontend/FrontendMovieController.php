<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Movie;
use App\Models\Backend\Product;
use App\Models\Backend\Category;
use App\Models\Backend\Genre;
use App\Models\Backend\Cast;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Image;
use App\Models\Backend\Blog;
use App\Models\Frontend\ProductComment;

class FrontendMovieController extends Controller
{
    public function index()
    {
        $movies = Product::where('type', 'movie')->where('status', 1)->latest()->paginate(18);
        $genres = Genre::all();
        $posts = Blog::where('status', 1)->latest()->take(6)->get();
        return view('frontend.movies.movie_index',compact('movies','genres','posts'));
    }// End Method

    public function MovieDetail($id)
    {
        $movie = Product::find($id);
        $genres = Genre::all();
        $casts = Cast::with('movies')->get();
        $posts = Blog::where('status', 1)->latest()->take(6)->get();
        $comments = $movie->comments()->latest()->get();
        $youtubeLink = null;

        if ($movie->trailer !== null) {
            parse_str(parse_url($movie->trailer, PHP_URL_QUERY), $my_array_of_vars);
            $youtubeLink = $my_array_of_vars['v'];
        }
        return view('frontend.movies.movie_detail',compact('movie','genres','posts','casts','comments','youtubeLink'));
    }

    public function MovieDetailCommentStore(Request $request)
    {
        $data = $request->validate([
            'content' => 'required',
            'product_id' => 'required|exists:products,id',
        ]);

        $data['user_id'] = Auth::user()->id;
        ProductComment::create($data);

        $notification = array(
            'message' => 'Post Updated Successfully',
            'alert-type' => 'success'
        );

        return back()->with($notification);
    }// End Method


    public function MovieYear($release_date)
    {
        $movies = Product::where('release_date', $release_date)->where('type', 'movie')->where('status', 1)->latest()->paginate(18);

        $genres = Genre::all();
        $posts = Blog::where('status', 1)->latest()->take(6)->get();
        return view('frontend.movies.movie_year', compact('movies', 'genres', 'posts','release_date'));
    }

    public function MovieCategory($id)
    {
        $category = Category::find($id);
        $movies = $category->movies()->where('type', 'movie')->where('status', 1)->latest()->paginate(18);
        $genres = Genre::all();
        $posts = Blog::where('status', 1)->latest()->take(6)->get();
        return view('frontend.movies.movie_categories', compact('movies', 'genres','posts','category'));
    }

    public function MovieGenre($id)
    {
        $genre = Genre::find($id);
        $movies = $genre->movies()->where('type', 'movie')->where('status', 1)->latest()->paginate(18);
        $genres = Genre::all();
        $posts = Blog::where('status', 1)->latest()->take(6)->get();
        return view('frontend.movies.movie_genres', compact('movies', 'genres', 'posts','genre'));
    }


}
