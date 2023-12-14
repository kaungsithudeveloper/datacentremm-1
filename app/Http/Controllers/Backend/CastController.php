<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Backend\Cast;
use Illuminate\Support\Facades\Validator;
use Image;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CastController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function CastIndex()
    {
        $casts = Cast::all();
        return view('backend.casts.cast_index',compact('casts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function CastCreate()
    {
        return view('backend.casts.cast_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function CastStore(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255|unique:permissions',
            'gender' => 'required',
            'birthday' => 'required',
            'biography' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:1024',
        ];

        $customMessages = [
            'name.unique' => 'The name has already been taken.',
        ];

        $validator = Validator::make($request->all(), $rules, $customMessages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->file('photo')) {
            $image = $request->file('photo');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $imagePath = 'upload/cast_images/' . $name_gen;
            Image::make($image)->resize(300, 450)->save(public_path($imagePath));
            $imageName = $name_gen;
        }

        $cast = Cast::create([
            'name' => $request->name,
            'gender' => $request->gender,
            'birthday' => $request->birthday,
            'biography' => $request->biography,
            'slug' => strtolower(str_replace(' ', '-', $request->name)),
            'photo' => $imageName,

        ]);

        $notification = [
            'message' => 'Cast Create Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('casts')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function CastEdit($id)
    {
        $cast = Cast::find($id);
        return view('backend.casts.cast_edit', compact('cast'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function CastUpdate(Request $request)
    {

        $rules = [
            'name' => 'required|string|max:255|unique:permissions',
            'gender' => 'required',
            'birthday' => 'required',
            'biography' => 'required',
        ];

        $customMessages = [
            'name.unique' => 'The name has already been taken.',
        ];

        $validator = Validator::make($request->all(), $rules, $customMessages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $id = $request->id;
        $cast = Cast::find($id);
        $cast->name = $request->name;
        $cast->gender = $request->gender;
        $cast->birthday = $request->birthday;
        $cast->biography = $request->biography;
        $cast->slug = strtolower(str_replace(' ', '-', $request->name));

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $imagePath = 'upload/cast_images/' . $imageName;
            Image::make($image)->resize(300, 450)->save(public_path($imagePath));
            $cast->photo = $imageName;
            if ($cast->photo) {
                Storage::delete('upload/cast_images/' . $cast->photo);
            }
        }

        $cast->save();

        $notification = array(
            'message' => 'Cast Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('casts')->with($notification);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function CastDestroy($id)
    {

        $cast = Cast::findOrFail($id);
        if (!is_null($cast)) {
            $cast->delete();
        }

         $notification = array(
            'message' => 'Cast Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }// End Mehtod
}
