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


class SerieController extends Controller
{
    public function Series()
    {
        $series = Product::where('type', 'serie')->latest()->get();
        $activeSeries = Product::where('type', 'serie')->where('status', 1)->latest()->get();
        $inActiveSeries = Product::where('type', 'serie')->where('status', 0)->latest()->get();
        return view('backend.series.series_index',compact('series','activeSeries','inActiveSeries'));
    }// End Method

    public function SerieInactive($id)
    {

        Product::findOrFail($id)->update(['status' => 0]);
        $notification = array(
            'message' => 'Product Inactive',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }// End Method

    public function SerieActive($id)
    {

        Product::findOrFail($id)->update(['status' => 1]);
        $notification = array(
            'message' => 'Product Active',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }// End Method

    public function SeriesCreate()
    {
        return view('backend.series.series_create');
    }// End Method

    public function SeriesStore(Request $request)
    {
        //dd($request->all());
        // Validate the request
        $validatedData = $request->validate([
            'code' => 'required',
            'title' => 'required',
            'description' => 'required',
            'short_descp' => 'required',
            'release_date' => 'required',
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
                'message' => 'Series with the given code already exists.',
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

        $serie = new Product();
        $serie->title = $validatedData['title'];
        $serie->code = $validatedData['code'];
        $serie->slug = strtolower(str_replace(' ', '-', $request->input('title')));
        $serie->description = $validatedData['description'];
        $serie->short_descp = $validatedData['short_descp'];
        $serie->release_date = $validatedData['release_date'];
        $serie->video_format = $validatedData['video_format'];
        $serie->runtime = $request->runtime;
        $serie->rating = $validatedData['rating'];
        $serie->trailer = $validatedData['trailer'];
        $serie->selling_price = $validatedData['selling_price'];
        $serie->discount_price = $validatedData['discount_price'];
        $serie->photo = $imageName;
        $serie->user_id = auth()->user()->id;
        $serie->type = 'serie';
        $serie->status = 1;
        $serie->save();

        if (!empty($validatedData['category_id'])) {
            $categoryNames = explode(',', $validatedData['category_id']);
            foreach ($categoryNames as $categoryName) {
                $category = Category::firstOrCreate(['name' => trim($categoryName)]);
                $category->slug = Str::slug($category->name);
                $category->type = 'serie';
                $category->save();
                $serie->series_categories()->attach($category->id);
            }
        }

        if (!empty($validatedData['genre_id'])) {
            $genreNames = explode(',', $validatedData['genre_id']);

            foreach ($genreNames as $genreName) {
                $genreName = trim($genreName);
                $genre = Genre::firstOrCreate(['name' => $genreName]);
                $genre->slug = Str::slug($genre->name); // Generate slug for the tag name
                $genre->type = 'serie';
                $genre->save();

                // Check if the tag is already attached to the blog post
                if (!$serie->genres->contains($genre->id)) {
                    $serie->series_genres()->attach($genre->id);
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
                if (!$serie->casts->contains($cast->id)) {
                    $serie->casts()->attach($cast->id);
                }
            }
        }

        $notification = [
            'message' => 'Serie Created Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('series')->with($notification);

    }// End Method

    public function SerieEdit($id)
    {
        $serie = Product::find($id);
        $categories = $serie->series_categories;
        $genres = $serie->series_genres;
        $casts = $serie->series_casts;
        return view('backend.series.series_edit', compact('id', 'serie', 'categories', 'genres','casts'));
    }// End Method

    public function SerieUpdate(Request $request)
    {
        $id = $request->id;
        $serie = Product::find($id);
        $serie->title = $request->title;
        $serie->code = $request->code;
        $serie->slug = strtolower(str_replace(' ', '-', $request->input('title')));
        $serie->description = $request->description;
        $serie->short_descp = $request->short_descp;
        $serie->release_date = $request->release_date;
        $serie->runtime = $request->runtime;
        $serie->video_format = $request->video_format;
        $serie->rating = $request->rating;
        $serie->trailer = $request->trailer;
        $serie->selling_price = $request->selling_price;
        $serie->discount_price = $request->discount_price;
        $serie->user_id = auth()->user()->id;
        $serie->type = 'serie';
        $serie->status = 1;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/product_images/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/product_images'),$filename);
            $serie['photo'] = $filename;
        }

        $serie->save();

        // Update PostCategories
        $categoryNames = explode(',', $request->input('category_id'));
        $categoryIds = [];
        foreach ($categoryNames as $categoryName) {
            $category = Category::firstOrCreate(['name' => trim($categoryName)]);
            $category->slug = Str::slug($category->name);
            $category->type = 'serie';
            $category->save();
            $categoryIds[] = $category->id;
        }
        $serie->series_categories()->sync($categoryIds);

        // Update PostTags
        $genreNames = explode(',', $request->input('genre_id'));
        $genreIds = [];
        foreach ($genreNames as $genreName) {
            $genre = Genre::firstOrCreate(['name' => trim($genreName)]);
            $genre->slug = Str::slug($genre->name);
            $genre->type = 'serie';
            $genre->save();
            $genreIds[] = $genre->id;
        }
        $serie->series_genres()->sync($genreIds);

        // Update PostTags
        $castNames = explode(',', $request->input('cast_id'));
        $castIds = [];
        foreach ($castNames as $castName) {
            $cast = Cast::firstOrCreate(['name' => trim($castName)]);
            $cast->slug = Str::slug($cast->name);
            $cast->save();
            $castIds[] = $cast->id;
        }
        $serie->casts()->sync($castIds);

        $notification = array(
            'message' => 'Serie Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('series')->with($notification);
    }// End Method

    public function SerieDestroy($id)
    {
        $serie = Product::findOrFail($id);
        $imagePath = public_path('upload/product_images/' . $serie->photo);
        if (file_exists($imagePath) && is_file($imagePath)) {
            unlink($imagePath);
        }

        $serie->delete();

        $notification = array(
            'message' => 'Serie Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('series')->with($notification);
    }// End Method
}
