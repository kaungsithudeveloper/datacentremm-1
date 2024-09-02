<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Product;
use App\Models\Backend\Genre;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Image;

class GameController extends Controller
{
    public function Games()
    {
        $games = Product::where('type', 'game')->latest()->get();
        $activeGames = Product::where('type', 'game')->where('status', 1)->latest()->get();
        $inActiveGames = Product::where('type', 'game')->where('status', 0)->latest()->get();
        return view('backend.games.games_index',compact('games','activeGames','inActiveGames'));
    }// End Method

    public function GamesInactive($id)
    {

        Product::findOrFail($id)->update(['status' => 0]);
        $notification = array(
            'message' => 'Product Inactive',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }// End Method

    public function GamesActive($id)
    {

        Product::findOrFail($id)->update(['status' => 1]);
        $notification = array(
            'message' => 'Product Active',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }// End Method

    public function GamesCreate()
    {
        return view('backend.games.games_create');
    }// End Method

    public function GamesStore(Request $request)
    {
        //dd($request->all());
        // Validate the request
        $validatedData = $request->validate([
            'code' => 'required|string|max:255|unique:products,code',
            'title' => 'required',
            'description' => 'required',
            'short_descp' => 'required',
            'release_date' => 'required',
            'trailer' => 'required',
            'selling_price' => 'required',
            'discount_price' => 'required',
            'genre_id' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $existingProduct = Product::where('code', $validatedData['code'])->first();

        if ($existingProduct) {
            $notification = [
                'message' => 'PC-Games with the given code already exists.',
                'alert-type' => 'error',
            ];

            return redirect()->back()->withInput()->with($notification);
        }

        if ($request->file('photo')) {
            $image = $request->file('photo');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $imagePath = 'upload/product_images/' . $name_gen;
            Image::make($image)->resize(300, 450)->save(public_path($imagePath));
            $imageName = $name_gen;
        }

        $game = new Product();
        $game->title = $validatedData['title'];
        $game->code = $validatedData['code'];
        $game->slug = strtolower(str_replace(' ', '-', $request->input('title')));
        $game->description = $validatedData['description'];
        $game->short_descp = $validatedData['short_descp'];
        $game->release_date = $validatedData['release_date'];
        $game->trailer = $validatedData['trailer'];
        $game->selling_price = $validatedData['selling_price'];
        $game->discount_price = $validatedData['discount_price'];
        $game->photo = $imageName;
        $game->user_id = auth()->user()->id;
        $game->type = 'game';
        $game->status = 1;
        $game->save();

        if (!empty($validatedData['genre_id'])) {
            $genreNames = explode(',', $validatedData['genre_id']);

            foreach ($genreNames as $genreName) {
                $genreName = trim($genreName);
                $genre = Genre::firstOrCreate(['name' => $genreName]);
                $genre->slug = Str::slug($genre->name); // Generate slug for the tag name
                $genre->type = 'game';
                $genre->save();

                // Check if the tag is already attached to the blog post
                if (!$game->genres->contains($genre->id)) {
                    $game->games_genres()->attach($genre->id);
                }
            }
        }

        $notification = [
            'message' => 'Game Created Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('games')->with($notification);

    }// End Method

    public function GamesEdit($id)
    {
        $game = Product::find($id);
        $genres = $game->games_genres;

        return view('backend.games.games_edit', compact('id', 'game', 'genres'));
    }// End Method

    public function GamesUpdate(Request $request)
    {



        $id = $request->id;
        $game = Product::find($id);
        $game->title = $request->title;
        $game->code = $request->code;
        $game->slug = strtolower(str_replace(' ', '-', $request->input('title')));
        $game->description = $request->description;
        $game->short_descp = $request->short_descp;
        $game->release_date = $request->release_date;
        $game->trailer = $request->trailer;
        $game->selling_price = $request->selling_price;
        $game->discount_price = $request->discount_price;
        $game->user_id = auth()->user()->id;
        $game->type = 'game';
        $game->status = 1;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/product_images/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/product_images'),$filename);
            $game['photo'] = $filename;
        }

        $game->save();

        // Update PostTags
        $genreNames = explode(',', $request->input('genre_id'));
        $genreIds = [];
        foreach ($genreNames as $genreName) {
            $genre = Genre::firstOrCreate(['name' => trim($genreName)]);
            $genre->slug = Str::slug($genre->name);
            $genre->type = 'game';
            $genre->save();
            $genreIds[] = $genre->id;
        }
        $game->games_genres()->sync($genreIds);

        $notification = array(
            'message' => 'Game Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('games')->with($notification);
    }// End Method

    public function GamesDestroy($id)
    {
        $game = Product::findOrFail($id);
        $imagePath = public_path('upload/product_images/' . $game->photo);
        if (file_exists($imagePath) && is_file($imagePath)) {
            unlink($imagePath);
        }

        $game->delete();

        $notification = array(
            'message' => 'Game Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('games')->with($notification);
    }// End Method
}
