<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.post.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        if ($request->hasFile('images')) {
            $file = $request->file('images');
            $filename = 'image' . time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/images'), $filename);

            $data['images'] = $filename; // Lưu đường dẫn ảnh vào database
        }

        Post::create($data);

        return redirect()->route('admin/post')->with('success', 'Thêm bài viết thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('admin.post.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('admin.post.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->all();

        if ($request->hasFile('images')) {
            $imagePath = public_path('storage/images/' . $post->images);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }

            $file = $request->file('images');
            $filename = 'image' . time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/images'), $filename);

            $data['images'] = $filename; // Lưu đường dẫn ảnh vào database
        }

        $post->update($data);

        return redirect()->route('admin/post')->with('success', 'Cập nhật bài viết thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // Xóa ảnh bìa bài viết
        $imagePath = public_path('storage/images/' . $post->images);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        // Trích xuất URL của ảnh từ nội dung bài viết
        preg_match_all('/<img.*?src=["\'](.*?)["\'].*?>/i', $post->contents, $matches);
        // Xóa ảnh trong nội dung bài viết
        if (!empty($matches[1])) {
            foreach ($matches[1] as $imageUrl) {
                $imageContentPath = str_replace(asset('storage/'), public_path('storage'), $imageUrl);
                File::delete($imageContentPath);
            }
        }

        $post->delete();

        return redirect()->route('admin/post')->with('success', 'Xóa bài viết thành công');
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $imagename = 'image' . time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('storage/images'), $imagename);
            $url = asset('storage/images/' . $imagename);
            
            return response()->json([
                'link' => $url, // Trả về đường dẫn ảnh để Froala hiển thị
            ]);
        }

        return response()->json(['error' => 'Không có ảnh được tải lên'], 400);
    }
}
