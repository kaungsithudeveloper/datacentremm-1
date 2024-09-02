<?php

namespace App\Http\Controllers\Backend;

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

class MovieController extends Controller
{
    public function Movies()
    {
        $movies = Product::where('type', 'movie')->latest()->get();
        $activeMovies = Product::where('type', 'movie')->where('status', 1)->latest()->get();
        $inActiveMovies = Product::where('type', 'movie')->where('status', 0)->latest()->get();
        return view('backend.movies.movies_index',compact('movies','activeMovies','inActiveMovies'));
    }// End Method

    public function MovieInactive($id)
    {

        Product::findOrFail($id)->update(['status' => 0]);
        $notification = array(
            'message' => 'Product Inactive',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }// End Method

    public function MovieActive($id)
    {

        Product::findOrFail($id)->update(['status' => 1]);
        $notification = array(
            'message' => 'Product Active',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }// End Method

    public function MoviesCreate()
    {
        return view('backend.movies.movies_create');
    }// End Method

    public function MovieStore(Request $request)
    {
        //dd($request->all());
        // Validate the request
        $validatedData = $request->validate([
            'code' => 'required',
            'title' => 'required',
            'description' => 'required',
            'short_descp' => 'required',
            'release_date' => 'required',
            'runtime' => 'required',
            'video_format' => 'required',
            'rating' => 'required',
            'trailer' => 'required',
            'selling_price' => 'required',
            'discount_price' => 'required',
            'category_id' => 'nullable|string',
            'genre_id' => 'nullable|string',
            'cast_id' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $existingProduct = Product::where('code', $validatedData['code'])->first();

        if ($existingProduct) {
            $notification = [
                'message' => 'Movies with the given code already exists.',
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

        $movie = new Product();
        $movie->code = $validatedData['code'];
        $movie->title = $validatedData['title'];
        $movie->slug = strtolower(str_replace(' ', '-', $request->input('title')));
        $movie->description = $validatedData['description'];
        $movie->short_descp = $validatedData['short_descp'];
        $movie->release_date = $validatedData['release_date'];
        $movie->runtime = $validatedData['runtime'];
        $movie->video_format = $validatedData['video_format'];
        $movie->rating = $validatedData['rating'];
        $movie->trailer = $validatedData['trailer'];
        $movie->selling_price = $validatedData['selling_price'];
        $movie->discount_price = $validatedData['discount_price'];
        $movie->photo = $imageName;
        $movie->user_id = auth()->user()->id;
        $movie->type = 'movie';
        $movie->status = 1;
        $movie->save();

        if (!empty($validatedData['category_id'])) {
            $categoryNames = explode(',', $validatedData['category_id']);
            foreach ($categoryNames as $categoryName) {
                $category = Category::firstOrCreate(['name' => trim($categoryName)]);
                $category->slug = Str::slug($category->name);
                $category->type = 'movie';
                $category->save();
                $movie->categories()->attach($category->id);
            }
        }

        if (!empty($validatedData['genre_id'])) {
            $genreNames = explode(',', $validatedData['genre_id']);

            foreach ($genreNames as $genreName) {
                $genreName = trim($genreName);
                $genre = Genre::firstOrCreate(['name' => $genreName]);
                $genre->slug = Str::slug($genre->name); // Generate slug for the tag name
                $genre->type = 'movie';
                $genre->save();

                // Check if the tag is already attached to the blog post
                if (!$movie->genres->contains($genre->id)) {
                    $movie->genres()->attach($genre->id);
                }
            }
        }

        if (!empty($validatedData['cast_id'])) {
            $castNames = explode(',', $validatedData['cast_id']);

            foreach ($castNames as $castName) {
                $castName = trim($castName);
                $cast = Cast::firstOrCreate(['name' => $castName]);
                $cast->slug = Str::slug($cast->name); // Generate slug for the tag name
                $cast->save();

                // Check if the tag is already attached to the blog post
                if (!$movie->casts->contains($cast->id)) {
                    $movie->casts()->attach($cast->id);
                }
            }
        }

        $notification = [
            'message' => 'Movie Created Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('movies')->with($notification);

    }// End Method

    public function MovieEdit($id)
    {
        $movie = Product::find($id);
        $categories = $movie->categories;
        $genres = $movie->genres;
        $casts = $movie->casts;
        return view('backend.movies.movies_edit', compact('id', 'movie', 'categories', 'genres','casts'));
    }// End Method

    public function MovieUpdate(Request $request)
    {

        //dd($request->all());

        $id = $request->id;
        $movie = Product::find($id);
        $movie->title = $request->title;
        $movie->code = $request->code;
        $movie->slug = strtolower(str_replace(' ', '-', $request->input('title')));
        $movie->description = $request->description;
        $movie->short_descp = $request->short_descp;
        $movie->release_date = $request->release_date;
        $movie->runtime = $request->runtime;
        $movie->video_format = $request->video_format;
        $movie->rating = $request->rating;
        $movie->trailer = $request->trailer;
        $movie->selling_price = $request->selling_price;
        $movie->discount_price = $request->discount_price;
        $movie->user_id = auth()->user()->id;
        $movie->type = 'movie';
        $movie->status = 1;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/product_images/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/product_images'),$filename);
            $movie['photo'] = $filename;
        }

        $movie->save();

        // Update PostCategories
        $categoryNames = explode(',', $request->input('category_id'));
        $categoryIds = [];
        foreach ($categoryNames as $categoryName) {
            $category = Category::firstOrCreate(['name' => trim($categoryName)]);
            $category->slug = Str::slug($category->name);
            $category->type = 'movie';
            $category->save();
            $categoryIds[] = $category->id;
        }
        $movie->categories()->sync($categoryIds);

        // Update PostTags
        $genreNames = explode(',', $request->input('genre_id'));
        $genreIds = [];
        foreach ($genreNames as $genreName) {
            $genre = Genre::firstOrCreate(['name' => trim($genreName)]);
            $genre->slug = Str::slug($genre->name);
            $genre->type = 'movie';
            $genre->save();
            $genreIds[] = $genre->id;
        }
        $movie->genres()->sync($genreIds);

        // Update PostTags
        $castNames = explode(',', $request->input('cast_id'));
        $castIds = [];
        foreach ($castNames as $castName) {
            $cast = Cast::firstOrCreate(['name' => trim($castName)]);
            $cast->slug = Str::slug($cast->name);
            $cast->save();
            $castIds[] = $cast->id;
        }
        $movie->casts()->sync($castIds);

        $notification = array(
            'message' => 'Movie Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('movies')->with($notification);
    }// End Method

    public function MovieDestroy($id)
    {
        $movie = Product::findOrFail($id);
        $imagePath = public_path('upload/product_images/' . $movie->photo);
        if (file_exists($imagePath) && is_file($imagePath)) {
            unlink($imagePath);
        }

        $movie->delete();

        $notification = array(
            'message' => 'Movie Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('movies')->with($notification);
    }// End Method

}
