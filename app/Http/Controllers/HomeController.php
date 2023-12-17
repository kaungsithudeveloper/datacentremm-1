<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Backend\Movie;
use App\Models\Backend\Product;
use App\Models\Backend\Category;
use App\Models\Backend\Genre;
use App\Models\Backend\Blog;
use App\Models\User;

class HomeController extends Controller
{
    public function dashboard()
    {
        $allitem = Product::whereIn('type', ['movie', 'serie', 'game'])->where('status', 1)->latest()->get();
        $movies = Product::where('type', 'movie')->where('status', 1)->latest()->get();
        $series = Product::where('type', 'serie')->where('status', 1)->latest()->get();
        $games = Product::where('type', 'game')->where('status', 1)->latest()->get();

        $genres = Genre::all();
        $posts = Blog::where('status', 1)->latest()->take(6)->get();
        return view('dashboard',compact('allitem', 'movies','series','games','genres','posts'));
    }// End Method

    public function Detail($id)
    {
        $detail = Product::find($id);
        $genres = Genre::all();
        $casts = $detail->casts;
        $posts = Blog::where('status', 1)->latest()->take(6)->get();
        $comments = $detail->comments()->latest()->get();
        $youtubeLink = null;

        if ($detail->trailer !== null) {
            parse_str(parse_url($detail->trailer, PHP_URL_QUERY), $my_array_of_vars);
            $youtubeLink = $my_array_of_vars['v'];
        }

        return view('detail', compact('detail', 'genres', 'posts', 'casts', 'comments', 'youtubeLink'));
    }

    public function ProductSearch(Request $request)
    {

        $request->validate(['search' => "required"]);

        $item = $request->search;
        $data = Product::where('title','LIKE',"%$item%")->latest()->paginate(18);
        $genres = Genre::all();
        $posts = Blog::where('status', 1)->latest()->take(6)->get();
        return view('search',compact('data','item','genres','posts'));

    }// End Method

    public function SearchProduct(Request $request){

        $request->validate(['search' => "required"]);

         $item = $request->search;
         $products = Product::where('title','LIKE',"%$item%")->select('title','slug','photo','selling_price','id')->limit(6)->get();

         return view('search_data',compact('products'));

      }// End Method

      public function ContactUs()
    {

        $genres = Genre::all();
        $posts = Blog::where('status', 1)->latest()->take(6)->get();
        return view('contact_us',compact('genres','posts'));
    }

}
