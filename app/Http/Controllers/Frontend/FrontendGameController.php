<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

class FrontendGameController extends Controller
{
    public function GameIndex()
    {
        $games = Product::where('type', 'game')->where('status', 1)->latest()->paginate(18);
        $genres = Genre::all();
        $posts = Blog::where('status', 1)->latest()->take(6)->get();
        return view('frontend.games.game_index',compact('games','genres','posts'));
    }// End Method

    public function GameDetail($id)
    {
        $serie = Product::find($id);
        $genres = Genre::all();
        $casts = Cast::with('movies')->get();
        $posts = Blog::where('status', 1)->latest()->take(6)->get();
        $comments = $serie->comments()->latest()->get();
        $youtubeLink = null;

        if ($serie->trailer !== null) {
            parse_str(parse_url($serie->trailer, PHP_URL_QUERY), $my_array_of_vars);
            $youtubeLink = $my_array_of_vars['v'];
        }
        return view('frontend.games.game_detail',compact('serie','genres','posts','casts','comments','youtubeLink'));
    }

    public function GameDetailCommentStore(Request $request)
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

    public function GameYear($release_date)
    {
        $games = Product::where('release_date', $release_date)->where('type', 'game')->where('status', 1)->latest()->paginate(18);

        $genres = Genre::all();
        $posts = Blog::where('status', 1)->latest()->take(6)->get();
        return view('frontend.games.game_year', compact('games', 'genres', 'posts','release_date'));
    }

    public function GameGenre($id)
    {
        $genre = Genre::find($id);
        $games = $genre->games()->where('type', 'game')->where('status', 1)->latest()->paginate(18);
        $genres = Genre::all();
        $posts = Blog::where('status', 1)->latest()->take(6)->get();
        return view('frontend.games.game_genres', compact('games', 'genres', 'posts','genre'));
    }
}
