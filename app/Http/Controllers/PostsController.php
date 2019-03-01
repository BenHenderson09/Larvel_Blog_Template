<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Storage;

use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    private $postConstraints = [
        'title' => 'required|min:5|max:150',
        'body' => 'required',
        'cover_image' => 'nullable|image|max:1999' // Set to 1999 kb because apache defaults to max upload sizes at 2mb
    ];

    /**
     *  Creates a new controller instance.
     *  The `auth` middleware redirects guests to the login page, unless they are accessing
     *  a page that has been marked to be excluded from the middleware.
     * 
     *  @return void
     */
    public function __construct(){
        $this->middleware('auth', ['except'=>['index', 'show']]);
    }

    /**
     * Display a listing of the resource. (All posts)
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        return view('pages.posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new post.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.posts.create');
    }

    /**
     * Store a newly created post in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*  If the requirements are not met, the user will be sent back to
            the location the request was sent from, and an `$errors` variable will
            be set.
        */ 
        $this->validate($request, $this->postConstraints);

        $coverImageFilename;

        if ($request->hasFile('cover_image')){
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            $filename = explode('.', $filenameWithExt)[0];
            $extension = explode('.', $filenameWithExt)[1]; 

            // Format as unique filename
            $coverImageFilename = uniqid($filename, true) . '.' . $extension;
        
            /**
             * Store the image. This actually saves the file to `storage/app/public/cover_images`. This directory
             * is not publicly accessible therefore we must run `php artiasn storage:link` to make a publicly
             * accessible `symlink` (symbolic link) in the public directory.
             * 
             * This means that if we type in our browser `blog.me/storage/cover_images/<image name>.jpg` we get
             * the image. It goes like this: public->storage(symlink)->cover_images->filename.jpg
             */
            $request->file('cover_image')->storeAs('public/cover_images', $coverImageFilename);
        }
        else {
            $coverImageFilename = 'noimage.jpg';
        }        

        $post = new Post();
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->cover_image = $coverImageFilename;
        $post->user_id = auth()->user()->id;
        $post->save();

        return redirect('/posts')->with('success', 'Post Created Successfully');
    }

    /**
     * Display one specific post.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('pages.posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified post.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        if (empty($post)){
            return redirect()->back()->with('error', 'Post not found');
        }

        if ($post->user_id != auth()->user()->id){
            return redirect(route('posts.index'))->with('error', 'Unauthorized access: You do not own this post');
        }

        return view('pages.posts.edit')->with('post', $post);
    }

    /**
     * Update the specified post in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, $this->postConstraints);

        $post = Post::find($id);

        // If the current user is not the post author
        if ($post->user_id != auth()->user()->id) {
            return redirect(route('posts.index'))->with('error', 'Unauthorized access: You do not own this post');
        }

        $coverImageFilename;

        if ($request->hasFile('cover_image')){
            
            // Delete the old image
            if ($post->cover_image != 'noimage.jpg'){
                Storage::delete('public/cover_images/' . $post->cover_image);
            }

            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            $filename = explode('.', $filenameWithExt)[0];
            $extension = explode('.', $filenameWithExt)[1]; 

            // Format as unique filename
            $coverImageFilename = uniqid($filename, true) . '.' . $extension;
    
            // Save image
            $request->file('cover_image')->storeAs('public/cover_images', $coverImageFilename);
        }
        else {
            $coverImageFilename = 'noimage.jpg';
        }  

        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->cover_image = $coverImageFilename;
        $post->save();

        return redirect("/posts/{$id}")->with('success', 'Post Updated Successfully');
    }

    /**
     * Remove the specified post from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        if (empty($post)){
            return redirect(route('posts.index'))->with('error', 'Post not found');
        }

        if ($post->user_id != auth()->user()->id){
            return redirect(route('posts.index'))->with('error', 'Unauthorized access: You do not own this post');
        }

        // Delete cover image
        if ($post->cover_image != 'noimage.jpg'){
            Storage::delete('public/cover_images/' . $post->cover_image);
        }

        $post->delete();
        return redirect('/posts')->with('success', 'Post Deleted Successfully');
    }
}
