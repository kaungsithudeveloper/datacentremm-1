<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Backend\Blog;
use Session;
use Image;
use Carbon\Carbon;
use App\Models\Backend\PostCategorie;
use App\Models\Backend\PostTags;
use App\Models\Backend\PostComment;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Backend\Genre;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Blog::with('categories', 'tags')->latest()->get();
        $activePost = Blog::where('status', 1)->latest()->get();
        $inActivePost = Blog::where('status', 0)->latest()->get();
        return view('backend.blogs.blog_index',compact('posts','activePost','inActivePost'));
    }// End Method

    public function ActivePost()
    {
        Session::put('page', 'blogs.active');
        $activePost = Blog::where('status', 1)->latest()->get();
        return view('backend.blogs.blog_active', compact('activePost'));
    }// End Method

    public function InactivePost()
    {
        Session::put('page', 'blogs.inactive');
        $inActivePost = Blog::where('status', 0)->latest()->get();
        return view('backend.blogs.blog_inactive', compact('inActivePost'));
    }// End Method

    public function PostInactive($id)
    {

        Blog::findOrFail($id)->update(['status' => 0]);
        $notification = array(
            'message' => 'Product Inactive',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }// End Method

    public function PostActive($id)
    {

        Blog::findOrFail($id)->update(['status' => 1]);
        $notification = array(
            'message' => 'Product Active',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }// End Method

    public function create()
    {
        $category = PostCategorie::latest()->get();
        return view('backend.blogs.post_create',compact('category'));
    }// End Method

    public function store(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'title' => 'required|string',
            'description' => 'required',
            'post_category_id' => 'nullable|string',
            'post_tag_id' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $blog = new Blog();
        $blog->title = $validatedData['title'];
        $blog->post_slug = strtolower(str_replace(' ', '-', $request->input('title')));
        $blog->description = $validatedData['description'];
        $blog->user_id = auth()->user()->id;
        $blog->status = 1;

        if ($request->file('photo')) {
            $image = $request->file('photo');

            // Generate a unique name for the image
            $filename = date('YmdHi') . '.' . $image->getClientOriginalExtension();

            // Save the original image to the storage directory
            $image->move(public_path('upload/blog_images'), $filename);

            // Delete the old image (if it exists)
            if (file_exists(public_path('upload/blog_images/' . $blog->photo))) {
                @unlink(public_path('upload/blog_images/' . $blog->photo));
            }

            $blog->photo = $filename;
        }

        $blog->save();

        if (!empty($validatedData['post_category_id'])) {
            $categoryNames = explode(',', $validatedData['post_category_id']);
            foreach ($categoryNames as $categoryName) {
                $category = PostCategorie::firstOrCreate(['name' => trim($categoryName)]);
                $category->slug = Str::slug($category->name); // Generate slug for the category name
                $category->save();
                $blog->categories()->attach($category->id);
            }
        }

        if (!empty($validatedData['post_tag_id'])) {
            $tagNames = explode(',', $validatedData['post_tag_id']);

            foreach ($tagNames as $tagName) {
                $tagName = trim($tagName);
                $tag = PostTags::firstOrCreate(['name' => $tagName]);
                $tag->slug = Str::slug($tag->name); // Generate slug for the tag name
                $tag->save();

                // Check if the tag is already attached to the blog post
                if (!$blog->tags->contains($tag->id)) {
                    $blog->tags()->attach($tag->id);
                }
            }
        }

        return redirect()->route('blogs')->with('success', 'Post created successfully.');
    }// End Method

    public function edit($id)
    {
        $blog = Blog::find($id);
        $categories = $blog->categories;
        $tags = $blog->tags;
        return view('backend.blogs.post_edit', compact('id', 'blog', 'categories', 'tags'));
    }// End Method

    public function update(Request $request)
    {
        $id = $request->id;
        $post = Blog::find($id);
        $post->title = $request->title;
        $post->description = $request->description;
        $post->post_slug = strtolower(str_replace(' ', '-', $request->title));

        if ($request->file('photo')) {
            $image = $request->file('photo');

            // Generate a unique name for the image
            $filename = date('YmdHi') . '.' . $image->getClientOriginalExtension();

            // Save the original image to the storage directory
            $image->move(public_path('upload/blog_images'), $filename);

            // Delete the old image (if it exists)
            if (file_exists(public_path('upload/blog_images/' . $blog->photo))) {
                @unlink(public_path('upload/blog_images/' . $blog->photo));
            }
            $post->photo = $filename;
        }

        $post->save();

        // Update PostCategories
        $categoryNames = explode(',', $request->input('post_category_id'));
        $categoryIds = [];
        foreach ($categoryNames as $categoryName) {
            $category = PostCategorie::firstOrCreate(['name' => trim($categoryName)]);
            $category->slug = Str::slug($category->name); // Generate slug for the category name
            $category->save();
            $categoryIds[] = $category->id;
        }
        $post->categories()->sync($categoryIds);

        // Update PostTags
        $tagNames = explode(',', $request->input('post_tag_id'));
        $tagIds = [];
        foreach ($tagNames as $tagName) {
            $tag = PostTags::firstOrCreate(['name' => trim($tagName)]);
            $tag->slug = Str::slug($tag->name); // Generate slug for the tag name
            $tag->save();
            $tagIds[] = $tag->id;
        }
        $post->tags()->sync($tagIds);

        $notification = array(
            'message' => 'Post Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('blogs')->with($notification);
    }// End Method

    public function destroy($id)
    {
        $post = Blog::findOrFail($id);

        // Get the file path for the image
        $imagePath = public_path('upload/blog_images/' . $post->photo);

        if (file_exists($imagePath) && is_file($imagePath)) {
            // Delete the image file
            unlink($imagePath);
        }

        // Delete the blog post
        $post->delete();

        $notification = array(
            'message' => 'Post Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('blogs')->with($notification);
    }// End Method

    public function detail($id)
    {
        $blog = Blog::find($id);
        $posts = Blog::latest()->take(12)->get();
        $categories = $blog->categories;
        $tags = $blog->tags;
        $comments = $blog->comments;

        return view('backend.blogs.blog_detail', compact('id', 'blog', 'categories', 'tags', 'comments', 'posts'));
    }// End Method

    ////////// Post Category ///////////

    public function PostCategoryIndex()
    {
        $postcategories = PostCategorie::latest()->get();
        return view ('backend.blogs.post_category_add', compact('postcategories'));

    }// End Method

    public function PostCategoryStore(Request $request)
    {
        // Validate user input
        $validator = validator($request->all(), [
            'name' => 'required|string|unique:post_categories,name',
        ],
        [
            'name.unique' => 'The category name has already been taken.',    ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput(); // Redirect back with errors and input repopulation
        }

        $postcategory = new PostCategorie;
        $postcategory->name = $request->input('name'); // Retrieve and sanitize input
        $postcategory->slug = strtolower(str_replace(' ', '-', $request->input('name')));
        $postcategory->save();


        $notification = array(
            'message' => 'Post Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('posts.categories')->with($notification);
    }// End Method

    public function PostCategoryEdit($id)
    {
        $postcategory = PostCategorie::findOrFail($id);
        $postcategories = PostCategorie::latest()->get();
        return view ('backend.blogs.post_category_edit', compact( 'postcategory' ,'postcategories'));
    }// End Method

    public function PostCategoryUpdate(Request $request)
    {
        // Validate user input
        $validator = validator($request->all(), [
            'name' => 'required|string|unique:post_categories,name',
        ],
        [
            'name.unique' => 'The category name has already been taken.',    ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput(); // Redirect back with errors and input repopulation
        }

        $id = $request->id;
        $postcategory = PostCategorie::find($id);
        $postcategory->name = $request->input('name'); // Retrieve and sanitize input
        $postcategory->slug = strtolower(str_replace(' ', '-', $request->input('name')));
        $postcategory->save();

        $notification = array(
            'message' => 'Post Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('posts.categories')->with($notification);
    }// End Method

    public function PostCategoryDestroy($id)
    {
        $postcategory = PostCategorie::findOrFail($id);
        $postcategory->delete();

        $notification = array(
            'message' => 'Post Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('posts.categories')->with($notification);
    }// End Method

    ////////// Post Tag ///////////
    public function PostTagIndex()
    {
        $posttags = PostTags::latest()->get();
        return view ('backend.blogs.post_tag_add', compact('posttags'));

    }// End Method

    public function PostTagStore(Request $request)
    {
        // Validate user input
        $validator = validator($request->all(), [
            'name' => 'required|string|unique:post_tags,name',
        ],
        [
            'name.unique' => 'The tags name has already been taken.',    ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput(); // Redirect back with errors and input repopulation
        }

        $posttag = new PostTags;
        $posttag->name = $request->input('name'); // Retrieve and sanitize input
        $posttag->slug = strtolower(str_replace(' ', '-', $request->input('name')));
        $posttag->save();


        $notification = array(
            'message' => 'Post Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('posts.tags')->with($notification);
    }// End Method

    public function PostTagEdit($id)
    {
        $posttag = PostTags::findOrFail($id);
        $posttags = PostTags::latest()->get();
        return view ('backend.blogs.post_tag_edit', compact( 'posttag' ,'posttags'));
    }// End Method

    public function PostTagUpdate(Request $request)
    {
        // Validate user input
        $validator = validator($request->all(), [
            'name' => 'required|string|unique:post_categories,name',
        ],
        [
            'name.unique' => 'The category name has already been taken.',    ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput(); // Redirect back with errors and input repopulation
        }

        $id = $request->id;
        $tag = PostTags::find($id);
        $tag->name = $request->input('name'); // Retrieve and sanitize input
        $tag->slug = strtolower(str_replace(' ', '-', $request->input('name')));
        $tag->save();

        $notification = array(
            'message' => 'Post Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('posts.tags')->with($notification);
    }// End Method

    public function PostTagDestroy($id)
    {
        $posttag = PostTags::findOrFail($id);
        $posttag->delete();

        $notification = array(
            'message' => 'Post Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('posts.tags')->with($notification);
    }// End Method





    ////////// Frontend Blog //////////
    public function DCindex()
    {
        $blogs = Blog::with('categories', 'tags')->latest()->take(12)->get();
        $genres = Genre::all();
        $posts = Blog::where('status', 1)->latest()->paginate(9);
        return view('frontend.blogs.blog_index',compact('blogs','genres','posts'));
    }// End Method

    public function DCdetail($id)
    {
        $blog = Blog::find($id);
        $genres = Genre::all();
        $categories = $blog->categories;
        $tags = $blog->tags;
        $comments = $blog->comments;
        $posts = Blog::where('status', 1)->latest()->paginate(6);

        return view('frontend.blogs.blog_detail', compact('id', 'blog','posts','genres', 'categories', 'tags', 'comments' ));
    }// End Method

    public function DCUserPost($id)
    {
        $user = User::find($id);
        $blogs = Blog::where('user_id', $user->id)->where('status', 1)->latest()->get();
        $genres = Genre::all();
        $posts = Blog::where('user_id', $user->id)->where('status', 1)->latest()->paginate(9);

        return view('frontend.blogs.blog_user_post', compact('user', 'blogs', 'genres','posts'));
    }// End Method

    public function DCPostCommentStore(Request $request)
    {
        $data = $request->validate([
            'content' => 'required',
            'blog_id' => 'required|exists:blogs,id', // Replace 'blogs' with the correct table name
        ]);

        $data['user_id'] = Auth::user()->id;
        PostComment::create($data);

        $notification = array(
            'message' => 'Post Updated Successfully',
            'alert-type' => 'success'
        );

        return back()->with($notification);
    }// End Method

    public function DCPostCategory($id)
    {
        $category = PostCategorie::find($id);
        $blogs = Blog::with('categories', 'tags')->where('status', 1)->latest()->take(12)->get();
        $posts = $category->blogs()->where('status', 1)->latest()->paginate(9);
        $genres = Genre::all();

        return view('frontend.blogs.blog_post_category', compact('category', 'posts', 'blogs','genres'));
    }// End Method

    public function DCPostTag($id)
    {
        $tag = PostTags::find($id);
        $posts = $tag->blogs()->where('status', 1)->latest()->paginate(9);
        $blogs = Blog::with('categories', 'tags')->latest()->take(12)->get();
        $genres = Genre::all();

        return view('frontend.blogs.blog_post_tag', compact('tag', 'posts', 'blogs','post','genres'));
    }// End Method

    public function DCPostDate($date)
    {
        $blogs = Blog::with('categories', 'tags')->latest()->take(12)->get();
        $posts = Blog::whereDate('created_at', $date)->where('status', 1)->latest()->paginate(9);
        $genres = Genre::all();

        return view('frontend.blogs.blog_post_date', compact('posts','blogs','genres'));
    }// End Method

}
