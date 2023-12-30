@section('content')

    <form method="post" enctype="multipart/form-data">

        @csrf
        @method($post->id ? 'PATCH' : 'POST')

        <div class="mb-3">
            <label class="form-label">Titre</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $post->title) }}">
            @error('title')
                {{ $message }}
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Contenu</label>
            <textarea type="text" name="content" class="form-control">{{ old('content', $post->content) }}</textarea>
            @error('content')
                {{ $message }} 
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" name="image" class="form-control">
            @error('image')
                {{ $message }} 
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Catégorie</label>
            <select class="form-control" name="category_id">
                <option selected>Sélectionner une catégorie</option>

                @foreach ($categories as $category)
                    <option @selected(old('category_id', $post->category_id) == $category->id) value="{{ $category->id }}">{{ $category->name }}</option> 
                @endforeach
                
            </select>
            @error('category_id')
                {{ $message }} 
            @enderror
        </div>
        @php
            $tagsIds = $post->tags()->pluck('id');
        @endphp
        <div class="mb-3">
            <label class="form-label">Tags</label>
            <select class="form-control" name="tags[]" multiple>

                @foreach ($tags as $tag)
                    <option @selected($tagsIds->contains($tag->id)) value="{{ $tag->id }}">{{ $tag->name }}</option> 
                @endforeach
                
            </select>
            @error('tags')
                {{ $message }} 
            @enderror
        </div>

        @if ($post->id)
            <button type="submit" class="btn btn-warning btn-block">Modifier</button>
        @else
            <button type="submit" class="btn btn-primary btn-block">Créer</button> 
        @endif

    </form>

@endsection