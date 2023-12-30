@extends('base')

@section('title', 'Accueil du blog')
 
@section('content')

    <h1>Mon blog</h1>

    {{-- @foreach ($posts as $post)
        <article>
            <h1>{{ $post->title }}</h1>
            <p class="small">
                @if ($post->category)
                    Catégorie : <strong>{{ $post->category?->name }}</strong>,
                @endif
                @if (!$post->tags->isEmpty())
                    Tags :
                    @foreach ($post->tags as $tag)
                        <span class="badge bg-secondary">{{ $tag->name }}</span>
                    @endforeach
                @endif
            </p>
            <p>
                {{ $post->content }}
            </p>
            <p>
                <a href="{{ route('blog.show', ['slug' => $post->slug, 'post' => $post->id]) }}" class="btn btn-primary">Lire suite</a>
            </p>
        </article>
    @endforeach --}}

    
        <div class="row">

            @foreach ($posts as $post)

                <div class="col-md-4 mb-4">
                    <div class="card carte">
                        @if ($post->image)
                            <img src="{{ $post->imageUrl() }}" class="card-img-top custom-card-image img-fluid" alt="Image" style="height: 200px;">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title"><b>{{ $post->title }}</b></h5>
                            <p class="small">
                                @if ($post->category)
                                    Catégorie : <strong>{{ $post->category?->name }}</strong>,
                                @endif
                                @if (!$post->tags->isEmpty())
                                    Tags :
                                    @foreach ($post->tags as $tag)
                                        <span class="badge bg-secondary">{{ $tag->name }}</span>
                                    @endforeach
                                @endif
                            </p>
                            <div class="d-flex justify-content-between">
                                <p>
                                    {{ $post->content }}
                                </p>
                                <div>
                                    <a href="{{ route('blog.show', ['slug' => $post->slug, 'post' => $post->id]) }}" class="btn btn-primary">Lire suite</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach

        </div>
   

    {{ $posts->links() }}
@endsection