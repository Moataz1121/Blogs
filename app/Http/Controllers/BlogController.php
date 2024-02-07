<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['create']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();

        return view('theme.blogs.create' , compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogRequest $request)
    {
        $data = $request->validated();
        // how to upload image
        //get the image first
        $image = $request->image; // اسم الصوره هنا معتمد علي اسمها في الفورم الي انت عملتها
        //change name of image to be unquie
        $newImageName = time() . '-' . $image->getClientOriginalName(); // this is the name of image
        //move to my projecr
        $image->storeAs('blogs' , $newImageName , 'public');
        //save new name to database
        $data['image'] = $newImageName;
        $data['user_id'] = Auth::user()->id;
        //send and save the data in database
        Blog::create($data);
        return back()->with('blogCreateStatus' , 'Your blog created successfuly');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return view('theme.blog' , compact('blog')) ;

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        if($blog->user_id == Auth::user()->id){
             $categories = Category::get();
        return view('theme.blogs.edit' , compact('categories' , 'blog'));
        }
       abort(403);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        if($blog->user_id == Auth::user()->id){
            $data = $request->validated();

            if($request->hasFile('image')){
                //delete old image
                Storage::delete("public/blogs/$blog-<img");
                // how to upload image
            //get the image first
            $image = $request->image; // اسم الصوره هنا معتمد علي اسمها في الفورم الي انت عملتها
            //change name of image to be unquie
            $newImageName = time() . '-' . $image->getClientOriginalName(); // this is the name of image
            //move to my projecr
            $image->storeAs('blogs' , $newImageName , 'public');
            //save new name to database
            $data['image'] = $newImageName;
            }
          //  dd($request->all());

            $blog->update($data);
          //send and save the data in database
            return back()->with('blogUpdateStatus' , 'Your blog created successfuly');
        }

        abort(403);
      }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        if($blog->user_id == Auth::user()->id){

        Storage::delete("public/blogs/$blog-<img");
        $blog->delete();
        return back()->with('blogDeleteStatus' , 'Your blog deleted successfuly');

        }
    }
    public function myBlogs(){
        if(Auth::check()){
           $blogs = Blog::where('user_id',Auth::user()->id)->paginate(10);
        return view('theme.blogs.my-blogs' , compact('blogs'));
        }
        abort(403);

    }
}
