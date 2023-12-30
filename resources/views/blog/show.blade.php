@extends('base')

@section('title', $post->title)
 
@section('content')

    <article>
        {{-- <h1>Titre : {{ $post->title }}</h1>
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
        <p>Description : {{ $post->content }}</p> --}}
        
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
                            <a href="{{ route('blog.edit', ['post' => $post->id]) }}" class="btn btn-warning">Modifier</a>
                            <a href="{{ route('blog.show', ['slug' => $post->slug, 'post' => $post->id]) }}" class="btn btn-danger">Supprimer</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </article>
   
@endsection