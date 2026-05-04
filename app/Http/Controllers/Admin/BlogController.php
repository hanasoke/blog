<?php 

namespace App\Http\Controllers\Admin; 

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use App\Blog;
use App\Genre;
use App\Source;
use App\AccessBlog;
use App\Member;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class BlogController extends Controller 
{
    public function blogs_data() {
        $blogs = Blog::with(['genre', 'source', 'user'])->orderBy('created_at', 'desc')->get();

        return view('pages.admin.blog.blogs_data', compact('blogs'));
    }

    public function add_blog() {
        $genres = Genre::orderBy('name')->get();
        $sources = Source::orderBy('name')->get();
        return view('pages.admin.blog.add_blog', compact('genres', 'sources'));
    }

    public function store_blog(Request $request)
    {
        // Validation rules 
        $rules = [
            'title' => 'required|string|max:255',
            'genre_id' => 'required|exists:genres,id',
            'source_id' => 'required|exists:sources,id',
            'thumbnail' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'image_2' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'image_3' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'required|string|min:10',
        ];

        // Custom error messages 
        $messages = [
            'title.required' => 'Blog title is required.',
            'title.max' => 'Blog title cannot exceed 255 characters.',
            'genre_id.required' => 'Please select a genre.',
            'genre_id.exists' => 'Selected genre is invalid.',
            'source_id.required' => 'Please select a source.',
            'source_id.exists' => 'Selected source is invalid.',
            'thumbnail.required' => 'Thumbnail image is required.',
            'thumbnail.image' => 'Thumbnail must be an image file.',
            'thumbnail.mimes' => 'Thumbnail must be a JPG, JPEG, or PNG file.',
            'thumbnail.max' => 'Thumbnail size must not exceed 2MB.',
            'image_2.image' => 'Image 2 must be an image file.',
            'image_2.mimes' => 'Image 2 must be a JPG, JPEG, or PNG file.',
            'image_2.max' => 'Image 2 size must not exceed 2MB.',
            'image_3.image' => 'Image 3 must be an image file.',
            'image_3.mimes' => 'Image 3 must be a JPG, JPEG, or PNG file.',
            'image_3.max' => 'Image 3 size must not exceed 2MB.',
            'description.required' => 'Description is required.',
            'description.min' => 'Description must be at least 10 characters.',
        ];

        // Validate request 
        $this->validate($request, $rules, $messages);

        // Handle file uploads 
        $thumbnailPath = $request->file('thumbnail')->store('blogs/thumbnails', 'public');

        $image2Path = null;
        if($request->hasFile('image_2')) {
            $image2Path = $request->file('image_2')->store('blogs/images', 'public');
        }

        $image3Path = null;
        if($request->hasFile('image_3')) {
            $image3Path = $request->file('image_3')->store('blogs/images', 'public');
        }

        // Create blog 
        $blog = Blog::create([
            'title' => $request->title,
            'genre_id' => $request->genre_id,
            'source_id' => $request->source_id,
            'thumbnail' => $thumbnailPath,
            'image_2' => $image2Path,
            'image_3' => $image3Path,
            'description' => $request->description,
            'user_id' => Auth::id(),
        ]);

        // Redirect with success message 
        return redirect()->route('blogs_data')
                        ->with('success', 'Blog "' . $blog->title . '" has been successfully added!');
    }

    public function edit_blog($id) {
        $blog = Blog::findOrFail($id);
        $genres = Genre::orderBy('name')->get();
        $sources = Source::orderBy('name')->get();

        return view('pages.admin.blog.edit_blog', compact('blog', 'genres', 'sources'));
    }

    public function update_blog(Request $request, $id) 
    {
        $blog = Blog::findOrFail($id);

        // Validation rules 
        $rules = [
            'title' => 'required|string|max:255',
            'genre_id' => 'required|exists:genres,id',
            'source_id' => 'required|exists:sources,id',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'image_2' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'image_3' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'required|string|min:10',
        ];

        // Custom error messages
        $messages = [
            'title.required' => 'Blog title is required.',
            'title.max' => 'Blog title cannot exceed 255 characters.',
            'genre_id.required' => 'Please select a genre.',
            'genre_id.exists' => 'Selected genre is invalid.',
            'source_id.required' => 'Please select a source.',
            'source_id.exists' => 'Selected source is invalid.',
            'thumbnail.image' => 'Thumbnail must be an image file.',
            'thumbnail.mimes' => 'Thumbnail must be a JPG, JPEG, or PNG file.',
            'thumbnail.max' => 'Thumbnail size must not exceed 2MB.',
            'image_2.image' => 'Image 2 must be an image file.',
            'image_2.mimes' => 'Image 2 must be a JPG, JPEG, or PNG file.',
            'image_2.max' => 'Image 2 size must not exceed 2MB.',
            'image_3.image' => 'Image 3 must be an image file.',
            'image_3.mimes' => 'Image 3 must be a JPG, JPEG, or PNG file.',
            'image_3.max' => 'Image 3 size must not exceed 2MB.',
            'description.required' => 'Description is required.',
            'description.min' => 'Description must be at least 10 characters.',
        ];

        // Validate request 
        $this->validate($request, $rules, $messages);

        // Handle thumbnail upload (if new file is uploaded)
        if($request->hasFile('thumbnail')) {
            // Delete old thumbnail 
            if($blog->thumbnail && Storage::disk('public')->exists($blog->thumbnail)) {
                Storage::disk('public')->delete($blog->thumbnail);
            }
            $thumbnailPath = $request->file('thumbnail')->store('blogs/thumbnails', 'public');
            $blog->thumbnail = $thumbnailPath;
        }

        // Handle image_2 upload (if new file is uploaded)
        if($request->hasFile('image_2')) {
            // Delete old image_2 if exists 
            if($blog->image_2 && Storage::disk('public')->exists($blog->image_2)) {
                Storage::disk('public')->delete($blog->image_2);
            }
            $image2Path = $request->file('image_2')->store('blogs/images', 'public');
            $blog->image_2 = $image2Path;
        }

        // Handle image_3 upload (if new file is uploaded)
        if($request->hasFile('image_3')) {
            // Delete old image_3 if exists 
            if($blog->image_3 && Storage::disk('public')->exists($blog->image_3)) {
                Storage::disk('public')->delete($blog->image_3);
            }
            $image3Path = $request->file('image_3')->store('blogs/images', 'public');
            $blog->image_3 = $image3Path;
        }

        // Update blog data 
        $blog->title = $request->title;
        $blog->genre_id = $request->genre_id;
        $blog->source_id = $request->source_id;
        $blog->description = $request->description;
        $blog->save();

        // Redirect with success message 
        return redirect()->route('blogs_data') 
                        ->with('success', 'Blog "' . $blog->title . '" has been successfully updated!');
    }
    
    public function delete_blog($id)
    {
        $blog = Blog::findOrFail($id);
        $blogTitle = $blog->title;

        // Cek apakah blog masih memiliki access 
        if($blog->access) {
            return redirect()->route('blogs_data')
                            ->with('error', 'Blog "' . $blogTitle . '" cannot be deleted because it has an access level set. Please delete the access first!' );
        }

        // Delete files from storage 
        if($blog->thumbnail && Storage::disk('public')->exists($blog->thumbnail)) {
            Storage::disk('public')->delete($blog->thumbnail);
        }
        if($blog->image_2 && Storage::disk('public')->exists($blog->image_2)) {
            Storage::disk('public')->delete($blog->image_2);
        }
        if($blog->image_3 && Storage::disk('public')->exists($blog->image_3)) {
            Storage::disk('public')->delete($blog->image_3);
        }

        // Delete blog from database 
        $blog->delete();

        return redirect()->route('blogs_data')
                        ->with('success', 'Blog "' . $blogTitle . '" has been successfully deleted!');
    }

    public function access_blogs() 
    {
        $accessBlogs = AccessBlog::with(['blog', 'member'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.admin.access_blogs.index', compact('accessBlogs'));
    }

    public function add_access() 
    {
        // Get blogs that don't have access yet 
        $blogs = Blog::whereDoesntHave('access')
            ->orderBy('title')
            ->get();
        
        // Get all members (access levels)
        $members = Member::orderBy('price')->get();

        return view('pages.admin.access_blogs.add_access', compact('blogs', 'members'));
    }

    public function store_access(Request $request)
    {
        // Validation rules 
        $rules = [
            'blog_id' => [
                'required',
                'exists:blogs,id',
                Rule::unique('access_blogs', 'blog_id')->where(function ($query){
                    return $query->whereNotNull('blog_id');
                }),
            ],
            'member_id' => 'required|exists:members,id',
        ];

        // Custom error messages 
        $messages = [
            'blog_id.required' => 'Please select a blog.',
            'blog_id.exists' => 'Selected blog is invalid.',
            'blog_id.unique' => 'This blog already has an access level assigned.',
            'member_id.required' => 'Please select a member/access level.',
            'member_id.exists' => 'Selected member level is invalid.'
        ];

        // Validate request 
        $this->validate($request, $rules, $messages);

        // Get blog and member details 
        $blog = Blog::findOrFail($request->blog_id);
        $member = Member::findOrFail($request->member_id);

        // Create access 
        $accessBlog = AccessBlog::create([
            'blog_id' => $request->blog_id,
            'member_id' => $request->member_id,
        ]);

        // Redirect with success message 
        return redirect()->route('access_blogs')
            ->with('success', 'Access for blog "' . $blog->title . '" has been successfully set to ' . $member->name . ' level!');
    }  

    public function edit_access($id) 
    {
        $accessBlog = AccessBlog::with(['blog', 'member'])->findOrFail($id);

        // Get all members (access levels)
        $members = Member::orderBy('price')->get();

        return view('pages.admin.access_blogs.edit_access', compact('accessBlog', 'members'));
    }

    public function update_access(Request $request, $id)
    {
        $accessBlog = AccessBlog::findOrFail($id);

        // Validation rules 
        $rules = [
            'member_id' => 'required|exists:members,id',
        ];

        // Custom error messages 
        $messages = [
            'member_id.required' => 'Please select a member/access level.',
            'member_id.exists' => 'Selected member level is invalid.',
        ];

        // Validate request 
        $this->validate($request, $rules, $messages);

        $oldMember = $accessBlog->member;
        $newMember = Member::findOrFail($request->member_id);

        // Update access 
        $accessBlog->update([
            'member_id' => $request->member_id,
        ]);

        // Redirect with success message 
        return redirect()->route('access_blogs')
            ->with('success', 'Access for blog "' . $accessBlog->blog->title . '" has been updated from ' . $oldMember->name . ' to ' . $newMember->name . '!');
    }

    public function delete_access($id) 
    {
        $accessBlog = AccessBlog::with(['blog', 'member'])->findOrFail($id);
        $blogTitle = $accessBlog->blog->title;
        $memberName = $accessBlog->member->name;

        // Delete access 
        $accessBlog->delete();

        return redirect()->route('access_blogs')
            ->with('success', 'Access for blog "' . $blogTitle . '" (' . $memberName . ') has been successfully deleted!');
    }

    public function article_status() 
    {
        // Ambil semua blog berserta relasi genre, source, user, dan access 
        $blogs = Blog::with(['genre', 'source', 'user', 'access'])
                        ->orderBy('created_at', 'desc')
                        ->get();
        return view('pages.admin.article_status.index', compact('blogs'));
    }

}