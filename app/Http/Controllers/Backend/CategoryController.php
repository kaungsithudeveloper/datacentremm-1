<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Category;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function CategoryIndex()
    {
        $categories = Category::get();
        return view('backend.categories.categories_index',compact('categories'));
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
    public function CategoryStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255', 'unique:categories,name,'],

        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $category = new Category();
        $category->name = $request->name;
        $category->slug = strtolower(str_replace(' ', '-', $request->name));
        $category->type = $request->type;
        $category->save();

        $notification = [
            'message' => 'Category Created Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('categories')->with($notification);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function CategoryEdit($id)
    {
        $category = Category::find($id);
        $categories = Category::get();
        return view('backend.categories.categories_edit', compact('category','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function CategoryUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255', 'unique:categories,name,'],

        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $id = $request->id;
        $category = Category::find($id);
        $category->name = $request->name;
        $category->slug = strtolower(str_replace(' ', '-', $request->name));
        $category->type = $request->type;
        $category->save();

        $notification = [
            'message' => 'category Update Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('categories')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function CategoryDestroy($id)
    {
        $category = Category::findOrFail($id);
        if (!is_null($category)) {
            $category->delete();
        }

         $notification = array(
            'message' => 'Genre Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('categories')->with($notification);
    }
}
