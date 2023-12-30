<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormPostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index (): View {

        return view('blog.index', [
           'posts' => Post::with('tags', 'category')->paginate(3),
        ]);
        
    }

    public function show (string $slug, Post $post): RedirectResponse | View {
        //dd($post);
        //$post = Post::findOrFail($post);

        if ($post->slug != $slug) {
            return to_route('blog.show', ['slug' => $post->slug, 'id' => $post->id]);
        }

        return view('blog.show', [
            'post' => $post,
        ]);
    }

    public function create () {
        $post = new Post();

        return view('blog.create', [
            'post' => $post,
            'categories' => Category::select('id', 'name')->get(),
            'tags' => Tag::select('id', 'name')->get(),
        ]);
    }

    public function store (FormPostRequest $request) {
        $post = new Post();
        $post = Post::create($this->extractData($post, $request));
        $post->tags()->sync($request->validated('tags'));

        return redirect()->route('blog.show', ['slug' => $post->slug, 'post' => $post->id])->with(['message' => ['type' => 'success', 'text' => 'L\'article a été sauvegardé.']]);
    }

    public function edit (Post $post) {
        return view('blog.edit', [
            'post' => $post,
            'categories' => Category::select('id', 'name')->get(),
            'tags' => Tag::select('id', 'name')->get(),
        ]);
    }

    public function update (Post $post, FormPostRequest $request) {
        $post->update($this->extractData($post, $request));
        $post->tags()->sync($request->validated('tags'));

        return redirect()->route('blog.show', ['slug' => $post->slug, 'post' => $post->id])->with(['message' => ['type' => 'success', 'text' => 'L\'article a été bien modifié.']]);
    }

    private function extractData (Post $post, FormPostRequest $request) : array { 
        $data = $request->validated();
        /** @var UploadedFile | null $image */
        $image = $request->validated('image');
        if ($image === null || $image->getError()) {
            return $data;
        }
       
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }
        $data['image'] = $image->store('blog', 'public');
        return $data;
    }
}